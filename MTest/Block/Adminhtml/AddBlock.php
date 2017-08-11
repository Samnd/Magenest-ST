<?php
namespace Packt\MTest\Block\Adminhtml;
class AddBlock extends \Magento\Backend\Block\Template
{

    protected function _construct()
    {
        $this->_blockGroup = 'Packt_MTest';
        $this->_controller = 'adminhtml_customer_add';
        parent::_construct();
    }

}
?>