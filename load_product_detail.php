<?php

/**
 * @Copyright: Copyright :copyright: 2019 by IBPort. All rights reserved.
 * @Author: Neal Wong
 * @Email: ibprnd@gmail.com
 */

require_once './vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

use AmazonProductLoader\ProductLoader;

$marketplace = 'us';
$asins = ['B07X7KW3PY', 'B0838ZSMHS', 'B083H2QR54', '0393094804'];

$dotenvPath = __DIR__ . '/.env';
if (is_file($dotenvPath)) {
	$dotenv = new Dotenv();
	$dotenv->load($dotenvPath);
}

$host = getenv('PRODUCT_SERVICE_HOST') ?? 'localhost';
$port = getenv('PRODUCT_SERVICE_PORT') ?? 80;
$user = getenv('PRODUCT_SERVICE_USER') ?? '';
$password = getenv('PRODUCT_SERVICE_PASSWORD') ?? '';

$loader = new ProductLoader($host, $port, $user, $password);
$products = $loader->getProducts($asins, $marketplace);
print_r($products);
