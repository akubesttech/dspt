  <?php
include("header1.php");
//include("dbconnection.php")
include("admin/qrcode.php");
$showf = showfullresult;
$qr = new qrcode();
$session_id = 0;
$sql_tranid = "SELECT * FROM payment_tb WHERE md5(trans_id) ='".safee($condb,$_GET['p_id'])."'";
$sql_tranid1=mysqli_query($condb,$sql_tranid);
$dform_checkexist20 = mysqli_num_rows($sql_tranid1);
$rsprint = mysqli_fetch_array($sql_tranid1);
$applcation_id = $rsprint['app_no'];
$student_reg = $rsprint['stud_reg']; $tranD = MD5($rsprint['trans_id']);  $smato = $row['smat'];  $student_email = $rsprint['email'];
 if(empty($student_reg)){  $mat2 = $applcation_id;
    $student_level = $rsprint['level']; $student_prog = $rsprint['prog']; $idtype = "Application Number "; }else{
        include('Student/session.php');   if(!empty($smato)){ $idtype = "Username "; $mat2 = $student_reg;  }else{
        $idtype = "Matric Number "; $mat2 = $student_reg; }}
  $existl = imgExists("admin/".$row['Logo']);
if($dform_checkexist20 < 1){ //message("The page you are trying to access is not Available.", "error");
echo "<script>alert('The page you are trying to access is not Available!');</script>";
unset($_SESSION['student_id']);
redirect('Userlogin.php'); }

 if(empty($student_reg)){ 
$sql2 = "SELECT * FROM new_apply1 left join payment_tb ON payment_tb.app_no = new_apply1.appNo WHERE  appNo ='".safee($condb,$applcation_id)."' and md5(trans_id) ='".safee($condb,$_GET['p_id'])."' ";
}else{ $sql2 = "SELECT * FROM student_tb left join payment_tb ON payment_tb.stud_reg = student_tb.RegNo WHERE  stud_reg ='".safee($condb,$student_reg)."' and md5(trans_id) ='".safee($condb,$_GET['p_id'])."' ";}
//$qsql1=mysqli_query($condb,$sql2);$rsprint1 = mysqli_fetch_array($qsql1);
if(!$qsql1=mysqli_query($condb,$sql2)) { echo mysqli_error($condb); } $rsprint1 = mysqli_fetch_array($qsql1);  $feecategory = $rsprint1['ft_cat'];
$cchoicen = isset($rsprint1['course_choice']) ? $rsprint1['course_choice'] : '';
 $lev =$rsprint1['level'];  $pro =$rsprint1['prog'];  $scan =$rsprint1['stud_cat']; $sec =$rsprint1['session'];
$getdueamt = getDueamt($feecategory,$pro,$lev,$scan);
echo $currentbal = getpayamt($mat2,$feecategory,$pro,$lev,$sec);
$linkno = host()."paymentslip.php?p_id=".$_GET['p_id'];
$qr->text($linkno);
?>
<style>#imgn::before {
  content: "";
position: absolute;
  content: url("<?php if ($existl > 0 ){ echo "admin/".$row['Logo'];
	}else{ echo "css/images/logo.png";} ?>");
  width: 100%;
  height: 100%;
  background-image: url('<?php if ($existl > 0 ){ echo "admin/".$row['Logo'];
	}else{ echo "css/images/logo.png";} ?>');
  background-repeat:no-repeat;
  background-size: 450px 440px;
  opacity: 0.5;
z-index: -9;
  background-position: center;

  text-align:center;} 
  /* background-color: transparent; #EFEFEF   #DEDEDE; */
.row1 {background-color: transparent;border: 1px solid #98C1D1;
		height: 30px;	font-family:Verdana, Geneva, sans-serif; font-size:12px; }
.row2 {background-color: transparent;border: 1px solid #98C1D1;height: 30px; font-family:Verdana, Geneva, sans-serif; 
	font-size:12px; }
	@page { size: A4 landscape }
    
</style>
<?php  //$sql3 = "SELECT * FROM student_tb left join payment_tb ON payment_tb.stud_reg = student_tb.RegNo WHERE  stud_reg ='".safee($condb,$student_reg)."' and md5(trans_id) ='".safee($condb,$_GET['p_id'])."' "; 
//if(!$qsql=mysqli_query($condb,$sql3)) { echo mysqli_error($condb); } $rsprint = mysqli_fetch_array($qsql);$feecategory = $rsprint1['ft_cat']; ?>
<body style="background-color: rgb(59, 59, 59); padding: 4px; height: 800px;">
  <div class="row-fluid" >
                        <!-- block -->
 <div class="block1"  >
 <div class="navbar navbar-inner block-header">
