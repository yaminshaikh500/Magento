<?php
namespace Cp\User\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class CustomProcessorSource extends AbstractSource
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
            ['value' => 0, 'label' => __('Core')],
            ['value' => 1, 'label' => __('Intel')],
          //  ['value' => '3000Mah','label' => __('3000Mah')],
            // Add more options as needed
        ];
    }
}
?>