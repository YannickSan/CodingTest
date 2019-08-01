<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 30/07/19
 * Time: 01:46
 */
namespace Test\Banner\Model;

class Banner extends \Magento\Framework\Model\AbstractModel
    implements \Test\Banner\Api\Data\BannerInterface
{
    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'banners';

    /**
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'banners';

    /**
     * Attaching resource model to model
     */
    public function _construct()
    {
        $this->_init(\Test\Banner\Model\ResourceModel\Banner::class);
    }

    /**
     * @return mixed
     */
    public function getEntityId()
    {
        return $this->_getData(self::ENTITY_ID);
    }

    /**
     * @param int $entityId
     * @return $this
     */
    public function setEntityId($entityId)
    {
        $this->setData(self::ENTITY_ID, $entityId);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->_getData(self::IDENTIFIER);
    }

    /**
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->setData(self::IDENTIFIER, $identifier);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->_getData(self::IS_ACTIVE);
    }

    /**
     * @param int $isActive
     * @return $this
     */
    public function setIsActive($isActive)
    {
        $this->setData(self::IS_ACTIVE, $isActive);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageFilename()
    {
        return $this->_getData(self::IMAGE_FILENAME);
    }

    /**
     * @param string $imageFilename
     * @return $this
     */
    public function setImageFilename($imageFilename)
    {
        $this->setData(self::IMAGE_FILENAME, $imageFilename);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHtmlContent()
    {
        return $this->_getData(self::HTML_CONTENT);
    }

    /**
     * @param string $htmlContent
     * @return $this
     */
    public function setHtmlContent($htmlContent)
    {
        $this->setData(self::HTML_CONTENT, $htmlContent);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->_getData(self::CREATED_AT);
    }

    /**
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->setData(self::CREATED_AT, $createdAt);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->_getData(self::UPDATED_AT);
    }

    /**
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
        return $this;
    }

}