<div class="muted pull-center"><i class="icon-plus-sign2 icon-large" >	
                    <img src=" <?php 
					if ($existl > 0 ){ echo "admin/".$row['Logo'];
	}else{ echo "css/images/logo.png";}
	// if ($row['Logo']==NULL or $row['Logo']=='uploads/' ){echo "css/images/logo.png";}else{echo "admin/".$row['Logo'];} ?>  " class="muted pull-left" style=" width:90px; height:60;"> <span style="color: #000080; font-size:26px;  font-family:vandana;text-shadow: 1px 1px gray; "><br><?php echo strtoupper($row['SchoolName']);  ?></span> </i></div>
</div>
<div class="block-content2 collapse in"  >

                             <div class="span121" style="background-image: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.7)), url('<?php if ($existl > 0 ){ echo "admin/".$row['Logo'];
	}else{ echo "css/images/logo.png";} ?>'); background-repeat: no-repeat;background-position: center;  background-size: 550px 500px;display: block; -webkit-print-color-adjust: exact; "  >
								<div class="span121"  >
								 <!--------------------form------------------->
								<form method="post" enctype="multipart/form-data">
					<div class="control-group">
                             <div class="controls">
                             
                                <table  align="center" style="margin:5px; font-size:15px;  font-weight:bold; width:900px;" border="0">
    
	<tr style="background-color:#FFC;">
            <td height="25" colspan="4">
             
    
      <!-- main body -->  <?php $ptitle = "STUDENT ".getfeecat($feecategory)." RECEIPT"; $ptitle2 = "STUDENT ".getftype($rsprint1['fee_type'])." RECEIPT"; ?>
      <!-- ################################################################################################ -->
<center><font size="+2" style="color: #000088;"> <?php if(substr($rsprint1['fee_type'],0,1) == "B"){echo strtoupper($ptitle); }else{  echo strtoupper($ptitle2); } ?> </font></center>
     <center><font size="+1" ><?php echo  $rsprint['session']." Academic Sesssion";  ?></font></center>
     <p></p>
<p><font size="+2" ><?php if($cchoicen == '1'){ $facnew =  getfacultyc($rsprint1['fact_1']); $depnew = $rsprint1['first_Choice'];
}elseif($cchoicen == '2'){ $facnew =  getfacultyc($rsprint1['fact_2']); $depnew = $rsprint1['Second_Choice'];} ?></font></p>
      
      <?php if($session_id > 0){if(!empty($smato)){ $regno = $student_email; }else{$regno = $rsprint1['stud_reg'];}}else{ $regno = $rsprint1['app_no']; }?>
     
      <!-- ################################################################################################ --> 
      <!-- / main body -->
      
    
  </td>
     
          </tr>
          
          <tr ><td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;width: 355px;text-align: justify;" colspan="1" height="30">
<p><?php echo $idtype; ?> : <?php echo $regno ?></p>
<p><?php echo $SCategory; ?> : <?php  if(empty($student_reg)){ echo $facnew; }else{ echo getfacultyc($rsprint1['Faculty']) ;} ?></p>
<p><?php echo $SGdept1; ?>: <?php  if(empty($student_reg)){ echo getdeptc($depnew);  }else{ echo getdeptc($rsprint1['Department']);}?></p>
<p>Level: <?php echo getlevel($student_level,$student_prog); ?></p><?php if(!empty($student_reg)){  ?>
<p style="color: red;">You will be required to present this receipt on the Day of Examination <font color="red"> <?php //echo ucfirst($rsprint1['appNo']);  ?></font>.
</p> <?php }else{ ?>
<p style="color: black;">Your can Reprint this Payment Receipt with This   <font color="red"> <?php echo ucfirst($regno);  ?></font> Application  Number. 
</p><?php } ?>
</td>
            <td height="30" colspan="1" style="text-align: center;width: 190px;">
   <img  src="<?php $existn = imgExists("Student/".$rsprint1['images']);
		  		  if ($existn > 0 ){ echo "Student/".$rsprint1['images']; }else{ echo "Student/uploads/NO-IMAGE-AVAILABLE.jpg";}
	 ?>" width="140" height="120" style=" border-radius: 50%;" >
  </td><td height="30"  colspan="1" style="text-align: center;font-family:Verdana, Geneva, sans-serif;355px;">
  <?php echo strtoupper(getprog($student_prog)); ?>
  <p><img src="<?php echo $qr->get_link(); ?>" width="130" height="130" style="margin-bottom: 2px;" border='0'/> </p>
  </td>
     
          </tr>

