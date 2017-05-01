<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 30/04/2017
 * Time: 22:39
 */

namespace App;


class Utils
{
    public static function createDigitNumber()
    {
        return sprintf("%018d", mt_rand(1, 999999999999999999));
    }
}