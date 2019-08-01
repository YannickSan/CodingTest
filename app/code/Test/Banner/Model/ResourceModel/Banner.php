<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 30/07/19
 * Time: 01:46
 */
namespace Test\Banner\Model\ResourceModel;

use Magento\Framework\Stdlib\DateTime\DateTime;

class Banner extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    const MAIN_TABLE = 'banners';
    const ID_FIELD_NAME = 'entity_id';

    protected $dateTime;

    public function __construct
    (
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        $connectionName = null,
        DateTime $dateTime
    )
    {
        parent::__construct($context, $connectionName);
        $this->dateTime = $dateTime;
    }

    /**
     * Resource model initialization
     */
    public function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }

    /**
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return \Magento\Framework\Model\AbstractModel
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $now = $this->dateTime->gmtDate();
        if(!$this->isObjectNotNew($object)){
            $object->setCreatedAt($now);
        }

        $object->setUpdatedAt($now);
        return $object;
    }

    /**
     * Retrieve Banner data by ID
     * @param $entityId
     * @return array
     */
    public function getById($entityId)
    {
        $connection = $this->getConnection();
        $select = $connection->select()
                             ->from($this->getMainTable())
                             ->where($connection->quoteInto('entity_id = ?', $entityId));

        return $connection->fetchRow($select);
    }
}