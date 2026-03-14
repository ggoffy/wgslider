<?php

declare(strict_types=1);

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgSlider module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package         wgSlider
 * @author          Goffy - Wedega.com - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 */

use Xmf\Request;
use XoopsModules\Wgslider;
use XoopsModules\Wgslider\{
    Common\Resizer,
    Constants
};

include __DIR__ . '/header.php';
$templateMain = 'wgslider_admin_image_editor.tpl';

$op         = Request::getString('op', 'list');
$imageId    = Request::getInt('id');
$start      = Request::getInt('start');
$limit      = Request::getInt('limit', $helper->getConfig('adminpager'));

$img_resize = Request::getInt('img_resize');

// get all objects/classes/vars needed for image editor
$imageClass = 0;
$imgCurrent = [];
if ('cropimage' === $op) {
    $imageId = Request::getInt('imageIdCrop');
}

$imageObj = $imageHandler->get($imageId);
$imgName = $imageObj->getVar('realname');
$imgPath = \WGSLIDER_UPLOAD_IMAGE_PATH . '/';
$imgUrl = \WGSLIDER_UPLOAD_IMAGE_URL  . '/';
$imgFinal = $imgPath . $imgName;
$imgTemp = \WGSLIDER_UPLOAD_PATH . '/temp/' . $imgName;

$imgCurrent['img_name'] = $imgName;
$imgCurrent['src'] = $imgUrl . $imgName;
$images = [];
// end: get all objects/classes/vars needed for image editor


// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet(\WGSLIDER_URL . '/assets/css/style.css');
$GLOBALS['xoTheme']->addStylesheet(\WGSLIDER_URL . '/assets/css/imageeditor.css');

// assign vars
$GLOBALS['xoopsTpl']->assign('wgslider_url', \WGSLIDER_URL);
$GLOBALS['xoopsTpl']->assign('wgslider_icon_url_16', \WGSLIDER_ICONS_URL . '/16');
$GLOBALS['xoopsTpl']->assign('wgslider_icon_url_32', \WGSLIDER_ICONS_URL . '/32');
$GLOBALS['xoopsTpl']->assign('wgslider_upload_url', \WGSLIDER_UPLOAD_URL);
$GLOBALS['xoopsTpl']->assign('wgslider_upload_path', \WGSLIDER_UPLOAD_PATH);
$GLOBALS['xoopsTpl']->assign('wgslider_image_editor', \WGSLIDER_URL . '/admin');
$GLOBALS['xoopsTpl']->assign('wgslider_upload_image_url', $imgUrl);
$GLOBALS['xoopsTpl']->assign('imgCurrent', $imgCurrent);
$GLOBALS['xoopsTpl']->assign('imageId', $imageId);
$GLOBALS['xoopsTpl']->assign('currentTime', '?' . time()); //add time to force reload image

// get config for images
$maxwidth = $helper->getConfig('maxwidth_image');
$maxheight = $helper->getConfig('maxheight_image');
$maxsize = $helper->getConfig('maxsize_image');
$mimetypes = $helper->getConfig('mimetypes_image');

switch ($op) {
    case 'cropimage':
        // save base64_image and resize to maxwidth/maxheight
        $base64_image_content = Request::getString('croppedImage');
        if (!\preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {
            \redirect_header('image.php?op=list&start=' . $start . '&limit=' . $limit, 2, _AM_WGSLIDER_INVALID_VALUE);
        }
        $mime = 'image/' . \strtolower($result[2]);
        if (!\in_array($mime, ['image/jpeg', 'image/png', 'image/gif'], true)) {
            \redirect_header('image.php?op=list&start=' . $start . '&limit=' . $limit, 2, _AM_WGSLIDER_INVALID_VALUE);
        }
        if (\is_file($imgTemp)) {
            \unlink($imgTemp);
        }
        $payload = \base64_decode(\str_replace($result[1], '', $base64_image_content), true);
        if (false === $payload || false === \file_put_contents($imgTemp, $payload)) {
            \redirect_header('image.php?op=list&start=' . $start . '&limit=' . $limit, 2, _AM_WGSLIDER_INVALID_VALUE);
        }

        $imgHandler                = new Resizer();
        $imgHandler->sourceFile    = $imgTemp;
        $imgHandler->endFile       = $imgTemp;
        $imgHandler->imageMimetype = $mime;
        $imgHandler->maxWidth      = $maxwidth;
        $imgHandler->maxHeight     = $maxheight;
        $ret                       = $imgHandler->resizeImage();

        break;
    case 'saveCrop':
        $uid = $xoopsUser instanceof \XoopsUser ? $xoopsUser->id() : 0;
        // save before created cropped image
        $imgRestore = $imgFinal . '.tmp';
        $ret = \rename($imgFinal, $imgRestore);
        if (!$ret) {
            \redirect_header('image.php?op=list&start=' . $start . '&limit=' . $limit, 2, _AM_WGSLIDER_ERROR_MOVE_FILE);
        }
        $ret = \rename($imgTemp, $imgFinal);
        if (!$ret) {
            //try to restore previous file
            $ret = \rename($imgRestore, $imgFinal);
            if ($ret) {
                \redirect_header('image.php?op=list&start=' . $start . '&limit=' . $limit, 2, _AM_WGSLIDER_ERROR_MOVE_FILE_RESTORED);
            } else {
                \redirect_header('image.php?op=list&start=' . $start . '&limit=' . $limit, 2, _AM_WGSLIDER_ERROR_MOVE_FILE);
            }
        }
        // delete copy for restore
        \unlink($imgRestore);
        // Set Vars
        $imageObj->setVar('submitter', $uid);
        // Insert Data
        if ($imageHandler->insert($imageObj, true)) {
            \redirect_header('image.php?op=list&start=' . $start . '&limit=' . $limit, 2, _AM_WGSLIDER_FORM_OK);
        }
        $GLOBALS['xoopsTpl']->assign('error', $imageObj->getHtmlErrors());

        break;

    case 'crophandler':
    default:
        $GLOBALS['xoTheme']->addStylesheet(\WGSLIDER_URL . '/assets/css/cropper.min.css');
        $GLOBALS['xoTheme']->addScript(\WGSLIDER_URL . '/assets/js/jquery-3.7.1.min.js');
        $GLOBALS['xoTheme']->addScript(\WGSLIDER_URL . '/assets/js/jquery-ui.min.js');
        $GLOBALS['xoTheme']->addScript(\WGSLIDER_URL . '/assets/js/cropper.min.js');
        $GLOBALS['xoTheme']->addScript(\WGSLIDER_URL . '/assets/js/cropper-main.js');

        $GLOBALS['xoopsTpl']->assign('image_path', $imgFinal);

        break;
}

include __DIR__ . '/footer.php';
