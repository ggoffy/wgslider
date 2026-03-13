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
if (!\defined('XOOPS_ICONS32_PATH')) {
    \define('XOOPS_ICONS32_PATH', \XOOPS_ROOT_PATH . '/Frameworks/moduleclasses/icons/32');
}
if (!\defined('XOOPS_ICONS32_URL')) {
    \define('XOOPS_ICONS32_URL', \XOOPS_URL . '/Frameworks/moduleclasses/icons/32');
}
\define('WGSLIDER_DIRNAME', 'wgslider');
\define('WGSLIDER_PATH', \XOOPS_ROOT_PATH . '/modules/' . \WGSLIDER_DIRNAME);
\define('WGSLIDER_URL', \XOOPS_URL . '/modules/' . \WGSLIDER_DIRNAME);
\define('WGSLIDER_ICONS_PATH', \WGSLIDER_PATH . '/assets/icons');
\define('WGSLIDER_ICONS_URL', \WGSLIDER_URL . '/assets/icons');
\define('WGSLIDER_IMAGE_PATH', \WGSLIDER_PATH . '/assets/images');
\define('WGSLIDER_IMAGE_URL', \WGSLIDER_URL . '/assets/images');
\define('WGSLIDER_UPLOAD_PATH', \XOOPS_UPLOAD_PATH . '/' . \WGSLIDER_DIRNAME);
\define('WGSLIDER_UPLOAD_URL', \XOOPS_UPLOAD_URL . '/' . \WGSLIDER_DIRNAME);
\define('WGSLIDER_UPLOAD_IMAGE_PATH', \WGSLIDER_UPLOAD_PATH . '/images');
\define('WGSLIDER_UPLOAD_IMAGE_URL', \WGSLIDER_UPLOAD_URL . '/images');
\define('WGSLIDER_ADMIN', \WGSLIDER_URL . '/admin/index.php');
$localLogo = \WGSLIDER_IMAGE_URL . '/goffy-wedega_logo.png';
// Module Information
$copyright = "<a href='https://wedega.com' title='Wedega Webdesign Gabor for XOOPS' target='_blank'><img src='" . $localLogo . "' alt='Wedega Webdesign Gabor for XOOPS' ></a>";
require_once \XOOPS_ROOT_PATH . '/class/xoopsrequest.php';
require_once \WGSLIDER_PATH . '/include/functions.php';
