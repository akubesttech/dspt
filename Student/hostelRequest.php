<script type="text/javascript">   
$(document).ready(function() {   
$('#paytype').change(function(){   
if($('#paytype').val() === 'Paycard')   
   {   
    $('#pin1').show(); $('#pin2').show();    $('#pin3').show(); $('#pin4').show();$('#pin5').show(); $('#pin6').show();
   }   
else 
   {   
   $('#pin1').hide();    $('#pin2').hide();    $('#pin3').hide();  $('#pin4').hide();  $('#pin5').hide(); $('#pin6').hide();  
   }   
});   
});
   $( "#ed" ).datepicker({
    dateFormat: "yy-mm-dd"
    });   
</script>
<?php 
	function createRandomPassword2() {
$chars = "abcdefghijkmnopqrstuvwxyz023456789";
srand((double)microtime()*1000000);$i = 0;$pass = '' ;while ($i <= 7) {
$num = rand() % 33;$tmp = substr($chars, $num, 1);$pass = $pass . $tmp;$i++;}
return $pass;}

function createRandomPassword($qtd){
//Under the string $Caracteres you write all the characters you want to be used to randomly generate the code.
    $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
    $QuantidadeCaracteres = strlen($Caracteres);
    $QuantidadeCaracteres--;

    $Hash=NULL;

    for($x=1;$x<=$qtd;$x++){
        $Posicao = rand(0,$QuantidadeCaracteres);
        $Hash .= substr($Caracteres,$Posicao,1);
    }

    return $Hash;
}
$viewfee_query1 = mysqli_query($condb,"select * from fee_db where md5(fee_id)='".safee($condb,$_GET['id'])."'")or die(mysqli_error($condb));
$cfeecheck = mysqli_num_rows($viewfee_query1);
$row_fee = mysqli_fetch_array($viewfee_query1); $Fee_amount = $row_fee['f_amount']; $Fee_type = $row_fee['feetype'];
$Fee_level = $row_fee['level'];
$pemail1 = getsemail($student_RegNo);

//if($cfeecheck < 1){ message("The page you are trying to access is not Available.", "error");

//redirect('Spay_manage.php?view=a_p'); }

