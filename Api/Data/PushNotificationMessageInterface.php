<?php
/**
 * Copyright © Landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\WebPushNotification\Api\Data;

interface PushNotificationMessageInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const ENTITY_ID = 'entity_id';
    const CREATED_AT = 'created_at';
    const TITLE = 'title';
    const BODY = 'body';
    const STATUS = 'status';
    const ICON = 'icon';
    const UPDATED_AT = 'updated_at';
    const URL = 'url';

    /**
     * Get entity_id
     * @return string|null
     */
    public function getEntityId();

    /**
     * Set entity_id
     * @param string $entityId
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface
     */
    public function setEntityId($entityId);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationMessageExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Lof\WebPushNotification\Api\Data\PushNotificationMessageExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Lof\WebPushNotification\Api\Data\PushNotificationMessageExtensionInterface $extensionAttributes
    );

    /**
     * Get title
     * @return string|null
     */
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface
     */
    public function setTitle($title);

    /**
     * Get body
     * @return string|null
     */
    public function getBody();

    /**
     * Set body
     * @param string $body
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface
     */
    public function setBody($body);

    /**
     * Get url
     * @return string|null
     */
    public function getUrl();

    /**
     * Set url
     * @param string $url
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface
     */
    public function setUrl($url);

    /**
     * Get icon
     * @return string|null
     */
    public function getIcon();

    /**
     * Set icon
     * @param string $icon
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface
     */
    public function setIcon($icon);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface
     */
    public function setStatus($status);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface
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
     * @return \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface
     */
    public function setUpdatedAt($updatedAt);
}

