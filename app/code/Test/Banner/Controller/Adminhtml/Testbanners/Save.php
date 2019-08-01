<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 01/08/19
 * Time: 02:33
 */
namespace Test\Banner\Controller\Adminhtml\Testbanners;

use Magento\Backend\App\Action;
use Test\Banner\Controller\Adminhtml\AbstractBanner;

class Save extends AbstractBanner
{
    public function execute()
    {
        $redirectBack = $this->getRequest()->getParam('back', false);
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            return $resultRedirect->setPath('adminhtml/*/');
        }

        /** @var \Test\Banner\Model\Banner $model */
        $model = $this->_initBanner('id');
        if (!$this->isBannerExist($model)) {
            $this->messageManager->addErrorMessage(__('This banner does not exist.'));
            return $resultRedirect->setPath('adminhtml/*/');
        }

        try {
            $this->prepareBannerModelData($model, $data);
            $this->bannerRepository->save($model);
            $this->_getSession()->setFormData(false);
            $this->messageManager->addSuccessMessage(__('You saved the banner.'));
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $redirectBack = true;
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $redirectBack = true;
            $this->messageManager->addErrorMessage(__('We cannot save the banner.'));
            $this->_objectManager->get(\Psr\Log\LoggerInterface::class)->critical($e);
        }

        return ($redirectBack)
            ? $resultRedirect->setPath('adminhtml/*/edit', [
                'id' => $model->getId(),
                'store' => $model->getStoreId()
            ])
            : $resultRedirect->setPath('adminhtml/*/');
    }

    /**
     * Prepare banner model data
     *
     * @param \Test\Banner\Api\Data\BannerInterface $model
     * @param array $data
     * @return void
     */
    protected function prepareBannerModelData(\Test\Banner\Api\Data\BannerInterface $model, array $data)
    {
        if (!empty($data)) {
            if(isset($data['image_filename']) && is_array($data['image_filename'])) {
                $file = $data['image_filename'][0]['file'];
                $data['image_filename'] = $file;
            }

            $model->addData($data);
            $this->_getSession()->setFormData($data);
        }
    }

    /**
     * Check if banner exist
     *
     * @param \Test\Banner\Api\Data\BannerInterface $model
     * @return bool
     */
    protected function isBannerExist(\Test\Banner\Api\Data\BannerInterface $model)
    {
        $bannerId = $this->getRequest()->getParam('id');
        return (!$model->getId() && $bannerId) ? false : true;
    }
}