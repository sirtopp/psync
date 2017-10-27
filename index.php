<?php

use GuzzleHttp\Psr7\Uri;
use Stadnicki\Psync\Model\User;
use Stadnicki\Psync\Protocol\Endpoint\UserApi;
use Stadnicki\Psync\Transport\GuzzleHttpClient;

require "./vendor/autoload.php";

$client = new GuzzleHttpClient();
$adminUri = new Uri("http://127.0.0.1:8005");
$timecampAdminUri = $adminUri->withPath('/timecamp');


$userApi = new UserApi(
    $client,
    $timecampAdminUri
);

$user = new User();
$user->name = 'testtest';
$user->password = 'dupadupa';

//$userApi->createUser($user);

$user = $userApi->getUser('testtest');
var_dump($user);