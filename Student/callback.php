<?php
 include('../admin/lib/dbcon.php'); 
dbcon();
$curl = curl_init();
$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
if(!$reference){
  die('No reference supplied');
}

curl_setopt_array($curl, array(
CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
   //CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . ($reference),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    //"authorization: Bearer sk_test_07a04bc4d12ea7c4640ba82055729ff1175def5a",
    "authorization: Bearer ".t_gate,
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
    // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}

$tranx = json_decode($response);

if(!$tranx->status){
  // there was an error from the API
  die('API returned error: ' . $tranx->message);
}

$pstart = "1";
$payamount = $tranx->data->amount / 100;
$refme = $tranx->data->reference ;
if('success' == $tranx->data->status){
  // transaction was successful...
  // please check other things like whether you already gave value for this ref
  // if the email matches the customer who owns the product etc
  // Give value
  $qpayn = mysqli_query($condb,"SELECT * FROM payment_tb WHERE  trans_id ='".safee($condb,$refme)."'");
	$hpeno = mysqli_fetch_array($qpayn); $feetp1 = $hpeno['fee_type']; $paid = $hinfoo1['dueamount'];
  $sql2_up = mysqli_query($condb,"UPDATE payment_tb SET pay_status='1',paid_amount ='".safee($condb,$paid)."' WHERE trans_id ='".safee($condb,$refme)."' ")or die(mysqli_error($condb));
  $sql2_up1 = mysqli_query($condb,"UPDATE feecomp_tb SET pstatus = '1' WHERE Batchno ='".safee($condb,$feetp1)."' ")or die(mysqli_error($condb));
  //echo "<h2>Thank you for making a purchase. Your file has bee sent your email.</h2>"
  	message("Your Payment was Successful!", "success");
		        redirect('Spay_manage.php?view=e_suc&id='.($refme));
   //header('Location: Spay_manage.php?view=e_suc&id='.($refme));
	exit();
}else{
  	message("Your Payment was not Successful!", "error");
		        redirect('Spay_manage.php?view=e_fail&id='.($refme));
}
//function give_value($reference, $trx){
  // Be sure to log the reference as having gotten value
  // write code to give value
//

//function perform_success(){
  // inline
  // json_encode(['verified'=>true]);
  // standard
  //header('Location: /success.php');
	//exit();
//}
?>