<?php
namespace Cp\User\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class CustomAttributeSource extends AbstractSource
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
            ['value' => 0, 'label' => __('256GB')],
            ['value' => 1, 'label' => __('128GB')],
            ['value' => 2, 'label' => __('64GB')],
            // Add more options as needed
        ];
    }
}
?>