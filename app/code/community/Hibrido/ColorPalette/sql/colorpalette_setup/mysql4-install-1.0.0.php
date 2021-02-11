<?php

try {
    $installer = $this;
    $installer->startSetup();

    $installer->run("
        CREATE TABLE IF NOT EXISTS `colorpalette_rules` (
            `id` int(10) unsigned NOT NULL auto_increment,
            `element` varchar(255),
            `color` varchar(255),
            `active` tinyint(1) NOT NULL DEFAULT '0',
            `store_id` int(10) NOT NULL DEFAULT '1',
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

    $installer->run("
        CREATE TABLE IF NOT EXISTS `colorpalette_elements` (
            `id` int(10) unsigned NOT NULL auto_increment,
            `element` varchar(255),
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

    $installer->run("
        INSERT INTO `colorpalette_elements` (`element`)
        VALUES ('button'), ('header-language-background'), ('page-header'), ('footer');
    ");

} catch (Exception $e) {
    Mage::log($e->getMessage(), null, __FILE__ . '_setup_exception.log', true);
} finally {
    $installer->endSetup();
}
