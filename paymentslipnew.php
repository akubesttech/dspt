  <?php
include("header1.php");
//include("dbconnection.php")
include('Student/session.php'); 
 $existl = imgExists("admin/".$row['Logo']);
$sql_tranid = "SELECT * FROM payment_tb WHERE md5(trans_id) ='".safee($condb,$_GET['p_id'])."'";
$sql_tranid1=mysqli_query($condb,$sql_tranid);
$rsprint = mysqli_fetch_array($sql_tranid1);
$applcation_id = $rsprint['app_no'];
$student_reg = $rsprint['stud_reg'];

 $sql = "SELECT * FROM payment_tb,new_apply1 WHERE app_no ='$applcation_id' OR stud_reg ='$student_reg'";
 $qsql1=mysqli_query($condb,$sql);
$rsprint1 = mysqli_fetch_array($qsql1);
?>

<body style="background-color: rgb(59, 59, 59); padding: 5px; height: 700px;">
  <div class="row-fluid">
                        <!-- block -->
 <div class="block1">
 <div class="navbar navbar-inner block-header">
<div class="muted pull-center"><i class="icon-plus-sign2 icon-large" >	
                    <img src=" <?php 
					if ($existl > 0 ){ echo "admin/".$row['Logo'];
	}else{ echo "css/images/logo.png";} 
	//if ($row['Logo']==NULL or $row['Logo']=='uploads/' ){echo "css/images/logo.png";}else{echo "admin/".$row['Logo'];} ?>  " class="muted pull-left" style=" width:90px; height:60;"> <span style="color: #000080; font-size:26px;  font-family:vandana;text-shadow: 1px 1px gray; "><br><?php echo strtoupper($row['SchoolName']);  ?></span> </i></div>
</div>
<div class="block-content2 collapse in">
                                <div class="span121">
								
								 <!--------------------form------------------->
								<form method="post" enctype="multipart/form-data">
					<div class="control-group">
                             <div class="controls">
                             
                                <table  align="center" style="margin:5px; font-size:15px;  font-weight:bold; width:750px;" border="0">
    
	<tr style="background-color:#FFC">
            <td height="30" colspan="2"> <div class="rounded">
    <main class="container clear"> 
      <!-- main body --> 
      <!-- ################################################################################################ -->
     <center><font size="+2">STUDENT PAYMENT RECEIPT</font></center>
     <p></p>
      <p>Payment Discription: <?php echo $rsprint1['fee_type']; ?></p>
      <?php if($session_id > 0){?>
      <p>Student Registration Number  <font color="green"> <?php echo ucfirst($rsprint1['stud_reg']);  ?></font> .</p>
      <?php }else{?>
     <p>Your can Reprint this Payment Slip with This   <font color="red"> <?php echo ucfirst($rsprint1['app_no']);  ?></font> Application  Number.</p> <?php }?>
      <p>You will be required to present this receipt on the Day of Examination .</p>
      <!-- ################################################################################################ --> 
      <!-- / main body -->
      <div class="clear"><hr></div>
    </main>
  </div></td>
     
          </tr>

<tr >
            <td height="32" colspan="2"> <div class="rounded" align="center">
   <img id="admin_avatar" class="img-circle" src="Student/<?php 
  // $sql = "SELECT * FROM new_apply1 left join olevel_tb ON olevel_tb.oPin = new_apply1.Pin WHERE md5(new_apply1.appNo)='$_GET[applyid]' or md5(new_apply1.JambNo)='$_GET[applyid]'";
   $sql = "SELECT * FROM payment_tb,new_apply1 WHERE app_no ='$applcation_id' or stud_reg ='$student_reg'";
   
if(!$qsql=mysqli_query($condb,$sql))
{
	echo mysqli_error($condb);
}
$rsprint = mysqli_fetch_array($qsql);
		$existn = imgExists("Student/".$rsprint['images']);	
		 if ($existn > 0 ){ echo "Student/".$rsprint['images'];
	}else{ echo "Student/uploads/NO-IMAGE-AVAILABLE.jpg";}	  
	//if ($rsprint['images']==NULL ){print "Student/uploads/NO-IMAGE-AVAILABLE.jpg";}else{print $rsprint['images'];}
				  
				  
				 // echo $row['adminthumbnails']; ?>">
  </div></td>
     
          </tr>

<tr >
            <td height="32" colspan="2"> <div class="rounded" align="center"><br><br>
  Transaction ID:<?php echo  $rsprint['trans_id']; ?>
  </div></td>
     
          </tr>