<tr style="display: none;" ><td style="position: absolute;font-size:13px;font-family:Verdana, Geneva, sans-serif;" colspan="1" height="32">
<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $idtype." ". $regno; ?><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $SCategory; ?> :   <?php  if(empty($student_reg)){ echo $facnew; }else{ echo getfacultyc($rsprint1['Faculty']) ;} ?><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $SGdept1; ?>:&nbsp;<?php  if(empty($student_reg)){ echo getdeptc($depnew);  }else{ echo getdeptc($rsprint1['Department']);}?><br><br>&nbsp;&nbsp;&nbsp;&nbsp;
Level: <?php echo getlevel($student_level,$student_prog); ?></td>
            <td height="32" colspan="1"> <div class="rounded" align="center">
   <img id="admin_avatar" class="img-circle" src="<?php $existn = imgExists("Student/".$rsprint1['images']);
		  		  if ($existn > 0 ){ echo "Student/".$rsprint1['images']; }else{ echo "Student/uploads/NO-IMAGE-AVAILABLE.jpg";}
	 ?>" width="200" height="130" style=" border-radius: 50%;" >
  </div></td> <td style="margin-left: 30px;" colspan="1"></td>
     
          </tr>
          
          

<tr ><td height="25" colspan="4" style="font-size:22px;font-weight: bold;color: blue; font-family:vandana;text-shadow: 1px 1px gray;"> <div class="rounded" align="center">
 <div style="font-size:18px; color:black;"> Transaction Reference:<?php echo  " ".$rsprint1['trans_id']; ?></div>
  <?php if(empty($student_reg)){ echo strtoupper($rsprint1['FirstName']." ".$rsprint1['SecondName']." ".$rsprint1['Othername']); }else{ echo strtoupper(getname($rsprint1['stud_reg']));} ?>
  </div></td> <td style="margin-left: 30px;" colspan="1"></td>
     
          </tr>
          
          
<div class="rounded">
        <table style="margin:5px; font-size:15px; font-family: Verdana;  font-weight:bold; width:900px;">
      <!--  <tr ><td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Student details:</strong> <hr style="border-top: 1px solid black; background: transparent;"></td>
</tr>
          <tr >
            <td width="27%" height="40">Surname:</td>
            <td width="24%" id="firstname" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint1['FirstName']); ?></td>
            <td width="26%">Middle Name:</td>
            <td width="23%" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint1['SecondName']); ?></td>
          </tr>
          <tr>
            <td height="43">Other Name:</td>
            <td style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint1['Othername']); ?></td>
           <td height="30"><strong>Student Gender:</strong></td>
            <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint1['Gender']; ?></td>
          </tr>
         
          <tr>
            <td height="43">Mobile Number:</td>
            <td style="font-color:gray;  font-weight:normal;">
               <?php echo  $rsprint1['phone']; ?>
             </td>
            <td height="43">Email Address:</td>
            <td style="font-color:gray;  font-weight:normal;">
               <?php echo  $rsprint1['e_address']; ?>
             </td>
          </tr>
           <tr>
            <td height="43"><?php echo $SCategory; ?>:</td>
            <td style="font-color:gray;  font-weight:normal;">
               <?php 
	echo getfacultyc($rsprint1['Faculty']);

 ?>
             </td>
            <td height="43"><?php echo $SGdept1; ?>:</td>
            <td style="font-color:gray;  font-weight:normal;">
               <?php 
	echo getdeptc($rsprint1['Department']);

 ?>
             </td>
          </tr>
          <tr>
            <td height="43">Level:</td>
            <td style="font-color:gray;  font-weight:normal;">
               <?php echo  getlevel($rsprint1['level'],$student_prog); ?>
             </td>
            <td height="43">Academic Session:</td>
            <td style="font-color:gray;  font-weight:normal;">
                      <?php echo  $rsprint1['session']; ?>
             </td>
          </tr> --!>
          <tr style="border-width: 0;">
          <td height="25" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Payment Details:</strong><hr style="border-top: 1px solid black; background: transparent;"></td></tr>
  </table>
       <table  border ="1" style="margin:5px; font-size:15px;  font-weight:bold; width:900px;" > <!-- style="background-color:lightblue;box-shadow: 2px 2px gray;" --!><thead> 
                        <tr height="30" width="200" style="background-color:lightblue;box-shadow: 2px 2px gray;color: #000080;">
                         <th>S/N</th><th>Item</th>
                         <th> Description</th>
                          <th>Amount Paid</th>
                         </tr>
                      </thead>
        <?php //echo  getadminstatusc($rsprint['adminstatus']); ?>
        <?php 
      $serial=1; 
