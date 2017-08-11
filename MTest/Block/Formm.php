<?php

namespace Packt\MTest\Block;

use Magento\Framework\View\Element\Template;

class Formm extends \Magento\Framework\View\Element\Template
{
    public function __construct( \Magento\Framework\View\Element\Template\Context $context )
    {
        parent::__construct($context);
    }

    protected function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Customer View'));
    }


}
?>