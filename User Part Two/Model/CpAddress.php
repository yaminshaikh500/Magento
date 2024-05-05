<?php

namespace Cp\User\Model;

class CpAddress extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Cp\User\Model\ResourceModel\CpAddress::class);
    }
}
