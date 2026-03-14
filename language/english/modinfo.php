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

require_once __DIR__ . '/common.php';

// ---------------- Admin Main ----------------
\define('_MI_WGSLIDER_NAME', 'wgSlider');
\define('_MI_WGSLIDER_DESC', 'wgSlider is a module to manage a slideshow');
// ---------------- Admin Menu ----------------
\define('_MI_WGSLIDER_ADMENU1', 'Dashboard');
\define('_MI_WGSLIDER_ADMENU2', 'Categories');
\define('_MI_WGSLIDER_ADMENU3', 'Images');
\define('_MI_WGSLIDER_ADMENU4', 'Slideshows');
\define('_MI_WGSLIDER_ADMENU5', 'Clone');
\define('_MI_WGSLIDER_ADMENU6', 'Feedback');
\define('_MI_WGSLIDER_ABOUT', 'About');
// ---------------- Blocks ----------------
\define('_MI_WGSLIDER_IMAGE_BLOCK_SLIDESHOW', 'Slideshow');
\define('_MI_WGSLIDER_IMAGE_BLOCK_SLIDESHOW_DESC', 'Show a slideshow');
// ---------------- Admin Nav ----------------
\define('_MI_WGSLIDER_ADMIN_PAGER', 'Admin pager');
\define('_MI_WGSLIDER_ADMIN_PAGER_DESC', 'Admin per page list');
// Config
\define('_MI_WGSLIDER_SIZE_MB', 'MB');
\define('_MI_WGSLIDER_MAXSIZE_IMAGE', 'Max size image');
\define('_MI_WGSLIDER_MAXSIZE_IMAGE_DESC', 'Define the max size for uploading images');
\define('_MI_WGSLIDER_MIMETYPES_IMAGE', 'Mime types image');
\define('_MI_WGSLIDER_MIMETYPES_IMAGE_DESC', 'Define the allowed mime types for uploading images');
\define('_MI_WGSLIDER_MAXWIDTH_IMAGE', 'Max width image');
\define('_MI_WGSLIDER_MAXWIDTH_IMAGE_DESC', 'Set the max width to which uploaded images should be scaled (in pixel)<br>0 means, that images keep the original size. <br>If an image is smaller than maximum value then the image will be not be enlarged, it will be saved in original width.');
\define('_MI_WGSLIDER_MAXHEIGHT_IMAGE', 'Max height image');
\define('_MI_WGSLIDER_MAXHEIGHT_IMAGE_DESC', 'Set the max height to which uploaded images should be scaled (in pixel)<br>0 means, that images keep the original size. <br>If an image is smaller than maximum value then the image will be not be enlarged, it will be saved in original height');
\define('_MI_WGSLIDER_MAINTAINEDBY', 'Maintained By');
\define('_MI_WGSLIDER_MAINTAINEDBY_DESC', 'Allow url of support site or community');
\define('_MI_WGSLIDER_BOOKMARKS', 'Social Bookmarks');
\define('_MI_WGSLIDER_BOOKMARKS_DESC', 'Show Social Bookmarks in the single page');
\define('_MI_WGSLIDER_SHOW_TAB_CLONE', 'Show tab "Clone" on admin page');
\define('_MI_WGSLIDER_SHOW_TAB_FEEDBACK', 'Show tab "Feedback" on admin page');
// ---------------- End ----------------
