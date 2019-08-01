<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 31/07/19
 * Time: 13:46
 */
namespace Test\Banner\Controller\Adminhtml\Testbanners;

use Test\Banner\Controller\Adminhtml\AbstractBanner;

class Changestatus extends AbstractBanner
{
    /**
     * Change banner status action
     */
    public function execute()
    {
        $bannerId = $this->getRequest()->getParam('id');
        $status = $this->getRequest()->getParam('status');

        try{
            $this->bannerRepository->changeStatusById($bannerId, $status);
            $this->messageManager->addSuccessMessage(__('The status has been changed succesfully'));
        }catch(\Exception $e){
            $this->messageManager->addErrorMessage(__('The status could not been changed: ['.$e->getMessage().']'));
        }

        $this->_redirect($this->_redirect->getRefererUrl());
    }
}