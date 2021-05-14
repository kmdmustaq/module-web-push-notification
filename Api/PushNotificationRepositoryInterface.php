<?php
/**
 * Copyright © Landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\WebPushNotification\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface PushNotificationRepositoryInterface
{

    /**
     * Save PushNotification
     * @param \Lof\WebPushNotification\Api\Data\PushNotificationInterface $pushNotification
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Lof\WebPushNotification\Api\Data\PushNotificationInterface $pushNotification
    );

    /**
     * Retrieve PushNotification
     * @param string $pushnotificationId
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($pushnotificationId);

    /**
     * Retrieve PushNotification matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete PushNotification
     * @param \Lof\WebPushNotification\Api\Data\PushNotificationInterface $pushNotification
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Lof\WebPushNotification\Api\Data\PushNotificationInterface $pushNotification
    );

    /**
     * Delete PushNotification by ID
     * @param string $pushnotificationId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($pushnotificationId);
}

