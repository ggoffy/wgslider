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
$catId = Request::getInt('id');
$start = Request::getInt('start');
$limit = Request::getInt('limit', $helper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

switch ($op) {
    case 'list':
    default:
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'wgslider_admin_category.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('category.php'));
        $adminObject->addItemButton(\_AM_WGSLIDER_ADD_CATEGORY, 'category.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $categoryCount = $categoryHandler->getCountCategory();
        $categoryAll = $categoryHandler->getAllCategory($start, $limit);
        $GLOBALS['xoopsTpl']->assign('category_count', $categoryCount);
        $GLOBALS['xoopsTpl']->assign('wgslider_url', \WGSLIDER_URL);
        $GLOBALS['xoopsTpl']->assign('wgslider_upload_url', \WGSLIDER_UPLOAD_URL);
        // Table view category
        if ($categoryCount > 0) {
            foreach (\array_keys($categoryAll) as $i) {
                $category = $categoryAll[$i]->getValuesCategory();
                $GLOBALS['xoopsTpl']->append('category_list', $category);
                unset($category);
            }
            // Display Navigation
            if ($categoryCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($categoryCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
            $GLOBALS['xoopsTpl']->assign('token', $GLOBALS['xoopsSecurity']->getTokenHTML());
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGSLIDER_THEREARENT_CATEGORIES);
        }
        break;
    case 'change_status':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('category.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($catId > 0) {
            $categoryObj = $categoryHandler->get($catId);
        } else {
            \redirect_header('category.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_AM_WGSLIDER_INVALID_PARAM);
        }
        $currentStatus = (int)$categoryObj->getVar('status');
        if (Constants::STATUS_OFFLINE === $currentStatus) {
            $categoryObj->setVar('status', Constants::STATUS_ONLINE );
        } else {
            $categoryObj->setVar('status', Constants::STATUS_OFFLINE );
        }
        // Insert Data
        if ($categoryHandler->insert($categoryObj)) {
            \redirect_header('category.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_AM_WGSLIDER_FORM_OK);
        } else {
            \redirect_header('category.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_AM_WGSLIDER_STATUS_CHANGE_ERROR);
        }
        break;
    case 'new':
        $templateMain = 'wgslider_admin_category.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('category.php'));
        $adminObject->addItemButton(\_AM_WGSLIDER_LIST_CATEGORY, 'category.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $categoryObj = $categoryHandler->create();
        $form = $categoryObj->getFormCategory();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        $templateMain = 'wgslider_admin_category.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('category.php'));
        $adminObject->addItemButton(\_AM_WGSLIDER_LIST_CATEGORY, 'category.php', 'list');
        $adminObject->addItemButton(\_AM_WGSLIDER_ADD_CATEGORY, 'category.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Request source
        $catIdSource = Request::getInt('id_source');
        // Get Form
        $categoryObjSource = $categoryHandler->get($catIdSource);
        $categoryObj = $categoryObjSource->xoopsClone();
        $form = $categoryObj->getFormCategory();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('category.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($catId > 0) {
            $categoryObj = $categoryHandler->get($catId);
        } else {
            $categoryObj = $categoryHandler->create();
        }
        // Set Vars
        $categoryObj->setVar('name', Request::getString('name'));
        $categoryObj->setVar('display', Request::getInt('display'));
        $categoryObj->setVar('key', Request::getString('key'));
        $categoryObj->setVar('status', Request::getInt('status'));
        $categoryObj->setVar('maximg', Request::getInt('maximg'));
        $categoryObj->setVar('imgwidth', Request::getInt('imgwidth'));
        $categoryObj->setVar('imgheight', Request::getInt('imgheight'));
        $categoryObj->setVar('slideshow', Request::getInt('slideshow'));
        $categoryDatecreatedObj = \DateTime::createFromFormat(\_SHORTDATESTRING, Request::getString('datecreated'));
        if ($categoryDatecreatedObj === false) {
            // invalid date
            \redirect_header('category.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_AM_WGSLIDER_INVALID_DATE);
        }
        $categoryObj->setVar('datecreated', $categoryDatecreatedObj->getTimestamp());
        $categoryObj->setVar('submitter', Request::getInt('submitter'));
        // Insert Data
        if ($categoryHandler->insert($categoryObj)) {
            \redirect_header('category.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_AM_WGSLIDER_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $categoryObj->getHtmlErrors());
        $form = $categoryObj->getFormCategory();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        $templateMain = 'wgslider_admin_category.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('category.php'));
        $adminObject->addItemButton(\_AM_WGSLIDER_ADD_CATEGORY, 'category.php?op=new');
        $adminObject->addItemButton(\_AM_WGSLIDER_LIST_CATEGORY, 'category.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $categoryObj = $categoryHandler->get($catId);
        $categoryObj->start = $start;
        $categoryObj->limit = $limit;
        $form = $categoryObj->getFormCategory();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        $templateMain = 'wgslider_admin_category.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('category.php'));
        $categoryObj = $categoryHandler->get($catId);
        $catName = $categoryObj->getVar('name');
        if (1 === Request::getInt('ok')) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('category.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($categoryHandler->delete($categoryObj)) {
                //delete all images of this category
                if ($imageHandler->deleteImagesOfCategory($catId)){
                    \redirect_header('category.php', 3, \_AM_WGSLIDER_CATEGORY_DELETE_OK);
                } else {
                    \redirect_header('category.php', 3, \_AM_WGSLIDER_CATEGORY_DELETE_FAILED);
                }
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $categoryObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'id' => $catId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_AM_WGSLIDER_CATEGORY_SURE_DELETE, $catName));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}
require __DIR__ . '/footer.php';
