<?php
namespace Packt\MTest\Observer;

use Magento\Framework\Event\ObserverInterface;

class AddCustomerAfterRegister implements ObserverInterface
{
    protected $mtestfactory;

    public function __construct(
        \Packt\MTest\Model\MTestFactory $mtestFactory
    )
    {
        $this->mtestfactory = $mtestFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $firstname = $observer->getCustomer()->getFirstname();
        $lastname = $observer->getCustomer()->getLastname();
        $email = $observer->getCustomer()->getEmail();
        $data = [
            'name' => $firstname.$lastname,
            'address' => $email,
            'phone' => '11111111111'
        ];
        $sub = $this->mtestfactory->create();
        $sub->setData($data);
        $sub->save();
    }
}