<?php
namespace Cp\User\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class PriceType extends AbstractSource
{
    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        // Your custom logic to fetch options
        return [
            ['value' => '', 'label' => __( 'Select Type')],
            ['value' => 0, 'label' => __('Fixed')],
            ['value' => 1, 'label' => __('Percentage')],
            // Add more options as needed
        ];
    }
}
?>