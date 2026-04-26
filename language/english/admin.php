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

// ---------------- Admin Index ----------------
\define('_AM_WGSLIDER_STATISTICS', 'Statistics');
// There are
\define('_AM_WGSLIDER_THEREARE_CATEGORIES', "There are <span class='bold'>%s</span> categories in the database");
\define('_AM_WGSLIDER_THEREARE_IMAGES', "There are <span class='bold'>%s</span> images in the database");
\define('_AM_WGSLIDER_THEREARE_SLIDESHOWS', "There are <span class='bold'>%s</span> slideshows in the database");
// ---------------- Admin Files ----------------
// There aren't
\define('_AM_WGSLIDER_THEREARENT_CATEGORIES', "There aren't categories");
\define('_AM_WGSLIDER_THEREARENT_IMAGES', "There aren't images");
\define('_AM_WGSLIDER_THEREARENT_SLIDESHOWS', "There aren't slideshows");
// Save/Delete
\define('_AM_WGSLIDER_FORM_OK', 'Successfully saved');
\define('_AM_WGSLIDER_FORM_DELETE_OK', 'Successfully deleted');
\define('_AM_WGSLIDER_FORM_SURE_DELETE', "Are you sure to delete: <b><span style='color : Red;'>%s </span></b>");
\define('_AM_WGSLIDER_FORM_SURE_RENEW', "Are you sure to update: <b><span style='color : Red;'>%s </span></b>");
\define('_AM_WGSLIDER_FORM_UPLOAD_IMG', 'Upload new image');
// Buttons
\define('_AM_WGSLIDER_ADD_CATEGORY', 'Add New Category');
\define('_AM_WGSLIDER_ADD_IMAGE', 'Add New Image');
\define('_AM_WGSLIDER_ADD_SLIDESHOW', 'Add New Slideshow');
\define('_AM_WGSLIDER_SLIDESHOW_SHOW', 'Show Slideshow');
\define('_AM_WGSLIDER_SLIDESHOW_RESET', 'Reset All Slideshows');
// Lists
\define('_AM_WGSLIDER_LIST_CATEGORY', 'List of Categories');
\define('_AM_WGSLIDER_LIST_IMAGE', 'List of Images');
\define('_AM_WGSLIDER_LIST_SLIDESHOW', 'List of Slideshows');
// ---------------- Admin Classes ----------------
// Category display types
\define('_AM_WGSLIDER_DISPLAY_BLOCK', 'Display as a block');
\define('_AM_WGSLIDER_DISPLAY_KEY', 'Display as smarty variable');
// Category add/edit
\define('_AM_WGSLIDER_CATEGORY_ADD', 'Add Category');
\define('_AM_WGSLIDER_CATEGORY_EDIT', 'Edit Category');
// Elements of Category
\define('_AM_WGSLIDER_CATEGORY_ID', 'Id');
\define('_AM_WGSLIDER_CATEGORY_NAME', 'Name');
\define('_AM_WGSLIDER_CATEGORY_DISPLAY', 'Display type');
\define('_AM_WGSLIDER_CATEGORY_KEY', 'Name of smarty variable');
\define('_AM_WGSLIDER_CATEGORY_KEY_DESCR', "Name is only mandatory if you select '" . _AM_WGSLIDER_DISPLAY_KEY . "'.<br>You have to put the smarty variable somewhere in your template");
\define('_AM_WGSLIDER_CATEGORY_MAXIMG', 'Maximum images');
\define('_AM_WGSLIDER_CATEGORY_MAXIMG_DESCR', 'Define the maximum number of images per category. 0 means no limit');
\define('_AM_WGSLIDER_CATEGORY_IMGWIDTH', 'Image width');
\define('_AM_WGSLIDER_CATEGORY_IMGWIDTH_DESCR', 'Define the width of images. Images must have exactly this width in order to be shown. 0 means no restriction.');
\define('_AM_WGSLIDER_CATEGORY_IMGHEIGHT', 'Image height');
\define('_AM_WGSLIDER_CATEGORY_IMGHEIGHT_DESCR', 'Define the height of images. Images must have exactly this height in order to be shown. 0 means no restriction.');
\define('_AM_WGSLIDER_CATEGORY_SLIDESHOW', 'Slideshow');
\define('_AM_WGSLIDER_CATEGORY_SURE_DELETE', "Are you sure to delete category: <b><span style='color : Red;'>%s </span></b><br>All images of this category will be deleted also!");
\define('_AM_WGSLIDER_CATEGORY_DELETE_OK', 'Category and all images of this category successfully deleted');
\define('_AM_WGSLIDER_CATEGORY_DELETE_FAILED', 'Category deleted, but error while deleting images!');
\define('_AM_WGSLIDER_CATEGORY_NO_SLIDESHOW', 'There are no slideshows with status "Online" available');
// Image add/edit
\define('_AM_WGSLIDER_IMAGE_ADD', 'Add Image');
\define('_AM_WGSLIDER_IMAGE_EDIT', 'Edit Image');
// Elements of Image
\define('_AM_WGSLIDER_IMAGE_ID', 'Id');
\define('_AM_WGSLIDER_IMAGE_NAME', 'Name');
\define('_AM_WGSLIDER_IMAGE_DESCRIPTION', 'Description');
\define('_AM_WGSLIDER_IMAGE_REALNAME', 'Real file name');
\define('_AM_WGSLIDER_IMAGE_REALNAME_UPLOADS', 'Path in %s :');
\define('_AM_WGSLIDER_IMAGE_PREVIEW', 'Preview');
\define('_AM_WGSLIDER_IMAGE_WIDTH', 'Width');
\define('_AM_WGSLIDER_IMAGE_HEIGHT', 'Height');
\define('_AM_WGSLIDER_IMAGE_WEIGHT', 'Weight');
\define('_AM_WGSLIDER_IMAGE_CATEGORY', 'Category');
// Slideshow misc
\define('_AM_WGSLIDER_SLIDESHOW_DESCR_DEFAULT', 'Default slideshow without any additional requirements');
\define('_AM_WGSLIDER_SLIDESHOW_DESCR_BT3', 'Bootstrap3 Carousel requires a theme based on Bootstrap 3');
\define('_AM_WGSLIDER_SLIDESHOW_DESCR_BT5', 'Bootstrap5 Carousel requires a theme based on Bootstrap 5');
\define('_AM_WGSLIDER_SLIDESHOW_DESCR_SWIPER', 'Swiper Slideshow without any additional requirements');
\define('_AM_WGSLIDER_SLIDESHOW_DESCR_SPLIDE', 'Splide Slideshow without any additional requirements');
\define('_AM_WGSLIDER_SLIDESHOW_RESET_SURE', 'Do you really want to reset all slideshows? All your current settings for parameters will be lost.');
\define('_AM_WGSLIDER_SLIDESHOW_RESET_OK', 'Reset of all slideshows successfully done');
\define('_AM_WGSLIDER_SLIDESHOW_RESET_ERROR', 'An error occurred while resetting the slideshow');
// Slideshow add/edit
\define('_AM_WGSLIDER_SLIDESHOW_ADD', 'Add Slideshow');
\define('_AM_WGSLIDER_SLIDESHOW_EDIT', 'Edit Slideshow');
// Elements of Slideshow
\define('_AM_WGSLIDER_SLIDESHOW_ID', 'Id');
\define('_AM_WGSLIDER_SLIDESHOW_NAME', 'Name');
\define('_AM_WGSLIDER_SLIDESHOW_DESCR', 'Description');
\define('_AM_WGSLIDER_SLIDESHOW_TPL', 'Template file');
\define('_AM_WGSLIDER_SLIDESHOW_PARAMS', 'Parameters');
\define('_AM_WGSLIDER_SLIDESHOW_CREDITS', 'Credits');
// Slideshow parameters
\define('_AM_WGSLIDER_SLIDESHOW_DELAY', 'Delay');
\define('_AM_WGSLIDER_SLIDESHOW_PAUSE', 'Pause on hover');
\define('_AM_WGSLIDER_SLIDESHOW_WRAP', 'Slideshow should run continuously');
\define('_AM_WGSLIDER_SLIDESHOW_KEYBOARD', 'Support keyboard');
\define('_AM_WGSLIDER_SLIDESHOW_TOUCH', 'Support touch');
\define('_AM_WGSLIDER_SLIDESHOW_SHOW_INDICATOR', 'Show indicator');
\define('_AM_WGSLIDER_SLIDESHOW_SHOW_PREV_NEXT', 'Show previous/next ');
\define('_AM_WGSLIDER_SLIDESHOW_SHOW_CAPTION', 'Show caption');
\define('_AM_WGSLIDER_SLIDESHOW_SHOW_DESCR', 'Show description');
\define('_AM_WGSLIDER_SLIDESHOW_SHOW_THUMBS', 'Show thumbnails');
\define('_AM_WGSLIDER_SLIDESHOW_FULLSIZE', 'Full size');
\define('_AM_WGSLIDER_SLIDESHOW_PERVIEW', 'Images per view');
\define('_AM_WGSLIDER_SLIDESHOW_AUTOPLAY', 'Auto play');
\define('_AM_WGSLIDER_SLIDESHOW_EFFECT', 'Effect');
\define('_AM_WGSLIDER_SLIDESHOW_BG_CAPTION', 'Background caption');
\define('_AM_WGSLIDER_SLIDESHOW_AUTOHEIGHT', 'Adjust image height automatically');
\define('_AM_WGSLIDER_SLIDESHOW_GAP', 'Gap between images');
\define('_AM_WGSLIDER_SLIDESHOW_GAP_DESCR', "Used only if '" . _AM_WGSLIDER_SLIDESHOW_PERVIEW . "' is greater than 1");
// Permissions
\define('_AM_WGSLIDER_PERMS_GLOBAL', 'Permissions global');
\define('_AM_WGSLIDER_PERMS_GLOBAL_SUBMIT', 'Permissions global to submit and edit all');
\define('_AM_WGSLIDER_PERMS_GLOBAL_SUBMIT_DESC', 'Groups which should have permissions to <ul><li>create categories</li><li>edit all categories</li><li>upload images to all categories</li></ul>');
\define('_AM_WGSLIDER_PERMS_GLOBAL_VIEW', 'Permissions to view all');
\define('_AM_WGSLIDER_PERMS_GLOBAL_VIEW_DESC', 'Groups which should have permissions to view all categories');
\define('_AM_WGSLIDER_PERMS_GLOBAL_DESC', '<ul>
                                                <li>' . \_AM_WGSLIDER_PERMS_GLOBAL_SUBMIT . ': ' . \_AM_WGSLIDER_PERMS_GLOBAL_SUBMIT_DESC . '<br></li>
                                                <li>' . \_AM_WGSLIDER_PERMS_GLOBAL_VIEW . ': ' . \_AM_WGSLIDER_PERMS_GLOBAL_VIEW_DESC . '<br></li>
                                           </ul>');
\define('_AM_WGSLIDER_PERMS_CATEGORY_SUBMIT', 'Permissions to submit and edit own categories');
\define('_AM_WGSLIDER_PERMS_CATEGORY_SUBMIT_DESC', 'Groups which should have permissions to <ul><li>create categories</li><li>edit only own categories</li><li>upload images only to own categories</li></ul>');
\define('_AM_WGSLIDER_PERMS_CATEGORY_VIEW', 'Permissions to view this category');
\define('_AM_WGSLIDER_PERMS_CATEGORY_VIEW_DESC', 'Groups which should have permissions to view this category');
\define('_AM_WGSLIDER_PERMS_NOTSET', 'No permission set');
// General
\define('_AM_WGSLIDER_DATECREATED', 'Datecreated');
\define('_AM_WGSLIDER_SUBMITTER', 'Submitter');
\define('_AM_WGSLIDER_FORM_UPLOAD', 'Upload file');
\define('_AM_WGSLIDER_FORM_UPLOAD_NEW', 'Upload new file: ');
\define('_AM_WGSLIDER_FORM_UPLOAD_SIZE', 'Max file size: ');
\define('_AM_WGSLIDER_FORM_UPLOAD_SIZE_MB', 'MB');
\define('_AM_WGSLIDER_FORM_UPLOAD_IMG_WIDTH', 'Max image width: ');
\define('_AM_WGSLIDER_FORM_UPLOAD_IMG_HEIGHT', 'Max image height: ');
\define('_AM_WGSLIDER_FORM_IMAGE_PATH', 'Files in %s :');
\define('_AM_WGSLIDER_FORM_ACTION', 'Action');
\define('_AM_WGSLIDER_FORM_EDIT', 'Modification');
\define('_AM_WGSLIDER_FORM_DELETE', 'Clear');
// Status
\define('_AM_WGSLIDER_STATUS', 'Status');
\define('_AM_WGSLIDER_STATUS_NONE', 'No status');
\define('_AM_WGSLIDER_STATUS_OFFLINE', 'Offline');
\define('_AM_WGSLIDER_STATUS_OFFLINE_CLICK', 'Offline, click to set online!');
\define('_AM_WGSLIDER_STATUS_ONLINE', 'Online');
\define('_AM_WGSLIDER_STATUS_ONLINE_CLICK', 'Online, click to set offline!');
\define('_AM_WGSLIDER_STATUS_INVALID_SIZE', 'Invalid size');
\define('_AM_WGSLIDER_STATUS_CHANGE', 'Change status');
\define('_AM_WGSLIDER_STATUS_CHANGE_ERROR', 'Error when changing the status');
// Clone feature
\define('_AM_WGSLIDER_CLONE', 'Clone');
\define('_AM_WGSLIDER_CLONE_DSC', 'Cloning a module has never been this easy! Just type in the name you want for it and hit submit button!');
\define('_AM_WGSLIDER_CLONE_TITLE', 'Clone %s');
\define('_AM_WGSLIDER_CLONE_NAME', 'Choose a name for the new module');
\define('_AM_WGSLIDER_CLONE_NAME_DSC', 'Do not use special characters! <br>Do not choose an existing module dirname or database table name!');
\define('_AM_WGSLIDER_CLONE_INVALIDNAME', 'ERROR: Invalid module name, please try another one!');
\define('_AM_WGSLIDER_CLONE_EXISTS', 'ERROR: Module name already taken, please try another one!');
\define('_AM_WGSLIDER_CLONE_CONGRAT', 'Congratulations! %s was successfully created!<br>You may want to make changes in language files.');
\define('_AM_WGSLIDER_CLONE_IMAGEFAIL', 'Attention, we failed creating the new module logo. Please consider modifying assets/images/logo_module.png manually!');
\define('_AM_WGSLIDER_CLONE_FAIL', 'Sorry, we failed in creating the new clone. Maybe you need to temporarily set write permissions (CHMOD 777) to modules folder and try again.');
// Image editor
\define('_AM_WGSLIDER_IMAGE_EDITOR', 'Image editor');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CREATE', 'Create image');
\define('_AM_WGSLIDER_IMAGE_EDITOR_APPLY', 'Apply');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP', 'Crop image');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE', 'Move');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_ZOOMIN', 'Zoom in');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_ZOOMOUT', 'Zoom out');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE_LEFT', 'Move left');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE_RIGHT', 'Move right');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE_UP', 'Move up');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE_DOWN', 'Move down');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_ROTATE_LEFT', 'Rotate left');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_ROTATE_RIGHT', 'Rotate right');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_FLIP_HORIZONTAL', 'Flip horizontal');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_FLIP_VERTICAL', 'Flip vertical');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO', 'Aspect ratio');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO_FREE', 'Free');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CURRENT2', 'Source of current image');
\define('_AM_WGSLIDER_IMAGE_EDITOR_RESXY', 'Resolution');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_ERROR', 'Crop operation failed. Please try again.');
// ---------------- Checks and errors ----------------
\define('_AM_WGSLIDER_INVALID_PARAM', 'Invalid parameter');
\define('_AM_WGSLIDER_INVALID_VALUE', 'Invalid value');
\define('_AM_WGSLIDER_INVALID_DATE', 'Invalid date');
\define('_AM_WGSLIDER_FORM_ERROR_INVALID_ID', 'Invalid ID');
\define('_AM_WGSLIDER_ERROR_MOVE_FILE', 'Error: moving file failed!');
\define('_AM_WGSLIDER_ERROR_MOVE_FILE_RESTORED', 'Error: moving file failed, previous file has been restored!');
\define('_AM_WGSLIDER_ERROR_FILE_NOT_FOUND', 'Error: file not found!');
\define('_AM_WGSLIDER_WARNING_SLIDESHOW_OFFLINE', 'Attention: selected slideshow is offline');
\define('_AM_WGSLIDER_WARNING_CATEGORY_OFFLINE', 'Attention: selected category is offline');
// ---------------- Admin Others ----------------
\define('_AM_WGSLIDER_ABOUT_MAKE_DONATION', 'Submit');
\define('_AM_WGSLIDER_SUPPORT_FORUM', 'Support Forum');
\define('_AM_WGSLIDER_DONATION_AMOUNT', 'Donation Amount');
\define('_AM_WGSLIDER_MAINTAINEDBY', ' is maintained by ');
// ---------------- End ----------------
