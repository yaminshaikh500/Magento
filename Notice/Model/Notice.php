<?php

namespace Cp\Notice\Model;

class Notice extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Cp\Notice\Model\ResourceModel\Notice::class);
    }
}