if(mysqli_num_rows($qsql1)==0){
        echo " <tr style=\"background-color:#CFF\">
          <td height=\"30\">No payment Found For This Session</td>
        </tr>"; }else{ //$rsprint1 = mysqli_fetch_array($qsql1);
		 $feetp = $rsprint1['fee_type']; $transession = $rsprint1['session']; $fcate = $rsprint1['ft_cat'];  ?>
     <?php if(substr($feetp,0,1) == "B"){ if($showf =="yes"){
   $paycomponent=mysqli_query($condb,"SELECT * FROM feecomp_tb  WHERE Batchno ='".safee($condb,$feetp)."' and pstatus = '1' "); }else{
   $paycomponent=mysqli_query($condb,"SELECT * FROM payment_tb WHERE md5(trans_id) ='".safee($condb,$_GET['p_id'])."' and pay_status = '1' "); }
$serial=1;	$i = 0;	 
while($row_utme = mysqli_fetch_array($paycomponent)){ 
    if ($i%2) {$classo1 = 'row1';} else {$classo1 = 'row2';}$i += 1;
    	 $feetype = $row_utme['fee_type']; $transession = $row_utme['session']; $fcate = $row_utme['ft_cat']; $amountn = $row_utme['paid_amount']; 
    if(substr($feetype,0,1) == "B"){ $feet = getfeecat($fcate);}else{ $feet = getftype($feetype);}
//$ftypecon = $row_utme['feetype']; $amount = $row_utme['f_amount'];
//$paysession = $row_utme['session']; $feecategory = $row_utme['fcat']; $penalty = $row_utme['penalty']; if($penalty > 0){ $pens = " ( penalty inclusive).";}else{ $pens ="";} ?>
 <!-- <tr  class="<?php echo $classo1; ?>" align="center" height="30" width="30" > <td><?php //echo $serial++; ?></td>
                      <td><?php echo getftype($ftypecon) ;?></td>
                        <td><?php echo "Payment Of " .getftype($ftypecon)." For ".$transession ;?></td>
                          <td><?php echo number_format($amount,2); ?></td>   </tr> --!>
                          
                      <tr  class="<?php echo $classo1; ?>" align="center" height="30" width="30" > <td><?php echo $serial++; ?></td>
                      <td><?php echo $feet ;?></td>
                        <td><?php echo "Payment Of " .$feet." For ".$transession ;?></td>
                          <td><?php echo number_format($amountn,2); ?></td>   </tr>    
    <?php	} 
    
         }else{  ?> 
	<tr  align="center" height="30" width="30" class="row1" > <td><?php echo $serial++; ?></td>
                      <td><?php echo getftype($feetp) ;?></td>
                        <td><?php echo "Payment Of " .getftype($feetp)." For ".$transession ;?></td>
                          <td><?php echo number_format($rsprint1['paid_amount'],2); ?></td>   </tr> <?php }} ?>
   <tr ><td colspan="4" height="30">&nbsp;</td></tr>
<tfoot><?php if($currentbal > $getdueamt){ $bal = "0.00";}else{ $bal = $getdueamt - $currentbal; } ?>
    <tr class="row2" height="30"><td colspan="2"></td> <td colspan="1" align='right'><strong>Total Scheduled Payment</strong></td>
<td align='center' ><strong><font color="black">&#8358;<?php echo number_format($getdueamt,2); ?></font></strong></td></tr>
<tr class="row2" height="30"><td colspan="2"></td> <td colspan="1" align='right'><strong>Total Amount Paid</strong></td>
<td align='center' ><strong><font color="green">&#8358;<?php echo number_format($rsprint1['paid_amount'],2); ?></font></strong></td></tr>
<tr class="row2" height="30" style="display: none;"><td colspan="2"></td> <td colspan="1" align='right'><strong>Total Balance</strong></td>
<td align='center' ><strong><font color="black">&#8358;<?php echo number_format($bal,2); ?></font></strong></td></tr>

