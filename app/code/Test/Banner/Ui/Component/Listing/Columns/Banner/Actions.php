<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 30/07/19
 * Time: 23:59
 */
namespace Test\Banner\Ui\Component\Listing\Columns\Banner;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Actions extends Column
{
    const URL_PATH_CHANGE_STATUS = 'adminhtml/testbanners/changestatus';
    const URL_PATH_DELETE = 'adminhtml/testbanners/delete';
    const URL_PATH_EDIT = 'adminhtml/testbanners/edit';

    /** @var UrlInterface */
    protected $urlBuilder;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }


    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                $item[$name]['edit'] = [
                    'href' => $this->urlBuilder->getUrl(self::URL_PATH_EDIT, ['id' => $item['entity_id']]),
                    'label' => __('Edit'),
                ];
                if((bool) $item['is_active']){
                    $item[$name]['disable'] = [
                        'href' => $this->urlBuilder->getUrl(self::URL_PATH_CHANGE_STATUS, ['id' => $item['entity_id'], 'status' => 0]),
                        'label' => __('Disable'),
                        'confirm' => [
                            'title' => __('Disable "${ $.$data.entity_id }"'),
                            'message' => __('Are you sure you wan\'t to disable Banner "#${ $.$data.entity_id }"?')
                        ]
                    ];
                }else{
                    $item[$name]['enable'] = [
                        'href' => $this->urlBuilder->getUrl(self::URL_PATH_CHANGE_STATUS, ['id' => $item['entity_id'], 'status' => 1]),
                        'label' => __('Enable'),
                        'confirm' => [
                            'title' => __('Enable "${ $.$data.entity_id }"'),
                            'message' => __('Are you sure you wan\'t to enable Banner "#${ $.$data.entity_id }"?')
                        ]
                    ];
                }
                $item[$name]['delete'] = [
                    'href' => $this->urlBuilder->getUrl(self::URL_PATH_DELETE, ['id' => $item['entity_id']]),
                    'label' => __('Delete'),
                    'confirm' => [
                        'title' => __('Delete "${ $.$data.entity_id }"'),
                        'message' => __('Are you sure you wan\'t to delete Banner "#${ $.$data.entity_id }"?')
                    ]
                ];

            }
        }

        return $dataSource;
    }
}