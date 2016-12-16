<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 16/12/2016
 * Time: 13:44
 */
require 'vendor/autoload.php';
require_once "config.php";
use Controller\indexController;

$app->get('/', function ($request, $response, $args) {

    $index = new indexController();


    $keyDev = "AIzaSyAKwp2I_Rok-M96Q3mq_e5ocMwZFd0hNtE";
    $client = new Google_Client();
    $client->setDeveloperKey($keyDev);

    $youtube = new Google_Service_YouTube($client);
    $datas['name'] = 'maxime';
    $datas['age'] = 20;

    $relatedVideos = $youtube->search->listSearch('id,snippet',['relatedToVideoId' => '34Na4j8AVgA' ,'maxResults' => 10, 'type' => 'video']);

    //$videos = $youtube->videos->listVideos("snippet, contentDetails", array('id' => '34Na4j8AVgA'));


    return $this->view->render($response, 'page/index.twig', $datas);


});


$app->get('/{name}', function ($request, $response, $args) {
    $indexController = new indexController();
    $indexController->render($args['name']);
});

$app->run();