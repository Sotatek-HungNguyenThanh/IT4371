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
    public static function createBankNumber()
    {
        $topBankCard = Consts::TOP_BANK_CARD;
        return $topBankCard[rand(0, count($topBankCard) -1)] . sprintf("%018d", mt_rand(1, 999999999999999999));
    }

    public static function createCardNumber()
    {
        return sprintf("%018d", mt_rand(1, 999999999999999999));
    }
}