<?php


$amount = 2500;
$merchant_id = "1226459";
$order_id = uniqid();
$merchant_secret = "NDA1ODEzNDM1MTk1MDgyNDMyNDM3Njc1NDU4ODk3OTk3Njg1MjY=";
$currency = "LKR";

$hash = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        number_format($amount, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchant_secret)) 
    ) 
);

// Create an array to store data
$array = array(); // Corrected array initialization

$array["amount"] = $amount;
$array["merchant_id"] = $merchant_id;
$array["order_id"] = $order_id;
$array["currency"] = $currency;
$array["hash"] = $hash;

// Convert the array to JSON
$jsonobj = json_encode($array);

// Output the JSON
echo $jsonobj;
?>
