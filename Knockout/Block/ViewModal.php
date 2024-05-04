<?php


namespace Cp\Knockout\Block;

use Cp\User\Model\GalleryFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Config\ScopeConfigInterface; 
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ViewModal extends \Magento\Framework\View\Element\Template implements ArgumentInterface
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


    public function display()
{
   
    $model = $this->galleryFactory->create();
    $collection = $model->getCollection();


    foreach ($collection as $item) {
        echo "<tr>";
        echo "<td>".$item->getUserId()."</td>";
        echo "<td>".$item->getName()."</td>";
        echo "<td>".$item->getEmail()."</td>";
        echo "<td>".$item->getCreationTime()."</td>";
        echo "<td>".$item->getUpdateTime()."</td>";
        echo "<td><a href='".$this->urlBuilder->getUrl('user1/index/index', ['id' => $item->getId()])."'>Edit</a></td>";
        echo "<td><button onclick=\"window.location='".$this->urlBuilder->getUrl('user1/gallery/delete', ['deleteid' => $item->getId()])."'\">Delete</button></td>";
        echo "</tr>";
    }
}
    public function sayHello()
    {
        return __('Hello World');

             
    }
 
}