<tr class="row1"><td colspan="4"height="30" align='center' style="font-color:gray; font-weight:normal;"><strong>
<?php echo numtowords($rsprint1['paid_amount'])." Naira Only. "; ?></strong></td></tr>
 </tfoot> 
 <?php  $date20 = str_replace('/', '-', $rsprint1['pay_date'] );  $newDate20 = date("Y-m-d", strtotime($date20));
   $timestamp = strtotime($newDate20); $datetime	= date('l, jS F Y', $timestamp);?>
    </table> <?php if($rsprint1['pay_mode'] == "Online"){  }else{?>
	<table border ="1" style="margin:5px; font-size:15px;  font-weight:bold; width:900px;">
<tr class="row2" height="30" >
 <td colspan="1"><strong>Bank: </strong></td>
<td colspan="1"><strong><?php if($rsprint1['pay_mode'] == "Online"){ echo "----------"; }else{ echo  $rsprint1['bank_name']; }  ?></strong></td>
     <td colspan="1"><strong>Teller No:</strong></td>
<td colspan="1"><strong><?php if($rsprint1['pay_mode'] == "Online"){ echo "----------"; }else{ echo  $rsprint1['teller_no']; }  ?></strong></td>
      <td colspan="1"><strong>PIN:</strong></td>
<td ><strong><font color="green"><?php echo  hide_phone($rsprint1['pin']); ?>&nbsp;</font></strong></td>
    </tr> </table><?php } ?>
    
	<table>
<tr class="text-offset" height="35" style="text-align:right;" bgcolor="white" >
 <td colspan="1"><strong>&nbsp;Payment Mode:&nbsp; </strong></td>
     <td colspan="1"><strong><?php echo  $rsprint1['pay_mode']; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td colspan="1"><strong>Payment Date:&nbsp; </strong></td>
     <td colspan="1"><strong><?php echo $datetime ; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td colspan="1"><strong>Payment Status:&nbsp; </strong></td>
<td ><strong><font color="green"> <?php echo  getpaystatus($rsprint1['pay_status']); ?>&nbsp;</font></strong></td>
    </tr> </table>
    
    <table><!-- <tr style="border-style:hidden;"><td colspan="4">&nbsp;</td></tr>--!><?php if($rsprint1['pay_mode'] !== "Online"){ ?>
       <tr><td colspan="4"><span class="style5">The student has satisfied the School   requirement, I recomend that the payment of fees of the above  session be approved</span></td></tr> <?php } ?>
       <!-- <tr>
         <td colspan="4">&nbsp;</td>
       </tr>--!>
       <tr>
         <td colspan="4">&nbsp;</td>
       </tr><tr>
         <td colspan="4">&nbsp;</td>
       </tr><tr>
         <td colspan="4">&nbsp;</td>
       </tr>
       <tr>
         <td colspan="2">________________________________________&nbsp;&nbsp;&nbsp;&nbsp;</td>
         <td colspan="2"> ____________________________________ </td>
       </tr>
       <tr>
         <td colspan="2"><strong>STUDENT SIGNATURE AND DATE &nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
         <td colspan="2"><strong>BURSARY SIGNATURE AND DATE</strong> </td>
       </tr>
      
       <tr>
         <td colspan="4">&nbsp;</td>
       </tr>
       <!--
       <tr>
         <td colspan="4">_______________________________________&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;             _________________________________________</td>
       </tr>
       <tr>
         <td colspan="2"><strong>FORM TEACHER SIGNATURE </strong></td>
         <td colspan="4"><strong>DATE</strong></td>
       </tr>--!>
       <tr>
         <td colspan="4"><strong><font color="red">Note : This payment Receipt is void if not signed and Stamped.</font> </strong></td>
       </tr>
     
      
</table>
      </div>
<?php
//course_choice

//
/* function getfaculty2($get_fac2)
{$query2 = @mysqli_query($condb,"select fac_name from faculty where fac_id = '$get_fac2' ")or die(mysqli_error($condb));
$count = mysqli_fetch_array($query2);
 $nameclass2=$count['fac_name'];
return $nameclass2;
} */

