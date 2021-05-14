<?php
/**
 * Landofcoder
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Landofcoder.com license that is
 * available through the world-wide-web at this URL:
 * https://landofcoder.com/license
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category   Landofcoder
 * @package    Lof_WebPushNotification
 * @copyright  Copyright (c) 2021 Landofcoder (https://landofcoder.com/)
 * @license    https://landofcoder.com/LICENSE-1.0.html
 */
declare(strict_types=1);

namespace Lof\WebPushNotification\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Filesystem\DirectoryList;

class Data extends AbstractHelper
{

    protected $_storeManager;

    /**
     * @var \Magento\Framework\Encryption\EncryptorInterface
     */
    protected $_encryptor;

    protected $__mediaDirectory;

    /**
     * @var \Magento\Framework\Image\Factory
     */
    protected $_imageFactory;

    /**
     * @var \Magento\Framework\Module\Dir\Reader
     */
    protected $_baseDirectory;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Encryption\EncryptorInterface $encryptor
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Framework\Image\AdapterFactory $imageFactory
     * @param \Magento\Framework\Filesystem\Io\File $filesystemFile
     * @param \Magento\Framework\Module\Dir\Reader $moduleReader
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Encryption\EncryptorInterface $encryptor,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\Image\AdapterFactory $imageFactory,
        \Magento\Framework\Filesystem\Io\File $filesystemFile,
        \Magento\Framework\Module\Dir\Reader $moduleReader
    ) {
        $this->_storeManager = $storeManager;
        $this->_encryptor = $encryptor;
        $this->_imageFactory = $imageFactory;
        $this->filesystemFile = $filesystemFile;
        parent::__construct($context);
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->_baseDirectory = $moduleReader;
    }

    /**
     * Return brand config value by key and store
     *
     * @param string $key
     * @param \Magento\Store\Model\Store|int|string $store
     * @param string|null $default
     * @return string|null
     */
    public function getConfig($key, $store = null, $default = null)
    {
       
        $store = $this->_storeManager->getStore($store);
        $result =  $this->scopeConfig->getValue(
            'lofwebpushnotification/'.$key,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store);
        return $result;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return (bool)$this->getConfig("general/enabled");
    }
    /**
     * @return string
     */
    public function getSenderId()
    {
        return $this->_encryptor->decrypt($this->getConfig('general/app_sender_id'));
    }

    /**
     * @return string
     */
    public function getServerKey()
    {
        return $this->_encryptor->decrypt($this->getConfig('general/app_server_key'));
    }

    /**
     * @return string
     */
    public function getPublicKey()
    {
        return $this->_encryptor->decrypt($this->getConfig('general/app_public_key'));
    }
    /**
     * getMediaUrl get media url
     *
     * @param  string $path
     * @return
     */
    public function getMediaUrl($path = null)
    {
        if ($path) {
            return $this ->_storeManager->getStore()->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA,
                ['_secure' => true]
            ).$path;
        } else {
            return $this ->_storeManager->getStore()->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA,
                ['_secure' => true]
            );
        }
    }

    /**
     * @return string
     */
    public function getSecureUrl()
    {
        return $this->scopeConfig->getValue(
            'web/secure/base_url',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    
    /**
     * @param string $value
     * @return string
     */
    public function getFCMConfig($value)
    {
        return $this->getConfig('general/'.$value);
    }

    /**
     * @param string $value
     * @return string
     */
    public function getFCMConfigEncrypted($value)
    {
        return $this->_encryptor->decrypt($this->getConfig('general/'.$value));
    }

    public function getCanDebug() {
        return $this->getConfig('general/debug');
    }

    public function getFCMServiceWorkerContent() {
        $version = 1;
        $debug = $this->getCanDebug();
        $swTemplate = @file_get_contents($this->_baseDirectory->getModuleDir(
            \Magento\Framework\Module\Dir::MODULE_ETC_DIR,
            'Lof_WebPushNotification'
        )."/templates/fcm-service-worker.js.dist");

        $swTemplate = str_replace("%version%", $version, $swTemplate);
        $swTemplate = str_replace("%debug%", $debug, $swTemplate);
             
        return $swTemplate;
    }

}

