<?php

namespace Cp\User\Model\Config\Source;

use Cp\User\Model\GalleryFactory;
use Magento\Framework\Option\ArrayInterface;

class Promotion implements ArrayInterface
{
    protected $galleryFactory;

    public function __construct(
        GalleryFactory $galleryFactory
    ) {
        $this->galleryFactory = $galleryFactory;
    }

    public function toOptionArray()
    {
        $options = [];
        $model = $this->galleryFactory->create();
        $collection = $model->getCollection();
        
        
        $activeUsers = $collection->addFieldToFilter('is_active', 1)->getItems();
        foreach ($activeUsers as $user) {
            $options[] = ['value' => $user->getId(), 'label' => $user->getName()];
        }
        
        
        // $inactiveUsers = $collection->addFieldToFilter('is_active', 0)->getItems();
        // foreach ($inactiveUsers as $user) {
        //     $options[] = ['value' => $user->getId(), 'label' => $user->getName()];
        // }

        return $options;
    }
}
