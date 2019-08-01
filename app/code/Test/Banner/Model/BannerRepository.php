<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 30/07/19
 * Time: 02:04
 */
namespace Test\Banner\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Serialize\JsonConverter;

class BannerRepository implements \Test\Banner\Api\BannerRepositoryInterface
{
    /**
     * @var string
     */
    protected $_cacheKey = 'test_banner_cache_';

    /**
     * @var ResourceModel\BannerFactory
     */
    protected $bannerResourceModel;

    /**
     * @var BannerFactory
     */
    protected $bannerFactory;

    /**
     * @var \Magento\Framework\App\CacheFactory
     */
    protected $cacheFactory;

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    protected $jsonSerializer;

    public function __construct
    (
        \Test\Banner\Model\ResourceModel\BannerFactory $bannerResourceModel,
        \Test\Banner\Model\BannerFactory $bannerFactory,
        \Magento\Framework\App\CacheFactory $cacheFactory,
        \Magento\Framework\Serialize\Serializer\Json $jsonSerializer
    )
    {
        $this->bannerResourceModel = $bannerResourceModel;
        $this->bannerFactory = $bannerFactory;
        $this->cacheFactory = $cacheFactory;
        $this->jsonSerializer = $jsonSerializer;
    }

    /**
     * Save Banner entity to DB
     * @param \Test\Banner\Api\Data\BannerInterface $banner
     * @throws CouldNotSaveException
     * @return bool
     */
    public function save(\Test\Banner\Api\Data\BannerInterface $banner)
    {
        try{
            /** @var $bannerResource \Test\Banner\Model\ResourceModel\Banner */
            $bannerResource = $this->bannerResourceModel->create();
            $bannerResource->save($banner);
            return true;
        }catch (\Exception $e){
            throw new CouldNotSaveException($e->getMessage());
        }
    }

    /**
     * Retrieves Banner Entity by ID
     * @param $entityId
     * @param bool $forceReload
     * @return string
     * @throws NoSuchEntityException
     */
    public function get($entityId, $forceReload = false)
    {
        $banner = $this->getBannerCached($entityId);
        if(!$banner || $forceReload){
            /** @var  $bannerResource \Test\Banner\Model\ResourceModel\Banner */
            $bannerResource = $this->bannerResourceModel->create();
            $bannerData = $bannerResource->getById($entityId);

            if(!empty($bannerData)){
                $banner = $this->bannerFactory->create()->setData($bannerData);
                if(!$banner->getId()){
                    throw new NoSuchEntityException("Invalid Banner with ID [{$entityId}]");
                }
                $this->setBannerCached($banner);
            }
        }
        return $banner;
    }

    /**
     * Delete banner entity
     * @param \Test\Banner\Api\Data\BannerInterface $banner
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\Test\Banner\Api\Data\BannerInterface $banner)
    {
        try{
            $bannerResource = $this->bannerResourceModel->create();
            $bannerResource->delete($banner);
            return true;
        }catch(\Exception $e){
            throw new CouldNotDeleteException($e->getMessage());
        }
    }

    /**
     * @param $id
     * @param $status
     * @return bool
     * @throws CouldNotSaveException
     */
    public function changeStatusById($id, $status)
    {
        try{
            $banner = $this->get($id);
            $banner->setIsActive($status);
            $this->save($banner);
            return true;
        }catch (\Exception $e){
            throw new CouldNotSaveException($e->getMessage());
        }
    }

    /**
     * Retrieve all active banners
     * @param $active bool
     * @return array
     */
    public function getBannersToArray($active = true)
    {
        $bannerResource = $this->bannerResourceModel->create();
        $connection = $bannerResource->getConnection();

        $select = $connection->select()->from($bannerResource->getMainTable())
                             ->reset(\Zend_Db_Select::COLUMNS)
                             ->columns(['entity_id','identifier']);

        // Is active filter
        if((bool) $active){
            $select->where($connection->quoteInto('is_active = ?', 1));
        }

        return $connection->fetchPairs($select);
    }

    /**
     * Retrieve cache key
     * @param $entityId
     * @return string
     */
    public function getCacheKey($entityId)
    {
        return $this->_cacheKey . $entityId;
    }

    /**
     * Set Banner Data on cache with key
     * @param $banner
     * @return mixed
     */
    public function setBannerCached($banner)
    {
        $cacheKey = $this->getCacheKey($banner->getId());
        $bannerData = $this->jsonSerializer->serialize($banner->getData());
        $this->cacheFactory->create()->save($bannerData, $cacheKey);
        return $banner;
    }

    /**
     * Retrieve Banner Entity from cache
     * @param $entityId
     * @return string
     */
    public function getBannerCached($entityId)
    {
        $banner = null;
        /** @var  $cache \Magento\Framework\App\Cache */
        $cache = $this->cacheFactory->create();
        $cacheKey = $this->getCacheKey($entityId);

        if($bannerData = $cache->load($cacheKey)){
            $banner = $this->bannerFactory->create()
                                ->setData($this->jsonSerializer->unserialize($bannerData));
        }
        return $banner;
    }

}