<?php
namespace Packt\MTest\Controller\Adminhtml\Customer;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Add extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    protected $resultJsonFactory;
    protected $mtestFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Packt\MTest\Model\MTestFactory $mtestFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->mtestFactory = $mtestFactory;
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $result = $this->resultJsonFactory->create();
        if ($this->getRequest()->isAjax()) {
            try {
                $data = $this->getRequest()->getParams();
                $newdata = [
                    'name' => $data['name'],
                    'address' => $data['address'],
                    'phone' => $data['phone']
                ];
                $sub = $this->mtestFactory->create();
                $sub->setData($newdata);
                $sub->save();
                return $result->setData([
                   'success' => true,
                   'error'=>false,
                   'message'=>"Add customer success!."
                ]);
            }
            catch (\Exception $e) { // if the API call returns an error, get the error message for display later
                return $result->setData([
                    'success' => false,
                    'error' => true,
                    'errorMessage' => $e->getMessage()
                ]);
            }
        }
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Packt_MTest::customer');
    }
}
?>