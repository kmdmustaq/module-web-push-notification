# Mage2 Module Lof WebPushNotification

    ``landofcoder/module-web-push-notification``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
Magento 2 Web Push Notification can use for PWA studio app

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Lof`
 - Enable the module by running `php bin/magento module:enable Lof_WebPushNotification`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require landofcoder/module-web-push-notification`
 - enable the module by running `php bin/magento module:enable Lof_WebPushNotification`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

 - enabled (lofwebpushnotification/general_settings/enabled)

 - app_api_key (lofwebpushnotification/general_settings/app_api_key)

 - fcm_app_auth_domain (lofwebpushnotification/general_settings/fcm_app_auth_domain)

 - fcm_app_database_url (lofwebpushnotification/general_settings/fcm_app_database_url)

 - fcm_app_project_id (lofwebpushnotification/general_settings/fcm_app_project_id)

 - fcm_app_store_bucket (lofwebpushnotification/general_settings/fcm_app_store_bucket)

 - fcm_app_sender_id (lofwebpushnotification/general_settings/fcm_app_sender_id)

 - fcm_app_id (lofwebpushnotification/general_settings/fcm_app_id)


## Specifications

 - GraphQl Endpoint
	- Pushnotifications

 - GraphQl Endpoint
	- Pushnotificationmessages

 - GraphQl Endpoint
	- Registerpushnotification

 - Helper
	- Lof\WebPushNotification\Helper\Data

 - Model
	- PushNotification

 - Model
	- PushNotificationMessage


## Attributes



