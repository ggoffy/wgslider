<?php
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
 * @package        wgslider
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 */

use Xmf\Request;
use XoopsModules\Wgslider\Constants;

require __DIR__ . '/header.php';
require_once \XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';

// Check admin have access to this page
$templateMain = 'wgslider_admin_permission.tpl';
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('permissions.php'));
$op = Request::getString('op', 'global');
\xoops_load('XoopsFormLoader');
$permTableForm = new \XoopsSimpleForm('', 'fselperm', 'permission.php', 'post');
$formSelect    = new \XoopsFormSelect('', 'op', $op);
$formSelect->setExtra('onchange="document.fselperm.submit()"');
$formSelect->addOption('global', \_AM_WGSLIDER_PERMS_GLOBAL);
$formSelect->addOption('cat_submit', \_AM_WGSLIDER_PERMS_CATEGORY_SUBMIT);
$formSelect->addOption('cat_view', \_AM_WGSLIDER_PERMS_CATEGORY_VIEW);
$permTableForm->addElement($formSelect);
$permTableForm->display();
switch ($op) {
    case 'global':
    default:
        $formTitle   = \_AM_WGSLIDER_PERMS_GLOBAL;
        $permName    = 'wgslider_global';
        $permDesc    = \_AM_WGSLIDER_PERMS_GLOBAL_DESC;
        $globalPerms = [Constants::PERM_GLOBAL_SUBMIT => \_AM_WGSLIDER_PERMS_GLOBAL_SUBMIT, Constants::PERM_GLOBAL_VIEW => \_AM_WGSLIDER_PERMS_GLOBAL_VIEW];
        break;
    case 'cat_submit':
        $formTitle   = \_AM_WGSLIDER_PERMS_CATEGORY_SUBMIT;
        $permName    = 'wgslider_cat_submit';
        $permDesc    = \_AM_WGSLIDER_PERMS_CATEGORY_SUBMIT_DESC;
        break;
    case 'cat_view':
        $formTitle = \_AM_WGSLIDER_PERMS_CATEGORY_VIEW;
        $permName  = 'wgslider_cat_view';
        $permDesc  = \_AM_WGSLIDER_PERMS_CATEGORY_VIEW_DESC;
        break;
}
$moduleId = $xoopsModule->getVar('mid');

if ('global' === $op) {
    $permform = new \XoopsGroupPermForm($formTitle, $moduleId, $permName, $permDesc, 'admin/permissions.php', false);
    foreach ($globalPerms as $gPermId => $gPermName) {
        $permform->addItem($gPermId, $gPermName);
    }
    $GLOBALS['xoopsTpl']->assign('form', $permform->render());
} else {
    $permform    = new \XoopsGroupPermForm($formTitle, $moduleId, $permName, $permDesc, 'admin/permissions.php');
    $categoryCount = $categoryHandler->getCountCategory();
    if ($categoryCount > 0) {
        $categoryAll = $categoryHandler->getAllCategory();
        foreach (\array_keys($categoryAll) as $i) {
            $permform->addItem($categoryAll[$i]->getVar('id'), $categoryAll[$i]->getVar('name'));
        }
        $GLOBALS['xoopsTpl']->assign('form', $permform->render());
    } else {
        $GLOBALS['xoopsTpl']->assign('error', \_AM_WGSLIDER_THEREARENT_CATEGORIES);
    }
}
unset($permform);
require __DIR__ . '/footer.php';
