<?php
namespace Cp\User\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class CustomBatterySource extends AbstractSource
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
            ['value' => 5000, 'label' => __('5000Mah')],
            ['value' => 4000, 'label' => __('4000Mah')],
            ['value' => 3000,'label' => __('3000Mah')],
            // Add more options as needed
        ];
    }
}
?>