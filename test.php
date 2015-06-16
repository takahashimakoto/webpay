<?php

require "vendor/autoload.php";
use WebPay\WebPay;
$webpay = new WebPay('test_secret_dHh2fLeBJ80menecnFf863Et');
$webpay->charge->create(array(
   "amount"=>400,
   "currency"=>"jpy",
   "card"=>"tok_8tLdro3spayD2J2",
   "capture"=>false
));

