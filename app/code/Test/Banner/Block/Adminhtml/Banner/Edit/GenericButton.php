<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 31/07/19
 * Time: 20:24
 */
namespace Test\Banner\Block\Adminhtml\Banner\Edit;

use Magento\Framework\UrlInterface;
use Magento\Framework\App\RequestInterface;

class GenericButton
{

    /**
     * @var \Test\Banner\Api\BannerRepositoryInterface
     */
    private $bannerRepository;

    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * GenericButton constructor.
     * @param UrlInterface $urlBuilder
     * @param RequestInterface $request
     * @param \Test\Banner\Api\BannerRepositoryInterface $bannerRepository
     */
    public function __construct(
        UrlInterface $urlBuilder,
        RequestInterface $request,
        \Test\Banner\Api\BannerRepositoryInterface $bannerRepository
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->request = $request;
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * Return banner id
     *
     * @return int|null
     */
    public function getBannerId()
    {
        $bannerId = $this->request->getParam('id');
        if(!$bannerId){
            return null;
        }

        $banner = $this->bannerRepository->get($bannerId);
        return $banner->getId() ?? null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}