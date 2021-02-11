<?php

use Mage_Adminhtml_Block_Widget_Form as WidgetForm;

class Hibrido_ColorPalette_Block_Adminhtml_Rules_Form_Edit extends WidgetForm
{
    protected $_fieldsEnabled = true;

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'name'      => 'edit_form',
            'action'    => $this->getData('action'),
            'method'    => 'post',
        ));

        $fieldset = $form->addFieldset('description', array(
            'legend'    => Mage::helper('colorpalette')->__('Regra de cores'),
        ));

        $fieldset->addField('id', 'hidden', array(
            'label'     => Mage::helper('colorpalette')->__('Id'),
            'name'      => 'id',
            'value'     => Mage::registry('id'),
        ));

        $fieldset->addField('active', 'select', array(
            'name'      => 'active',
            'label'     => 'Ativo',
            'class'     => 'required-entry',
            'required'  => true,
            'values'    => array('1' => 'Habilitado', '0' => 'Desabilitado'),
            'value'     => Mage::registry('active'),
        ));

        $model = Mage::getModel('colorpalette/elements');
        $fieldset->addField('element', 'select', array(
            'name'      => 'element',
            'index'     => 'element',
            'label'     => 'Elementos',
            'options'   => $model->getElementsOptionsArray(),
            'required'  => true,
            'value'     => Mage::registry('element'),
            'note'      => 'Elementos podem ser adicionado em: <br> Paleta de cores -> Adicionar elementos'
        ));

        $fieldset->addField('color', 'text', array(
            'name'      => 'color',
            'index'     => 'color',
            'label'     => 'Cor',
            'required'  => true,
            'class'     => 'color {required:true, adjust:true, hash:true} validate-hex',
            'value'     => Mage::registry('color'),
            'maxlength' => 7,
            'note'      =>  '
            <strong style="color:red;">
                Exemplo de HEX Color: <br>
            </strong>
            <label>
                <strong>Branco:</strong> #FFFFF <br>
                <strong>Vermelho:</strong> #FF0000 <br>
                <strong>Azul:</strong> #0037FF <br>
                <strong>Amarelo:</strong> #FFEE00 <br>

            </label>',
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
