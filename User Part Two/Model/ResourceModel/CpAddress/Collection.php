<?php

namespace Cp\User\Model\ResourceModel\CpAddress;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected function _construct()
    {
        $this->_init(
            \Cp\User\Model\CpAddress::class,
            \Cp\User\Model\ResourceModel\CpAddress::class
        );
    }
}
