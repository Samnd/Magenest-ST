<?php
    namespace Packt\MTest\Controller\Part;

    class Time extends \Magento\Framework\App\Action\Action
    {
        /** @var \Magento\Framework\View\Result\PageFactory */
        protected $resultPageFactory;
        protected $resultJsonFactory;
        protected $mtestFactory;

        public function __construct(
            \Magento\Framework\App\Action\Context $context,
            \Magento\Framework\View\Result\PageFactory $resultPageFactory,
            \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
            \Packt\MTest\Model\MTestFactory $mtestFactory
        ) {
            $this->resultPageFactory = $resultPageFactory;
            $this->resultJsonFactory = $resultJsonFactory;
            $this->mtestFactory = $mtestFactory;
            parent::__construct($context);
        }

        public function execute()
        {
            $result = $this->resultJsonFactory->create();
            if ($this->getRequest()->isAjax()) {
                try {
                    $data = $this->getRequest()->getParams();
                    $mtestCollection = $this->mtestFactory->create()->getCollection();
                    $searchById = $mtestCollection->addFieldToFilter('member_id', $data['member_id'])->getFirstItem()->getData();
                    if (!!$searchById) {

                        return $result->setData([
                            'data' => json_encode($searchById),
                            'success' => true,
                            'error' => false
                        ]);
                    } else {
                        return $result->setData([
                            'success' => false,
                            'error' => true,
                            'errorMessage' => "Member ID not found."
                        ]);
                    }
                } catch (\Exception $e) { // if the API call returns an error, get the error message for display later
                    return $this->resultJsonFactory->create()->setData([
                        'success' => false,
                        'error' => true,
                        'errorMessage' => $e->getMessage()
                    ]);
                }
            }
            $resultPage = $this->resultPageFactory->create();
            return $resultPage;
        }

    }


?>