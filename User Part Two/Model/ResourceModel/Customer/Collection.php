<?php

namespace Cp\User\Model\ResourceModel\Customer;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'customer_id';
    protected function _construct()
    {
        $this->_init(
            \Cp\User\Model\Customer::class,
            \Cp\User\Model\ResourceModel\Customer::class
        );
    }
}
