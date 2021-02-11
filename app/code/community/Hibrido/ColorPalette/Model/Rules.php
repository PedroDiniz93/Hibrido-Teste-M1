<?php

use Mage_Core_Model_Abstract as ModelAbstract;

class Hibrido_ColorPalette_Model_Rules extends ModelAbstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('colorpalette/rules');
    }
}
