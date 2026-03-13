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

$helper = \XoopsModules\Wgslider\Helper::getInstance();

$adminmenu[] = [
    'title' => \_MI_WGSLIDER_ADMENU1,
    'link' => 'admin/index.php',
    'icon' => 'assets/icons/32/dashboard.png',
];
$adminmenu[] = [
    'title' => \_MI_WGSLIDER_ADMENU2,
    'link' => 'admin/category.php',
    'icon' => 'assets/icons/32/category.png',
];
$adminmenu[] = [
    'title' => \_MI_WGSLIDER_ADMENU3,
    'link' => 'admin/image.php',
    'icon' => 'assets/icons/32/image.png',
];
$adminmenu[] = [
    'title' => \_MI_WGSLIDER_ADMENU4,
    'link' => 'admin/slideshow.php',
    'icon' => 'assets/icons/32/slideshow.png',
];
if ($helper->getConfig('displayTabClone')) {
    $adminmenu[] = [
        'title' => \_MI_WGSLIDER_ADMENU5,
        'link' => 'admin/clone.php',
        'icon' => 'assets/icons/32/clone.png',
    ];
}
if ($helper->getConfig('displayTabFeedback')) {
    $adminmenu[] = [
        'title' => \_MI_WGSLIDER_ADMENU6,
        'link' => 'admin/feedback.php',
        'icon' => 'assets/icons/32/feedback.png',
    ];
}
$adminmenu[] = [
    'title' => \_MI_WGSLIDER_ABOUT,
    'link' => 'admin/about.php',
    'icon' => 'assets/icons/32/about.png',
];
