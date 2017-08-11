<?php
namespace Packt\MTest\Controller\Adminhtml\Customer;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Packt_MTest::customer');
        $resultPage->addBreadcrumb(__('Hello'), __('Hello'));
        $resultPage->addBreadcrumb(__('Manage Customer'), __('Manage Customers'));
        $resultPage->getConfig()->getTitle()->prepend(__('Customer List'));
    return $resultPage;
}
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Packt_MTest::customer');
}
}
?>