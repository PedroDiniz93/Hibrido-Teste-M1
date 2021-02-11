<?php

use Mage_Core_Block_Template as BlockTemplate;

class Hibrido_ColorPalette_Block_Frontend_Style extends BlockTemplate
{
    public function getRulesClass()
    {
        if (Mage::helper('colorpalette')->isActive()) {
            $rules = Mage::getModel('colorpalette/rules')->getCollection()->getData();
            $modelElements = Mage::getModel('colorpalette/elements');
            $classes = [];
            foreach ($rules as $rule) {
                if ($rule['active']) {
                    $classes[] = [
                        'class' => $modelElements->load($rule['element'])->getElement(),
                        'color' => $rule['color']
                    ];
                }
            }
            return $classes;
        }
    }
}
