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

namespace Lof\WebPushNotification\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class Notification extends \Magento\Framework\View\Element\Template
{

    /** @var \Magento\Framework\View\Helper\SecureHtmlRenderer */
    private $secureRenderer;

    /**
     * @var \Lof\WebPushNotification\Helper\Data
     */
    protected $_helper;

    /**
     * @param Context $context
     * @param \Lof\WebPushNotification\Helper\Data $_helper
     * @param \Magento\Framework\App\RequestInterface $httpRequest
     * @param Filesystem $filesystem
     * @param array   $data
     */
    public function __construct(
        Context $context,
        \Lof\WebPushNotification\Helper\Data $_helper,
        \Magento\Framework\App\RequestInterface $httpRequest,
        Filesystem $filesystem,
        array $data = []
    ) {
        $this->_helper = $_helper;
        $this->httpRequest = $httpRequest;
        $this->_baseDirectory = $filesystem->getDirectoryWrite(DirectoryList::PUB);
        parent::__construct($context, $data);
    }

    /**
     * get secure url
     *
     * @return string
     */
    public function getSecureUrl()
    {
        return $this->_helper->getSecureUrl();
    }

    /**
     * get sender id
     *
     * @return string
     */
    public function getSenderId()
    {
        return $this->_helper->getSenderId();
    }

     /**
      * get sender key
      *
      * @return string
      */
    public function getServerKey()
    {
        return $this->_helper->getServerKey();
    }

    /**
     * get Browser
     */
    public function getBrowser()
    {
        $u_agent = $this->httpRequest->getServer('HTTP_USER_AGENT');
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";
        $ub = "";
        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        $known = ['Version', $ub, 'other'];
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
            return $matches;
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version= $matches['version'][0];
            } else {
                $version= $matches['version'][1];
            }
        } else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {
            $version="?";
        }

        return [
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        ];
    }

    /**
     * Get Helper Object
     */
    public function helperObject()
    {
        return $this->_helper;
    }

    /**
     * Get Get Path
     */

    public function getPath()
    {
        return $this->_baseDirectory->getAbsolutePath();
    }
}