<div class="rounded">
        <table style="margin:5px; font-size:15px; font-family: Verdana;  font-weight:bold; width:900px;">
        <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
            <td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Student details:</strong></td>
          </tr>
          <tr >
            <td width="27%" height="40">Surname:</td>
            <td width="24%" id="firstname" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['FirstName']); ?></td>
            <td width="26%">Middle Name:</td>
            <td width="23%" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['SecondName']); ?></td>
          </tr>
          <tr>
            <td height="43">Other Name:</td>
            <td style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['Othername']); ?></td>
           <td height="30"><strong>Student Gender:</strong></td>
            <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['Gender']; ?></td>
          </tr>
         
          <tr>
            <td height="43">Mobile Number:</td>
            <td style="font-color:gray;  font-weight:normal;">
               <?php echo  $rsprint['phone']; ?>
             </td>
            <td height="43">Email Address:</td>
            <td style="font-color:gray;  font-weight:normal;">
               <?php echo  $rsprint['e_address']; ?>
             </td>
          </tr>
           <tr>
            <td height="43">Faculty:</td>
            <td style="font-color:gray;  font-weight:normal;">
               <?php if($rsprint['course_choice'] == '1'){
	echo getfacultyc($rsprint['fact_1']);
	}elseif($rsprint['course_choice'] == '2'){
echo getfacultyc($rsprint['fact_2']);
} ?>
             </td>
            <td height="43">Department:</td>
            <td style="font-color:gray;  font-weight:normal;">
               <?php 	if($rsprint['course_choice'] == '1'){
	echo $rsprint['first_Choice'];
	}elseif($rsprint['course_choice'] == '2'){
echo $rsprint['Second_Choice'];
} ?>
             </td>
          </tr>
          <tr>
            <td height="43">Level:</td>
            <td style="font-color:gray;  font-weight:normal;">
               <?php echo  $rsprint['level']; ?>
             </td>
            <td height="43">Academic Session:</td>
            <td style="font-color:gray;  font-weight:normal;">
                      <?php echo  $rsprint['session']; ?>
             </td>
          </tr>
          
        
          
        </table>
       <table border="1" style="margin:5px; font-size:15px;  font-weight:bold; width:900px;" >
        <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Payment Details:</strong></td>
        </tr>
        <?php //echo  getadminstatusc($rsprint['adminstatus']); ?>
        <?php 
   $sql2 = "SELECT * FROM payment_tb,new_apply1 WHERE app_no ='$applcation_id' or stud_reg ='$student_reg'";
$qsql2=mysqli_query($condb,$sql2);
if(mysqli_num_rows($qsql2)==0){
        echo " <tr style=\"background-color:#CFF\">
          <td height=\"30\">No payment Found For This Session</td>
        
        
        </tr>";
    }else{
      $rsprint21 = mysqli_fetch_array($qsql2);
				  
				 // echo $row['adminthumbnails']; ?>
        <tr  align="center" >
          <td height="30" width="200">Payment Mode:</td>
          <td id="contact Address" style="font-color:gray;  font-weight:normal;" > <?php echo  $rsprint21['pay_mode']; ?></td>
          <td>Bank:</td>
          <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint21['bank_name']; ?></td>
        </tr>
     
     <tr align="center" >
          <td height="30" width="200">Teller Number:</td>
          <td style="font-color:gray;  font-weight:normal;" >
            <?php echo  $rsprint21['teller_no']; ?>
          </td>
          <td>Pin:</td>
          <td style="font-color:gray;  font-weight:normal;"><?php echo  hide_phone($rsprint21['pin']); ?></td>
        </tr>
        
        <tr align="center" >
          <td height="30" width="200">Amount:</td>
          <td style="font-color:gray;  font-weight:normal;">
            <?php echo  $rsprint21['paid_amount']; ?>
          </td>
          <td>Date Of Payment:</td>
          <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint21['pay_date']; ?></td>
        </tr>
		<!--
		<tr height="36">
          <td></td> <td></td> <td></td> <td></td>
          </tr> --!>
		  <tr align="center" >
         <td>Amount in words:</td>
          <td style="font-color:gray;  font-weight:normal;"><?php echo  numtowords($rsprint21['paid_amount'])." Naira Only."; ?></td>
          <td height="30" width="300">Payment Status:</td>
          <td style="font-color:gray;  font-weight:normal;">
            <?php echo  getadminstatusc($rsprint21['pay_status']); ?>
         </td>
        </tr>
       
    </table>
       <table>
 <tr>
         <td colspan="4">&nbsp;</td>
       </tr>
       <tr>
         <td colspan="4"><span class="style5">The student has satisfied the School   requirement, I recomend that the payment of fees of the above  session be approved</span></td>
       </tr>
        <tr>
         <td colspan="4">&nbsp;</td>
       </tr>
       <tr>
         <td colspan="2">________________________________________</td>
         <td colspan="3"> ____________________________________ </td>
       </tr>
       <tr>
         <td colspan="2"><strong>STUDENT SIGNATURE AND DATE </strong></td>
         <td colspan="3"><strong>BUSARY SIGNATURE AND DATE</strong> </td>
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
     
      <?php }?>
</table>
      </div>
<?php
//course_choice

//


function numtowords($num){
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
$rettxt.=$ones[$i];
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
 <button data-placement="right" title="Click Here To Exit Payment Receipt" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='index.php';" type="reset"><i class="icon-signin icon-large"></i> Go Back </button>
<?php } ?>
  <button data-placement="right" title="Click to Print Payment Receipt" id="reset" name="B2" class="btn btn-info" onClick="myFunction()" type="reset"><i class="icon-file icon-large"></i> Print Receipt</button>

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
                      