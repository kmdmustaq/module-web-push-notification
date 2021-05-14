<?php
/**
 * Copyright © Landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\WebPushNotification\Api\Data;

interface PushNotificationInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const ENTITY_ID = 'entity_id';
    const CREATED_AT = 'created_at';
    const END_POINT = 'end_point';
    const REGISTRATION_ID = 'registration_id';
    const UPDATED_AT = 'updated_at';


    /**
     * Get entity_id
     * @return string|null
     */
    public function getEntityId();

    /**
     * Set entity_id
     * @param string $entityId
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationInterface
     */
    public function setEntityId($entityId);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Lof\WebPushNotification\Api\Data\PushNotificationExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Lof\WebPushNotification\Api\Data\PushNotificationExtensionInterface $extensionAttributes
    );

    /**
     * Get registration_id
     * @return string|null
     */
    public function getRegistrationId();

    /**
     * Set registration_id
     * @param string $registrationId
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationInterface
     */
    public function setRegistrationId($registrationId);

    /**
     * Get end_point
     * @return string|null
     */
    public function getEndPoint();

    /**
     * Set end_point
     * @param string $endPoint
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationInterface
     */
    public function setEndPoint($endPoint);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationInterface
     */
    public function setUpdatedAt($updatedAt);
}

