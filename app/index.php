<?php

require 'vendor/autoload.php';

$client = new Predis\Client([
    'scheme' => 'tcp',
    'host' => '127.0.0.1',
    'port' => '6379',
    'password' => null
]);

$client->set('name', 'An Amazing Name');

$cache = new App\Cache\RedisAdapter($client);

$name = $cache->remember('name', 0.1, function () {
   return 'An Amazing Name';
});
