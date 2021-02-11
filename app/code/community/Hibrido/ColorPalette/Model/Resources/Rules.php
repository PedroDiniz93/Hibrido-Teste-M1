<?php
use Mage_Core_Model_Mysql4_Abstract as Mysql4Abstract;

class Hibrido_ColorPalette_Model_Resources_Rules extends Mysql4Abstract
{
    public function _construct()
    {
        $this->_init('colorpalette/rules', 'id');
    }
}