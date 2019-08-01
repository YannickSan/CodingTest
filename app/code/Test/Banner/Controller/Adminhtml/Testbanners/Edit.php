<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 31/07/19
 * Time: 10:09
 */
namespace Test\Banner\Controller\Adminhtml\Testbanners;

//use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\NoSuchEntityException;
use Test\Banner\Controller\Adminhtml\AbstractBanner;

class Edit extends AbstractBanner
{
    public function execute()
    {
        $bannerId = $this->getRequest()->getParam('id');
        try{
            $model = $this->_initBanner('id');
        }catch (NoSuchEntityException $e){
            $this->messageManager->addErrorMessage(__('This banner no longer exists.'));
            $this->_redirect('adminhtml/*/');
            return;
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        $this->_view->loadLayout();
        $this->_setActiveMenu('Test_Banner::banners');
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Banners'));
        $this->_view->getPage()->getConfig()->getTitle()->prepend(
            $model->getId() ? $model->getName() : __('New Banner')
        );

        $this->_addBreadcrumb(
            $bannerId ? __('Edit Banner') : __('New Banner'),
            $bannerId ? __('Edit Banner') : __('New Banner')
        );
        $this->_view->renderLayout();
    }
}