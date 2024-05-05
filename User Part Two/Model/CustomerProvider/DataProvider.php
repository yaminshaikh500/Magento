<?php

namespace Cp\User\Model\CustomerProvider;

use Cp\User\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Request\Http as Request;
use Magento\Framework\File\Mime;
use Magento\Store\Model\StoreManagerInterface;
use Cp\User\Model\ImageUploader;
use Magento\Framework\Filesystem\Directory\WriteInterface; 

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $loadedData;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var CollectionFactory
     */
    protected $collection;

    /**
     * @var \Magento\Framework\Filesystem\Driver\File
     */
    private $fileDriver;

    /**
     * @var \Magento\Framework\Filesystem
     */
    private $_filesystem;

    /**
     * @var Mime
     */
    private $mime;
    private $imageUploader;
    
    /**
     * @var WriteInterface
     */
    private $mediaDirectory; 

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param StoreManagerInterface $storeManager
     * @param Request $request
     * @param \Magento\Framework\Filesystem\Driver\File $fileDriver
     * @param \Magento\Framework\Filesystem $filesystem
     * @param Mime $mime
     * @param ImageUploader $imageUploader
     * @param array $meta
     * @param array $data
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        StoreManagerInterface $storeManager,
        Request $request,
        \Magento\Framework\Filesystem\Driver\File $fileDriver,
        \Magento\Framework\Filesystem $filesystem,
        Mime $mime,
        ImageUploader $imageUploader,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->storeManager = $storeManager;
        $this->request = $request;
        $this->fileDriver = $fileDriver;
        $this->_filesystem = $filesystem;
        $this->mime = $mime;
        $this->imageUploader = $imageUploader;
        
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Define resource model
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        foreach ($items as $model) {
            $modelData = $model->getData();
            $modelData['profile_image'] = [];
            $modelData['newsletter_subscription'] = explode(',', $model->getNewsletterSubscription()); 
            $mediapath = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath($this->imageUploader::BASE_TMP_PATH);

            $fileName = $model->getProfileImage();
            $filePath = $mediapath . $fileName;

            if ($this->fileDriver->isExists($filePath) && $this->fileDriver->isFile($filePath)) {
                $stat = $this->getMediaDirectory()->stat($filePath);
                $mime = $this->mime->getMimeType($filePath);

                $modelData['profile_image'] = [
                    [
                        'name' =>  $fileName,
                        'url' => $this->getMediaUrl().$this->imageUploader::BASE_TMP_PATH. $model->getProfileImage(),
                        'size' => isset($stat) ? $stat['size'] : 0,
                        'type' => $mime
                    ],
                ];
            }

            $this->loadedData[$model->getId()] = $modelData;
        }

        return $this->loadedData;
    }

    /**
     * l
     *
     * @return string
     */
    public function getMediaUrl()
    {
        $mediaUrl = $this->storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        return $mediaUrl;
    }

    /**
     * Get WriteInterface instance
     *
     * @return WriteInterface
     */
    private function getMediaDirectory()
    {
        if ($this->mediaDirectory === null) {
            $this->mediaDirectory = $this->_filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        }
        return $this->mediaDirectory;
    }
}
