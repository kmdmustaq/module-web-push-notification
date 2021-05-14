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
use Lof\WebPushNotification\Model\PushNotificationFactory;
use Lof\WebPushNotification\Api\PushNotificationRepositoryInterface;

/**
 * PWa Index Page
 */
class Index extends Action
{
    /**
     * @var PushNotificationFactory
     */
    protected $pushNotificationDataFactory;

    /**
     * @var PushNotificationRepositoryInterface
     */
    protected $_pushNotificationRepository;

    /**
     * @var Magento\Framework\Json\Helper\Data
     */
    protected $data;

    /**
     * @param Context                                     $context
     * @param PushNotificationFactory            $pushNotificationDataFactory
     * @param PushNotificationRepositoryInterface         $pushNotificationRepository
     */
    public function __construct(
        Context $context,
        \Magento\Framework\Json\Helper\Data $data,
        PushNotificationFactory $pushNotificationDataFactory,
        PushNotificationRepositoryInterface $pushNotificationRepository,
    ) {
        $this->pushNotificationDataFactory = $pushNotificationDataFactory;
        $this->_pushNotificationRepository = $pushNotificationRepository;
        $this->data = $data;
        parent::__construct($context);
    }

    /**
     * PWA Home Page.
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
       
        $data = $this->getRequest()->getParams();
        if (isset($data['regId']) && isset($data['endPoint'])) {
            $registrationId = $data['regId'];
            $endPoint = $data['endPoint'];
            $getPushNotification = $this->_pushNotificationRepository->getPushNotification(
                $registrationId,
                $endPoint
            );
            if (!$getPushNotification->getId()) {
                $pushNotificationData = [];
                $pushNotificationData['registration_id'] = $registrationId;
                $pushNotificationData['end_point'] = $endPoint;
                $pushNotification = $this->pushNotificationDataFactory->create();
                $pushNotification->setData($pushNotificationData);
                $this->_pushNotificationRepository->save($pushNotification);
            }
        }
        $this->getResponse()->representJson(
            $this->data->jsonEncode([true])
        );
    }
}
