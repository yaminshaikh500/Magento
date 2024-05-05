<?php

namespace Cp\User\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Cp\User\Model\GalleryFactory;

class ActiveUsers implements ArrayInterface
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
        $users = $this->galleryFactory->create()->getCollection()->addFieldToFilter('is_active', 1);
        foreach ($users as $user) {
            $options[] = [
                'value' => $user->getUserId(),
                'label' => $user->getName() 
            ];
        }
        return $options;
    }
}
