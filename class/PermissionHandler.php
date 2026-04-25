<?php

declare(strict_types=1);


namespace XoopsModules\Wgslider;

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

use XoopsModules\Wgslider\Constants;

\defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object PermissionsHandler
 */
class PermissionHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * @public function permGlobalSubmit
     * returns right for global submit
     *
     * @return bool
     */
    public function getPermGlobalSubmit()
    {
        global $xoopsUser, $xoopsModule;
        $currentuid = 0;
        if (isset($xoopsUser) && \is_object($xoopsUser)) {
            if ($xoopsUser->isAdmin($xoopsModule->mid())) {
                return true;
            }
            $currentuid = $xoopsUser->uid();
        }
        $grouppermHandler = \xoops_getHandler('groupperm');
        $mid = $xoopsModule->mid();
        $memberHandler = \xoops_getHandler('member');
        if (0 == $currentuid) {
            $my_group_ids = [\XOOPS_GROUP_ANONYMOUS];
        } else {
            $my_group_ids = $memberHandler->getGroupsByUser($currentuid);
        }
        if ($grouppermHandler->checkRight('wgslider_global', Constants::PERM_GLOBAL_SUBMIT, $my_group_ids, $mid)) {
            return true;
        }
        return false;
    }

    /**
     * @public function permGlobalView
     * returns right for global view
     *
     * @return bool
     */
    public function getPermGlobalView()
    {
        if ($this->getPermGlobalSubmit()) {
            return true;
        }

        global $xoopsUser, $xoopsModule;
        $currentuid = 0;
        if (isset($xoopsUser) && \is_object($xoopsUser)) {
            if ($xoopsUser->isAdmin($xoopsModule->mid())) {
                return true;
            }
            $currentuid = $xoopsUser->uid();
        }
        $grouppermHandler = \xoops_getHandler('groupperm');
        $mid = $xoopsModule->mid();
        $memberHandler = \xoops_getHandler('member');
        if (0 == $currentuid) {
            $my_group_ids = [\XOOPS_GROUP_ANONYMOUS];
        } else {
            $my_group_ids = $memberHandler->getGroupsByUser($currentuid);
        }

        if ($grouppermHandler->checkRight('wgslider_global', Constants::PERM_GLOBAL_VIEW, $my_group_ids, $mid)) {
            return true;
        }
        return false;
    }

    /**
     * @public function getPermCategorySubmit
     * returns right for submitting a category
     *
     * @return bool
     */
    public function getPermCategorySubmit()
    {
        if ($this->getPermGlobalSubmit()) {
            return true;
        }

        global $xoopsUser, $xoopsModule;
        $currentuid = 0;
        if (isset($xoopsUser) && \is_object($xoopsUser)) {
            if ($xoopsUser->isAdmin($xoopsModule->mid())) {
                return true;
            }
            $currentuid = $xoopsUser->uid();
        }
        $grouppermHandler = \xoops_getHandler('groupperm');
        $mid = $xoopsModule->mid();
        $memberHandler = \xoops_getHandler('member');
        if (0 == $currentuid) {
            $my_group_ids = [\XOOPS_GROUP_ANONYMOUS];
        } else {
            $my_group_ids = $memberHandler->getGroupsByUser($currentuid);
        }
        if ($grouppermHandler->checkRight('wgslider_global', Constants::PERM_CATEGORY_SUBMIT, $my_group_ids, $mid)) {
            return true;
        }
        return false;
    }

    /**
     * @public function getPermCategoryEdit
     * returns right for editing category
     * @param int $catId
     * @param int $catSubmitter
     *
     * @return bool
     */
    public function getPermCategoryEdit(int $catId, int $catSubmitter): bool
    {
        if ($this->getPermGlobalSubmit() || $this->getPermCategorySubmit()) {
            return true;
        }

        global $xoopsUser, $xoopsModule;
        $currentuid = 0;
        if (isset($xoopsUser) && \is_object($xoopsUser)) {
            if ($xoopsUser->isAdmin($xoopsModule->mid())) {
                return true;
            }
            $currentuid = (int)$xoopsUser->uid();
        }
        if ($currentuid !== $catSubmitter) {
            return false;
        }
        $grouppermHandler = \xoops_getHandler('groupperm');
        $mid = $xoopsModule->mid();
        $memberHandler = \xoops_getHandler('member');
        if (0 == $currentuid) {
            $my_group_ids = [\XOOPS_GROUP_ANONYMOUS];
        } else {
            $my_group_ids = $memberHandler->getGroupsByUser($currentuid);
        }
        if ($grouppermHandler->checkRight('wgslider_cat_edit', $catId, $my_group_ids, $mid)) {
            return true;
        }
        return false;
    }

    /**
     * @public function getPermCategoryView
     * returns right for viewing category
     * @param int $catId
     *
     * @return bool
     */
    public function getPermCategoryView(int $catId): bool
    {
        if ($this->getPermGlobalView() || $this->getPermGlobalSubmit()) {
            return true;
        }

        global $xoopsUser, $xoopsModule;
        $currentuid = 0;
        if (isset($xoopsUser) && \is_object($xoopsUser)) {
            if ($xoopsUser->isAdmin($xoopsModule->mid())) {
                return true;
            }
            $currentuid = $xoopsUser->uid();
        }
        $grouppermHandler = \xoops_getHandler('groupperm');
        $mid = $xoopsModule->mid();
        $memberHandler = \xoops_getHandler('member');
        if (0 == $currentuid) {
            $my_group_ids = [\XOOPS_GROUP_ANONYMOUS];
        } else {
            $my_group_ids = $memberHandler->getGroupsByUser($currentuid);
        }

        if ($grouppermHandler->checkRight('wgslider_cat_view', $catId, $my_group_ids, $mid)) {
            return true;
        }
        return false;
    }
}
