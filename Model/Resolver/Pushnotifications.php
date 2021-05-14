<?php
/**
 * Copyright © Landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\WebPushNotification\Model\Resolver;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class Pushnotifications implements ResolverInterface
{

    private $pushnotificationsDataProvider;

    /**
     * @param DataProvider\Pushnotifications $pushnotificationsRepository
     */
    public function __construct(
        DataProvider\Pushnotifications $pushnotificationsDataProvider
    ) {
        $this->pushnotificationsDataProvider = $pushnotificationsDataProvider;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $pushnotificationsData = $this->pushnotificationsDataProvider->getPushnotifications();
        return $pushnotificationsData;
    }
}

