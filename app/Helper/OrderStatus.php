<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 10/26/2019
 * Time: 1:38 PM
 */

namespace App\Helper;


class OrderStatus
{
    const Pending = 'pending';
    const InProgress = 'in progress';
    const ToDelivering = 'to delivering';
    const onWay = 'on way';
    const OnDelivering = 'on delivering';
    const Delivered = 'delivered';
    const Completed = 'complete';
    const Cancelled = 'cancelled';
    const UserNotFound = 'User Not Found';
    const SyS_cancelled = 'SyS_cancelled';
    const interrupt = 'interrupt';
    const refund = 'refund';
    const doneRefund = 'doneRefund';

    const arr=array(
        'pending' => 'pending',
        'in progress' => 'in progress',
        'to delivering' => 'to delivering',
        'onWay' => 'on way',
        'on delivering' => 'on delivering',
        'delivered' => 'delivered',
        'completed' => 'complete',
        'cancelled' => 'cancelled',
        'User Not Found' => 'User Not Found',
        'SyS_cancelled' => 'SyS_cancelled',
        'interrupt' => 'interrupt',
        'refund' => 'refund',
        'doneRefund' => 'doneRefund',
    );

    static function getStatus($status)
    {
        $arr = array(
            'pending' => 'pending',
            'in progress' => 'in progress',
            'to delivering' => 'to delivering',
            'onWay' => 'on way',
            'on delivering' => 'on delivering',
            'delivered' => 'delivered',
            'completed' => 'complete',
            'cancelled' => 'cancelled',
            'User Not Found' => 'User Not Found',
            'SyS_cancelled' => 'SyS_cancelled',
            'interrupt' => 'interrupt',
        );
        return $arr[$status];
    }
}
