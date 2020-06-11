<?php

/**
 * @Copyright: Copyright :copyright: 2019 by IBPort. All rights reserved.
 * @Author: Neal Wong
 * @Email: ibprnd@gmail.com
 */

require_once './vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

use AmazonProductLoader\ProductCategoriesTaskSender;

$marketplace = 'us';
$asins = ['B0838ZSMHS', 'B083H2QR54', '0393094804'];

$dotenvPath = __DIR__ . '/.env';
if (is_file($dotenvPath)) {
	$dotenv = new Dotenv();
	$dotenv->load($dotenvPath);
}

$host = getenv('BROKER_HOST') ?? 'localhost';
$username = getenv('BROKER_USER') ?? 'guest';
$password = getenv('BROKER_PASSWORD') ?? 'guest';
$vhost = getenv('BROKER_VHOST') ?? '/';
$exchange = getenv('BROKER_EXCHANGE_CATEGORIES') ?? '';
$routingKey = getenv('BROKER_ROUTING_KEY_CATEGORIES') ?? $exchange;

$sender = new ProductCategoriesTaskSender($host, $username, $password, $vhost, $exchange, $routingKey);
foreach ($asins as $asin) {
	$sender->sendTask($asin, $marketplace);
}
