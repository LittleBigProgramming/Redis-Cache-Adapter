<?php

namespace App\Cache;

/**
 * Interface Cache
 * @package App\Cache
 */
interface CacheInterface {
    public function get($key);
    public function put($key, $value, $minutes = null);
    public function forever($key, $value);
    public function remember($key, $minutes = null, callable $callback);
    public function forget($key);
}