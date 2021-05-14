<?php
/**
 * Copyright © Landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\WebPushNotification\Model;

use Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface;
use Lof\WebPushNotification\Api\Data\PushNotificationMessageInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class PushNotificationMessage extends \Magento\Framework\Model\AbstractModel
{

    protected $_eventPrefix = 'lof_webpushnotification_pushnotificationmessage';
    protected $dataObjectHelper;

    protected $pushnotificationmessageDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param PushNotificationMessageInterfaceFactory $pushnotificationmessageDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Lof\WebPushNotification\Model\ResourceModel\PushNotificationMessage $resource
     * @param \Lof\WebPushNotification\Model\ResourceModel\PushNotificationMessage\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        PushNotificationMessageInterfaceFactory $pushnotificationmessageDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Lof\WebPushNotification\Model\ResourceModel\PushNotificationMessage $resource,
        \Lof\WebPushNotification\Model\ResourceModel\PushNotificationMessage\Collection $resourceCollection,
        array $data = []
    ) {
        $this->pushnotificationmessageDataFactory = $pushnotificationmessageDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve pushnotificationmessage model with pushnotificationmessage data
     * @return PushNotificationMessageInterface
     */
    public function getDataModel()
    {
        $pushnotificationmessageData = $this->getData();
        
        $pushnotificationmessageDataObject = $this->pushnotificationmessageDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $pushnotificationmessageDataObject,
            $pushnotificationmessageData,
            PushNotificationMessageInterface::class
        );
        
        return $pushnotificationmessageDataObject;
    }
}

