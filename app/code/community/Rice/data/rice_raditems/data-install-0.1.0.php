<?php

/**
 * Begin catalog attribute setup.
 * @var Mage_Catalog_Model_Resource_Setup $installer
 */
$installer = new Mage_Catalog_Model_Resource_Setup('core_setup');
$installer->startSetup();

$installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'half_life', [
	'type'                       => Varien_Db_Ddl_Table::TYPE_INTEGER,
	'label'                      => 'Half-life (seconds)',
	'frontend_class'             => 'validate-digits',
	'input'                      => 'text',
	'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
	'user_defined'               => true,
	'visible'                    => true,
	'visible_on_front'           => false,
	'unique'                     => false,
	'required'                   => false,
	'is_configurable'            => false,
	'visible_in_advanced_search' => false,
	'is_html_allowed_on_front'   => false,
	'group'                      => 'General'
]);

$installer->endSetup();


/**
 * Begin sales order attribute setup.
 * @var Mage_Sales_Model_Resource_Setup $installer
 */
$installer = new Mage_Sales_Model_Resource_Setup('core_setup');
$installer->startSetup();

$installer->addAttribute(Mage_Sales_Model_Order::ENTITY, 'contains_radioactive_item', [
	'type'     => Varien_Db_Ddl_Table::TYPE_BOOLEAN,
	'nullable' => false,
	'grid'     => true,
	'default'  => false,
	'comment'  => 'Contains radioactive item(s) below half-life threshold'
]);

$installer->endSetup();
