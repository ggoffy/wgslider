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
        $defaultSliders[] = $this->getSlideshowSwiper();
        $defaultSliders[] = $this->getSlideshowSplide();

        foreach ($defaultSliders as $slider) {
            $slideshowObj = $slideshowHandler->get($slider['id']);
            if (!$slideshowObj) {
                $slideshowObj = $slideshowHandler->create();
            }
            $slideshowObj->setVar('id', $slider['id']);
            $slideshowObj->setVar('name', $slider['name']);
            $slideshowObj->setVar('descr', $slider['descr']);
            $slideshowObj->setVar('tpl', $slider['tpl']);
            $slideshowObj->setVar('status', $slider['status']);
            $slideshowObj->setVar('credits', $slider['credits']);
            $slideshowObj->setVar('params', $slider['params']);
            $slideshowObj->setVar('assets', $slider['assets']);
            $slideshowHandler->insert($slideshowObj);
        }

        return true;
    }

    /**
     * Render array for slideshow, used as block or smarty
     * @param int  $catId
     * @param int  $display
     * @param bool $assets
     * @param bool $preview
     * @return array
     */
    public function getSlideshowElements(int $catId, int $display, bool $assets = false, bool $preview = false): array
    {
        $helper = \XoopsModules\Wgslider\Helper::getInstance();
        /** `@var` \XoopsModules\Wgslider\ImageHandler $imageHandler */
        $imageHandler    = $helper->getHandler('Image');
        /** `@var` \XoopsModules\Wgslider\CategoryHandler $categoryHandler */
        $categoryHandler = $helper->getHandler('Category');

        $block     = [];
        $slsParams = [];
        $slsAssets = [];

        $categoryObj = $categoryHandler->get($catId);
        if (is_object($categoryObj)) {
            if ((int)$categoryObj->getVar('display') !== $display && !$preview) {
                return [];
            }
            if ((int)$categoryObj->getVar('status') !== Constants::STATUS_ONLINE) {
                return [];
            }
            $slideshowObj = $this->get($categoryObj->getVar('slideshow'));
            if (is_object($slideshowObj)) {
                $slsTpl = $slideshowObj->getVar('tpl');

                $params = json_decode($slideshowObj->getVar('params', 'n'), true);
                if (!\is_array($params)) {
                    $params = [];
                }
                foreach ($params as $key => $value) {
                    $paramValue = \is_array($value) ? ($value['default'] ?? null) : $value;
                    $slsParams[$key] = match ($paramValue) {
                        'true' => true,
                        'false' => false,
                        default => $paramValue,
                    };
                }
                if ($assets) {
                    $slsAssets = json_decode($slideshowObj->getVar('assets', 'n'), true);
                    if (!\is_array($slsAssets)) {
                        $slsAssets = [];
                    }
                }
            } else {
                return [];
            }
        } else {
            return [];
        }
        $crImage = new \CriteriaCompo();
        $crImage->add(new \Criteria('category', $catId));
        if (!$preview) {
            $crImage->add(new \Criteria('status', Constants::STATUS_ONLINE));
        }
        $crImage->setSort('weight');
        $crImage->setOrder('ASC');
        $imageCount = $imageHandler->getCount($crImage);

        if ($imageCount > 0) {
            $imageAll = $imageHandler->getAll($crImage);
            foreach (\array_keys($imageAll) as $i) {
                $block['images'][$i]['id'] = $imageAll[$i]->getVar('id');
                $block['images'][$i]['name'] = \htmlspecialchars($imageAll[$i]->getVar('name'), ENT_QUOTES | ENT_HTML5);
                $block['images'][$i]['description'] = \htmlspecialchars($imageAll[$i]->getVar('description'), ENT_QUOTES | ENT_HTML5);
                $block['images'][$i]['realname'] = $imageAll[$i]->getVar('realname');
            }
        } else {
            $block['images'] = [];
        }
        unset($crImage);

        $block['params'] = $slsParams;
        $block['assets'] = $slsAssets;

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
            'id'        => Constants::SLIDESHOW_DEFAULT,
            'name'      => 'Default',
            'descr'     => _AM_WGSLIDER_SLIDESHOW_DESCR_DEFAULT,
            'tpl'       => 'wgslider_slideshow_default.tpl',
            'status'    => Constants::STATUS_ONLINE,
            'credits'   => '',
            'assets'    => json_encode(['css' => '', 'js' => '']),
            'params'    => json_encode([
                'timeout' => [
                    'type' => 'int',
                    'default' => 4000,
                    'form' => 'text',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_DELAY',
                ]
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
            'id'        => Constants::SLIDESHOW_BT3,
            'name'      => 'Bootstrap3 Carousel',
            'descr'     => _AM_WGSLIDER_SLIDESHOW_DESCR_BT3,
            'tpl'       => 'wgslider_slideshow_bt3.tpl',
            'status'    => Constants::STATUS_ONLINE,
            'credits'   => 'https://getbootstrap.com',
            'assets'    => json_encode([
                'css' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css',
                'js' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js'
            ]),
            'params'    => json_encode([
                'interval' => [
                    'type' => 'int',
                    'default' => 4000,
                    'form' => 'int',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_DELAY',
                ],
                'pause' => [
                    'type' => 'text',
                    'default' => 'hover',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_PAUSE',
                    'options' => ['hover' => '_YES', 'false' => '_NO'],
                ],
                'wrap' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_WRAP',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'keyboard' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_KEYBOARD',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'show_indicator' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_SHOW_INDICATOR',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'show_prev_next' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_SHOW_PREV_NEXT',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'fullsize' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_FULLSIZE',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
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
            'id'        => Constants::SLIDESHOW_BT5,
            'name'      => 'Bootstrap5 Carousel',
            'descr'     => _AM_WGSLIDER_SLIDESHOW_DESCR_BT5,
            'tpl'       => 'wgslider_slideshow_bt5.tpl',
            'status'    => Constants::STATUS_ONLINE,
            'credits'   => 'https://getbootstrap.com',
            'assets'    => json_encode([
                'css' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
                'js' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js'
            ]),
            'params'    => json_encode([
                'interval' => [
                    'type' => 'int',
                    'default' => 4000,
                    'form' => 'int',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_DELAY',
                ],
                'pause' => [
                    'type' => 'text',
                    'default' => 'hover',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_PAUSE',
                    'options' => ['hover' => '_YES', 'false' => '_NO'],
                ],
                'wrap' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_WRAP',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'touch' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_TOUCH',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'keyboard' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_KEYBOARD',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'show_indicator' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_SHOW_INDICATOR',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'show_prev_next' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_SHOW_PREV_NEXT',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'show_caption' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_SHOW_CAPTION',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'show_descr' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_SHOW_DESCR',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'fullsize' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_FULLSIZE',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
            ])
        ];
    }

    /**
     * function getSlideshowSwiper to get settings for swiper
     *
     * @return array
     */
    private function getSlideshowSwiper(): array
    {
        return [
            'id'        => Constants::SLIDESHOW_SWIPER,
            'name'      => 'Swiper',
            'descr'     => _AM_WGSLIDER_SLIDESHOW_DESCR_SWIPER,
            'tpl'       => 'wgslider_slideshow_swiper.tpl',
            'status'    => Constants::STATUS_ONLINE,
            'credits'   => 'https://swiperjs.com',
            'assets'    => json_encode([
                'css' => 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
                'js' => 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js'
            ]),
            'params'    => json_encode([
                'delay' => [
                    'type' => 'int',
                    'default' => 4000,
                    'form' => 'int',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_DELAY',
                ],
                'effect'          => [
                    'type' => 'text',
                    'default' => 'slide',
                    'form' => 'select',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_EFFECT',
                    'options' => ['slide' => 'slide', 'fade' => 'fade', 'coverflow' => 'coverflow'],
                ],
                'perview' => [
                    'type' => 'text',
                    'default' => 1,
                    'form' => 'select',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_PERVIEW',
                    'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10],
                ],
                'autoplay'        => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_AUTOPLAY',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'show_indicator'  => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_SHOW_INDICATOR',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'show_prev_next' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_SHOW_PREV_NEXT',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'show_caption' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_SHOW_CAPTION',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'show_descr' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_SHOW_DESCR',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'show_thumbs' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_SHOW_THUMBS',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'pauseOnMouse' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_PAUSE',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'bg_caption' => [
                    'type' => 'text',
                    'default' => 'hard',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_BG_CAPTION',
                    'options' => ['hard' => 'hard', 'smooth' => 'smooth'],
                ],
                'autoheight' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_AUTOHEIGHT',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
            ])
        ];
    }

    /**
     * function getSlideshowSplide to get settings for splide
     *
     * @return array
     */
    private function getSlideshowSplide(): array
    {
        return [
            'id'        => Constants::SLIDESHOW_SPLIDE,
            'name'      => 'Splide',
            'descr'     => _AM_WGSLIDER_SLIDESHOW_DESCR_SPLIDE,
            'tpl'       => 'wgslider_slideshow_splide.tpl',
            'status'    => Constants::STATUS_ONLINE,
            'credits'   => 'https://splidejs.com/',
            'assets'    => json_encode([
                'css' => 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4/dist/css/splide.min.css',
                'js' => 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4/dist/js/splide.min.js'
                ]),
            'params'    => json_encode([
                'interval' => [
                    'type' => 'int',
                    'default' => 4000,
                    'form' => 'int',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_DELAY',
                ],
                'perview' => [
                    'type' => 'text',
                    'default' => 1,
                    'form' => 'select',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_PERVIEW',
                    'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10],
                ],
                'autoplay' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_AUTOPLAY',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'show_indicator'  => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_SHOW_INDICATOR',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'show_prev_next' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_SHOW_PREV_NEXT',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'show_caption' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_SHOW_CAPTION',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'show_descr' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_SHOW_DESCR',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'pauseOnMouse' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_PAUSE',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
                'gap' => [
                    'type' => 'text',
                    'default' => '0.1rem',
                    'form' => 'select',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_GAP',
                    'options' => ['0.1rem' => '0.1rem', '0.2rem' => '0.2rem','0.5rem' => '0.5rem','1rem' => '1rem'],
                ],
                'show_thumbs' => [
                    'type' => 'text',
                    'default' => 'true',
                    'form' => 'radio',
                    'label' => '_AM_WGSLIDER_SLIDESHOW_SHOW_THUMBS',
                    'options' => ['true' => '_YES', 'false' => '_NO'],
                ],
            ])
        ];
    }

    /**
     * function getDefaultParamsById to get default params
     *
     * @return array
     */
    public function getDefaultParamsById(int $slideshowId): array
    {
        switch ($slideshowId) {
            case Constants::SLIDESHOW_DEFAULT:
                $data = $this->getSlideshowDefault();
                break;
            case Constants::SLIDESHOW_BT3:
                $data = $this->getSlideshowBt3();
                break;
            case Constants::SLIDESHOW_BT5:
                $data = $this->getSlideshowBt5();
                break;
            case Constants::SLIDESHOW_SWIPER:
                $data = $this->getSlideshowSwiper();
                break;
            case Constants::SLIDESHOW_SPLIDE:
                $data = $this->getSlideshowSplide();
                break;
            default:
                return [];
        }

        return \json_decode($data['params'], true) ?: [];
    }
}
