<?php
namespace Cp\User\Model;

use Magento\Framework\Exception\LocalizedException;
use Cp\User\Model\GalleryFactory;

class CpApi {

	protected $galleryFactory;
    protected $cpDataResource;

    public function __construct(
        GalleryFactory $galleryFactory
    ) {
		$this->galleryFactory = $galleryFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getInfo()
    {
        return 'New Api';
    }

    /**
     * Insert data into User table
     *
     * @param array $data
     * @return bool
     * @throws LocalizedException
     */
    public function save($data)
    {

        try {
            $model = $this->galleryFactory->create();
            $model->setName($data['name']);
       		$model->setEmail($data['email']);
      		$model->setPassword($data['password']);
      		$model->setAId($data['a_id']);

			$model->save();
		$response = ['status' => true, 'message' => 'User inserted successfully.'];
		return $response;


        } catch (\Exception $e) {
            throw new LocalizedException(__($e->getMessage()));
        }
    }
     /**
    * @inheritDoc
    */
   public function getUsers()
   {
       try {
           $model = $this->galleryFactory->create()->getCollection()->getData();
           return ['status' => true, 'data' => $model];
       } catch (\Exception $e) {
           return ['status' => false, 'message' => $e->getMessage()];
       }
   }
 
   /**
    * @inheritDoc
    */
    public function deleteUser($id)
    {
        try {
            $model = $this->galleryFactory->create()->load($id);
            $model->delete();
            return ['status' => true, 'message' => 'User deleted successfully.'];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

        public function updateUser($id,$name,$email,$password,$aid)
        {  
          if ($id) {
                try {
                    $model = $this->galleryFactory->create()->load($id);
                    $model->setName($name);
                    $model->setEmail($email);
                    $model->setPassword($password);
                    $model->setAId($aid);
        
                    $model->save();
                    
                    $response = ['status' => true, 'message' => 'Tax rate updated successfully.'];
                    return $response;
                } catch (\Exception $e) {
                    $this->logger->error('Error in update user: ' . $e->getMessage());
                    return ['status' => false, 'message' => $e->getMessage()];
                }
            } 
        }




 

}



 