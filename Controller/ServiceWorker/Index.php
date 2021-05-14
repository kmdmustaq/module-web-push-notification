<?php
/**
 * Landofcoder
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Landofcoder.com license that is
 * available through the world-wide-web at this URL:
 * https://landofcoder.com/license
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category   Landofcoder
 * @package    Lof_WebPushNotification
 * @copyright  Copyright (c) 2021 Landofcoder (https://landofcoder.com/)
 * @license    https://landofcoder.com/LICENSE-1.0.html
 */
namespace Lof\WebPushNotification\Controller\ServiceWorker;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Pwa Index Page
 */
class Index extends Action
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * @var Lof\WebPushNotification\Helper\Data
     */
    protected $data;

    public function __construct(
        Context $context,
        \Lof\WebPushNotification\Helper\Data $data,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        ResultFactory $resultFactory,
        \Magento\Framework\Module\Dir\Reader $moduleReader
    ) {
        $this->_baseDirectory = $moduleReader;
        $this->_date = $date;
        $this->data = $data;
        $this->resultFactory = $resultFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $swTemplate = "";
        $response = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $response->setHeader('Content-type', 'application/javascript');
        $response->setHeader('Access-Control-Allow-Origin', '*');

        $response->setContents(
            $swTemplate
        );
        return $response;
    }
}