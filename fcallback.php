<?php
 include('./admin/lib/dbcon.php'); 
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
$paynowdate = date("Y-m-d");
$pstart = "1";
$payamount = $tranx->data->amount / 100;
$refme = $tranx->data->reference ;
$queryshoolp= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $rowp = mysqli_fetch_array($queryshoolp);
							  $ev_actives = $rowp['emailver']; $schoolNe = $rowp['SchoolName'];
  $qpayn = mysqli_query($condb,"SELECT * FROM payment_tb WHERE  trans_id ='".safee($condb,$refme)."'");
	$hpeno = mysqli_fetch_array($qpayn); $feetp1 = $hpeno['fee_type']; $appnon = $hpeno['app_no']; $smatno  = $hpeno['RegNo'];
    $status = "TRUE"; $sessionad  = $hpeno['session']; $department  = $hpeno['department']; $pro = $hpeno['prog'];
    $studentRegno = getmatno($sessionad,$department,$pro); $regcount = "1".getlstr($studentRegno,3);  $p_email = $hpeno['email'];
    $paid = $hpeno['dueamount'];
    $pass_word = substr(md5($studentRegno.SUDO_M),14);
    // check if paid acceptance
 $sql_cstudent = mysqli_query($condb,"SELECT * FROM student_tb WHERE appNo = '".safee($condb,$appnon)."'");
$contstate = mysqli_num_rows($sql_cstudent);
//select applicant details from admission register
$sqlstud1=mysqli_query($condb,"select * from new_apply1 where appNo ='".safee($condb,$appnon)."' and app_type = '".safee($condb,$pro)."' and Asession = '".safee($condb,$sessionad)."' and adminstatus = '1' and reg_status = '1' and application_r = '0' ")or die(mysqli_error($condb));
$row_b = mysqli_fetch_array($sqlstud1);  $p_duration = getdura($pro);
$num_fchoice2 =$row_b['course_choice'] ; $entryyear   =	substr($sessionad,0,4);   $yog_t =  $entryyear + $p_duration; $modeentry = $row_b['moe']; $entrylev = getelevel($modeentry); $noapp = $row_b['appNo'];
if($num_fchoice2 == '1'){ $facnew =  $row_b['fact_1']; $depnew =  $row_b['first_Choice']; }else{  $facnew =  $row_b['fact_2']; $depnew =  $row_b['Second_Choice'];}
	
if('success' == $tranx->data->status){
  // transaction was successful...
  // please check other things like whether you already gave value for this ref
  // if the email matches the customer who owns the product etc
  // Give value
   if($contstate > 0){
 $sql2_up = mysqli_query($condb,"UPDATE payment_tb SET pay_status='1',paid_amount ='".safee($condb,$paid)."',pay_date = '".safee($condb,$paynowdate)."',stud_reg = '".safee($condb,$studentRegno)."' WHERE trans_id ='".safee($condb,$refme)."' ")or die(mysqli_error($condb));
 $sql2_up1 = mysqli_query($condb,"UPDATE feecomp_tb SET pstatus = '1',regno = '".safee($condb,$studentRegno)."' WHERE Batchno ='".safee($condb,$feetp1)."'")or die(mysqli_error($condb));
 if($smatno < 1){
  $sql2_up3 = mysqli_query($condb,"UPDATE student_tb SET RegNo='".safee($condb,$studentRegno)."',reg_count='".safee($condb,$regcount)."',verify_Data = '".safee($condb,$status)."',password = '".safee($condb,$pass_word)."' WHERE appNo = '".safee($condb,$appnon)."'")or die(mysqli_error($condb));

  //echo "<h2>Thank you for making a purchase. Your file has bee sent your email.</h2>"
  $msg = nl2br("Congratulations! ".getname($appnon).",.\n
	
	Following your Successful School fees payment of ".number_format($paid,2)." your Matric Number was Generated .\n
	Find below your Matric Number and your CMS Password \n
	Matric Number :".$studentRegno.   "\n
	Password :".$studentRegno.   "\n
	..................................................................\n
    Please Login and reset your Password!\n
    
    This Message was Sent From " .$schoolNe ." @ ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
    For inquiry and complaint please email info@deltasmartcity.ng \n
	
	Thank You Admin!\n\n");
  $subject="Matric Number Notification";
  $mail_data = array('to' => $p_email, 'sub' => $subject, 'msg' => 'Notify','body' => $msg, 'srname' => $comn);
	send_email2($mail_data); }}else{
	    $sql2_up = mysqli_query($condb,"UPDATE payment_tb SET pay_status='1',paid_amount ='".safee($condb,$paid)."',pay_date = '".safee($condb,$paynowdate)."',app_no = '".safee($condb,$noapp)."' WHERE trans_id ='".safee($condb,$refme)."' ")or die(mysqli_error($condb));
 $sql2_up1 = mysqli_query($condb,"UPDATE feecomp_tb SET pstatus = '1',regno = '".safee($condb,$noapp)."' WHERE Batchno ='".safee($condb,$feetp1)."'")or die(mysqli_error($condb));
 $sql=mysqli_query($condb,"INSERT INTO student_tb (appNo,FirstName,SecondName,Othername,Gender,dob,hobbies,state,lga,nation,religion,address,e_address,phone,postal_address,any_fchalenge,State_chalenge,Faculty,Department,Age,bloodgroup,gtype,RegNo,app_type,Asession,Moe,yoe,yog,prog_dura,p_level,images,dateofreg,reg_status,verify_Data,Cert_inview)VALUES('".safee($condb,$noapp)."','".safee($condb,$row_b['FirstName'])."','".safee($condb,$row_b['SecondName'])."','".safee($condb,$row_b['Othername'])."','".safee($condb,$row_b['Gender'])."','".safee($condb,$row_b['dob'])."','".safee($condb,$row_b['hobbies'])."','".safee($condb,$row_b['state'])."','".safee($condb,$row_b['lga'])."','".safee($condb,$row_b['nation'])."','".safee($condb,$row_b['religion'])."','".safee($condb,$row_b['address'])."','".safee($condb,$row_b['e_address'])."','".safee($condb,$row_b['phone'])."','".safee($condb,$row_b['postal_address'])."','".safee($condb,$row_b['any_fchalenge'])."','".safee($condb,$row_b['State_chalenge'])."','".safee($condb,$facnew)."','".safee($condb,$depnew)."','".safee($condb,$row_b['Age'])."','".safee($condb,$row_b['bloodgroup'])."','".safee($condb,$row_b['gtype'])."','','".safee($condb,$row_b['app_type'])."','".safee($condb,$row_b['Asession'])."','".safee($condb,$modeentry)."','".safee($condb,$entryyear)."','".safee($condb,$yog_t)."','".safee($condb,$p_duration)."','".safee($condb,$entrylev)."','".safee($condb,$row_b['images'])."',Now(),'1','FALSE','".safee($condb,$row_b['app_type'])."')");
			   }
    
  	message("Your Payment was Successful!", "success");
		        redirect('apply_b.php?view=e_view&id='.md5($refme));
   
	exit();
}else{
  	message("Your Payment was not Successful!", "error");
		        redirect('apply_b.php?view=lpay&p_id='.md5($appnon));
		        //redirect('Spay_manage.php?view=e_fail&id='.($refme));
		        
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