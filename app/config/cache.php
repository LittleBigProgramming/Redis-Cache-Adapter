<?php

return [
  'cache' => [
      'driver' => 'redis',

      'connections' => [
          'redis' => [
              'host' => '127.0.0.1',
              'port' => '6379',
              'password' => null,
          ]
      ]
  ]
];