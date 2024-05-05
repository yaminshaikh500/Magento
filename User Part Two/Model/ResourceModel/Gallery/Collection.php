<?php

namespace Cp\User\Model\ResourceModel\Gallery;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'user_id';
    protected function _construct()
    {
        $this->_init(
            \Cp\User\Model\Gallery::class,
            \Cp\User\Model\ResourceModel\Gallery::class
        );
    }
}
