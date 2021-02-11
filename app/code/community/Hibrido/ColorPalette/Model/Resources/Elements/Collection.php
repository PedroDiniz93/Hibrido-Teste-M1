<?php

use Mage_Core_Model_Mysql4_Collection_Abstract as CollectionAbstract;

class Hibrido_ColorPalette_Model_Resources_Elements_Collection extends CollectionAbstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('colorpalette/elements');
    }
}
