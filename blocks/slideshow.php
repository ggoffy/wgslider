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

use XoopsModules\Wgslider;
use XoopsModules\Wgslider\Helper;
use XoopsModules\Wgslider\Constants;

require_once \XOOPS_ROOT_PATH . '/modules/wgslider/include/common.php';

/**
 * Function show block
 * @param  $options
 * @return array
 */
function b_wgslider_slideshow_show($options): array
{
    $helper        = Helper::getInstance();
    //$typeBlock     = $options[0];

    $slideshowHandler = $helper->getHandler('Slideshow');

    $slsIdentifier = \md5((string)\mt_rand());
    $catId = (int)$options[1] ?? 0;
    if (empty($catId)) {
        return [];
    }

    $slsElements = $slideshowHandler->getSlideshowElements($catId, Constants::DISPLAY_BLOCK);
    if (empty($slsElements)) {
        return [];
    }

    $GLOBALS['xoopsTpl']->assign('wgslider_upload_image_url', \WGSLIDER_UPLOAD_IMAGE_URL);
    $GLOBALS['xoopsTpl']->assign('wgslider_url', \WGSLIDER_URL);
    $GLOBALS['xoopsTpl']->assign('wgslider_identifier', $slsIdentifier);
    $GLOBALS['xoopsTpl']->assign('wgslider_slideshow_tpl', $slsElements['slsTpl']);

    return $slsElements['block'];

}

/**
 * Function edit block
 * @param  $options
 * @return string
 */
function b_wgslider_slideshow_edit($options): string
{
    $GLOBALS['xoopsTpl']->assign('wgslider_upload_url', \WGSLIDER_UPLOAD_URL);
    $form = "<input type='hidden' name='options[0]' value='".$options[0]."' >";
    \array_shift($options);

    $crCategory = new \CriteriaCompo();
    $crCategory->setSort('id');
    $crCategory->setOrder('ASC');

    $helper = Helper::getInstance();
    $categoryHandler = $helper->getHandler('Category');
    $categoryAll = $categoryHandler->getAll($crCategory);
    unset($crCategory);
    $form .= \_MB_WGSLIDER_CATEGORY_TO_DISPLAY . "<br><select name='options[1]' size='5'>";
    foreach (\array_keys($categoryAll) as $i) {
        $categoryName = $categoryAll[$i]->getVar('name');
        if (Constants::DISPLAY_BLOCK <> $categoryAll[$i]->getVar('display')) {
            $categoryName .= ' (' . \_MB_WGSLIDER_CATEGORY_NO_BLOCK . ')';
        }
        $form .= "<option value='" . $i . "' " . (!\in_array($i, $options) ? '' : "selected='selected'") . '>' . $categoryName . '</option>';
    }
    $form .= '</select>';


    return $form;

}
