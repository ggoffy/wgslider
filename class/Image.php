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

use XoopsModules\Wgslider;

\defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Image
 */
class Image extends \XoopsObject
{
    /**
     * @var int
     */
    public int $start = 0;

    /**
     * @var int
     */
    public int $limit = 0;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('id', \XOBJ_DTYPE_INT);
        $this->initVar('name', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('description', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('realname', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('width', \XOBJ_DTYPE_INT);
        $this->initVar('height', \XOBJ_DTYPE_INT);
        $this->initVar('category', \XOBJ_DTYPE_INT);
        $this->initVar('status', \XOBJ_DTYPE_INT);
        $this->initVar('weight', \XOBJ_DTYPE_INT);
        $this->initVar('datecreated', \XOBJ_DTYPE_INT);
        $this->initVar('submitter', \XOBJ_DTYPE_INT);
    }

    /**
     * @static function &getInstance
     */
    public static function getInstance(): self
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }
        return $instance;
    }

    /**
     * The new inserted $Id
     * @return integer
     */
    public function getNewInsertedIdImage():int
    {
        return $GLOBALS['xoopsDB']->getInsertId();
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormImage(bool $action = false): \XoopsThemeForm
    {
        $helper = \XoopsModules\Wgslider\Helper::getInstance();

        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Title
        $title = $this->isNew() ? \_AM_WGSLIDER_IMAGE_ADD : \_AM_WGSLIDER_IMAGE_EDIT;
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text imgName
        $form->addElement(new \XoopsFormText(\_AM_WGSLIDER_IMAGE_NAME, 'name', 50, 255, $this->getVar('name')), true);
        // Form Text imgDescription
        $imgDescription = $this->getVar('description');
        $form->addElement(new \XoopsFormText(\_AM_WGSLIDER_IMAGE_DESCRIPTION, 'description', 50, 255, $imgDescription));
        // Form Image imgRealname
        $imgRealname = $this->getVar('realname');
        if ($this->isNew()) {
            // Form Image imgPath: Select Uploaded Image
            $maxsize = $helper->getConfig('maxsize_image');
            $imageTray = new \XoopsFormElementTray(\_AM_WGSLIDER_IMAGE_REALNAME, '<br>');
            $imageTray->addElement(new \XoopsFormFile('<br>' . \_AM_WGSLIDER_FORM_UPLOAD_NEW, 'path', $maxsize));
            $imageTray->addElement(new \XoopsFormLabel(\_AM_WGSLIDER_FORM_UPLOAD_SIZE, ($maxsize / 1048576) . ' ' . \_AM_WGSLIDER_FORM_UPLOAD_SIZE_MB));
            $imageTray->addElement(new \XoopsFormLabel(\_AM_WGSLIDER_FORM_UPLOAD_IMG_WIDTH, $helper->getConfig('maxwidth_image') . ' px'));
            $imageTray->addElement(new \XoopsFormLabel(\_AM_WGSLIDER_FORM_UPLOAD_IMG_HEIGHT, $helper->getConfig('maxheight_image') . ' px'));
            $form->addElement($imageTray, true);
        } else {
            $form->addElement(new \XoopsFormLabel(\_AM_WGSLIDER_IMAGE_REALNAME, $imgRealname));
            $safeRealname = \rawurlencode((string)$imgRealname);
            $safeDescription  = \htmlspecialchars((string)$imgDescription, \ENT_QUOTES | \ENT_SUBSTITUTE, 'UTF-8');
            $imgPreview = '<img src="' . WGSLIDER_UPLOAD_IMAGE_URL . '/' . $safeRealname . '"';
            $imgPreview .= ' title="' . $safeDescription . '"';
            $imgPreview .= '>';
            $form->addElement(new \XoopsFormLabel('', $imgPreview));
        }
        // Form Text imgWidth
        $imgWidth = $this->isNew() ? '0' : $this->getVar('width');
        $form->addElement(new \XoopsFormLabel(\_AM_WGSLIDER_IMAGE_WIDTH, $imgWidth));
        // Form Text imgHeight
        $imgHeight = $this->isNew() ? '0' : $this->getVar('height');
        $form->addElement(new \XoopsFormLabel(\_AM_WGSLIDER_IMAGE_HEIGHT,  $imgHeight));
        // Form Table category
        $categoryHandler = $helper->getHandler('Category');
        $imgCategorySelect = new \XoopsFormSelect(\_AM_WGSLIDER_IMAGE_CATEGORY, 'category', $this->getVar('category'));
        $imgCategorySelect->addOptionArray($categoryHandler->getList());
        $form->addElement($imgCategorySelect, true);
        // Form Select Status imgStatus
        if ($this->isNew()) {
            $imgStatus = Constants::STATUS_OFFLINE;
        } else {
            // check image dimension, if invalid then set status to STATUS_INVALID_SIZE
            // TODO
            $imgStatus = $this->getVar('status');
        }
        $imgStatusSelect = new \XoopsFormRadio(\_AM_WGSLIDER_STATUS, 'status', $imgStatus);
        $imgStatusSelect->addOption(Constants::STATUS_OFFLINE, \_AM_WGSLIDER_STATUS_OFFLINE);
        $imgStatusSelect->addOption(Constants::STATUS_ONLINE, \_AM_WGSLIDER_STATUS_ONLINE);
        $form->addElement($imgStatusSelect);
        // Form Text imgWeight
        $imgWeight = $this->isNew() ? '0' : $this->getVar('weight');
        $form->addElement(new \XoopsFormHidden('weight',  $imgWeight));
        $form->addElement(new \XoopsFormLabel(\_AM_WGSLIDER_IMAGE_WEIGHT, $imgWeight));
        // Form Text Date Select imgDatecreated
        $imgDatecreated = $this->isNew() ? \time() : $this->getVar('datecreated');
        $form->addElement(new \XoopsFormTextDateSelect(\_AM_WGSLIDER_DATECREATED, 'datecreated', '', $imgDatecreated), true);
        // Form Select User imgSubmitter
        $uidCurrent = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->uid() : 0;
        $imgSubmitter = $this->isNew() ? $uidCurrent : $this->getVar('submitter');
        $form->addElement(new \XoopsFormSelectUser(\_AM_WGSLIDER_SUBMITTER, 'submitter', false, $imgSubmitter));
        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormHidden('start', $this->start));
        $form->addElement(new \XoopsFormHidden('limit', $this->limit));
        $form->addElement(new \XoopsFormButtonTray('', \_SUBMIT, 'submit', '', false));
        return $form;
    }

