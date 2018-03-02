<?php
/**
 * 2017-2018 ipns.co
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 *
 * @author    Wandrille RONCE <contact@ipns.co>
 * @copyright 2017-2018 ipns.co
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */
require(dirname(__FILE__) . '/src/config.inc.php');

if( !defined('IPNS') )
    exit;

ipfsProxyHTTP::loadInstance($_SERVER['REQUEST_URI'])->dispatch();
