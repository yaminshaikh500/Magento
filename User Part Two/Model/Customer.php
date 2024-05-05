<?php

namespace Cp\User\Model;

class Customer extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Cp\User\Model\ResourceModel\Customer::class);
    }
}
