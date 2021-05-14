<?php
/**
 * Copyright © Landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\WebPushNotification\Api\Data;

interface PushNotificationMessageSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get PushNotificationMessage list.
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface[]
     */
    public function getItems();

    /**
     * Set entity_id list.
     * @param \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

