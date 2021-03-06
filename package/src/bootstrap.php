<?php

require_once(__DIR__ . '/../vendor/autoload.php');

function addpay($config)
{
    if (empty($config['client_id'])) {
        throw new \Exception('Please fill in the client_id');
    }

    if (empty($config['client_secret'])) {
        throw new \Exception('Please fill in the client_secret');
    }

    define('ADDPAY_TOKEN', 'Token ' . base64_encode("{$config['client_id']}:{$config['client_secret']}"));

    if ($config['client_live']) {
        define('ADDPAY_BASE_URL', 'https://secure.addpay.co.za/v2');
    } else {
        define('ADDPAY_BASE_URL', 'https://secure-test.addpay.co.za/v2');
    }

    \Httpful\Request::ini(\Httpful\Request::init()
                                          ->expectsJson()
                                          ->addHeader('Authorization', ADDPAY_TOKEN)
                                          ->sendsType(\Httpful\Mime::FORM));
}
