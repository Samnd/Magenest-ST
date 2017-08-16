<?php

namespace Packt\MTest\Observer;

use Magento\Framework\Event\ObserverInterface;

class CheckProductAddCart implements ObserverInterface
{
    protected $mtestfactory;
    protected $configHelper;

    public function __construct(
        \Packt\MTest\Model\MTestFactory $mtestFactory,
        \Packt\MTest\Helper\ConfigHelper $configHelper
    )
    {
        $this->mtestfactory = $mtestFactory;
        $this->configHelper = $configHelper;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $expect = $this->configHelper->getExpectProduct();
        $data = $observer->getProduct()->getData();
        if ($expect !== $data['name']) {
//            throw new \Magento\Framework\Exception\LocalizedException(__("You can\'t add this product to cart.")) ;
//            \Exception(__("sadsfafsfsa"));
            return true;
        } else {
            return true;
        }
    }
}