<?php

namespace Cp\Notice\Model\ResourceModel;

class Notice extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('cp_notice', 'notice_id');
    }
}
