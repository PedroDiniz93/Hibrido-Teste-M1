<?php

use Mage_Adminhtml_Controller_Action as Action;

class Hibrido_ColorPalette_Adminhtml_RulesController extends Action
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
                    ->createBlock('colorpalette/Adminhtml_Rules_grid')
            );
        $this->renderLayout();
    }

    public function formAction()
    {
        $id = $this->getRequest()->getParam('id');

        if ($id) {

            $model = Mage::getModel('colorpalette/rules')->load($id);

            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError("A regra de cores do ID: {$id} não foi encontrado");
                return $this->_redirect('*/*/index');
            }
            Mage::register('id', $id);
            Mage::register('active', $model->getActive());
            Mage::register('element', $model->getElement());
            Mage::register('color', $model->getColor());
        }

        $this->_initAction()
            ->_setActiveMenu('colorpalette')
            ->_addContent(
                $this->getLayout()->createBlock('colorpalette/Adminhtml_Rules_form')
            );

        return $this->renderLayout();
    }

    public function saveAction()
    {
        $data = $this->getRequest()->getPost();
        $adminSession = Mage::getSingleton('adminhtml/session');
        try {
            $dataModel = Mage::getModel('colorpalette/rules');
            $active = $data['active'];
            $element = $data['element'];
            $color = $data['color'];

            if(!preg_match('/^#[a-zA-Z0-9]{6}/', $color)) {
                Mage::throwException('o Hex da cor está incorreto');
            }

            if ($element && $color) {
                $dataModel->setData('active', $active);
                $dataModel->setData('element', $element);
                $dataModel->setData('color', $color);
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
        $dataModel = Mage::getModel('colorpalette/rules');
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
