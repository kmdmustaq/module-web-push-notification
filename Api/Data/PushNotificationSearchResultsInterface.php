<?php
/**
 * Copyright © Landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\WebPushNotification\Api\Data;

interface PushNotificationSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get PushNotification list.
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationInterface[]
     */
    public function getItems();

    /**
     * Set entity_id list.
     * @param \Lof\WebPushNotification\Api\Data\PushNotificationInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

