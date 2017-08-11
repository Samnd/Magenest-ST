<?php
/**
 * Created by PhpStorm.
 * User: heomep
 * Date: 08/04/2017
 * Time: 00:11
 */
namespace Packt\MTest\Block\Adminhtml;
class Customer extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_customer';
        $this->_blockGroup = 'Packt_MTest';
        $this->_headerText = __('Customer');
        parent::_construct();
        if ($this->_isAllowedAction('Packt_MTest::save')) {
            $this->buttonList->update('add', 'label', __('Add'));
        } else {
            $this->buttonList->remove('add');
        }
    }
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}