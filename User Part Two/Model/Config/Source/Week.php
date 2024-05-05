<?php

namespace Cp\User\Model\Config\Source;
use Cp\User\Model\GalleryFactory;
use Magento\Framework\Option\ArrayInterface;

class Week implements ArrayInterface
{
    /**
     * Options getter
     * @return array
     */
    protected $galleryFactory;

     public function __construct(
		GalleryFactory $galleryFactory
		)
	{
		$this->galleryFactory = $galleryFactory;
		
	}
    public function toOptionArray()
    {
        $array = [];
        $model = $this->galleryFactory->create();
        $data = $model->getCollection()->getItems();
        foreach ( $data as $item) {
        $array[]=[
            'value' => $item['user_id'],
             'label' => __($item['name'])   
               ];
    }
    return $array;
}
}
