<?php
namespace Cp\User\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class CustomDisplaySource extends AbstractSource
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
            ['value' => 0, 'label' => __('Super Amoled')],
            ['value' => 1, 'label' => __('Amoled')],
            ['value' => 2,'label' => __('Dynamic Amoled')],
            // Add more options as needed
        ];
    }
}
?>