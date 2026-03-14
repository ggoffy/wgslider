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
 * Class Object Category
 */
class Category extends \XoopsObject
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
        $this->initVar('display', \XOBJ_DTYPE_INT);
        $this->initVar('key', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('status', \XOBJ_DTYPE_INT);
        $this->initVar('maximg', \XOBJ_DTYPE_INT);
        $this->initVar('imgwidth', \XOBJ_DTYPE_INT);
        $this->initVar('imgheight', \XOBJ_DTYPE_INT);
        $this->initVar('slideshow', \XOBJ_DTYPE_INT);
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
    public function getNewInsertedIdCategory():int
    {
        return $GLOBALS['xoopsDB']->getInsertId();
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormCategory(bool $action = false)
    {
        $helper = \XoopsModules\Wgslider\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Title
        $title = $this->isNew() ? \_AM_WGSLIDER_CATEGORY_ADD : \_AM_WGSLIDER_CATEGORY_EDIT;
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text catName
        $form->addElement(new \XoopsFormText(\_AM_WGSLIDER_CATEGORY_NAME, 'name', 50, 255, $this->getVar('name')), true);
        // Form Select catDisplay
        $catDisplaySelect = new \XoopsFormSelect(\_AM_WGSLIDER_CATEGORY_DISPLAY, 'display', $this->getVar('display'));
        $catDisplaySelect->addOption('', ' ');
        $catDisplaySelect->addOption(Constants::DISPLAY_BLOCK, \_AM_WGSLIDER_DISPLAY_BLOCK);
        $catDisplaySelect->addOption(Constants::DISPLAY_KEY, \_AM_WGSLIDER_DISPLAY_KEY);
        $form->addElement($catDisplaySelect, true);
        // Form Text catKey
        $catKey = $this->isNew() ? 'wgslider_' . \md5((string)\mt_rand()) : $this->getVar('key');
        $selectCatKey = new \XoopsFormText(\_AM_WGSLIDER_CATEGORY_KEY, 'key', 50, 255, $catKey);
        $selectCatKey->setDescription(\_AM_WGSLIDER_CATEGORY_KEY_DESCR);
        $form->addElement($selectCatKey);
        // Form Select Status catStatus
        $catStatus = $this->isNew() ? '1' : $this->getVar('status');
        $catStatusSelect = new \XoopsFormRadio(\_AM_WGSLIDER_CATEGORY_STATUS, 'status', $catStatus);
        $catStatusSelect->addOption(Constants::STATUS_OFFLINE, \_AM_WGSLIDER_STATUS_OFFLINE);
        $catStatusSelect->addOption(Constants::STATUS_ONLINE, \_AM_WGSLIDER_STATUS_ONLINE);
        $form->addElement($catStatusSelect, true);
        // Form Text catMaximg
        /* maximg currently not used */
        /* $catMaximg = $this->isNew() ? '0' : $this->getVar('maximg');
        $txtMaxImg = new \XoopsFormText(\_AM_WGSLIDER_CATEGORY_MAXIMG, 'maximg', 20, 150, $catMaximg);
        $txtMaxImg->setDescription(_AM_WGSLIDER_CATEGORY_MAXIMG_DESCR);
        $form->addElement($txtMaxImg);*/
        $form->addElement(new \XoopsFormHidden('maximg', 0));
        // Form Text catImgwidth
        /* imgwidth currently not used */
        /*$catImgwidth = $this->isNew() ? '0' : $this->getVar('imgwidth');
        $txtImgWidth = new \XoopsFormText(\_AM_WGSLIDER_CATEGORY_IMGWIDTH, 'imgwidth', 20, 150, $catImgwidth);
        $txtImgWidth->setDescription(_AM_WGSLIDER_CATEGORY_IMGWIDTH_DESCR);
        $form->addElement($txtImgWidth);*/
        $form->addElement(new \XoopsFormHidden('imgwidth', 0));
        // Form Text catImgheight
        /* imgwidth currently not used */
        /*$catImgheight = $this->isNew() ? '0' : $this->getVar('imgheight');
        $txtImgHeight = new \XoopsFormText(\_AM_WGSLIDER_CATEGORY_IMGHEIGHT, 'imgheight', 20, 150, $catImgheight);
        $txtImgHeight->setDescription(_AM_WGSLIDER_CATEGORY_IMGHEIGHT_DESCR);
        $form->addElement($txtImgHeight);*/
        $form->addElement(new \XoopsFormHidden('imgheight', 0));
        // Form Select catSlideshow
        $slideshowHandler = $helper->getHandler('Slideshow');
        $slideshowArr = $slideshowHandler->getAll();
        $catSlideshow = $this->isNew() ? 0 : $this->getVar('slideshow');
        $catSlideshowSelect = new \XoopsFormSelect(\_AM_WGSLIDER_CATEGORY_SLIDESHOW, 'slideshow', $catSlideshow, 5);
        foreach ($slideshowArr as $slideshow) {
            $catSlideshowSelect->addOption($slideshow->getVar('id'), $slideshow->getVar('name'));
        }
        $form->addElement($catSlideshowSelect, true);
        // Form Text Date Select catDatecreated
        $catDatecreated = $this->isNew() ? \time() : $this->getVar('datecreated');
        $form->addElement(new \XoopsFormTextDateSelect(\_AM_WGSLIDER_CATEGORY_DATECREATED, 'datecreated', '', $catDatecreated), true);
        // Form Select User catSubmitter
        $uidCurrent = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->uid() : 0;
        $catSubmitter = $this->isNew() ? $uidCurrent : $this->getVar('submitter');
        $form->addElement(new \XoopsFormSelectUser(\_AM_WGSLIDER_CATEGORY_SUBMITTER, 'submitter', false, $catSubmitter), true);
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
    public function getValuesCategory($keys = null, $format = null, $maxDepth = null)
    {
        $helper = \XoopsModules\Wgslider\Helper::getInstance();
        $ret = $this->getValues($keys, $format, $maxDepth);
        // get display text
        $display = (int)$this->getVar('display');
        switch ($display) {
            case 0:
            default:
                $display_text = \_AM_WGSLIDER_INVALID_VALUE;
                break;
            case Constants::DISPLAY_BLOCK:
                $display_text = \_AM_WGSLIDER_DISPLAY_BLOCK;
                break;
            case Constants::DISPLAY_KEY:
                $display_text = \_AM_WGSLIDER_DISPLAY_KEY;
                break;
        }
        $ret['display_text'] = $display_text;
        // get status text
        $status = $this->getVar('status');
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
        }
        $ret['status_text']    = $status_text;
        $ret['imgwidth_text']  = $this->getVar('imgwidth') . ' px';
        $ret['imgheight_text'] = $this->getVar('imgheight') . ' px';
        // get slideshow text
        $slideshow      = $this->getVar('slideshow');
        $slideshow_text = \_AM_WGSLIDER_INVALID_VALUE;
        $slideshowHandler = $helper->getHandler('Slideshow');
        $slideshowObj = $slideshowHandler->get($slideshow);
        if (is_object($slideshowObj)) {
            $slideshow_text = $slideshowObj->getVar('name');
        }
        $ret['slideshow_text']    = $slideshow_text;
        // get date/submitter
        $ret['datecreated_text']  = \formatTimestamp($this->getVar('datecreated'), 's');
        $ret['submitter_text']    = \XoopsUser::getUnameFromId($this->getVar('submitter'));
        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayCategory()
    {
        $ret = [];
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar($var);
        }
        return $ret;
    }
}