    /**
     * Get Values
     * @param null $keys
     * @param null $format
     * @param null $maxDepth
     * @return array
     */
    public function getValuesImage($keys = null, $format = null, $maxDepth = null): array
    {
        $helper  = \XoopsModules\Wgslider\Helper::getInstance();
        $ret = $this->getValues($keys, $format, $maxDepth);
        $ret['width_text']  = $this->getVar('width') . ' px';
        $ret['height_text'] = $this->getVar('height') . ' px';
        $categoryHandler = $helper->getHandler('Category');
        $categoryObj = $categoryHandler->get($this->getVar('category'));
        $categoryName = 'Invalid Category';
        if (is_object($categoryObj)) {
            $categoryName = $categoryObj->getVar('name');
        }
        $ret['category_name'] = $categoryName;
        $status        = $this->getVar('status');
        $ret['status'] = $status;
        switch ($status) {
            case Constants::STATUS_NONE:
            default:
                $status_text = \_AM_WGSLIDER_STATUS_NONE;
                break;
            case Constants::STATUS_OFFLINE:
                $status_text = \_AM_WGSLIDER_STATUS_OFFLINE_CLICK;
                break;
            case Constants::STATUS_ONLINE:
                $status_text = \_AM_WGSLIDER_STATUS_ONLINE_CLICK;
                break;
            case Constants::STATUS_INVALID_SIZE:
                $status_text = \_AM_WGSLIDER_STATUS_INVALID_SIZE;
                break;
        }
        $ret['status_text']       = $status_text;
        $ret['datecreated_text']  = \formatTimestamp($this->getVar('datecreated'), 's');
        $ret['submitter_text']    = \XoopsUser::getUnameFromId($this->getVar('submitter'));
        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayImage(): array
    {
        $ret = [];
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar($var);
        }
        return $ret;
    }
}
