<?php

/**
 * @Copyright: Copyright :copyright: 2019 by IBPort. All rights reserved.
 * @Author: Neal Wong
 * @Email: ibprnd@gmail.com
 */

require_once './vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

use AmazonProductLoader\ProductDetailTaskSender;

$marketplace = 'us';
$asins = ['B07X7KW3PY', 'B0838ZSMHS', 'B083H2QR54', '0393094804'];

$dotenvPath = __DIR__ . '/.env';
if (is_file($dotenvPath)) {
	$dotenv = new Dotenv();
	$dotenv->load($dotenvPath);
}

$host = getenv('BROKER_HOST') ?? 'localhost';
$username = getenv('BROKER_USER') ?? 'guest';
$password = getenv('BROKER_PASSWORD') ?? 'guest';
$vhost = getenv('BROKER_VHOST') ?? '/';
$exchange = getenv('BROKER_EXCHANGE') ?? '';
$routingKey = getenv('BROKER_ROUTING_KEY') ?? $exchange;

$sender = new ProductDetailTaskSender($host, $username, $password, $vhost, $exchange, $routingKey);
$sender->sendTask($asins, $marketplace);
