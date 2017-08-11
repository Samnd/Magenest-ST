<?php
    namespace Packt\HelloWorld\Logger;

    use Magento\Framework\Logger\Handler\Base;

    class Handler extends Base
    {
        protected $fileName = '/var/log/assembly/debug.log';
        protected $loggerType = \Monolog\Logger::DEBUG;
    }
?>