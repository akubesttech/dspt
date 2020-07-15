<?php 
##########################################################################
/*
The MIT License (MIT)

Copyright (c) 2014 https://voguepay.com

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
##########################################################################



//set variables
$api = 'https://voguepay.com/api/';
$ref = time().mt_rand(0,999999);
$task = 'create'; 
$merchant_id = 'demo';
$my_username = 'my_username';
$merchant_email_on_voguepay = 'merchant@example.com';
$ref = time().mt_rand(0,9999999);
$command_api_token = '9ufkS6FJffGplu9t7uq6XPPVQXBpHbaN';
$hash = hash('sha512',$command_api_token.$task.$merchant_email_on_voguepay.$ref);

$fields['task'] = $task;
$fields['merchant'] = $merchant_id;
$fields['ref'] = $ref;
$fields['hash'] = $hash;
$fields['amount'] = 1400.50;
$fields['seller'] = 'private_school@example.com';
$fields['memo'] = 'Payment of 3rd grade school fess for whitney Barlotelli'; 

//see function array2xml at the end of this file
$fields_string = 'xml='.urlencode(array2xml($fields));


//open curl connection
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $api);
curl_setopt($ch,CURLOPT_HEADER, false); //we dont need the headers
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);// data coming back is put into a string
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,TRUE);
curl_setopt($ch,CURLOPT_MAXREDIRS,2);
$reply_from_voguepay = curl_exec($ch);//execute post
curl_close($ch);//close connection




//Result is xml string so we convert into array
$xml_str = simplexml_load_string( $reply_from_voguepay, null , LIBXML_NOCDATA ); 
$reply_array = json_decode(json_encode($xml_str),true); 
//$reply_array is now and array



//Check that the result is actually from voguepay.com
$received_hash = $reply_array['hash'];
$expected_hash = hash('sha512',$command_api_token.$merchant_email_on_voguepay.$reply_array['salt']);
if($received_hash != $expected_hash || $my_username != $reply_array['username']){
	//Something is wrong. Discard result
	
} else if($reply_array['status'] != 'OK') {
	//Operation failed
	
} else {
	//operation successful 
	
	//print_r($reply_array) should give the following:
	/*
	
	 Array
	(
	    [status] => OK
	    [response] => OK
	    [values] => private_school@example.com
	    [description] => Payment successful
	    [username] => my_username
	    [salt] => 547f6e4d4bf32
	    [hash] => ae4eca383807f475cbc1928799e2b02ee1fb301feea563e311e24a97d232eb5e2f31548ab1e69eaa55bc528b54ec7d555a79e519f3988363b52e356d0510448d
	)
	 
	*/
	
}



function array2xml($array, $level=1, $root='voguepay') {
	$xml = '';
	if ($level==1) {
		$xml .= '<?xml version="1.0" encoding="ISO-8859-1"?>'.
				"\n<$root>\n";
	}
	foreach ($array as $key=>$value) {
		$key = strtolower($key);
		if (is_array($value)) {
			$multi_tags = false;
			foreach($value as $key2=>$value2) {
				if (is_array($value2)) {
					$xml .= str_repeat("\t",$level)."<$key>\n";
					$xml .= array2xml($value2, $level+1);
					$xml .= str_repeat("\t",$level)."</$key>\n";
					$multi_tags = true;
				} else {
					if (trim($value2)!='') {
						if (htmlspecialchars($value2)!=$value2) {
							$xml .= str_repeat("\t",$level).
							"<$key><![CDATA[$value2]]>".
							"</$key>\n";
						} else {
							$xml .= str_repeat("\t",$level).
							"<$key>$value2</$key>\n";
						}
					}
					$multi_tags = true;
				}
			}
			if (!$multi_tags and count($value)>0) {
				$xml .= str_repeat("\t",$level)."<$key>\n";
				$xml .= array2xml($value, $level+1);
				$xml .= str_repeat("\t",$level)."</$key>\n";
			}
		} else {
			///if (trim($value)!='') {
			///if (htmlspecialchars($value)!=$value) {
			///	$xml .= str_repeat("\t",$level)."<$key>".
				///			"<![CDATA[$value]]></$key>\n";
				///} else {
				$xml .= str_repeat("\t",$level).
				"<$key>$value</$key>\n";
				///}
				///}
			}
	}
	if ($level==1) {
		$xml .= "</$root>\n";
	}
	return $xml;
}

?>
