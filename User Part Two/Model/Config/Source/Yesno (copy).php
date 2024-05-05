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
class Subscription implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    
    public function toOptionArray()
    {
        return [
            [
                'value' => '1',
                'label' => __('Subscribed'),
            ],
            [
                'value' => '0',
                'label' => __('Unsubscribed'),
            ],
        ];
    }

}
