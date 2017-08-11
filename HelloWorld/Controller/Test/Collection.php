<?php
namespace Packt\HelloWorld\Controller\Test;

class Collection extends \Magento\Framework\App\Action\Action {
// Get info from database
//    public function execute() {
//        $productCollection = $this->_objectManager->create('Magento\Catalog\Model\ResourceModel\Product\Collection')->setPageSize(10,1);
//        $output = '';
//        foreach ($productCollection as $product) {
//            $output .= \Zend_Debug::dump($product->debug(), null, false);
//        }
//        $this->getResponse()->setBody($output);
//    }

//Add attribute for get info action
//    public function execute() {
//        $productCollection = $this->_objectManager
//            ->create('Magento\Catalog\Model\ResourceModel\Product\Collection')
//            ->addAttributeToSelect([
//                'name',
//                'price',
//                'image',
//            ])
//            ->setPageSize(10,1);
//        $output = '';
//        foreach ($productCollection as $product) {
//            $output .= \Zend_Debug::dump($product->debug(), null, false);
//        }
//        $this->getResponse()->setBody($output);
//    }

// Add Filter for get info function ex: ->addAttributeToFilter('entity_id', array('in' => array(0, 1, 2)));

//    public function execute() {
//        $productCollection = $this->_objectManager
//            ->create('Magento\Catalog\Model\ResourceModel\Product\Collection')
//            ->addAttributeToSelect([
//                'name',
//                'price',
//                'image',])
//            ->addAttributeToFilter('name', array('like'=>'%Product%'));
//        $output = $productCollection->getSelect()->__toString();
//        foreach ($productCollection as $product) {
//            $output .= \Zend_Debug::dump($product->debug(), null, false);
//        }
//        $this->getResponse()->setBody($output);
//    }

//Update data after the select query

    public function execute() {
        $productCollection = $this->_objectManager
            ->create('Magento\Catalog\Model\ResourceModel\Product\Collection')
            ->addAttributeToSelect([
                'name',
                'price',
                'image',
            ])
            ->addAttributeToFilter('entity_id', array(
                'in' => array(0, 1, 3)
            ));
        $output = '';
        $productCollection->setDataToAll('price', 120);

        foreach ($productCollection as $product) {
            $output .= \Zend_Debug::dump($product->debug(), null, false);
        }
        $this->getResponse()->setBody   ($output);
        $productCollection->save();

    }
}
?>