if(isset($_POST['addpayment'])){
 $Session_checker1 = $_POST["session"];
$level = $_POST["level"];
$paytype = $_POST['paytype'];

$hostelname = $_POST["hname"];
$roomnumber = $_POST["roomno"];
$amtMonth = $_POST["amt"];
$duration = $_POST["duration"];
$startdaten = $_POST["cdate"];
$total = $amtMonth * $duration;
$transid = createRandomPassword(10);
$roomftype = getroomftype($roomnumber);
//$num = "+".$duration." months";
//$date = strtotime($startdate2);
 //echo $actuald = date("Y/m/d",$date)." ".$num;
//echo $startdate = date("d/m/Y", strtotime($num, $date));
 //$startdate = date("d/m/Y", strtotime($actuald));
//for production enable
//$startdate2= DateTime::createFromFormat('d/m/Y', $startdaten)->format('Y-m-d');
//$startdate = endCycle($startdate2, $duration);


if($student_state == "Delta"){
$stud_from = "1" ;
}else{
$stud_from = "0" ;
}

$paystatus1=mysqli_query($condb,"SELECT * FROM hostelallot_tb WHERE studentreg ='".safee($condb,$student_RegNo)."'  AND validity = '1' AND paystatus = '1'");
$paystatus12=mysqli_num_rows($paystatus1);
$paystatuspin=mysqli_query($condb,"SELECT * FROM hostelallot_tb WHERE  studentreg ='".safee($condb,$student_RegNo)."' AND validity = '0'");
$paystatus13 =mysqli_num_rows($paystatuspin);

//if(strpos($nappNo21," ")){ $res="<font color='Red'><strong>Please! Application Id can not Contain a Space..</strong></font><br>";
//$resi=1;
if($paystatus12 > 0 ){ 
message("Your Hostel Room Allocation Has Been Verified.", "success");
redirect('shostel_manage.php?view=H_info');
//$res="<font color='Red'><strong>You Have Paid ".getftype($Fee_type)." For $Session_checker1 Session.</strong></font><br>"; $resi=1;
}else{

//$paystatus12=mysqli_query($condb,"SELECT * FROM payment_tb WHERE stud_reg ='".safee($condb,$student_RegNo)."' AND session='".safee($condb,$Session_checker1)."' AND fee_type = '".safee($condb,$Fee_type)."'");
//$paystatus13=mysqli_num_rows($paystatus12);
//$date1=date("d/m/Y");
if($paystatus13 > 0){
$sql2_up=	mysqli_query($condb,"UPDATE hostelallot_tb SET trans_id='".safee($condb,$transid)."',studentreg ='".safee($condb,$student_RegNo)."',email = '".safee($condb,$pemail1)."',dept = '".safee($condb,$student_dept)."',prog = '".safee($condb,$student_prog)."',session = '".safee($condb,$Session_checker1)."',level = '".safee($condb,$level)."',duration = '".safee($condb,$duration)."',h_code = '".safee($condb,$hostelname)."',roomno = '".safee($condb,$roomnumber)."',no_of_bed = '0',ftype = '".safee($condb,$roomftype)."',amount = '".safee($condb,$total)."',rdate = NOW(),allotdate = '".safee($condb,$startdate2)."', rchange = '1'  WHERE studentreg ='".safee($condb,$student_RegNo)."' AND validity = '0'")or die(mysqli_error($condb));

$sql2_pay=	mysqli_query($condb,"UPDATE payment_tb SET pay_date=NOW(),email='".safee($condb,$pemail1)."',session='".safee($condb,$Session_checker1)."',paid_amount='".safee($condb,$total)."',trans_id='".safee($condb,$transid)."',fee_type='".safee($condb,$roomftype)."',level='".safee($condb,$level)."',ft_cat='',prog='".safee($condb,$student_prog)."' WHERE stud_reg ='".safee($condb,$student_RegNo)."' AND session='".safee($condb,$Session_checker1)."' AND pay_status = '0' AND fee_type='".safee($condb,$roomftype)."'")or die(mysqli_error($condb));
$_SESSION['transide'] = $transid;
$_SESSION['in_time'] = time();
}else{   
$result = mysqli_query($condb,"insert into hostelallot_tb (trans_id,studentreg,email,dept,prog,session,level,duration,h_code,roomno,no_of_bed,ftype,amount,rdate,rchange,allotdate)values('".safee($condb,$transid)."','".safee($condb,$student_RegNo)."','".safee($condb,$pemail1)."','".safee($condb,$student_dept)."','".safee($condb,$student_prog)."','".safee($condb,$Session_checker1)."','".safee($condb,$level)."','".safee($condb,$duration)."','".safee($condb,$hostelname)."','".safee($condb,$roomnumber)."','0','".safee($condb,$roomftype)."','".safee($condb,$total)."',NOW(),'1','".safee($condb,$startdate2)."')")or die(mysqli_error($condb));
$resultpay = mysqli_query($condb,"insert into payment_tb(stud_reg,trans_id,email,pay_mode,fee_type,paid_amount,pay_date,session,level,department,pay_status,prog) 
			values('".safee($condb,$student_RegNo)."','".safee($condb,$transid)."','".safee($condb,$pemail1)."','Online','".safee($condb,$roomftype)."','".safee($condb,$total)."',NOW(),'".safee($condb,$Session_checker1)."','".safee($condb,$level)."','".safee($condb,$student_dept)."','0','".safee($condb,$student_prog)."')")or die(mysqli_error($condb));
$_SESSION['transide'] = $transid;
 $_SESSION['in_time'] = time();
}
message("Loading Room Booking Preview!", "info");
//echo "<script>alert('Loading Room Booking Preview!');</script>";
redirect("shostel_manage.php?view=Hslip"); 
}
			//	header("location:apply_b.php?view=N_1");
				//echo "<script>alert('Your Application was Sucessfully Submited!');</script>";
	
		//echo "<script>window.location.assign('studentresultprint.php?applyid=".md5($nappNo21)."');</script>";
			}
			

//}$_SESSION['insidp'] = rand();
?>
<div class="x_panel">
                
             
                <div class="x_content">
	                <form method="post" class="form-horizontal"  action="" enctype="multipart/form-data">
                    <input type="hidden" name="insidp" value="<?php echo $_SESSION['insidp'];?> " />
                      <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                      
                      <span class="section">Apply for Hostel Room</span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Please Note that your Room Reservation is not successful if your Hostel payment is not verified after Payment. 
                  </div>
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Registration No</label>
                            	  <input type="text" class="form-control " name='regNo' id="regNo" value="<?php echo $student_RegNo ; ?>" readonly>
                      </div>
    
               <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Level</label>
                            	  
                            	  <select  class="form-control " name='level' id="level"  required="required" readonly>
  <option value="<?php echo $student_level; ?>"><?php echo getlevel($student_level,$student_prog); ?></option>
               <?php 
//include('lib/dbcon.php'); 
//dbcon(); 
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db WHERE prog = '".safee($condb,$student_prog)."'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2))
{
echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	
}
?>	
</select>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Academic Session</label>
                            <select name="session" id="session"  required="required" class="form-control">
  <option value="">Select Session</option>
