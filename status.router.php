<?php
//Define interface class for router
use \Psr\Http\Message\ServerRequestInterface as Request;    //PSR7 ServerRequestInterface   >> Each router file must contains this
use \Psr\Http\Message\ResponseInterface as Response;        //PSR7 ResponseInterface        >> Each router file must contains this

//Define your modules class
use \modules\invoice\Status as Status;                      //Your main modules class

//Define additional class for any purpose
use \classes\middleware\ApiKey as ApiKey;                   //ApiKey Middleware             >> To authorize request by using ApiKey generated by reSlim

    // GET api to show all data option status customer
    $app->get('/invoice/option/data/status/{token}', function (Request $request, Response $response) {
        $i = new Status($this->db);
        $i->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $i->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($i->showOptionStatus());
        return classes\Cors::modify($response,$body,200);
    });