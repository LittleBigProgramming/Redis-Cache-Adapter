<?php

namespace App\Cache;

use Predis\Client as Predis;

class RedisAdapter implements CacheInterface {

    protected $client;

    function __construct(Predis $client) {
        $this->client = $client;
    }

    /**
     * @param $key
     * @return string
     */
    public function get($key) {
        return $this->client->get($key);
    }

    /**
     * @param $key
     * @param $value
     * @param null $minutes
     * @return int|mixed
     */
    public function put($key, $value, $minutes = null) {

        if ($minutes === null) {
            return $this->forever($key, $value);
        }

        return $this->client->setex($key, (int) max(1, $minutes * 60), $value);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function forever($key, $value) {
        return $this->client->set($key, $value);
    }

    /**
     * @param $key
     * @param null $minutes
     * @param callable $callback
     * @return string
     */
    public function remember($key, $minutes = null, callable $callback) {

        if (!is_null($value = $this->get($key))) {
            return $value;
        }

        $this->put($key, $value = $callback(), $minutes);

        return $value;
    }

    /**
     * @param $key
     * @return int
     */
    public function forget($key) {
        return $this->client->del($key);
    }
}