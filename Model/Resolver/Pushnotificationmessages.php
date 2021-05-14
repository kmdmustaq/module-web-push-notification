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

class Pushnotificationmessages implements ResolverInterface
{

    private $pushnotificationmessagesDataProvider;

    /**
     * @param DataProvider\Pushnotificationmessages $pushnotificationmessagesRepository
     */
    public function __construct(
        DataProvider\Pushnotificationmessages $pushnotificationmessagesDataProvider
    ) {
        $this->pushnotificationmessagesDataProvider = $pushnotificationmessagesDataProvider;
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
        $pushnotificationmessagesData = $this->pushnotificationmessagesDataProvider->getPushnotificationmessages();
        return $pushnotificationmessagesData;
    }
}

