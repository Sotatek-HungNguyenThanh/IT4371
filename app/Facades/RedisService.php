<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 02/05/2017
 * Time: 10:06
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class RedisService extends Facade
{
    protected static function getFacadeAccessor() {
        return 'RedisService';
    }
}