<?php  
$resultsec = mysqli_query($condb,"SELECT * FROM session_tb  ORDER BY session_name ASC");
while($rssec = mysqli_fetch_array($resultsec))
{
echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	
}
?>
</select>
                      </div>
                      
                   
   <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Hostel Name *</label>
                            <select name="hname" id="hname" onchange='loadroom2(this.name);return false;'  required="required" class="form-control">
  <option value="">Select Hostel</option>
<?php  
$resultblocks = mysqli_query($condb,"SELECT DISTINCT h_name,h_code FROM hostedb WHERE h_status  = '1' ORDER BY h_name ASC");
while($rsblocks = mysqli_fetch_array($resultblocks))
{if($_GET['loadroom'] == $rsblocks['h_code'] )
	{echo "<option value='$rsblocks[h_code]' selected>$rsblocks[h_name]</option>";}
	else{echo "<option value='$rsblocks[h_code]'>$rsblocks[h_name]</option>";}}
?>
</select>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Room No *</label>
                            	  <select name='roomno' id="roomno" onchange='loadhamt(this.name);return false;' class="form-control" required="required" >
                           <option value=''>Select Room No</option>
                          </select>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
						  	  <label for="heard">Room Fee Per Month</label>
                            	  <div  id="txtamtid" ><input type="text" name='amt' id="amt" class="form-control "   value="" readonly>
                      </div>  </div>
                                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
<label for="heard">Duration</label>

<select name="duration" id="duration" class="form-control" onChange="updatePrice()" >
<option value="">Select Duration in Month</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select>

</div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
<label for="heard">Check in Date</label>
<input  type="text" name="cdate" size="29"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed"   readonly="readonly" style="height:32px;">
</div>
  <!--      
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
						  	  <label for="heard">Total</label>
                            	  <input type="text" name='total' id="total" class="form-control "  value="" onChange="updatePrice()" readonly>
                      </div>  --!>
                      
 
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3"> 
                         <button data-placement="right" title="Click Here To Exit Room Request" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='index.php';" type="reset"><i class="icon-signin icon-cross"></i> Exit </button>
                         <button type="submit" name="addpayment"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click to Submit Request" ><i class="fa fa-sign-in"></i> Submit</button>
                        
                        <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='../admin/uploads/tabLoad.gif'></div>
                        </div>
                        
                      </div>
                    </form>
                    
                    
                    
                    
                    
                    
                  </div>
                  
                  
                  