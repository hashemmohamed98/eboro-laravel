<?php

namespace App\Helper;
use Srmklive\PayPal\Services\AdaptivePayments;
use Srmklive\PayPal\Services\ExpressCheckout;

class Paypalpaymet
{
    public static function pay()
    {
        $provider = new PayPalClient;
        $provider = PayPal::setProvider();
        $provider->getAccessToken();
        $provider->setCurrency('EUR')->setExpressCheckout($data);
        $options = [
            'BRANDNAME' => 'MyBrand',
            'LOGOIMG' => 'https://example.com/mylogo.png',
            'CHANNELTYPE' => 'Merchant'
        ];

        $provider->addOptions($options)->setExpressCheckout($data);
    }
}
