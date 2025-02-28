<?php

namespace App\Helper;

use App\Models\BranchStaff;

Class UsersType
{
    const Client = 0;
    const Admin = 1;
    const Seller = 2;
    const Cashier = 3;
    const Delivery = 4;
//    const Branch_Admin = 5;

    const AllTypes = array(
        '0' => 'Client',
        '1' => 'Admin',
        '2' => 'Seller',
        '3' => 'Cashier',
        '4' => 'Delivery',
//        '5' => 'Branch_Admin',
    );

    static function getType($status)
    {
        $arr = array(
            '0' => 'Client',
            '1' => 'Admin',
            '2' => 'Seller',
            '3' => 'Cashier',
            '4' => 'Delivery',
//            '5' => 'Branch_Admin',
        );
        return $arr[$status];
    }

}
