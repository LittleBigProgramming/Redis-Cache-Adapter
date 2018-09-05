<?php

require 'vendor/autoload.php';

$app = new \Slim\App(([
    'settings' => [
        'displayErrorDetails' => true
    ]
]));

$container = $app->getContainer();

$container['config'] = function () {
    return new Noodlehaus\Config([
       __DIR__ .'/config/cache.php',
    ]);
};

$container['cache'] = function ($container) {
    $client = new Predis\Client([
        'scheme' => 'tcp',
        'host' => $container->config->get('cache.connections.redis.host'),
        'port' => $container->config->get('cache.connections.redis.port'),
        'password' => $container->config->get('cache.connections.redis.password')
    ]);

    return new App\Cache\RedisAdapter($client);
};

$app->get('/', function ($request, $response) {
    $users = $this->cache->remember('users', 10, function () {
        $users = [
            ['username' => 'John'],
            ['username' => 'Jane'],
            ['username' => 'Jack'],
            ['username' => 'Jill'],
        ];

        return json_encode($users);
    });

    return $response->withHeader('Content-Type', 'application/json')->write($users);
});

$app->run();