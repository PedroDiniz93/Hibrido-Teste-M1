<?php

use Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract as RendererAbstract;

class Hibrido_ColorPalette_Block_Adminhtml_Rules_Renderer_Element extends RendererAbstract
{
    private $elements;

    public function render(Varien_Object $row)
    {
        $value = $row->getData('element');
        $element = Mage::getModel('colorpalette/elements')->load($value);
        return $element->getElement();
    }

}
