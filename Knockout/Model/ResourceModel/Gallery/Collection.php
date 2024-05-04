<?php

namespace Cp\Knockout\Model\ResourceModel\Gallery;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'user_id';
    protected function _construct()
    {
        $this->_init(
            \Cp\Knockout\Model\Gallery::class,
            \Cp\Knockout\Model\ResourceModel\Gallery::class
        );
    }
}
