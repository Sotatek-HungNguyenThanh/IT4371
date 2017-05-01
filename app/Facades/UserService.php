<?php

/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 01/05/2017
 * Time: 21:44
 */
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class UserService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'UserService';
    }
}