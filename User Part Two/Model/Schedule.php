<?php

namespace Cp\User\Model;

class Schedule extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Cp\User\Model\ResourceModel\Schedule::class);
    }
}
