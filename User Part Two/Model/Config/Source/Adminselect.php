<?php

namespace Cp\User\Model\Config\Source;

use Cp\User\Model\GalleryFactory;
use Magento\Framework\Option\ArrayInterface;

class Adminselect implements ArrayInterface
{
    /**
     * @var GalleryFactory
     */
    protected $galleryFactory;

    /**
     * Adminselect constructor.
     * @param GalleryFactory $galleryFactory
     */
    public function __construct(GalleryFactory $galleryFactory)
    {
        $this->galleryFactory = $galleryFactory;
    }

    /**
     * Options getter
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        $collection = $this->galleryFactory->create()->getCollection()->getItems();;
        $collection->getSelect()->joinLeft(
            ['AD' => $this->getTable('Admin')],
            'main_table.a_id = AD.admin_id', 
            ['adminName' => 'AD.admin_name'] 
        );

        foreach ($collection as $item) {
            $options[]=[
                'value' => $item['admin_id'],
                 'label' => __($item['admin_name'])   
                   ];
        }

        return $options;
    }
}
