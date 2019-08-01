<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 01/08/19
 * Time: 01:07
 */
namespace Test\Banner\Block\Widget;

use Magento\Framework\View\Element\Template;

class Banner extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface
{
    protected $_template = 'banner/view.phtml';

    /**
     * @var \Test\Banner\Api\BannerRepositoryInterface
     */
    protected $bannerRepository;

    /**
     * @var \Test\Banner\Helper\DataFactory
     */
    protected $helperData;

    public function __construct
    (
        Template\Context $context,
        array $data = [],
        \Test\Banner\Api\BannerRepositoryInterface $bannerRepository,
        \Test\Banner\Helper\DataFactory $helperData
    )
    {
        parent::__construct($context, $data);
        $this->bannerRepository = $bannerRepository;
        $this->helperData = $helperData;
    }

    /**
     * @return null|\Test\Banner\Api\Data\BannerInterface
     */
    public function getBanner()
    {
        if(!$this->getBannerId()){
            return null;
        }

        return $this->bannerRepository->get($this->getBannerId());
    }

    public function _toHtml()
    {
        /** @var  $helperData \Test\Banner\Helper\Data */
        $helperData = $this->helperData->create();
        if($helperData->bannersEnabledFlag()){
            return parent::_toHtml();
        }
        return '';
    }
}