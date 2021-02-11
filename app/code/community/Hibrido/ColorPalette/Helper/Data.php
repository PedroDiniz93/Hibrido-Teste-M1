<?php

use Mage_Core_Helper_Abstract as HelperAbstract;

class Hibrido_ColorPalette_Helper_Data extends HelperAbstract
{
    private $config = 'colorpalette/general/';

    public function getConfig($path)
    {
        return Mage::getStoreConfig($this->config . $path);
    }

    public function setConfig($path, $value = "")
    {
        Mage::getModel('core/config')->saveConfig($this->config . $path, $value);
        Mage::getModel('core/config')->cleanCache();
        return $this->getConfig($path);
    }

    public function isActive()
    {
        if (
            Mage::helper('core')->isModuleEnabled('Hibrido_ColorPalette')
            && $this->getConfig('active')
        ) {
            return true;
        }
        return false;
    }

}
