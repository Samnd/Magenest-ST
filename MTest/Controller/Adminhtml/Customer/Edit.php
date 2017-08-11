<?php
namespace Packt\MTest\Controller\Adminhtml\Customer;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Edit extends \Magento\Backend\App\Action
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
                $id = $data['id'];
                $model = $this->mtestFactory->create()->load($id);
                try {
                    $curData = $model->getData();
                    $curData['name'] = $data['name'];
                    $curData['address'] = $data['address'];
                    $curData['phone'] = $data['phone'];

                    $model->setData($curData)->save();

                    return $result->setData([
                        'success' => true,
                        'error' => false,
                        'message'=>'Edit was done.'
                    ]);
                } catch (\Exception $e){
                    return $result->setData([
                        'success' => false,
                        'error' => true,
                        'errorMessage' => $e->getMessage()
                    ]);
                }
            }
            catch (\Exception $e) {
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