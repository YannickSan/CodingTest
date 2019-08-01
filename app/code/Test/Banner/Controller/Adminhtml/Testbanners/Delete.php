<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 01/08/19
 * Time: 00:09
 */
namespace Test\Banner\Controller\Adminhtml\Testbanners;

use Test\Banner\Controller\Adminhtml\AbstractBanner;

class Delete extends AbstractBanner
{
    public function execute()
    {
        $banner = $this->_initBanner('id');
        try{
            $this->bannerRepository->delete($banner);
            $this->messageManager->addSuccessMessage(__('The banner has been deleted'));
        }catch(\Exception $e){
            $this->messageManager->addErrorMessage(__('The banner could not be deleted: ['.$e->getMessage().']'));
        }

        $this->_redirect($this->_redirect->getRefererUrl());
    }
}