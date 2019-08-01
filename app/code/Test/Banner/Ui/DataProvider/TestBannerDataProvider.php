<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 31/07/19
 * Time: 01:06
 */
namespace Test\Banner\Ui\DataProvider;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\RequestInterface;

class TestBannerDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Test\Banner\Model\ResourceModel\Banner\CollectionFactory
     */
    protected $collection;

    public function __construct
    (
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Test\Banner\Model\ResourceModel\Banner\Collection $collectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory;
    }

    public function getData()
    {
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }

        $items = [];
        foreach($this->getCollection() as $item){
            $items[] = $item->getData();
        }

        return [
            'totalRecords' => $this->getCollection()->getSize(),
            'items' => $items
        ];
    }
}