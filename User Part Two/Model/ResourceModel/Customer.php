<?php

namespace Cp\User\Model\ResourceModel;

class Customer extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('cp_customer', 'customer_id');
    }
}
