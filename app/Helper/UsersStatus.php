<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 10/26/2019
 * Time: 1:38 PM
 */

namespace App\Helper;


class UsersStatus
{
    const InActive = 0;
    const Active = 1;

    const arr=array(
        '0' => 'InActive',
        '1' => 'Active',
    );
    static function getStatus($status)
    {
        $arr = array(
            '1' => 'Active',
            '0' => 'InActive',
        );
        return $arr[$status];
    }
}
