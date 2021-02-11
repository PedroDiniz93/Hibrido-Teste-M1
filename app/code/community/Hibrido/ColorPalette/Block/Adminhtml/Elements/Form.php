<?php
use Mage_Adminhtml_Block_Widget_Form_Container as FormContainer;

class Hibrido_ColorPalette_Block_Adminhtml_Elements_Form extends FormContainer
{
    protected function _prepareLayout()
    {
        $this->setChild(
            'form',
            $this->getLayout()->createBlock('colorpalette/Adminhtml_elements_form_edit')
        );
        return parent::_prepareLayout();
    }

    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'adminhtml_colorpalette';
        $this->_controller = 'adminhtml_colorpalette';
        $this->_updateButton('save', 'label', 'Salvar Configurações');
        parent::__construct();
    }

    public function getHeaderText()
    {
        return Mage::helper('colorpalette')->__('Adicionar elemento');
    }

    public function getSaveUrl()
    {
        return $this->getUrl('*/*/save', array('back' => null));
    }
}
