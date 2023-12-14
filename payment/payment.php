<?php


namespace Payment;

use Omnipay\Omnipay;

class Payment {
    public function gateway(){
        $gateway = Omnipay::create("paypal_express");
        $gateway->setUsername("sb-pmdy428780441@business.example.com");
        $gateway->setPassword("Vv3t<4lG");
        $gateway->setSignature("EK1kwTor7kwKTXOMVYI0pvuhQFPUWCUIyA48ogjzv_tqZWKWMr4rucchOGe6FjRupw_usQYfm3Z0J9ur");
        $gateway->setTestMode(true);
        return $gateway;
    }

    public function pay(array $parameters){
        $response = $this->gateway()->pay($parameters)->send();
        return $response;
    }

    public function complete(array $parameters){
        $response = $this->gateway()->completePurchase($parameters)->send();
        return $response;
    }

    public function formatAmount($amount){
        return number_format($amount, 2, '.', '');
    }

    public function getCancelledPurchase($order = ""){
        return $this->route('https://localhost/aab/cancel.php', $order);
    }

    public function getReturnUrl($order = "")
    {
        return $this->route('https://demo.example.com/return.php', $order);
    }

    public function route($name, $params)
    {
        return $name; 
    }
}