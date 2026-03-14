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
 * Class Object Handler Image
 */
class ImageHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'wgslider_image', Image::class, 'id', 'name');
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
    public function get($id = null, $fields = null)
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
     * Get Count Image in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountImage(int $start = 0, int $limit = 0, string $sort = 'category ASC, weight', string $order = 'ASC'): int
    {
        $crCountImage = new \CriteriaCompo();
        $crCountImage = $this->getImageCriteria($crCountImage, $start, $limit, $sort, $order);
        return $this->getCount($crCountImage);
    }

    /**
     * Get All Image in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllImage(int $start = 0, int $limit = 0, string $sort = 'category ASC, weight', string $order = 'ASC'): array
    {
        $crAllImage = new \CriteriaCompo();
        $crAllImage = $this->getImageCriteria($crAllImage, $start, $limit, $sort, $order);
        return $this->getAll($crAllImage);
    }

    /**
     * Get Criteria Image
     * @param        $crImage
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return \CriteriaCompo
     */
    private function getImageCriteria($crImage, int $start, int $limit, string $sort, string $order)
    {
        $crImage->setStart($start);
        $crImage->setLimit($limit);
        $crImage->setSort($sort);
        $crImage->setOrder($order);
        return $crImage;
    }

    /**
     * Get Count Image in the database
     * @param int $catId
     * @return int
     */
    public function getMaxWeight(int $catId): int
    {
        $crImage = new \CriteriaCompo();
        $crImage->add(new \Criteria('category', $catId));
        $crImage->setSort('weight');
        $crImage->setOrder('DESC');
        $crImage->setLimit(1);
        $imageObj = $this->getAll($crImage);
        $max = 0;
        if (!empty($imageObj)) {
            $obj = reset($imageObj);
            $max = $obj->getVar('weight');
        }
        return $max;
    }

    /**
     * Delete all Image of given category
     * @param int $catId
     * @return bool
     */
    public function deleteImagesOfCategory(int $catId): bool
    {
        $crImage = new \CriteriaCompo();
        $crImage->add(new \Criteria('category', $catId));
        $imageAll = $this->getAll($crImage);
        $errors = 0;
        foreach (\array_keys($imageAll) as $i) {
            $imageRealname = $imageAll[$i]->getVar('realname');
            $imgPath = \WGSLIDER_UPLOAD_IMAGE_PATH . '/' . $imageRealname;
            if ($this->delete($imageAll[$i])) {
                if (file_exists($imgPath)) {
                    unlink($imgPath);
                    if (file_exists($imgPath)) {
                        $errors++;
                    }
                }
            } else {
                $errors++;
            }
        }
        return (0 !== $errors);
    }
}
