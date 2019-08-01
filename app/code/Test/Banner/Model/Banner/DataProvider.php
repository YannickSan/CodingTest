<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 31/07/19
 * Time: 09:51
 */
namespace Test\Banner\Model\Banner;

use Magento\Ui\DataProvider\Modifier\PoolInterface;

class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{

    /**
     * @var array
     */
    private $_loadedData;


    public function __construct
    (
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Test\Banner\Model\ResourceModel\Banner\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    )
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
        $this->collection = $collectionFactory->create();
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }

        /** @var \Test\Banner\Model\Banner $banner */
        $banner = $this->collection->getFirstItem();
        if(!$banner->getId()){
            return [];
        }
        $this->_loadedData[$banner->getId()] = $banner->getData();
        return $this->_loadedData;
    }
}