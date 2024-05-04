<?php


namespace Cp\Knockout\Block;

use Cp\User\Model\GalleryFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Config\ScopeConfigInterface; 

class Extra extends \Magento\Framework\View\Element\Template
{
    protected $galleryFactory;
    protected $urlBuilder;
    protected $scopeConfig; 

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        GalleryFactory $galleryFactory,
        UrlInterface $urlBuilder,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->galleryFactory = $galleryFactory;
        $this->urlBuilder = $urlBuilder;
        $this->scopeConfig = $scopeConfig; 
        parent::__construct($context);
    }


    public function sayHello()
    {
        return __('Hello World');

             
    }
 
}
