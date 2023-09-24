<?php

namespace Magedia\AccountManagement\Setup;

use Magedia\AccountManagement\Api\Data\AccountInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context): void
    {
        $installer = $setup;
        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable(AccountInterface::DB_NAME))
            ->addColumn(
                AccountInterface::ID,
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Id'
            )
            ->addColumn(
                AccountInterface::CUSTOMER_ID,
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Customer id'
            )
            ->addColumn(
                AccountInterface::IP_ADDRESS,
                Table::TYPE_TEXT,
                15,
                ['nullable' => false],
                'Ip address'
            )
            ->setComment('Customer ip address');

        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
