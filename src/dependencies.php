<?php

$container = $app->getContainer();

$container['flash'] = function ($c) {
    return new Slim\Flash\Messages;
};

$container['view'] = function($c) {
    $settings = $c->get('settings')['renderer'];
    $view = new \Slim\Views\Twig($settings['template_path'], [
        'cache' => $settings['cache'],
        'debug' => $settings['debug'],
        'auto_reload' => $settings['auto_reload'],
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $c->get('router'),
        $c->get('request')->getUri()
    ));
    return $view;
};

$container['logger'] = function($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new \Monolog\Logger($settings['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['db'] = function($c) {
    return "null";
};

if (!$isProduction) {
    $container['debugbar_middleware'] = new PhpMiddleware\PhpDebugBar\PhpDebugBarMiddlewareFactory();
    $app->add($app->getContainer()->get('debugbar_middleware'));
}
