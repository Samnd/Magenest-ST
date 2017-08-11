<?php
namespace Packt\MTest\Controller\Adminhtml\Customer;
use Packt\MTest\Model\ResourceModel\MTest;
use Magento\Backend\App\Action;

class Delete extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resultRedirect = $this->resultRedirectFactory->create();
        if (!($customer = $objectManager->create('Packt\MTest\Model\MTest')->load($id))) {
            $this->messageManager->addError(__('Unable to proceed. Please, try again.'));
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        try {
            $customer->delete();
            $this->messageManager->addSuccess(__('Your contact has been deleted !'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__('Error while trying to delete contact: '));
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}