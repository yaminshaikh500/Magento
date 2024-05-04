<?php

namespace Cp\Notice\Model\ResourceModel\Notification;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'notification_id';
    protected function _construct()
    {
        $this->_init(
            \Cp\Notice\Model\Notification::class,
            \Cp\Notice\Model\ResourceModel\Notification::class
        );
    }
}
