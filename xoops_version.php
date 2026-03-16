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

// 
$moduleDirName      = \basename(__DIR__);
$moduleDirNameUpper = \mb_strtoupper($moduleDirName);

include \XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . '/preloads/autoloader.php';

// ------------------- Informations ------------------- //
$modversion = [
    'name'                => \_MI_WGSLIDER_NAME,
    'version'             => '1.0.0',
    'description'         => \_MI_WGSLIDER_DESC,
    'author'              => 'Goffy - wedega',
    'author_mail'         => 'webmaster@wedega.com',
    'author_website_url'  => 'https://wedega.com',
    'author_website_name' => 'Wedega Webdesign Gabor for XOOPS',
    'credits'             => 'XOOPS Development Team',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'https://www.gnu.org/licenses/gpl-3.0.en.html',
    'help'                => 'page=help',
    'release_info'        => 'release_info',
    'release_file'        => \XOOPS_URL . '/modules/wgslider/docs/release_info file',
    'release_date'        => '2026/02/28',
    'manual'              => 'link to manual file',
    'manual_file'         => \XOOPS_URL . '/modules/wgslider/docs/install.txt',
    'min_php'             => '8.3',
    'min_xoops'           => '2.5.12',
    'min_admin'           => '1.2',
    'min_db'              => ['mysql' => '8.0', 'mysqli' => '8.0'],
    'image'               => 'assets/images/logoModule.png',
    'dirname'             => \basename(__DIR__),
    'dirmoduleadmin'      => 'Frameworks/moduleclasses/moduleadmin',
    'sysicons16'          => '../../Frameworks/moduleclasses/icons/16',
    'sysicons32'          => '../../Frameworks/moduleclasses/icons/32',
    'modicons16'          => 'assets/icons/16',
    'modicons32'          => 'assets/icons/32',
    'demo_site_url'       => 'https://wedega.com',
    'demo_site_name'      => 'Wedega Site',
    'support_url'         => 'https://xoops.org/modules/newbb',
    'support_name'        => 'Support Forum',
    'module_website_url'  => 'www.xoops.org',
    'module_website_name' => 'XOOPS Project',
    'release'             => '2026-02-28',
    'module_status'       => 'Beta 1',
    'system_menu'         => 1,
    'hasAdmin'            => 1,
    'hasMain'             => 0,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    'onInstall'           => 'include/install.php',
    'onUninstall'         => 'include/uninstall.php',
    'onUpdate'            => 'include/update.php',
];
// ------------------- Templates ------------------- //
// Admin
$modversion['templates'] = [
    // Admin templates
    ['file' => 'wgslider_admin_about.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgslider_admin_header.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgslider_admin_index.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgslider_admin_category.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgslider_admin_image.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgslider_admin_image_editor.tpl', 'description' => '', 'type' => 'admin'],
	['file' => 'wgslider_admin_slideshow.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgslider_admin_clone.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgslider_admin_footer.tpl', 'description' => '', 'type' => 'admin'],
];
// User
$modversion['templates'][] = ['file' => 'wgslider_slideshow_default.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'wgslider_slideshow_bt3.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'wgslider_slideshow_bt5.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'wgslider_slideshow_swiper.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'wgslider_slideshow_splide.tpl', 'description' => ''];
// ------------------- Mysql ------------------- //
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
// Tables
$modversion['tables'] = [
    'wgslider_category',
    'wgslider_image',
    'wgslider_slideshow',
];
// ------------------- Blocks ------------------- //
// slideshow
$modversion['blocks'][] = [
    'file'        => 'slideshow.php',
    'name'        => \_MI_WGSLIDER_IMAGE_BLOCK_SLIDESHOW,
    'description' => \_MI_WGSLIDER_IMAGE_BLOCK_SLIDESHOW_DESC,
    'show_func'   => 'b_wgslider_slideshow_show',
    'edit_func'   => 'b_wgslider_slideshow_edit',
    'template'    => 'wgslider_block_slideshow.tpl',
    'options'     => 'default|5|25|0',
];
// ------------------- Config ------------------- //
// create increment steps for file size
require_once __DIR__ . '/include/xoops_version.inc.php';
$iniPostMaxSize       = wgsliderReturnBytes(\ini_get('post_max_size'));
$iniUploadMaxFileSize = wgsliderReturnBytes(\ini_get('upload_max_filesize'));
$maxSize              = min($iniPostMaxSize, $iniUploadMaxFileSize);
if ($maxSize > 10000 * 1048576) {
    $increment = 500;
}
if ($maxSize <= 10000 * 1048576) {
    $increment = 200;
}
if ($maxSize <= 5000 * 1048576) {
    $increment = 100;
}
if ($maxSize <= 2500 * 1048576) {
    $increment = 50;
}
if ($maxSize <= 1000 * 1048576) {
    $increment = 10;
}
if ($maxSize <= 500 * 1048576) {
    $increment = 5;
}
if ($maxSize <= 100 * 1048576) {
    $increment = 2;
}
if ($maxSize <= 50 * 1048576) {
    $increment = 1;
}
if ($maxSize <= 25 * 1048576) {
    $increment = 0.5;
}
$optionMaxsize = [];
$i = $increment;
while ($i * 1048576 <= $maxSize) {
    $optionMaxsize[$i . ' ' . _MI_WGSLIDER_SIZE_MB] = $i * 1048576;
    $i += $increment;
}
// Uploads : maxsize of image
$modversion['config'][] = [
    'name'        => 'maxsize_image',
    'title'       => '\_MI_WGSLIDER_MAXSIZE_IMAGE',
    'description' => '\_MI_WGSLIDER_MAXSIZE_IMAGE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 3145728,
    'options'     => $optionMaxsize,
];
// Uploads : mimetypes of image
$modversion['config'][] = [
    'name'        => 'mimetypes_image',
    'title'       => '\_MI_WGSLIDER_MIMETYPES_IMAGE',
    'description' => '\_MI_WGSLIDER_MIMETYPES_IMAGE_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => ['image/gif', 'image/jpeg', 'image/png'],
    'options'     => ['bmp' => 'image/bmp','gif' => 'image/gif','pjpeg' => 'image/pjpeg', 'jpeg' => 'image/jpeg','jpg' => 'image/jpg','jpe' => 'image/jpe', 'png' => 'image/png'],
];
$modversion['config'][] = [
    'name'        => 'maxwidth_image',
    'title'       => '\_MI_WGSLIDER_MAXWIDTH_IMAGE',
    'description' => '\_MI_WGSLIDER_MAXWIDTH_IMAGE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 800,
];
$modversion['config'][] = [
    'name'        => 'maxheight_image',
    'title'       => '\_MI_WGSLIDER_MAXHEIGHT_IMAGE',
    'description' => '\_MI_WGSLIDER_MAXHEIGHT_IMAGE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 800,
];
// Admin pager
$modversion['config'][] = [
    'name'        => 'adminpager',
    'title'       => '\_MI_WGSLIDER_ADMIN_PAGER',
    'description' => '\_MI_WGSLIDER_ADMIN_PAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];

// Make Sample button visible?
$modversion['config'][] = [
    'name'        => 'displaySampleButton',
    'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON',
    'description' => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// Make tab clone visible?
$modversion['config'][] = [
    'name'        => 'displayTabClone',
    'title'       => '_MI_' . $moduleDirNameUpper . '_' . 'SHOW_TAB_CLONE',
    'description' => '',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// Make tab feedback visible?
$modversion['config'][] = [
    'name'        => 'displayTabFeedback',
    'title'       => '_MI_' . $moduleDirNameUpper . '_' . 'SHOW_TAB_FEEDBACK',
    'description' => '',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// Maintained by
$modversion['config'][] = [
    'name'        => 'maintainedby',
    'title'       => '\_MI_WGSLIDER_MAINTAINEDBY',
    'description' => '\_MI_WGSLIDER_MAINTAINEDBY_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'https://xoops.org/modules/newbb',
];
