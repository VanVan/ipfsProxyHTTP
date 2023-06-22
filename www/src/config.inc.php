<?php
/**
 * 2017-2018 ipns.co
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.opensource.org/licenses/mit-license.html
 *
 * @author    Wandrille RONCE <contact@ipns.co>
 * @copyright 2017-2018 ipns.co
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 */

const IPNS = true;

const CHECK_HOST = true;
const IPFS_STRING_LENGTH =  46;
const IPFS_STRING_PREFIX = array(
    '/ipfs',
    '/ipns',
	'/www',
	'/ipns/www',
	'/ipfs/www',
	'/ipfs/www/ipfs',
	'/ipfs/www/ipns'
);
const INDEX_TEMPLATE = '/index.template.html';
const REDIRECT_TEMPLATE = '/redirect.template.html';
const NOTFOUND_TEMPLATE = '/notfound.template.html';
const PROXY_LIST_FILE = 'gateway.txt';
const BLACKLIST_LIST_FILE = 'blacklist.txt';
const CHECK_HOST_TIMEOUT = 3;
const IPFS_CHECK_HOST_URI = 'QmYwAPJzv5CZsnA625s3Xf2nemtYgPpHdWEz79ojWnPbdG/readme';
const IPFS_CHECK_HOST_VERIFY_STRING = 'Welcome to IPFS';



require(dirname(__FILE__) . '/../src/ipfsProxyHTTP.class.php');