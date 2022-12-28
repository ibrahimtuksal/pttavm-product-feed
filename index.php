<?php
spl_autoload_register(function($className) {
    $file = 'src\\' . $className . '.php';
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
    require_once $file;
});

use Service\FeedService;
use Type\Format;
use Type\Provider;

set_error_handler("Handler\\ErrorHandler::handleError");
set_exception_handler("Handler\\ErrorHandler::handleException");

$products = file_get_contents('products.json');
$products = json_decode($products);

$feedService = new FeedService();
try {
    $feedService->create(Format::JSON, Provider::FACEBOOK, $products);
} catch (Exception $e) {
    echo $e->getMessage();
}