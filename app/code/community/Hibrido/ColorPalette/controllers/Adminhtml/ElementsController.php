<?php

use Mage_Adminhtml_Controller_Action as Action;

class Hibrido_ColorPalette_Adminhtml_ElementsController extends Action
{
    protected function _isAllowed()
    {
        return true;
    }

    protected function _initAction($ids = null)
    {
        $this->loadLayout($ids);
        return $this;
    }

    public function indexAction()
    {
        $this->_initAction()
            ->_setActiveMenu('colorpalette')
            ->_addContent(
                $this->getLayout()
                    ->createBlock('colorpalette/Adminhtml_Elements_grid')
            );
        $this->renderLayout();
    }

    public function formAction()
    {
        $id = $this->getRequest()->getParam('id');

        if ($id) {

            $model = Mage::getModel('colorpalette/elements')->load($id);

            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError("O elemento do ID: {$id} não foi encontrado");
                return $this->_redirect('*/*/index');
            }
            Mage::register('id', $id);
            Mage::register('element', $model->getElement());
        }

        $this->_initAction()
            ->_setActiveMenu('colorpalette')
            ->_addContent(
                $this->getLayout()->createBlock('colorpalette/Adminhtml_Elements_form')
            );

        return $this->renderLayout();
    }

    public function saveAction()
    {
        $data = $this->getRequest()->getPost();
        $adminSession = Mage::getSingleton('adminhtml/session');
        try {
            $dataModel = Mage::getModel('colorpalette/elements');
            $element = $data['element'];

            if ($element) {
                $dataModel->setData('element', $element);
            }

            if ($this->getRequest()->getParam('id', 0) != 0) {
                $dataModel->setId($this->getRequest()->getParam('id'));
            }

            $dataModel->save();
            $adminSession->addSuccess('Operação Realizada com sucesso');
            $this->_redirect('*/*/index');
        } catch (Exception $e) {
            $adminSession->addError($e->getMessage());
            $adminSession->setFormData($data);
            $this->_redirect('*/*/form', array('id' => $this->getRequest()->getParam('id')));
        }
    }

    public function deleteAction()
    {
        $dataId = $this->getRequest()->getParam('id');
        $dataModel = Mage::getModel('colorpalette/elements');
        $dataModel->setData('id', $dataId);

        try {
            $dataModel->delete();
            Mage::getSingleton('adminhtml/session')->addSuccess('Operação realizada com sucesso');
            $this->_redirect('*/*/index');
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError('Erro ao excluir. ' . $e->getMessage());
            $this->_redirect('*/*/edit', array('id' => $dataId));
        }
    }
}
