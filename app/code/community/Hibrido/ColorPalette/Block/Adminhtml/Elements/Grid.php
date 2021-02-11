
<?php

use Mage_Adminhtml_Block_Widget_Grid as WidgetGrid;

class Hibrido_ColorPalette_Block_Adminhtml_Elements_Grid extends WidgetGrid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('elements_grid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveBlingInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('colorpalette/elements')->getCollection();
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header' => 'ID',
            'sortable' => true,
            'index' => 'id',
            'width' => '50px',
        ));

        $this->addColumn('element', array(
            'header' => Mage::helper('colorpalette')->__('Elemento'),
            'sortable' => true,
            'index' => 'element',
            'type' => 'text',
        ));

        $this->addColumn('delete', array(
            'header' => 'Ação',
            'type' => 'action',
            'width' => '80px',
            'align' => 'center',
            'filter' => false,
            'sortable' => false,
            'index' => 'delete',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => 'Deletar',
                    'url' =>  $this->getUrl('*/*/delete', array('id' => '$id')),
                    'confirm'   => Mage::helper('adminhtml')->__('Are you sure you want to do this?')
                ),
            ),
        ));

        echo ($this->addNewButton());
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/form', array('id' => $row->getId()));
    }

    public function addNewButton()
    {
        return $this->getButtonHtml(
            Mage::helper('colorpalette')->__('Adicionar novo elemento'),
            "setLocation('" . $this->getUrl('*/*/form', array('id' => "")) . "')",
            "scalable add"
        );
    }
}
