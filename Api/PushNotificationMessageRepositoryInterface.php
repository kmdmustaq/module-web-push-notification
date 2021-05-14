<?php
/**
 * Copyright © Landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\WebPushNotification\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface PushNotificationMessageRepositoryInterface
{

    /**
     * Save PushNotificationMessage
     * @param \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface $pushNotificationMessage
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface $pushNotificationMessage
    );

    /**
     * Retrieve PushNotificationMessage
     * @param string $pushnotificationmessageId
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($pushnotificationmessageId);

    /**
     * Retrieve PushNotificationMessage matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationMessageSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );
    /**
     * Retrieve Active PushNotificationMessage.
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getActivePushNotificationMessage();

    /**
     * Delete PushNotificationMessage
     * @param \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface $pushNotificationMessage
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface $pushNotificationMessage
    );

    /**
     * Delete PushNotificationMessage by ID
     * @param string $pushnotificationmessageId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($pushnotificationmessageId);
}

