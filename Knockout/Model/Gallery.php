<?php

namespace Cp\Knockout\Model;

class Gallery extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Cp\Knockout\Model\ResourceModel\Gallery::class);
    }
}
