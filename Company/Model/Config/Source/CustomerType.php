<?php
namespace Cp\Company\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class CustomerType extends AbstractSource
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
            ['label' => 'Individual', 'value' => __(0)],
            ['label' => 'Company', 'value' => __(1)],
            // ['value' => 'option3', 'label' => __('Option 3')],
            // Add more options as needed
        ];
    }
}
?>