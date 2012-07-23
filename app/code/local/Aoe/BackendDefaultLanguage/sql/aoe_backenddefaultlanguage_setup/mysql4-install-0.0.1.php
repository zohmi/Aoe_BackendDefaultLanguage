<?php

/**
 * @var $installer Mage_Catalog_Model_Resource_Eav_Mysql4_Setup
 */
$installer = $this;

$installer->startSetup();

$installer->getConnection()->addColumn(
    $this->getTable('admin/user'),
    'default_backend_language',
    "varchar(10) NOT NULL default ''"
);

$installer->endSetup();