<?php

namespace Packt\MTest\Controller\Adminhtml\Customer;


use Magento\Backend\App\Action;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;

class MassDelete extends Action
{
    protected $filterBuilder;
    protected $_filter;
    protected $searchCriteriaBuilder;
    protected $customerFactory;

    public function __construct(
        Filter $filter,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        Action\Context $context,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Packt\MTest\Model\MTestFactory $customerFactory
    )
    {
        $this->customerFactory = $customerFactory;
        $this->_filter = $filter;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->_filter->getCollection($this->customerFactory->create()->getCollection());
        $total = 0;

        try {
            foreach ($collection as $item) {
                $this->customerFactory->delete($item);
                $total++;
            }
            $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $total));
        } catch (LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }
}