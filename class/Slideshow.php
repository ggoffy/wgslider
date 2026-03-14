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
 * Class Object Slideshow
 */
class Slideshow extends \XoopsObject
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
        $this->initVar('descr', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('tpl', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('params', \XOBJ_DTYPE_TXTBOX);
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
    public function getNewInsertedIdSlideshow():int
    {
        return $GLOBALS['xoopsDB']->getInsertId();
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormSlideshow(bool $action = false): \XoopsThemeForm
    {
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Title
        $title = \_AM_WGSLIDER_SLIDESHOW_SHOW;

        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text slsName
        $slsName = $this->getVar('name');
        $form->addElement(new \XoopsFormLabel(\_AM_WGSLIDER_SLIDESHOW_NAME, $slsName));
        // Form Text slsDescr
        $slsDescr = $this->getVar('descr');
        $form->addElement(new \XoopsFormLabel(\_AM_WGSLIDER_SLIDESHOW_DESCR, $slsDescr));
        // Form Editor TextArea slsParams
        $param_arr =  json_decode($this->getVar('params', 'n'), true);
        if (!is_array($param_arr)) {
            $param_arr = [];
        }
        $paramTray = new \XoopsFormElementTray(\_AM_WGSLIDER_SLIDESHOW_PARAMS, '<br>');
        foreach ($param_arr as $key => $value) {
            switch ($key) {
                // params with text or integer
                case 'timeout':
                default:
                    $paramTray->addElement(new \XoopsFormText($key, $key, 10, 255, $value), true);
                    break;
                // params with true/false
                case 'bt3_data_wrap':
                case 'bt3_data_keyboard':
                case 'bt3_show_indicators':
                case 'bt3_show_prev_next':
                case 'bt3_fullsize':
                case 'bt5_data_wrap':
                case 'bt5_data_keyboard':
                case 'bt5_data_touch':
                case 'bt5_show_indicators':
                case 'bt5_show_prev_next':
                case 'bt5_show_captions':
                case 'bt5_fullsize':
                    $truefalseSelect[$key] = new \XoopsFormRadio($key, $key, $value);
                    $truefalseSelect[$key]->addOption('true', 'true');
                    $truefalseSelect[$key]->addOption('false', 'false');
                    $paramTray->addElement($truefalseSelect[$key]);
                    break;
                // misc params
                case 'bt3_data_pause':
                case 'bt5_data_pause':
                    $truefalseSelect[$key] = new \XoopsFormRadio($key, $key, $value);
                    $truefalseSelect[$key]->addOption('"hover"', 'hover');
                    $truefalseSelect[$key]->addOption('false', 'false');
                    $paramTray->addElement($truefalseSelect[$key]);
                    break;
            }
        }
        $form->addElement($paramTray);
        // To Save
        $form->addElement(new \XoopsFormHidden('start', $this->start));
        $form->addElement(new \XoopsFormHidden('limit', $this->limit));
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormButtonTray('', \_SUBMIT, 'submit', '', false));

        return $form;
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormSlideshowAdmin(bool $action = false): \XoopsThemeForm
    {
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Title
        $title = $this->isNew() ? \_AM_WGSLIDER_SLIDESHOW_ADD : \_AM_WGSLIDER_SLIDESHOW_EDIT;

        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text slsName
        $form->addElement(new \XoopsFormText(\_AM_WGSLIDER_SLIDESHOW_NAME, 'name', 50, 255, $this->getVar('name')));
        // Form Text slsDescr
        $form->addElement(new \XoopsFormText(\_AM_WGSLIDER_SLIDESHOW_DESCR, 'descr', 50, 255, $this->getVar('descr')));
        // Form Editor TextArea slsParams
        $form->addElement(new \XoopsFormTextArea(\_AM_WGSLIDER_SLIDESHOW_PARAMS, 'params', $this->getVar('params', 'e'), 4, 47));
        // To Save
        $form->addElement(new \XoopsFormHidden('start', $this->start));
        $form->addElement(new \XoopsFormHidden('limit', $this->limit));
        $form->addElement(new \XoopsFormHidden('op', 'save'));
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
    public function getValuesSlideshow($keys = null, $format = null, $maxDepth = null): array
    {
        $ret = $this->getValues($keys, $format, $maxDepth);
        $ret['params_arr'] = json_decode($this->getVar('params', 'n'), true);

        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArraySlideshow(): array
    {
        $ret = [];
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar($var);
        }
        return $ret;
    }

    /**
     * Returns a string of a list of slideshow params
     * @param array $array
     * @return string
     */
    function renderJsonArray(array $array): string
    {
        $html = "<ul>";
        foreach ($array as $key => $value) {
            $safeKey = \htmlspecialchars((string)$key, \ENT_QUOTES | \ENT_SUBSTITUTE, 'UTF-8');
            $html .= "<li><strong>{$safeKey}:</strong> ";
            if (is_array($value)) {
                $html .= $this->renderJsonArray($value);
            } else {
                $html .= \htmlspecialchars((string)$value, \ENT_QUOTES | \ENT_SUBSTITUTE, 'UTF-8');
            }
            $html .= "</li>";
        }
        $html .= "</ul>";
        return $html;
    }

}
