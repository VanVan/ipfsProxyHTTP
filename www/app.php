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
require(dirname(__FILE__) . '/src/config.inc.php');

if( !defined('IPNS') )
    exit;

ipfsProxyHTTP::loadInstance($_SERVER['REQUEST_URI'])->dispatch();
