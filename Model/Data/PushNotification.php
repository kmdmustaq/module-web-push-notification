<?php
/**
 * Copyright © Landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\WebPushNotification\Model\Data;

use Lof\WebPushNotification\Api\Data\PushNotificationInterface;

class PushNotification extends \Magento\Framework\Api\AbstractExtensibleObject implements PushNotificationInterface
{

    /**
     * Get entity_id
     * @return string|null
     */
    public function getEntityId()
    {
        return $this->_get(self::ENTITY_ID);
    }

    /**
     * Set entity_id
     * @param string $entityId
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Lof\WebPushNotification\Api\Data\PushNotificationExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Lof\WebPushNotification\Api\Data\PushNotificationExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get registration_id
     * @return string|null
     */
    public function getRegistrationId()
    {
        return $this->_get(self::REGISTRATION_ID);
    }

    /**
     * Set registration_id
     * @param string $registrationId
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationInterface
     */
    public function setRegistrationId($registrationId)
    {
        return $this->setData(self::REGISTRATION_ID, $registrationId);
    }

    /**
     * Get end_point
     * @return string|null
     */
    public function getEndPoint()
    {
        return $this->_get(self::END_POINT);
    }

    /**
     * Set end_point
     * @param string $endPoint
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationInterface
     */
    public function setEndPoint($endPoint)
    {
        return $this->setData(self::END_POINT, $endPoint);
    }

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->_get(self::UPDATED_AT);
    }

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}

