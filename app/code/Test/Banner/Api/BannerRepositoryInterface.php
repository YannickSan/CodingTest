<?php
namespace Test\Banner\Api;

interface BannerRepositoryInterface
{
    /**
     * Save Banner entity
     * @param Data\BannerInterface $banner
     * @return mixed
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Test\Banner\Api\Data\BannerInterface $banner);

    /**
     * Get Banner by entity_id
     * @param $entityId
     * @return Data\BannerInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($entityId);

    /**
     * Delete Banner Entity
     * @param Data\BannerInterface $banner
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Test\Banner\Api\Data\BannerInterface $banner);

    /**
     * Modify 'is_active' property on banner by id
     * @param $id
     * @param $status
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function changeStatusById($id, $status);
}