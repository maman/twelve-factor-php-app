<?php

// Setup flash msgs
$container['flash'] = function ($c) {
    return new Slim\Flash\Messages;
};

// Setup views
$container['view'] = function($c) {
    $view = new \Slim\Views\Twig(__DIR__ . '/views', [
        'cache' => __DIR__ . '/views-cache',
        'debug' => true,
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $c->get('router'),
        $c->get('request')->getUri()
    ));
    return $view;
};

// Setup logger
$container['logger'] = function() {
    $logger = new \Monolog\Logger('main');
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__ . '/../logs/main.log', \Monolog\Logger::DEBUG));
    return $logger;
};

// TODO: Setup db

// Setup debugbar
$container['debugbar_middleware'] = new PhpMiddleware\PhpDebugBar\PhpDebugBarMiddlewareFactory();
$app->add($app->getContainer()->get('debugbar_middleware'));
