<?php
/**
 * Copyright © Landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\WebPushNotification\Model;

use Lof\WebPushNotification\Api\Data\PushNotificationInterfaceFactory;
use Lof\WebPushNotification\Api\Data\PushNotificationSearchResultsInterfaceFactory;
use Lof\WebPushNotification\Api\PushNotificationRepositoryInterface;
use Lof\WebPushNotification\Model\ResourceModel\PushNotification as ResourcePushNotification;
use Lof\WebPushNotification\Model\ResourceModel\PushNotification\CollectionFactory as PushNotificationCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class PushNotificationRepository implements PushNotificationRepositoryInterface
{

    protected $pushNotificationCollectionFactory;

    protected $resource;

    protected $extensibleDataObjectConverter;
    protected $searchResultsFactory;

    private $storeManager;

    protected $pushNotificationFactory;

    protected $dataObjectHelper;

    protected $dataPushNotificationFactory;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;


    /**
     * @param ResourcePushNotification $resource
     * @param PushNotificationFactory $pushNotificationFactory
     * @param PushNotificationInterfaceFactory $dataPushNotificationFactory
     * @param PushNotificationCollectionFactory $pushNotificationCollectionFactory
     * @param PushNotificationSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourcePushNotification $resource,
        PushNotificationFactory $pushNotificationFactory,
        PushNotificationInterfaceFactory $dataPushNotificationFactory,
        PushNotificationCollectionFactory $pushNotificationCollectionFactory,
        PushNotificationSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->pushNotificationFactory = $pushNotificationFactory;
        $this->pushNotificationCollectionFactory = $pushNotificationCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataPushNotificationFactory = $dataPushNotificationFactory;
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
        \Lof\WebPushNotification\Api\Data\PushNotificationInterface $pushNotification
    ) {
        /* if (empty($pushNotification->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $pushNotification->setStoreId($storeId);
        } */
        
        $pushNotificationData = $this->extensibleDataObjectConverter->toNestedArray(
            $pushNotification,
            [],
            \Lof\WebPushNotification\Api\Data\PushNotificationInterface::class
        );
        
        $pushNotificationModel = $this->pushNotificationFactory->create()->setData($pushNotificationData);
        
        try {
            $this->resource->save($pushNotificationModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the pushNotification: %1',
                $exception->getMessage()
            ));
        }
        return $pushNotificationModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($pushNotificationId)
    {
        $pushNotification = $this->pushNotificationFactory->create();
        $this->resource->load($pushNotification, $pushNotificationId);
        if (!$pushNotification->getId()) {
            throw new NoSuchEntityException(__('PushNotification with id "%1" does not exist.', $pushNotificationId));
        }
        return $pushNotification->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->pushNotificationCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Lof\WebPushNotification\Api\Data\PushNotificationInterface::class
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
        \Lof\WebPushNotification\Api\Data\PushNotificationInterface $pushNotification
    ) {
        try {
            $pushNotificationModel = $this->pushNotificationFactory->create();
            $this->resource->load($pushNotificationModel, $pushNotification->getPushnotificationId());
            $this->resource->delete($pushNotificationModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the PushNotification: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($pushNotificationId)
    {
        return $this->delete($this->get($pushNotificationId));
    }
}

