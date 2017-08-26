<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->group('/hello', function() {
    $this->get('', function(Request $req, Response $res) {
        return $this->view->render($res, 'pages/_hello.twig', [
            'name' => 'Hello',
        ]);
    });

    $this->get('/{name}', function(Request $req, Response $res) {
        return $this->view->render($res, 'pages/_hello.twig', [
            'name' => 'Hello ' . $req->getAttribute('name'),
        ]);
    });
});
