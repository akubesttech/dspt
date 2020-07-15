<?php
include('admin/lib/dbcon.php'); 
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
    //"authorization: Bearer sk_test_5a19822c308f7d12f9f64f19cecac63796ec6816",
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
//include('admin/lib/dbcon.php'); 
//dbcon();
$queryschool= mysqli_fetch_array(mysqli_query($condb,"select * from schoolsetuptd "))or die(mysqli_error($condb));
		$schoolNe = $queryschool['SchoolName'];					  
$pstart = "1";
$urllogin = host();
$logon ="assets/media/dslogo.png";
$refme = $tranx->data->reference ;
$payamount = $tranx->data->amount / 100;
$paydate = date("D d F, Y  - g:i A", time()) ; //$tranx->data->transaction_date ;
//$p_email = $tranx->data->email ;
if('success' == $tranx->data->status){
  // transaction was successful...
  // please check other things like whether you already gave value for this ref
  // if the email matches the customer who owns the product etc
 // Visit: "<a href=''>.$urllogin."apply_b.php?view=New"."\n
  // Give value
  $sql2_up=	mysqli_query($condb,"UPDATE fshop_tb SET fpay_status='1',fdate_paid = NOW(),fpamount = '".safee($condb,$payamount)."',dategen = NOW() WHERE ftrans_id ='".safee($condb,$refme)."' ")or die(mysqli_error($condb));
  //echo "<h2>Thank you for making a purchase. Your file has bee sent your email.</h2>"
  $sql_svery2=mysqli_query($condb,"SELECT * FROM fshop_tb WHERE (ftrans_id) ='".safee($condb,$refme)."'");
  $feeinfo = mysqli_fetch_array($sql_svery2); $sname = $feeinfo['fsname'];$oname = $feeinfo['foname'];
  $orderPin = $feeinfo['pin'];$orderSerial = $feeinfo['serial']; $p_email = $feeinfo['femail']; $payref = $feeinfo['ftrans_id'];
/*$messagep = nl2br("Dear $sname $oname,.\n
	The Message was Send To You From " .$schoolNe ." @ ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
	..................................................................\n
	The Following is Your PIN Order Information:.\n
	Pin:   ".$orderPin."\n
	Serial: ".$orderSerial."\n
	Date Generated: ".$paydate."\n
	Visit: ".$urllogin."apply_b.php?view=New"."\n
	..................................................................\n
 
	Thank You Admin!\n\n"); */
	//$random_hash = md5(date('r', time()));
$message = "<html><head> ";
$message .= "<style>.row1 {background-color: #EFEFEF;border: 1px solid #98C1D1;height: 30px;	font-family:Verdana, Geneva, sans-serif; font-size:12px; } </style>";
$message.= "<style>.row2 {background-color: #DEDEDE;border: 1px solid #98C1D1;height: 30px;font-family:Verdana, Geneva, sans-serif; font-size:12px; }</style>";
$message.= "<style>.button {background-color: #4CAF50;border: none;color: white;padding: 10px 22px;text-align: center;text-decoration: none;
    display: inline-block;font-size: 12px;margin: 2px 2px;cursor: pointer;}</style>";
 $message .= "<link rel='stylesheet' href='";
 $message .= $urllogin;
$message .= "'./assets/css/ApplyAlberta.css' type='text/css'><title>Email Verification</title></head><body>";
$message .= "<div class='clear' style='overflow: auto;'> <table  border='0' width=65% > ";
  $message .= "<tr class='row1'><td width='20%' colspan='6' height='15'><img src='";
   $message .= $urllogin."".$logon;
$message .= "' width='224' height='42'></td>";
  //$message .= "'./css/images/epaylogo.png' width='224' height='40'></td>";
    $message .= "</tr>";
    
    $message .= "<tr class='row2'><td width='20%' colspan='6' height='15'><strong> Dear: ".ucwords($sname." ". $oname)." </strong></td></tr>";
  $message .= "</tr><tr class='row1'><td width='19%' height='20' colspan='6'><center>The Message was Sent To You From " .$schoolNe ." @ ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y')."</center></td></tr>";
    $message .= "<tr class='row2'><td width='20%' colspan='6' height='15' style='color:green;'> <center><strong> The Following is Your PIN Order Information </strong></center></td>";
    $message .= " </tr>";
    $message .=  "<tr class='row1'> ";
  $message .= "<td width='20%' colspan='2' height='20'><strong> Pin:</strong></td>";
   $message .= "<td width='20%' colspan='4' height='20'> ".$orderPin."</td>";
  $message .=  "</tr> <tr class='row2'><td width='20%' colspan='2' height='20'><strong> Serial:</strong></td>";
$message .= "<td width='20%' colspan='4' height='20'> ".$orderSerial."</td> </tr>";
 $message .=  "<tr class='row1'> <td width='20%' colspan='2' height='20'><strong> Date Generated:</strong></td>";
  $message .=  "<td width='20%' colspan='4'> ".$paydate."</td> ";

 $message .=  "</tr> <tr class='row2'><td width='20%' colspan='2' height='20'><strong> Payment Reference:</strong></td>";
$message .= "<td width='20%' colspan='4' height='20'> ".$payref."</td> </tr>";

  $message .=  "</tr> <tr class='row1'>";
   $message .= "<td width='20%' colspan='5' height='20'><center> &nbsp;&nbsp;&nbsp; Click &nbsp;<strong><a href=".$urllogin."apply_b.php?view=New class='button' target='_blank'> Apply Now </a></strong>&nbsp; or &nbsp; Visit ".$urllogin."apply_b.php?view=New </center></td>";
   $message .= "</tr><tr class='row2'><td width='19%' height='20' colspan='6'><center> ....................................</center></td></tr>";
   $message .= "<tr class='row1'>";
   $message .= "<td width='20%' colspan='6' height='20'>&nbsp;For inquiry and complaint please email <strong>admin@smartdelta.com.ng </strong> 
	Thank You Admin! </td>";

$message .= "</tr></table></div></body></html>";
$subject="Pin Order Information "; 
//define the headers we want passed. Note that they are separated with \r\n
/*$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers      .= "From:Message From School Admin\r\n <$from>\r\n".
                   'Reply-To: '.$replyto ."\r\n" .
                   'Return-Path: The Sender: '. $from ."\r\n" .
                   'X-Priority: 3\r\n'.
                   //'Reply-To: '.$replyto."\r\n" .
                   'X-Mailer: PHP/' . phpversion(); */
                   
 //define the body of the message.
//ob_start(); //Turn on output buffering
//@mail($p_email, $subject, $msg, $headers);
$mail_data = array('to' => $p_email, 'sub' => $subject, 'msg' => 'Notify','body' => $message, 'srname' => $comn);
	send_email2($mail_data);
  	message("Your Pin Order was Successful!", "success");
		        redirect('apply_b.php?view=e_suc&txno='.md5($refme));
   //header('Location: apply_b.php?view=e_suc&txno='.($refme)
	exit();
}else{
  	message("Your Pin Order was not Successful!", "error");
		        redirect('apply_b.php?view=e_suc&txno='.md5($refme));
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