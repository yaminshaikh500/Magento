<?php

namespace Cp\Notice\Model\ResourceModel\Notice;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'notice_id';
    protected function _construct()
    {
        $this->_init(
            \Cp\Notice\Model\Notice::class,
            \Cp\Notice\Model\ResourceModel\Notice::class
        );
    }
}
