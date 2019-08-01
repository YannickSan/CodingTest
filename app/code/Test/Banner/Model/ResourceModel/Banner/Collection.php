<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 30/07/19
 * Time: 01:46
 */
namespace Test\Banner\Model\ResourceModel\Banner;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    public function _construct()
    {
        $this->_init(\Test\Banner\Model\Banner::class, \Test\Banner\Model\ResourceModel\Banner::class);
    }
}