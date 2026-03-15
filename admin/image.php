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
 * @copyright    2026 XOOPS Project (https://xoops.org)
 * @license      GPL 2.0 or later
 * @package      wgslider
 * @author       Goffy - wedega - Email:webmaster@wedega.com - Website:https://wedega.com
 */

use Xmf\Request;
use XoopsModules\Wgslider;
use XoopsModules\Wgslider\Constants;
use XoopsModules\Wgslider\Common;

require __DIR__ . '/header.php';
// Get all request values
$op    = Request::getCmd('op', 'list');
$imgId = Request::getInt('id');
$start = Request::getInt('start');
$limit = Request::getInt('limit', $helper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

switch ($op) {
    case 'list':
    default:
        $GLOBALS['xoTheme']->addScript(\WGSLIDER_URL . '/assets/js/jquery-3.7.1.min.js');
        $GLOBALS['xoTheme']->addScript(\WGSLIDER_URL . '/assets/js/jquery-ui.js');
        $GLOBALS['xoTheme']->addScript(\WGSLIDER_URL . '/assets/js/sortable-images.js');
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'wgslider_admin_image.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('image.php'));
        $adminObject->addItemButton(\_AM_WGSLIDER_ADD_IMAGE, 'image.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $imageCount = $imageHandler->getCountImage();
        $imageAll = $imageHandler->getAllImage($start, $limit);
        $GLOBALS['xoopsTpl']->assign('image_count', $imageCount);
        $GLOBALS['xoopsTpl']->assign('wgslider_url', \WGSLIDER_URL);
        $GLOBALS['xoopsTpl']->assign('wgslider_upload_url', \WGSLIDER_UPLOAD_URL);
        $GLOBALS['xoopsTpl']->assign('currentTime', '?' . time()); //add time to force reload image
        // Table view image
        if ($imageCount > 0) {
            foreach (\array_keys($imageAll) as $i) {
                $image = $imageAll[$i]->getValuesImage();
                $categoryHandler = $helper->getHandler('Category');
                $crCategory = new \CriteriaCompo();
                $crCategory->add(new \Criteria('id', $image['category']));
                $crCategory->add(new \Criteria('status', Constants::STATUS_ONLINE));
                $categoryCount = $categoryHandler->getCount($crCategory);
                $image['category_offline'] = (0 === $categoryCount);
                $GLOBALS['xoopsTpl']->append('image_list', $image);
                unset($image);
            }
            // Display Navigation
            if ($imageCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($imageCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
            $GLOBALS['xoopsTpl']->assign('token', $GLOBALS['xoopsSecurity']->getTokenHTML());
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGSLIDER_THEREARENT_IMAGES);
        }
        break;
    case 'order':
        $iorder = Request::getArray('iorder');
        for ($i = 0, $iMax = \count($iorder); $i < $iMax; $i++){
            $imageObj = $imageHandler->get($iorder[$i]);
            $imageObj->setVar('weight',$i+1);
            $imageHandler->insert($imageObj);
            unset($imageObj);
        }
        break;
    case 'change_status':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('image.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($imgId > 0) {
            $imageObj = $imageHandler->get($imgId);
        } else {
            \redirect_header('image.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_AM_WGSLIDER_INVALID_PARAM);
        }
        $currentStatus = (int)$imageObj->getVar('status');
        if (Constants::STATUS_OFFLINE === $currentStatus) {
            $imageObj->setVar('status', Constants::STATUS_ONLINE );
        } elseif (Constants::STATUS_ONLINE === $currentStatus) {
            $imageObj->setVar('status', Constants::STATUS_OFFLINE );
        }
        // Insert Data
        if ($imageHandler->insert($imageObj)) {
            \redirect_header('image.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_AM_WGSLIDER_FORM_OK);
        } else {
            \redirect_header('image.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_AM_WGSLIDER_STATUS_CHANGE_ERROR);
        }
        break;
    case 'new':
        $templateMain = 'wgslider_admin_image.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('image.php'));
        $adminObject->addItemButton(\_AM_WGSLIDER_LIST_IMAGE, 'image.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $imageObj = $imageHandler->create();
        $form = $imageObj->getFormImage();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        $templateMain = 'wgslider_admin_image.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('image.php'));
        $adminObject->addItemButton(\_AM_WGSLIDER_LIST_IMAGE, 'image.php', 'list');
        $adminObject->addItemButton(\_AM_WGSLIDER_ADD_IMAGE, 'image.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Request source
        $imgIdSource = Request::getInt('id_source');
        // Get Form
        $imageObjSource = $imageHandler->get($imgIdSource);
        $imageObj = $imageObjSource->xoopsClone();
        $form = $imageObj->getFormImage();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('image.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($imgId > 0) {
            $imageObj = $imageHandler->get($imgId);
        } else {
            $imageObj = $imageHandler->create();
        }
        // Set Vars
        $uploaderErrors = '';
        $imageObj->setVar('name', Request::getString('name'));
        $imageObj->setVar('description', Request::getString('description'));
        // Set Var img_realname
        if (0 === $imgId) {
            require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
            $filename = $_FILES['path']['name'];
            $imgMimetype = $_FILES['path']['type'];
            $imgNameDef = Request::getString('name');
            $uploader = new \XoopsMediaUploader(\WGSLIDER_UPLOAD_IMAGE_PATH,
                $helper->getConfig('mimetypes_image'),
                $helper->getConfig('maxsize_image'), null, null);
            if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
                $extension = \pathinfo($filename, PATHINFO_EXTENSION);
                $imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
                $uploader->setPrefix($imgName);
                $uploader->fetchMedia($_POST['xoops_upload_file'][0]);
                if ($uploader->upload()) {
                    $savedFilename = $uploader->getSavedFileName();
                    $maxwidth = (int)$helper->getConfig('maxwidth_image');
                    $maxheight = (int)$helper->getConfig('maxheight_image');
                    if ($maxwidth > 0 && $maxheight > 0) {
                        // Resize image
                        $imgHandler = new Wgslider\Common\Resizer();
                        $imgHandler->sourceFile = \WGSLIDER_UPLOAD_IMAGE_PATH . '/' . $savedFilename;
                        $imgHandler->endFile = \WGSLIDER_UPLOAD_IMAGE_PATH . '/' . $savedFilename;
                        $imgHandler->imageMimetype = $imgMimetype;
                        $imgHandler->maxWidth = $maxwidth;
                        $imgHandler->maxHeight = $maxheight;
                        $result = $imgHandler->resizeImage();
                    }
                    $imageObj->setVar('realname', $savedFilename);
                } else {
                    $uploaderErrors .= '<br>' . $uploader->getErrors();
                }
            } else {
                if ($filename !== '') {
                    $uploaderErrors .= '<br>' . $uploader->getErrors();
                }
                $imageObj->setVar('realname', Request::getString('realname'));
            }
        } else {
            $savedFilename = $imageObj->getVar('realname');
        }
        // get dimension of image
        if (!isset($savedFilename) || !file_exists(\WGSLIDER_UPLOAD_IMAGE_PATH . '/' . $savedFilename)) {
            \redirect_header('image.php?op=list', 3, \_AM_WGSLIDER_ERROR_FILE_NOT_FOUND);
        }
        $imageInfo = @getimagesize(\WGSLIDER_UPLOAD_IMAGE_PATH . '/' . $savedFilename);
        if ($imageInfo === false) {
            \redirect_header('image.php?op=list', 3, \_AM_WGSLIDER_ERROR_FILE_NOT_FOUND);
        }
        $width = $imageInfo[0];
        $height = $imageInfo[1];
        $imageObj->setVar('width', $width);
        $imageObj->setVar('height', $height);
        $imagCat = Request::getInt('category');
        $imageObj->setVar('category', $imagCat);
        $imageObj->setVar('status', Request::getInt('status'));
        $imageWeight = Request::getInt('weight');
        if (0 === $imageWeight) {
            $imageWeight = $imageHandler->getMaxWeight($imagCat) + 1;
        }
        $imageObj->setVar('weight', $imageWeight);
        $imageDatecreatedObj = \DateTime::createFromFormat(\_SHORTDATESTRING, Request::getString('datecreated'));
        if ($imageDatecreatedObj === false) {
            // invalid date
            \redirect_header('image.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_AM_WGSLIDER_INVALID_DATE);
        }
        $imageObj->setVar('datecreated', $imageDatecreatedObj->getTimestamp());
        $imageObj->setVar('submitter', Request::getInt('submitter'));
        // Insert Data
        if ($imageHandler->insert($imageObj)) {
            if ('' !== $uploaderErrors) {
                \redirect_header('image.php?op=edit&id=' . $imgId, 5, $uploaderErrors);
            } else {
                \redirect_header('image.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_AM_WGSLIDER_FORM_OK);
            }
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $imageObj->getHtmlErrors());
        $form = $imageObj->getFormImage();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        $templateMain = 'wgslider_admin_image.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('image.php'));
        $adminObject->addItemButton(\_AM_WGSLIDER_ADD_IMAGE, 'image.php?op=new');
        $adminObject->addItemButton(\_AM_WGSLIDER_LIST_IMAGE, 'image.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $imageObj = $imageHandler->get($imgId);
        $imageObj->start = $start;
        $imageObj->limit = $limit;
        $form = $imageObj->getFormImage();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        $templateMain = 'wgslider_admin_image.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('image.php'));
        $imageObj = $imageHandler->get($imgId);
        $imgName = $imageObj->getVar('name');
        if (1 === Request::getInt('ok')) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('image.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($imageHandler->delete($imageObj)) {
                $imgRealname = $imageObj->getVar('realname');
                if (file_exists(\WGSLIDER_UPLOAD_IMAGE_PATH . '/' . $imgRealname)) {
                    unlink(\WGSLIDER_UPLOAD_IMAGE_PATH . '/' . $imgRealname);
                }
                \redirect_header('image.php', 3, \_AM_WGSLIDER_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $imageObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'id' => $imgId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_AM_WGSLIDER_FORM_SURE_DELETE, $imgName));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}
require __DIR__ . '/footer.php';
