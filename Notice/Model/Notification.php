<?php

namespace Cp\Notice\Model;

class Notification extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Cp\Notice\Model\ResourceModel\Notification::class);
    }
}
