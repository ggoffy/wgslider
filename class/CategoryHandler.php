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
 * Class Object Handler Category
 */
class CategoryHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'wgslider_category', Category::class, 'id', 'name');
    }

    /**
     * @param bool $isNew
     *
     * @return object
     */
    public function create($isNew = true)
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
    public function getInsertId()
    {
        return $this->db->getInsertId();
    }

    /**
     * Get Count Category in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountCategory(int $start = 0, int $limit = 0, string $sort = 'id ASC, name', string $order = 'ASC')
    {
        $crCountCategory = new \CriteriaCompo();
        $crCountCategory = $this->getCategoryCriteria($crCountCategory, $start, $limit, $sort, $order);
        return $this->getCount($crCountCategory);
    }

    /**
     * Get All Category in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllCategory(int $start = 0, int $limit = 0, string $sort = 'id ASC, name', string $order = 'ASC')
    {
        $crAllCategory = new \CriteriaCompo();
        $crAllCategory = $this->getCategoryCriteria($crAllCategory, $start, $limit, $sort, $order);
        return $this->getAll($crAllCategory);
    }

    /**
     * Get Criteria Category
     * @param        $crCategory
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return \CriteriaCompo
     */
    private function getCategoryCriteria($crCategory, int $start, int $limit, string $sort, string $order)
    {
        $crCategory->setStart($start);
        $crCategory->setLimit($limit);
        $crCategory->setSort($sort);
        $crCategory->setOrder($order);
        return $crCategory;
    }
}
