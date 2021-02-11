<?php

use Mage_Core_Model_Abstract as ModelAbstract;

class Hibrido_ColorPalette_Model_Elements extends ModelAbstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('colorpalette/elements');
    }

    public function getElementsOptionsArray()
    {
        $elements = $this->getCollection();
        $return = array();
        foreach ($elements as $element) {
            $return[$element->getData('id')] = $element->getData('element');
        }
        return $return;
    }
}
