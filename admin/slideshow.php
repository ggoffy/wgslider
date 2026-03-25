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
$slsId  = Request::getInt('id');
$start = Request::getInt('start');
$limit = Request::getInt('limit', $helper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

switch ($op) {
    case 'list':
    default:
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'wgslider_admin_slideshow.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('slideshow.php'));
        $adminObject->addItemButton(\_AM_WGSLIDER_SLIDESHOW_RESET, 'slideshow.php?op=reset');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $slideshowCount = $slideshowHandler->getCountSlideshow();
        $GLOBALS['xoopsTpl']->assign('slideshow_count', $slideshowCount);
        $GLOBALS['xoopsTpl']->assign('wgslider_url', \WGSLIDER_URL);
        $GLOBALS['xoopsTpl']->assign('wgslider_upload_url', \WGSLIDER_UPLOAD_URL);
        // Table view slideshow
        if ($slideshowCount > 0) {
            $slideshowAll = $slideshowHandler->getAllSlideshow($start, $limit);
            foreach (\array_keys($slideshowAll) as $i) {
                $slideshow = $slideshowAll[$i]->getValuesSlideshow();
                $GLOBALS['xoopsTpl']->append('slideshow_list', $slideshow);
                unset($slideshow);
            }
            // Display Navigation
            if ($slideshowCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($slideshowCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
            $GLOBALS['xoopsTpl']->assign('token', $GLOBALS['xoopsSecurity']->getTokenHTML());
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGSLIDER_THEREARENT_SLIDESHOWS);
        }
        break;
    case 'new':
        $templateMain = 'wgslider_admin_slideshow.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('slideshow.php'));
        $adminObject->addItemButton(\_AM_WGSLIDER_LIST_SLIDESHOW, 'slideshow.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $slideshowObj = $slideshowHandler->create();
        $form = $slideshowObj->getFormSlideshow();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        $templateMain = 'wgslider_admin_slideshow.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('slideshow.php'));
        $adminObject->addItemButton(\_AM_WGSLIDER_LIST_SLIDESHOW, 'slideshow.php', 'list');
        $adminObject->addItemButton(\_AM_WGSLIDER_ADD_SLIDESHOW, 'slideshow.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Request source
        $slsIdSource = Request::getInt('id_source');
        // Get Form
        $slideshowObjSource = $slideshowHandler->get($slsIdSource);
        $slideshowObj = $slideshowObjSource->xoopsClone();
        $form = $slideshowObj->getFormSlideshow();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('slideshow.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($slsId > 0) {
            $slideshowObj = $slideshowHandler->get($slsId);
        } else {
            \redirect_header('slideshow.php', 3, \_AM_WGSLIDER_INVALID_VALUE);
        }
        // Set Vars
        //$slideshowObj->setVar('name', Request::getString('name'));
        //$slideshowObj->setVar('descr', Request::getString('descr'));
        //$slideshowObj->setVar('tpl', Request::getString('tpl'));
        $param_arr = $slideshowHandler->getDefaultParamsById($slsId);
        $params = [];
        foreach (array_keys($param_arr) as $key) {
            switch ($key) {
                // params with text or integer
                case 'timeout':
                case 'interval':
                case 'delay':
                case 'perview':
                    $params[$key] = Request::getInt($key);
                    break;
                // params with string
                case 'wrap':
                case 'keyboard':
                case 'show_indicator':
                case 'show_prev_next':
                case 'show_caption':
                case 'show_descr':
                case 'show_thumbs':
                case 'fullsize':
                case 'touch':
                case 'pauseOnMouse':
                case 'autoheight':
                case 'autoplay':
                case 'effect':
                case 'bg_caption':
                case 'pause':
                case 'gap':
                default:
                    $params[$key] = Request::getString($key);
                    break;
            }
        }

        $paramsJSON = json_encode($params);
        $slideshowObj->setVar('params', $paramsJSON);
        $slideshowObj->setVar('status', Request::getInt('status'));
        // Insert Data
        if ($slideshowHandler->insert($slideshowObj)) {
                \redirect_header('slideshow.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_AM_WGSLIDER_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $slideshowObj->getHtmlErrors());
        $form = $slideshowObj->getFormSlideshow();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        $templateMain = 'wgslider_admin_slideshow.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('slideshow.php'));
        //$adminObject->addItemButton(\_AM_WGSLIDER_ADD_SLIDESHOW, 'slideshow.php?op=new');
        $adminObject->addItemButton(\_AM_WGSLIDER_LIST_SLIDESHOW, 'slideshow.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $slideshowObj = $slideshowHandler->get($slsId);
        $slideshowObj->start = $start;
        $slideshowObj->limit = $limit;
        $form = $slideshowObj->getFormSlideshow();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        $templateMain = 'wgslider_admin_slideshow.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('slideshow.php'));
        $slideshowObj = $slideshowHandler->get($slsId);
        $slsName = $slideshowObj->getVar('name');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('slideshow.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($slideshowHandler->delete($slideshowObj)) {
                \redirect_header('slideshow.php', 3, \_AM_WGSLIDER_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $slideshowObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'id' => $slsId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_AM_WGSLIDER_FORM_SURE_DELETE, $slsName));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
    case 'reset':
        $templateMain = 'wgslider_admin_slideshow.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('slideshow.php'));
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('slideshow.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($slideshowHandler->loadInitialSlideshows()) {
                \redirect_header('slideshow.php', 3, \_AM_WGSLIDER_SLIDESHOW_RESET_OK);
            } else {
                \redirect_header('slideshow.php', 3, \_AM_WGSLIDER_SLIDESHOW_RESET_ERROR);
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'op' => 'reset'],
                $_SERVER['REQUEST_URI'], \_AM_WGSLIDER_SLIDESHOW_RESET_SURE);
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
    case 'change_status':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('slideshow.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($slsId > 0) {
            $slideshowObj = $slideshowHandler->get($slsId);
        } else {
            \redirect_header('slideshow.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_AM_WGSLIDER_INVALID_PARAM);
        }
        $currentStatus = (int)$slideshowObj->getVar('status');
        if (Constants::STATUS_OFFLINE === $currentStatus) {
            $slideshowObj->setVar('status', Constants::STATUS_ONLINE );
        } else {
            $slideshowObj->setVar('status', Constants::STATUS_OFFLINE );
        }
        // Insert Data
        if ($slideshowHandler->insert($slideshowObj)) {
            \redirect_header('slideshow.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_AM_WGSLIDER_FORM_OK);
        } else {
            \redirect_header('slideshow.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_AM_WGSLIDER_STATUS_CHANGE_ERROR);
        }
        break;
}
require __DIR__ . '/footer.php';
