<?php

namespace Packt\MTest\Block;

use Magento\Framework\View\Element\Template;

class MTest extends \Magento\Framework\View\Element\Template
{
    public function __construct( \Magento\Framework\View\Element\Template\Context $context )
    {
        parent::__construct($context);
    }

    protected function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('My Customer'));
    }

    public function getGreetings()
    {
        $this->_isScopePrivate = true;

        $objectManagerr  = \Magento\Framework\App\ObjectManager::getInstance();

        $greetingsFactory = $objectManagerr->create( 'Packt\MTest\Model\MTest' );

        $data             = $greetingsFactory ->getCollection();

        return $data;
    }
}