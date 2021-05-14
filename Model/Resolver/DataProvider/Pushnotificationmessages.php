<?php
/**
 * Copyright © Landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\WebPushNotification\Model\Resolver\DataProvider;

class Pushnotificationmessages
{

    private $pushNotificationMessage;

    /**
     * @param \Lof\WebPushNotification\Model\Resolver\PushNotificationMessage $pushNotificationMessage
     */
    public function __construct(
        \Lof\WebPushNotification\Model\Resolver\PushNotificationMessage $pushNotificationMessage
    ) {
        $this->pushNotificationMessage = $pushNotificationMessage;
    }

    public function getPushnotificationmessages()
    {
        return 'proviced data';
    }
}