function numtowordsold($num){
$ones=array(
1=>"One ",
2=>"Two ",3=>"Three ",4=>"Four ",5=>"Five ",6=>"Six ",7=>"Seven ",8=>"Eight ",9=>"Nine ",10=>"Ten ",
11=>"Eleven ",12=>"Twelve ",13=>"Thirteen ",14=>"Fourteen ",15=>"Fifteen ",16=>"Sixteen ",17=>"Seventeen ",
18=>"Eighteen ",19=>"Nineteen ");
$tens=array(
2=>"Twenty ",3=>"Thirty ",4=>"Forty ",5=>"Fifty ",6=>"Sixty ",7=>"Seventy ",8=>"Eighty ",9=>"Ninety "
);
$hundreds=array(
"Hundred ","Thousand ","Million ","Billion ","Trillion ","Quadrillion"
);
$num=number_format($num,2,".",",");
$num_arr=explode(".",$num);
$wholenum=$num_arr[0];
$decnum=$num_arr[1];
$whole_arr=array_reverse(explode(",",$wholenum));
krsort($whole_arr);
$rettxt="";
foreach($whole_arr as $key=>$i){
if($i<20){
$rettxt.= $ones[substr($i,2,1)];//$ones[$i];
}elseif($i<100){
$rettxt.=$tens[substr($i,0,1)];
$rettxt.="".$ones[substr($i,1,1)];
}else{
$rettxt.=$ones[substr($i,0,1)]."".$hundreds[0];
$rettxt.="".$tens[substr($i,1,1)];
$rettxt.="".$ones[substr($i,2,1)];
}
if($key>0){
$rettxt.="".$hundreds[$key].",";
}}
if($decnum>0){
$rettxt.=" and ";
if($decnum<20){
$rettxt.=$ones[$decnum];
}elseif($decnum<100){
$rettxt.=$tens[substr($decnum,0,1)];
$rettxt.="".$ones[substr($decnum,1,1)];
}
}
return $rettxt;
}

function hide_phone($phone) {
    //return substr($phone, 0, -4) . "**";
    //return substr($phone, 1, 2) . "**";
    return substr_replace($phone, str_repeat("*", 2), 1, 2);
}



//substr("9876543210", 6, 4);
//$var = '1234123412341234';
//$var = substr_replace($var, str_repeat("*", 8), 4, 8);
//echo $var;
/*public function maskCreditCardNumber($cc, $maskFrom = 0, $maskTo = 4, $maskChar = 'X', $maskSpacer = '-')
{
    // Clean out
    $cc       = str_replace(array('-', ' '), '', $cc);
    $ccLength = strlen($cc);

    // Mask CC number
    $cc = substr($cc, 0, $maskFrom) . str_repeat($maskChar, strlen($cc) - $maskFrom - $maskTo) . substr($cc, -1 * $maskTo);

    // Format
    $newCreditCard = substr($cc, -4);
    for ($i = $ccLength - 5; $i >= 0; $i--) {
        // If on the fourth character add the mask char
        if ((($i + 1) - $ccLength) % 4 == 0) {
            $newCreditCard = $maskSpacer . $newCreditCard;
        }

        // Add the current character to the new credit card
        $newCreditCard = $cc[$i] . $newCreditCard;
    }

    return $newCreditCard;
} 
function get_starred($str) {
    $len = strlen($str);

    return substr($str, 0, 1).str_repeat('*', $len - 2).substr($str, $len - 1, 1);
}


$myStr = 'YourName';
echo get_starred($myStr);
*/
?>
<br>
<tr><td colspan="2" align="left" height="40">
<?php  if($session_id > 0){?>
   <button data-placement="right" title="Click Here To Exit Payment Receipt" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='Student/Spay_manage.php';" type="reset"><i class="icon-signin icon-large"></i> Go Back </button>
<?php }else{ ?>
 <button data-placement="right" title="Click Here To Exit Payment Receipt" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='<?php echo host(); ?>';" type="reset"><i class="icon-signin icon-large"></i> Go Back </button>
<?php } ?>
  <button data-placement="right" title="Click to Print Payment Receipt" id="reset" name="B2" class="btn btn-info" onClick="myFunction()" type="reset"><i class="icon-file icon-large"></i> Print Receipt</button>
  <button data-placement="right" title="Click to Download Payment Receipt" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='paypdf.php?tid=<?php echo $tranD; ?>';" type="reset"><i class="icon-download icon-large"></i> Download in PDF</button>

												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#reset').tooltip('show');
	                                            $('#reset').tooltip('hide');
	                                            });
	                                            </script>
	                                          

<script>
function myFunction() {
    window.print();
}
</script>
</td></tr>

</table>
                                
                                 </div>
                                 
                                 
                                  </div>
										
						
										<div class="control-group">
                                          <div class="controls">

                                          </div>
                                        </div>
                                </form>
								
								</div>
								
								
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                    </body>
                      </center>
                      