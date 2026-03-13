<?php declare(strict_types=1);
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (https://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          XOOPS Project <www.xoops.org> <www.xoops.ir>
 */

use XoopsModules\Wgslider\Constants;

\defined('XOOPS_ROOT_PATH') || die('Restricted access.');

/**
 * Render all slideshows, used as smarty
 * @return bool
 * @throws SmartyException
 */
function loadSlideshows (): bool
{

    global $xoopsTpl;

    //$module_handler = xoops_getHandler('module');
    $helper = \XoopsModules\Wgslider\Helper::getInstance();
    $categoryHandler  = $helper->getHandler('Category');

    $crCategory = new \CriteriaCompo();
    $crCategory->add(new \Criteria('status', Constants::STATUS_ONLINE));
    $crCategory->add(new \Criteria('display', Constants::DISPLAY_KEY));
    $countCat = $categoryHandler->getCount($crCategory);
    if ($countCat > 0) {
        $slideshowHandler = $helper->getHandler('Slideshow');
        $wgsliderUploadImageUrl =   \XOOPS_URL . '/uploads/' . \basename(\dirname(__DIR__)) . '/images';
        $category_arr = $categoryHandler->getAll($crCategory);
        foreach (\array_keys($category_arr) as $i) {
            $catKey = $category_arr[$i]->getVar('key');
            $slsElements = $slideshowHandler->getSlideshowElements($i, Constants::DISPLAY_KEY);
            $slsIdentifier = \md5((string)\mt_rand());
            $xoopsTpl->assign('block', $slsElements['block']);
            $xoopsTpl->assign('wgslider_upload_image_url', $wgsliderUploadImageUrl);
            $xoopsTpl->assign('wgslider_identifier', $slsIdentifier);
            $xoopsTpl->assign('wgslider_slideshow_tpl', $slsElements['slsTpl']);

            $slideshow = $xoopsTpl->fetch('db:' . $slsElements['slsTpl']);

            $GLOBALS['xoopsTpl']->assign($catKey, $slideshow);
        }
    }

    return true;
}

