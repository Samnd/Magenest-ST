<?php
/**
 * Created by PhpStorm.
 * User: magenest
 * Date: 04/08/2017
 * Time: 19:42
 */

namespace Packt\MTest\Helper;

use Magento\Framework\App\Helper\Context;

class ConfigHelper extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $ruleFactory;
    protected $couponFactory;

    public function __construct(
        Context $context,
        \Magento\SalesRule\Model\RuleFactory $ruleFactory,
        \Magento\SalesRule\Model\CouponFactory $couponFactory
    )
    {
        $this->ruleFactory = $ruleFactory;
        $this->couponFactory = $couponFactory;
        parent::__construct($context);
    }

    public function getExpectProduct()
    {
        return $this->scopeConfig->getValue(
            'parttime/mtestsetting/header_title',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}