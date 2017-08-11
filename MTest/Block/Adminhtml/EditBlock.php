<?php
namespace Packt\MTest\Block\Adminhtml;
class EditBlock extends \Magento\Backend\Block\Template
{

    protected function _construct()
    {
        $this->_blockGroup = 'Packt_MTest';
        $this->_controller = 'adminhtml_customer_edit';
        parent::_construct();
    }
    public function getDataById($cid = null)
    {
        if ($cid != null){
            $id = $cid['id'];
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $data = $objectManager->create('Packt\MTest\Model\MTest')->load($id);
            $result = $data->getData();
            return $result;
        } else {
            return null;
        }
    }
}
?>