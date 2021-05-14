<?php
/**
 * Copyright © Landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\WebPushNotification\Model\ResourceModel\PushNotificationMessage;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'pushnotificationmessage_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Lof\WebPushNotification\Model\PushNotificationMessage::class,
            \Lof\WebPushNotification\Model\ResourceModel\PushNotificationMessage::class
        );
    }
}

