<?php
/**
 * Copyright © Landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\WebPushNotification\Controller\Adminhtml\PushNotificationMessage;

class Delete extends \Lof\WebPushNotification\Controller\Adminhtml\PushNotificationMessage
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('pushnotificationmessage_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Lof\WebPushNotification\Model\PushNotificationMessage::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Pushnotificationmessage.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['pushnotificationmessage_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Pushnotificationmessage to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

