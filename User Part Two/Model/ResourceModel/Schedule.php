<?php

namespace Cp\User\Model\ResourceModel;

class Schedule extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('cron_schedule', 'schedule_id');
    }
}
