<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 01/08/19
 * Time: 05:13
 */
namespace Test\Banner\Plugin;

class AddFullPathToImage
{
    /**
     * @var \Test\Banner\Helper\DataFactory
     */
    protected $helperData;

    /**
     * AddFullPathToImage constructor.
     * @param \Test\Banner\Helper\DataFactory $helperData
     */
    public function __construct
    (
        \Test\Banner\Helper\DataFactory $helperData
    )
    {
        $this->helperData = $helperData;
    }

    /**
     * Add path to image filename
     * @param \Test\Banner\Api\BannerRepositoryInterface $subject
     * @param $result
     * @return mixed
     */
    public function afterGet(\Test\Banner\Api\BannerRepositoryInterface $subject, $result)
    {
        $path = $this->helperData->create()->getPathImagesUpload();
        $file = $result->getImageFilename();

        $result->setImageFilename($path . DIRECTORY_SEPARATOR . $file);
        return $result;
    }

}