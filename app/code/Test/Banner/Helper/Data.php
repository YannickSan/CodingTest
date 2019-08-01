<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 01/08/19
 * Time: 01:29
 */
namespace Test\Banner\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\StoreManagerInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    public function __construct
    (
        Context $context,
        StoreManagerInterface $storeManager
    )
    {
        parent::__construct($context);
        $this->storeManager = $storeManager;
    }

    const XML_PATH_BANNERS_FRONTEND_ENABLED = 'cms/banners/enabled';

    const PATH_IMAGES_UPLOAD = 'catalog/tmp/category';

    /**
     * Check banner enabled flag from config
     * @return bool
     */
    public function bannersEnabledFlag()
    {
        return (bool) $this->scopeConfig->getValue(self::XML_PATH_BANNERS_FRONTEND_ENABLED);
    }

    /**
     * Retrieves path image upload
     * @return string
     */
    public function getPathImagesUpload()
    {
        $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . self::PATH_IMAGES_UPLOAD;
    }
}