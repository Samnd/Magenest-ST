<?php
namespace Packt\HelloWorld\Observer;
use Magento\Framework\Event\ObserverInterface;

class RegisterVisitObserver implements ObserverInterface
{
    /** @var \Psr\Log\LoggerInterface $logger */
    protected $myLogger;
    public function __construct(
        \Packt\HelloWorld\Logger\Logger $logger
    )
    {
        $this->myLogger = $logger;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->myLogger->addDebug("Registed");
        $product = $observer->getProduct();
        $category = $observer->getCategory();
        $this->myLogger->debug(print_r($product->debug(), true));
        $this->myLogger->debug(print_r($category->debug(), true));
    }
}
?>