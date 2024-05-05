<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Cp\User\Model\Config\Source;

/**
 * @api
 * @since 100.0.2
 */
class Hobbies implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [['value' => 'cricket', 'label' => __('Cricket')], ['value' => 'travelling', 'label' => __('Travelling')]];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    // public function toArray()
    // {
    //     return [0 => __('No'), 1 => __('Yes')];
    // }
}
