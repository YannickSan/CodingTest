<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 30/07/19
 * Time: 23:36
 */
namespace Test\Banner\Controller\Adminhtml\Testbanners;

use Test\Banner\Controller\Adminhtml\AbstractBanner;

class Index extends AbstractBanner
{
    /**
     * Banners list
     *
     * @return void
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('Test_Banner::banners');
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Banners'));
        $this->_view->renderLayout();
    }
}