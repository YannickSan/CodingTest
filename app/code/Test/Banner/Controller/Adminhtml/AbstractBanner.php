<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 30/07/19
 * Time: 23:40
 */
namespace Test\Banner\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Framework\Exception\NoSuchEntityException;

abstract class AbstractBanner extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Test_Banner::banners';

    /**
     * @var \Test\Banner\Api\BannerRepositoryInterface
     */
    protected $bannerRepository;

    /**
     * @var \Test\Banner\Model\BannerFactory
     */
    protected $bannerFactory;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;


    public function __construct
    (
        Action\Context $context,
        \Test\Banner\Api\BannerRepositoryInterface $bannerRepository,
        \Test\Banner\Model\BannerFactory $bannerFactory,
        \Psr\Log\LoggerInterface $logger
    )
    {
        parent::__construct($context);
        $this->bannerRepository = $bannerRepository;
        $this->bannerFactory = $bannerFactory;
        $this->logger = $logger;
    }

    /**
     * Retrieves Banner entity (new/edit)
     * @param $idFieldName
     * @return mixed|\Test\Banner\Model\Banner
     * @throws NoSuchEntityException
     */
    public function _initBanner($idFieldName)
    {
        $bannerId = $this->getRequest()->getParam($idFieldName);
        if(empty($bannerId)){
            return $this->bannerFactory->create();
        }

        if(empty($this->loadedData[$bannerId])){
            $bannerModel = $this->bannerRepository->get($bannerId);
            if(!$bannerModel->getId()){
                throw new NoSuchEntityException("Invalid Banner with ID [{$bannerId}]");
            }
            $this->loadedData[$bannerId] = $bannerModel;
        }
        return $this->loadedData[$bannerId];

    }
}