<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

include('../admin/lib/dbcon.php'); 
dbcon(); 
$curl = curl_init();

$email = $_POST['emailx'];
$amountn = $_POST['total'];  //the amount in kobo. This value is actually NGN 300
//$amount = $_POST['total'] * 100;  //the amount in kobo. This value is actually NGN 300
$tcharge = getptcharge($amountn,1.5); $amountp = $amountn + $tcharge; $amount = $amountp * 100;

// url to go to after payment
//$callback_url = 'myapp.com/pay/callback.php';  
$callback_url = host().'Student/ccallback.php'; 

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount'=>$amount,
    'email'=>$email,
     "reference" => $_POST['merchant_ref2'],
    'callback_url' => $callback_url
  ]),
  CURLOPT_HTTPHEADER => [
    //"authorization: Bearer sk_test_07a04bc4d12ea7c4640ba82055729ff1175def5a",
    "authorization: Bearer ".t_gate,
    "content-type: application/json",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
  // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}

$tranx = json_decode($response, true);

if(!$tranx->status){
  // there was an error from the API
  print_r('API returned error: ' . $tranx['message']);
}

// comment out this line if you want to redirect the user to the payment page
//print_r($tranx);
// redirect to page so User can pay
// uncomment this line to allow the user redirect to the payment page
//header('Location: ' . $tranx['data']['authorization_url']);
redirect($tranx['data']['authorization_url']);


?>