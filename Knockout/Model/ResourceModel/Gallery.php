<?php

namespace Cp\Knockout\Model\ResourceModel;

class Gallery extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('user', 'user_id');
    }
}
