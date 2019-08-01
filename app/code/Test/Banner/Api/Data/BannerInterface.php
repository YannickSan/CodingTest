<?php
namespace Test\Banner\Api\Data;

interface BannerInterface
{
    /**
     * Entity ID key name
     */
    const ENTITY_ID = 'entity_id';

    /**
     * Identifier key name
     */
    const IDENTIFIER = 'identifier';

    /**
     * Is active key name
     */
    const IS_ACTIVE = 'is_active';

    /**
     * Image Filename key name
     */
    const IMAGE_FILENAME = 'image_filename';

    /**
     * HTML Content key name
     */
    const HTML_CONTENT = 'html_content';

    /**
     * Created At key name
     */
    const CREATED_AT = 'created_at';

    /**
     * Updated At key name
     */
    const UPDATED_AT = 'updated_at';

    /**
     * @return int
     */
    public function getEntityId();

    /**
     * @param $entityId int
     * @return \Test\Banner\Api\Data\BannerInterface
     */
    public function setEntityId($entityId);

    /**
     * @return string
     */
    public function getIdentifier();

    /**
     * @param $identifier string
     * @return \Test\Banner\Api\Data\BannerInterface
     */
    public function setIdentifier($identifier);

    /**
     * @return int
     */
    public function getIsActive();

    /**
     * @param $isActive int
     * @return \Test\Banner\Api\Data\BannerInterface
     */
    public function setIsActive($isActive);

    /**
     * @return string
     */
    public function getImageFilename();

    /**
     * @param $imageFilename string
     * @return \Test\Banner\Api\Data\BannerInterface
     */
    public function setImageFilename($imageFilename);

    /**
     * @return string
     */
    public function getHtmlContent();

    /**
     * @param $htmlContent string
     * @return \Test\Banner\Api\Data\BannerInterface
     */
    public function setHtmlContent($htmlContent);

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param $createdAt string
     * @return \Test\Banner\Api\Data\BannerInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * @return string
     */
    public function getUpdatedAt();

    /**
     * @param $updatedAt string
     * @return \Test\Banner\Api\Data\BannerInterface
     */
    public function setUpdatedAt($updatedAt);
}