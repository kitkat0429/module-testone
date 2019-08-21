<?php
namespace Test\One\Setup;
/**
 * Test One Setup InstallSchema
 *
 * @package  Test\One\Setup
 * @author   Catherine Zuniga <kitkat21@gmail.com>
 */
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Install function
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        // Get card_suite table
        $suiteTableName = $installer->getTable('card_suite');
        // Check if the table already exists
        if ($installer->getConnection()->isTableExists($suiteTableName) != true) {
            // Create card_suite table
            $suiteTable = $installer->getConnection()
                ->newTable($suiteTableName)
                ->addColumn(
                    'card_suite_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'Card Suite ID'
                )
                ->addColumn(
                    'key',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    100,
                    ['nullable => false'],
                    'Key'
                )
                ->addColumn(
                    'value',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Value'
                )
                ->addColumn(
                    'status',
                    Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false, 'default' => '0'],
                    'Status'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->setComment('Card Suite');
            $installer->getConnection()->createTable($suiteTable);
        }

        // Get card_rank table
        $rankTableName = $installer->getTable('card_rank');
        // Check if the table already exists
        if ($installer->getConnection()->isTableExists($rankTableName) != true) {
            // Create card_rank table
            $rankTable = $installer->getConnection()
                ->newTable($rankTableName)
                ->addColumn(
                    'card_rank_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'Card Rank ID'
                )
                ->addColumn(
                    'key',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    100,
                    ['nullable => false'],
                    'Key'
                )
                ->addColumn(
                    'value',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Value'
                )
                ->addColumn(
                    'status',
                    Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false, 'default' => '0'],
                    'Status'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->setComment('Card Rank');
            $installer->getConnection()->createTable($rankTable);
        }

        // Get cards table
        $cardTableName = $installer->getTable('cards');
        // Check if the table already exists
        if ($installer->getConnection()->isTableExists($cardTableName) != true) {
            // Create cards table
            $cardTable = $installer->getConnection()
                ->newTable($cardTableName)
                ->addColumn(
                    'card_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'Card ID'
                )
                ->addColumn(
                    'card_suite_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Card Suite ID'
                )
                ->addColumn(
                    'card_rank_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Card Rank ID'
                )
                ->addColumn(
                    'key',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    100,
                    ['nullable => false'],
                    'Key'
                )
                ->addColumn(
                    'value',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Value'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->addColumn(
                    'status',
                    Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false, 'default' => '0'],
                    'Status'
                )
                ->addIndex(
                    $installer->getIdxName('cards',  ['card_suite_id', 'card_rank_id']),
                    ['card_suite_id', 'card_rank_id']
                )
                ->setComment('Cards');
            $installer->getConnection()->createTable($cardTable);
        }

        $installer->endSetup();
    }
}