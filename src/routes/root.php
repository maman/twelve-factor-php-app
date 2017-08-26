<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/', function(Request $req, Response $res) {
    return $this->view->render($res, 'pages/_root.twig', [
        'name' => 'KOPET',
        'env' => $this->isProduction ? 'prod' : 'dev',
    ]);
});
