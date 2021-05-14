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
namespace Lof\WebPushNotification\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface;
use Lof\WebPushNotification\Api\PushNotificationMessageRepositoryInterface;
use Lof\WebPushNotification\Model\PushNotificationMessageFactory;

/**
 * To Get and  Send Message (Notification)
 */
class SendMessage extends Action
{
    /**
     * @var PushNotificationMessageFactory
     */
    protected $pushNotificationMessageDataFactory;

    /**
     * @var PushNotificationMessageRepositoryInterface
     */
    protected $_pushNotificationMessageRepository;

    /**
     * @var Magento\Framework\Json\Helper\Data
     */

    protected $data;

    /**
     * @param Context                                    $context
     * @param PushNotificationMessageFactory    $pushNotificationMessageDataFactory
     * @param PushNotificationMessageRepositoryInterface $pushNotificationMessageRepository
     */
    public function __construct(
        Context $context,
        PushNotificationMessageFactory $pushNotificationMessageDataFactory,
        PushNotificationMessageRepositoryInterface $pushNotificationMessageRepository,
        \Magento\Framework\Json\Helper\Data $data
    ) {
        $this->pushNotificationMessageDataFactory = $pushNotificationMessageDataFactory;
        $this->_pushNotificationMessageRepository = $pushNotificationMessageRepository;
        $this->data = $data;
        parent::__construct($context);
    }

    /**
     * Send Push Notification Mesasge.
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $collection = $this->_pushNotificationMessageRepository->getActivePushNotificationMessage();
        $notificationData = [];
        foreach ($collection as $key => $value) {
            $notificationData['title'] = $value['title'];
            $notificationData['body'] = $value['body'];
            $notificationData['target_url'] = $value['url'];
            $notificationData['icon'] = 'media/pwa/icon/'.$value['icon'];
        }
        $this->getResponse()->representJson(
            $this->data->jsonEncode($notificationData)
        );
    }
}
