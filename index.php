<?php

require_once(__DIR__ . '/vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

\Auction\Bootstrap::Run($app);

$app->get('/', 'Auction\Controller\AuctionController::ShowList');
$app->get('/lots/{id}', 'Auction\Controller\LotController::ShowLot')->assert('id', '\d+');

$app->run();