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


/**
 * Class Object Handler Slideshow
 */
class SlideshowHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'wgslider_slideshow', Slideshow::class, 'id', 'name');
    }

    /**
     * @param bool $isNew
     *
     * @return object
     */
    public function create($isNew = true): object
    {
        return parent::create($isNew);
    }

    /**
     * retrieve a field
     *
     * @param int $id field id
     * @param fields
     * @return \XoopsObject|null reference to the {@link Get} object
     */
    public function get($id = null, $fields = null): ?\XoopsObject
    {
        return parent::get($id, $fields);
    }

    /**
     * get inserted id
     *
     * @return int reference to the {@link Get} object
     */
    public function getInsertId(): int
    {
        return $this->db->getInsertId();
    }

    /**
     * Get Count Slideshow in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountSlideshow(int $start = 0, int $limit = 0, string $sort = 'id', string $order = 'ASC'): int
    {
        $crCountSlideshow = new \CriteriaCompo();
        $crCountSlideshow = $this->getSlideshowCriteria($crCountSlideshow, $start, $limit, $sort, $order);
        return $this->getCount($crCountSlideshow);
    }

    /**
     * Get All Slideshow in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllSlideshow(int $start = 0, int $limit = 0, string $sort = 'id', string $order = 'ASC'): array
    {
        $crAllSlideshow = new \CriteriaCompo();
        $crAllSlideshow = $this->getSlideshowCriteria($crAllSlideshow, $start, $limit, $sort, $order);
        return $this->getAll($crAllSlideshow);
    }

    /**
     * Get Criteria Slideshow
     * @param        $crSlideshow
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return \CriteriaCompo
     */
    private function getSlideshowCriteria($crSlideshow, int $start, int $limit, string $sort, string $order)
    {
        $crSlideshow->setStart($start);
        $crSlideshow->setLimit($limit);
        $crSlideshow->setSort($sort);
        $crSlideshow->setOrder($order);
        return $crSlideshow;
    }

    /**
     * Load all default slideshows
     * @return bool
     */
    public function loadInitialSlideshows(): bool
    {
        $helper = Wgslider\Helper::getInstance();
        $slideshowHandler = $helper->getHandler('Slideshow');
        $defaultSliders = [];
        $defaultSliders[] = $this->getSlideshowDefault();
        $defaultSliders[] = $this->getSlideshowBt3();
        $defaultSliders[] = $this->getSlideshowBt5();

        foreach ($defaultSliders as $slider) {
            $slideshowObj = $slideshowHandler->get($slider['id']);
            if (!$slideshowObj) {
                $slideshowObj = $slideshowHandler->create();
            } else {
                $slideshowObj = $slideshowHandler->get($slider['id']);
            }
            $slideshowObj->setVar('id', $slider['id']);
            $slideshowObj->setVar('name', $slider['name']);
            $slideshowObj->setVar('descr', $slider['descr']);
            $slideshowObj->setVar('tpl', $slider['tpl']);
            $slideshowObj->setVar('status', $slider['status']);
            $slideshowObj->setVar('params', $slider['params']);
            $slideshowHandler->insert($slideshowObj);
        }

        return true;
    }
    /**
     * Render array for slideshow, used as block or smarty
     * @param int $catId
     * @param int $display
     * @return array
     */
    public function getSlideshowElements(int $catId, int $display): array
    {
        $helper = \XoopsModules\Wgslider\Helper::getInstance();
        $imageHandler = $helper->getHandler('Image');
        $categoryHandler = $helper->getHandler('Category');

        $categoryObj = $categoryHandler->get($catId);
        if (is_object($categoryObj)) {
            if ((int)$categoryObj->getVar('display') <> $display) {
                return [];
            }
            $slideshowObj = $this->get($categoryObj->getVar('slideshow'));
            if (is_object($slideshowObj)) {
                $slsTpl = $slideshowObj->getVar('tpl');
                $params = json_decode($slideshowObj->getVar('params', 'n'), true);
                foreach ($params as $key => $value) {
                    $GLOBALS['xoopsTpl']->assign('wgslider_param_' . $key, $value);
                }
            } else {
                return [];
            }
        } else {
            return [];
        }
        $crImage = new \CriteriaCompo();
        $crImage->add(new \Criteria('category', $catId));
        $crImage->add(new \Criteria('status', Constants::STATUS_ONLINE));
        $crImage->setSort('weight');
        $crImage->setOrder('ASC');
        $imageCount = $imageHandler->getCount($crImage);

        if ($imageCount > 0) {
            $imageAll = $imageHandler->getAll($crImage);
            foreach (\array_keys($imageAll) as $i) {
                $block[$i]['id'] = $imageAll[$i]->getVar('id');
                $block[$i]['name'] = \htmlspecialchars($imageAll[$i]->getVar('name'), ENT_QUOTES | ENT_HTML5);
                $block[$i]['tooltip'] = \htmlspecialchars($imageAll[$i]->getVar('tooltip'), ENT_QUOTES | ENT_HTML5);
                $block[$i]['realname'] = $imageAll[$i]->getVar('realname');
            }
        }
        unset($crImage);

        return ['slsTpl' => $slsTpl, 'block' => $block];
    }

    /**
     * function getSlideshowDefault to get settings for default
     *
     * @return array
     */
    private function getSlideshowDefault(): array
    {
        return [
            'id'     => Constants::SLIDESHOW_DEFAULT,
            'name'   => 'Default',
            'descr'  => _AM_WGSLIDER_SLIDESHOW_DESCR_DEFAULT,
            'tpl'    => 'wgslider_slideshow_default.tpl',
            'status' =>  Constants::STATUS_ONLINE,
            'params' => json_encode([
                'timeout'   => 4000
            ])
        ];
    }

    /**
     * function getSlideshowDefault to get settings for bootstrap 3 carousel
     *
     * @return array
     */
    private function getSlideshowBt3(): array
    {
        return [
            'id'     => Constants::SLIDESHOW_BT3,
            'name'   => 'Bootstrap3 Carousel',
            'descr'  => _AM_WGSLIDER_SLIDESHOW_DESCR_BT3,
            'tpl'    => 'wgslider_slideshow_bt3.tpl',
            'status' => Constants::STATUS_ONLINE,
            'params' => json_encode([
                'bt3_data_interval'   => 4000,
                'bt3_data_pause'      => 'hover',
                'bt3_data_wrap'       => 'true',
                'bt3_data_keyboard'   => 'true',
                'bt3_show_indicators' => 'true',
                'bt3_show_prev_next'  => 'true',
                'bt3_fullsize'        => 'true',
            ])
        ];
    }

    /**
     * function getSlideshowDefault to get settings for bootstrap 5 carousel
     *
     * @return array
     */
    private function getSlideshowBt5(): array
    {
        return [
            'id'     => Constants::SLIDESHOW_BT5,
            'name'   => 'Bootstrap5 Carousel',
            'descr'  => _AM_WGSLIDER_SLIDESHOW_DESCR_BT5,
            'tpl'    => 'wgslider_slideshow_bt5.tpl',
            'status' => Constants::STATUS_ONLINE,
            'params' => json_encode([
                'bt5_data_interval'   => 4000,
                'bt5_data_pause'      => 'hover',
                'bt5_data_wrap'       => 'true',
                'bt5_data_keyboard'   => 'true',
                'bt5_data_touch'      => 'true',
                'bt5_show_indicators' => 'true',
                'bt5_show_prev_next'  => 'true',
                'bt5_show_captions'   => 'true',
                'bt5_fullsize'        => 'true',
            ])
        ];
    }
}
