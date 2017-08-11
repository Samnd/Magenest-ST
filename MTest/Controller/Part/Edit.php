<?php
namespace Packt\MTest\Controller\Part;

class Edit extends \Magento\Framework\App\Action\Action
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

                    $id = $data['id'];
//                    $newName = $data['newName'];
//                    $newAddress = $data['newAddress'];
//                    $newPhone = $data['newPhone'];
//                    $newData = ['name'=>$newName, 'address'=>$newAddress, 'phone'=>$newPhone];
                    $model = $this->mtestFactory->create()->load($id);
                    try {
                        $curData = $model->getData();
                        $curData['name'] = $data['newName'];
                        $curData['address'] = $data['newAddress'];
                        $curData['phone'] = $data['newPhone'];

                        $model->setData($curData)->save();

                        $mtestCollection = $this->mtestFactory->create()->getCollection();
                        $searchById = $mtestCollection->addFieldToFilter('member_id', $id)->getFirstItem()->getData();
                        return $result->setData([
                                'data' => json_encode($searchById),
                                'success' => true,
                                'error' => false
                            ]);
                    } catch (\Exception $e){
                        return $result->setData([
                            'success' => false,
                            'error' => true,
                            'errorMessage' => $e->getMessage()
                        ]);
                    }
                }
            catch (\Exception $e) { // if the API call returns an error, get the error message for display later
                return $this->resultJsonFactory->create()->setData([
                    'success' => false,
                    'error' => true,
                    'errorMessage' => $e->getMessage()
                ]);
            }
        }
        return $result->setData([
        'success' => false,
        'error' => true
    ]);
    }

}


?>