<?php
/**
 * Copyright © Landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\WebPushNotification\Model\Resolver\DataProvider;

class Pushnotifications
{

    private $pushNotification;

    /**
     * @param \Lof\WebPushNotification\Model\Resolver\PushNotification $pushNotification
     */
    public function __construct(
        \Lof\WebPushNotification\Model\Resolver\PushNotification $pushNotification
    ) {
        $this->pushNotification = $pushNotification;
    }

    public function getPushnotifications()
    {
        return 'proviced data';
    }
}

