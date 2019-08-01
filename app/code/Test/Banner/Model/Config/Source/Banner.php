<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 01/08/19
 * Time: 01:13
 */
namespace Test\Banner\Model\Config\Source;

class Banner implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Test\Banner\Api\BannerRepositoryInterface
     */
    protected $bannerRepository;

    public function __construct
    (
        \Test\Banner\Api\BannerRepositoryInterface $bannerRepository
    )
    {
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * Retrieves an array with all active banner options
     * based on key => value structure
     * @return mixed
     */
    public function toOptionArray()
    {
        return $this->bannerRepository->getBannersToArray();
    }
}