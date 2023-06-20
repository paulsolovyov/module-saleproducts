<?php

namespace PaulSolovyov\SaleProducts\Logger;
 
use Magento\Framework\Logger\Handler\Base;
use Monolog\Logger;
 
class Handler extends Base
{
    protected $loggerType = Logger::INFO;
    protected $fileName = '/var/log/rest-api-product-does-not-exist.log';
}