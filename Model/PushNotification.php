<?php
/**
 * Copyright © Landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\WebPushNotification\Model;

use Lof\WebPushNotification\Api\Data\PushNotificationInterface;
use Lof\WebPushNotification\Api\Data\PushNotificationInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class PushNotification extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $_eventPrefix = 'lof_webpushnotification_pushnotification';
    protected $pushnotificationDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param PushNotificationInterfaceFactory $pushnotificationDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Lof\WebPushNotification\Model\ResourceModel\PushNotification $resource
     * @param \Lof\WebPushNotification\Model\ResourceModel\PushNotification\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        PushNotificationInterfaceFactory $pushnotificationDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Lof\WebPushNotification\Model\ResourceModel\PushNotification $resource,
        \Lof\WebPushNotification\Model\ResourceModel\PushNotification\Collection $resourceCollection,
        array $data = []
    ) {
        $this->pushnotificationDataFactory = $pushnotificationDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve pushnotification model with pushnotification data
     * @return PushNotificationInterface
     */
    public function getDataModel()
    {
        $pushnotificationData = $this->getData();
        
        $pushnotificationDataObject = $this->pushnotificationDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $pushnotificationDataObject,
            $pushnotificationData,
            PushNotificationInterface::class
        );
        
        return $pushnotificationDataObject;
    }
}

