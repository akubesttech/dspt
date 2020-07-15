<?php 
##############################################################
##	Sample voguepay confirmation/order processing script.	##
##	This easy-to-use sample is provided as-is under the 	##
##	GNU LGPL Version 3 License which can be found at:		##
##	http://www.gnu.org/licenses/lgpl-3.0-standalone.html					## 
##	Script is hosted at http://vogue247.com/voguepay		## 
##	There is no warranty for this opensource script			## 
##############################################################

##It is assumed that you have put the URL to this file in the notification url
##of the form you submitted to voguepay.
##VoguePay Submits transaction id to this file as $_POST['transaction_id']
/*--------------Begin Processing-----------------*/
include('../admin/lib/dbcon.php'); 
dbcon();
$merchant_id = 'demo';

##Check if transaction ID has been submitted

if(isset($_POST['transaction_id'])){
	//get the full transaction details as an xml from voguepay
	$xml = file_get_contents('https://voguepay.com/?v_transaction_id='.$_POST['transaction_id']);
	//parse our new xml
	$xml_elements = new SimpleXMLElement($xml);
	//create new array to store our transaction detail
	$transaction = array();
	//loop through the $xml_elements and populate our $transaction array
	foreach($xml_elements as $key => $value) 
	{
		$transaction[$key]=$value;
	}
	/*
	Now we have the following keys in our $transaction array
	$transaction['merchant_id'],
	$transaction['transaction_id'],
	$transaction['email'],
	$transaction['total'], 
	$transaction['merchant_ref'], 
	$transaction['memo'],
	$transaction['status'],
	$transaction['date'],
	$transaction['referrer'],
	$transaction['method'],
	$transaction['cur']
	*/
	  $paystatusn=mysql_query("SELECT * FROM payment_tb WHERE trans_id ='".mysql_real_escape_string($transaction['merchant_ref'])."' ");
      $payrecordn =mysql_fetch_array($paystatusn); 
	  $merchantref  = $payrecordn['trans_id']; $trans_amount  = $payrecordn['paid_amount'];
	  session_start()
	  $_SESSION['transide2'] = $merchantref;
	if($transaction['total'] == 0)die('Invalid total');
	if($transaction['status'] != 'Approved')die('Failed transaction');
	if($transaction['merchant_id'] != $merchant_id)die('Invalid merchant');
	
	if($transaction['total'] !== $trans_amount )die('Invalid total');
	/*You can do anything you want now with the transaction details or the merchant reference.
	You should query your database with the merchant reference and fetch the records you saved for this transaction.
	Then you should compare the $transaction['total'] with the total from your database.*/
}
?>
