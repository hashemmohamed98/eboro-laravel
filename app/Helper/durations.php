<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 10/26/2019
 * Time: 1:38 PM
 */

namespace App\Helper;


class durations
{
    const duration5 = '5';
    const duration8 = '8';
    const duration10 = '10';
    const duration15 = '15';
    const duration20 = '20';
    const duration25 = '25';
    const duration30 = '30';
    const duration40 = '40';
    const duration45 = '45';
    const duration50 = '50';
    const duration55 = '55';
    const duration60 = '60';
    const duration70 = '70';
    const duration80 = '80';
    const duration90 = '90';
    const duration100 = '100';
    const duration110 = '110';
    const duration120 = '120';

    const arr=array(
        'duration5' => '5',
        'duration8' => '8',
        'duration10' => '10',
        'duration15' => '15',
        'duration20' => '20',
        'duration25' => '25',
        'duration30' => '30',
        'duration40' => '40',
        'duration45' => '45',
        'duration50' => '50',
        'duration55' => '55',
        'duration60' => '60',
        'duration70' => '70',
        'duration80' => '80',
        'duration90' => '90',
        'duration100' => '100',
        'duration110' => '110',
        'duration120' => '120',

    );
    static function getDuration($duration)
    {
        $arr = array(
            'duration5' => '5',
            'duration8' => '8',
            'duration10' => '10',
            'duration15' => '15',
            'duration20' => '20',
            'duration25' => '25',
            'duration30' => '30',
            'duration40' => '40',
            'duration45' => '45',
            'duration50' => '50',
            'duration55' => '55',
            'duration60' => '60',
            'duration70' => '70',
            'duration80' => '80',
            'duration90' => '90',
            'duration100' => '100',
            'duration110' => '110',
            'duration120' => '120',

        );
        return $arr[$duration];
    }
}
