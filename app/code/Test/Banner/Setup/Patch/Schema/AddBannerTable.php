<?php
namespace Test\Banner\Setup\Patch\Schema;

use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table as Table;
use Test\Banner\Api\Data\BannerInterface;

/**
 * Class AddBannerTable
 *
 * @package Test\Banner\Setup\Patch\Schema
 */
class AddBannerTable implements SchemaPatchInterface, PatchVersionInterface
{
    const BANNER_TABLE_NAME = 'banners';

    /**
     * @var SchemaSetupInterface
     */
    private $schemaSetup;

    public function __construct
    (
        SchemaSetupInterface $schemaSetup
    )
    {
        $this->schemaSetup = $schemaSetup;
    }

    /**
     * Creates new banners table schema
     */
    public function apply()
    {
        $this->schemaSetup->startSetup();

        $this->schemaSetup->getConnection()->createTable($this->getTable());

        $this->schemaSetup->endSetup();
    }

    /**
     * Retrieves new table with all columns attached
     * @return Table
     */
    private function getTable()
    {
        $table = $this->schemaSetup->getConnection()->newTable(self::BANNER_TABLE_NAME);
        $table
            ->addColumn(
                BannerInterface::ENTITY_ID,
                Table::TYPE_INTEGER,
                null,
                [
                    'primary'  => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'auto_increment' => true,
                    'comment'  => 'Entity ID'
                ]
            )
            ->addColumn(
                BannerInterface::IDENTIFIER,
                Table::TYPE_TEXT,
                255,
                [
                    'unsigned' => true,
                    'nullable' => false,
                    'comment'  => 'Identifier'
                ]
            )
            ->addColumn(
                BannerInterface::HTML_CONTENT,
                Table::TYPE_TEXT,
                16777216, // mediumtext type limit size
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'comment'  => 'HTML Content'
                ]
            )
            ->addColumn(
                BannerInterface::IS_ACTIVE,
                Table::TYPE_SMALLINT,
                6,
                [
                    'unsigned' => true,
                    'nullable' => false,
                    'comment'  => 'Is Active',
                    'default'  => '1'
                ]
            )
            ->addColumn(
                BannerInterface::IMAGE_FILENAME,
                Table::TYPE_TEXT,
                255,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'comment'  => 'Image Filename'
                ]
            )
            ->addColumn(
                BannerInterface::CREATED_AT,
                Table::TYPE_DATETIME,
                null,
                [
                    'unsigned' => true,
                    'nullable' => false,
                    'comment'  => 'Created At'
                ]
            )
            ->addColumn(
                BannerInterface::UPDATED_AT,
                Table::TYPE_DATETIME,
                null,
                [
                    'unsigned' => true,
                    'nullable' => false,
                    'comment'  => 'Updated At'
                ]
            );

        return $table;
    }

    /**
     * @return array
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @return string
     */
    public static function getVersion()
    {
        return '1.0.0';
    }

    /**
     * @return array
     */
    public static function getDependencies()
    {
        return [];
    }
}