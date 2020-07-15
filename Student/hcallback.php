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
//include('../admin/lib/dbcon.php'); 
//dbcon();
$pstart = "1";
$payamount = $tranx->data->amount / 100;
$refme = $tranx->data->reference ;
if('success' == $tranx->data->status){
  // transaction was successful...
  // please check other things like whether you already gave value for this ref
  // if the email matches the customer who owns the product etc
  // Give value
  	$hinfoo=mysqli_query($condb,"SELECT * FROM hostelallot_tb WHERE  trans_id ='".safee($condb,$refme)."'");
	$hinfoo1 = mysqli_fetch_array($hinfoo); $roomid = $hinfoo1['roomno'];
  $sql2_up=	mysqli_query($condb,"UPDATE hostelallot_tb SET amount = '".safee($condb,$payamount)."',paystatus = '".safee($condb,$pstart)."'  WHERE trans_id ='".safee($condb,$refme)."'")or die(mysqli_error($condb));
  $sql2_up=	mysqli_query($condb,"UPDATE payment_tb SET pay_status='".safee($condb,$pstart)."',paid_amount = '".safee($condb,$payamount)."' WHERE trans_id ='".safee($condb,$refme)."' ")or die(mysqli_error($condb));
  $sql2   = mysqli_query($condb,"UPDATE  roomdb SET room_status = '0' WHERE room_id = '".safee($condb,$roomid)."'");
  //echo "<h2>Thank you for making a purchase. Your file has bee sent your email.</h2>"
  	message("Your Payment with Transaction Refrence: ".$refme. " was Successful!", "success");
		    redirect("shostel_manage.php?view=H_info");
   //header('Location: Spay_manage.php?view=e_suc&id='.($refme));
	exit();
}else{
  	message("Your Payment with Transaction Refrence:".$refme. " was not Successful!", "error");
		        redirect('shostel_manage.php?view=Hrequest');
		        
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