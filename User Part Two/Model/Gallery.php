<?php

namespace Cp\User\Model;

class Gallery extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Cp\User\Model\ResourceModel\Gallery::class);
    }
}
