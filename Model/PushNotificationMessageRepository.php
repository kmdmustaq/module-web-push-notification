<?php
/**
 * Copyright © Landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\WebPushNotification\Model;

use Lof\WebPushNotification\Api\Data\PushNotificationMessageInterfaceFactory;
use Lof\WebPushNotification\Api\Data\PushNotificationMessageSearchResultsInterfaceFactory;
use Lof\WebPushNotification\Api\PushNotificationMessageRepositoryInterface;
use Lof\WebPushNotification\Model\ResourceModel\PushNotificationMessage as ResourcePushNotificationMessage;
use Lof\WebPushNotification\Model\ResourceModel\PushNotificationMessage\CollectionFactory as PushNotificationMessageCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class PushNotificationMessageRepository implements PushNotificationMessageRepositoryInterface
{

    protected $dataPushNotificationMessageFactory;

    protected $resource;

    protected $extensibleDataObjectConverter;
    protected $searchResultsFactory;

    protected $pushNotificationMessageFactory;

    protected $pushNotificationMessageCollectionFactory;

    private $storeManager;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;


    /**
     * @param ResourcePushNotificationMessage $resource
     * @param PushNotificationMessageFactory $pushNotificationMessageFactory
     * @param PushNotificationMessageInterfaceFactory $dataPushNotificationMessageFactory
     * @param PushNotificationMessageCollectionFactory $pushNotificationMessageCollectionFactory
     * @param PushNotificationMessageSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourcePushNotificationMessage $resource,
        PushNotificationMessageFactory $pushNotificationMessageFactory,
        PushNotificationMessageInterfaceFactory $dataPushNotificationMessageFactory,
        PushNotificationMessageCollectionFactory $pushNotificationMessageCollectionFactory,
        PushNotificationMessageSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->pushNotificationMessageFactory = $pushNotificationMessageFactory;
        $this->pushNotificationMessageCollectionFactory = $pushNotificationMessageCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataPushNotificationMessageFactory = $dataPushNotificationMessageFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface $pushNotificationMessage
    ) {
        /* if (empty($pushNotificationMessage->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $pushNotificationMessage->setStoreId($storeId);
        } */
        
        $pushNotificationMessageData = $this->extensibleDataObjectConverter->toNestedArray(
            $pushNotificationMessage,
            [],
            \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface::class
        );
        
        $pushNotificationMessageModel = $this->pushNotificationMessageFactory->create()->setData($pushNotificationMessageData);
        
        try {
            $this->resource->save($pushNotificationMessageModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the pushNotificationMessage: %1',
                $exception->getMessage()
            ));
        }
        return $pushNotificationMessageModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($pushNotificationMessageId)
    {
        $pushNotificationMessage = $this->pushNotificationMessageFactory->create();
        $this->resource->load($pushNotificationMessage, $pushNotificationMessageId);
        if (!$pushNotificationMessage->getId()) {
            throw new NoSuchEntityException(__('PushNotificationMessage with id "%1" does not exist.', $pushNotificationMessageId));
        }
        return $pushNotificationMessage->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->pushNotificationMessageCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Lof\WebPushNotification\Api\Data\PushNotificationMessageInterface $pushNotificationMessage
    ) {
        try {
            $pushNotificationMessageModel = $this->pushNotificationMessageFactory->create();
            $this->resource->load($pushNotificationMessageModel, $pushNotificationMessage->getPushnotificationmessageId());
            $this->resource->delete($pushNotificationMessageModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the PushNotificationMessage: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($pushNotificationMessageId)
    {
        return $this->delete($this->get($pushNotificationMessageId));
    }
}

