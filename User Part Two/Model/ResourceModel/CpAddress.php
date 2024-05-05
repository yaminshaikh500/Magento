<?php

namespace Cp\User\Model\ResourceModel;

class CpAddress extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('cp_address', 'entity_id');
    }
}
