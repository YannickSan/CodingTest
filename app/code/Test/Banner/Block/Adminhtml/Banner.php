<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 01/08/19
 * Time: 01:43
 */
namespace Test\Banner\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Banner extends Container
{
    /**
     * Initialize banners manage page
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_testbanners';
        $this->_blockGroup = 'Test_Banner';
        $this->_headerText = __('Banners');
        $this->_addButtonLabel = __('Add New Banner');
        parent::_construct();
    }
}