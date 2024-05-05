<?php
namespace Cp\User\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Custom extends AbstractSource
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
            ['value' => '256', 'label' => __('256GB')],
            ['value' => '128', 'label' => __('128GB')],
            ['value' => '64', 'label' => __('64GB')],
            // Add more options as needed
        ];
    }
}
?>