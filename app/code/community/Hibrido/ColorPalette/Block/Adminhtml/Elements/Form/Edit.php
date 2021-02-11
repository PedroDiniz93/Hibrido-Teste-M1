<?php

use Mage_Adminhtml_Block_Widget_Form as WidgetForm;

class Hibrido_ColorPalette_Block_Adminhtml_Elements_Form_Edit extends WidgetForm
{
    protected $_fieldsEnabled = true;

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'name' => 'edit_form',
            'action' => $this->getData('action'),
            'method' => 'post',
        ));

        $fieldset = $form->addFieldset('description', array(
            'legend' => Mage::helper('colorpalette')->__('Adição de elementos'),
        ));

        $fieldset->addField('id', 'hidden', array(
            'label' => Mage::helper('colorpalette')->__('Id'),
            'name' => 'id',
            'value' => Mage::registry('id'),
        ));

        $fieldset->addField('element', 'text', array(
            'name' => 'element',
            'index' => 'element',
            'label' => 'Elemento',
            'required' => true,
            'value' => Mage::registry('element'),
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
