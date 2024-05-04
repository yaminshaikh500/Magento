<?php
namespace Cp\Knockout\Block;
use Cp\User\Model\GalleryFactory;

 
class ViewAbstract extends \Magento\Framework\View\Element\Template
{
    protected $configProvider;
    protected $galleryFactory;

    protected $_layoutProcessors;
 
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Checkout\Model\CompositeConfigProvider $configProvider,
        GalleryFactory $galleryFactory,

        array $layoutProcessors = [],
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->configProvider = $configProvider;
        $this->_layoutProcessors = $layoutProcessors;
        $this->galleryFactory = $galleryFactory;

        
    }
 
    public function getJsLayout()
    {
        foreach ($this->_layoutProcessors as $processor) {
            $this->jsLayout = $processor->process($this->jsLayout);
        }
        return parent::getJsLayout();
    }

    public function display()
    {
        $galleryCollection = $this->galleryFactory->create()->getCollection()->getData();
        
    
        return json_encode($galleryCollection);
    }
    
    
}
 