<?php

namespace Cp\Notice\Model\ResourceModel;

class Notification extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('cp_notification', 'notification_id');
    }
}
