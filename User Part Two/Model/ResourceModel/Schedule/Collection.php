<?php

namespace Cp\User\Model\ResourceModel\Schedule;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'schedule_id';
    protected function _construct()
    {
        $this->_init(
            \Cp\User\Model\Schedule::class,
            \Cp\User\Model\ResourceModel\Schedule::class
        );
    }
}
