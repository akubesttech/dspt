<script>

function sync(){
var sname = document.getElementById('sname');
var sname1 = sname.value;
var userID = document.getElementById('sid');
var number = Math.floor(Math.random() * 100) +4;

userID.value = sname1+number;
userID.value.changeToUpperCase();
}
</script>

<SCRIPT language=JavaScript>
//function reload(form)

function reload(form)
{
var val=form.fac1.options[form.fac1.options.selectedIndex].value;
self.location='add_Staff.php?fac1=' + val ;
//xmlhttp.onreadystatechange=stateChanged;
//xmlhttp.open("GET","add_Staff.php?fac1="+val,true);
//xmlhttp.send();
}
function myreload(){
location.reload();
}
</script>
<script type="text/javascript">   
$(document).ready(function() {   
$('#jdesc').change(function(){   
if($('#jdesc').val() === 'Others')   
   {   
   $('#addjob0').show(); 
      $('#addjob').show();    
   }   
else 
   {   
   $('#addjob0').hide(); 
      $('#addjob').hide();      
   }   
});   
});   
</script>

<?php
if($_SESSION['insidf']==$_POST['insidf'])
{
if(isset($_POST['addStaff'])){
$sname = ucfirst($_POST['sname']) ; $mname = $_POST['mname'] ; $oname = $_POST['oname'] ; $sex = $_POST['sex'];
$Mstatus = $_POST['Mstatus'] ; $dob = $_POST['dob'] ; $hobbies = $_POST['hobbies'] ; $sheight = $_POST['shight'];
$eaddress = $_POST['eaddress'] ; $paddress = $_POST['paddress'] ; $caddress = $_POST['caddress'] ;$phone = $_POST['phone'] ;
$stown = $_POST['stown'] ; $lga = $_POST['lga'] ; $state = $_POST['state'] ; $nation = ucfirst($_POST['nation']);
$jdesc = $_POST['jdesc'] ; $addjob = $_POST['addjob'] ; $heq = $_POST['heq'] ; $Cstudy = $_POST['cstudy'];
$doe = $_POST['doe'] ; $acctnum = $_POST['acctnum'] ; $fac1 = $_POST['fac1'] ; $dept1 = $_POST['dept1'];
$moe = $_POST['moe'] ; $bname = $_POST['bname'] ;$acctname = $_POST['acctname'] ; $scode = $_POST['scode'] ; $sid = $_POST['sid'];
$image_find = $_POST['pic'] ; $Cverify = $_POST['Cverify'] ; $time=date('l jS \of F Y h:i:s A');
$webaddress=$_SERVER['HTTP_HOST'];

$query = mysql_query("select * from staff_details where usern_id = '$sid' ")or die(mysql_error());
$count = mysql_num_rows($query);
$config = mysql_fetch_array(mysql_query("SELECT * FROM schoolsetuptd "));
	$sql_email_check = mysql_query("SELECT * FROM staff_details WHERE email='$eaddress' LIMIT 1");
	$email_check = mysql_num_rows($sql_email_check);
	
	$sql_phone_check = mysql_query("SELECT * FROM staff_details WHERE phone='$phone' LIMIT 1");
	$phone_check = mysql_num_rows($sql_phone_check);
	


	
if ($count > 0){ 

$res="<font color='red'><strong>This Staff Record Already Exist,Try Again!</strong></font><br>";
				$resi=1;
				//echo "<script>alert('Applicationform record inserted sucessfully..');</script>";
		}elseif(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $eaddress)){
	
		$res="<font color='Red'><strong>Please! Provide a valid Email Address...</strong></font><br>";
				$resi=1;
				
}elseif ($email_check > 0){ 
		
				
					$res="<font color='Red'><strong>ERROR:  This Email Address is already in use inside our system. Please try another.....</strong></font><br>";
				$resi=1;
				}	elseif ($phone_check > 0){ 
		
				
					$res="<font color='Red'><strong>ERROR:  This Phone Number is already in use inside our system. Please try another.....</strong></font><br>";
				$resi=1;}

else{

$images = uploadProductImage('pic','./uploads/');
$thumbnail = $images['thumbnail'];

if($jdesc=="Others"){
if($config['emailver'] == '1') {

$msg = nl2br("Dear $sname $mname,.\n
	The Message was Send To You From ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
	..................................................................\n
	The Following is Your Login Information:.\n
	User Name:   ".$sid."\n
	User Password: ".$sid."\n
	Date: ".$time."\n
	
	..................................................................\n
	
	Thank You Admin!\n\n");
	
	
	
//$random_hash = md5(date('r', time()));
$subject="Staff Login Information "; 
//define the headers we want passed. Note that they are separated with \r\n
 $headers      = "From:Message From Admin\r\n $subject <$webaddress>\r\n";
 //define the body of the message.
ob_start(); //Turn on output buffering
mail($email, $subject, $msg, $headers);

mysql_query("insert into staff_details (sname,mname,oname,mstatus,Gender,dob,hobbies,height,phone,email,paddress,caddress,town,lga,state,nation,job_desc,heq,cos,s_fac,s_dept,doe,e_mode,b_name,b_acct_name,b_acct_num,b_sort,usern_id,password,image,r_status) values('$sname','$mname','$oname','$Mstatus','$sex','$dob','$hobbies','$sheight','$phone','$eaddress','$paddress','$caddress','$stown','$lga','$state','$nation','$addjob','$heq','$Cstudy','$fac1','$dept1','$doe','$moe','$bname','$acctname','$acctnum','$scode','$sid','$sid','$thumbnail','$Cverify')")or die(mysql_error());

				}else{
mysql_query("insert into staff_details (sname,mname,oname,mstatus,Gender,dob,hobbies,height,phone,email,paddress,caddress,town,lga,state,nation,job_desc,heq,cos,s_fac,s_dept,doe,e_mode,b_name,b_acct_name,b_acct_num,b_sort,usern_id,password,image,r_status) values('$sname','$mname','$oname','$Mstatus','$sex','$dob','$hobbies','$sheight','$phone','$eaddress','$paddress','$caddress','$stown','$lga','$state','$nation','$addjob','$heq','$Cstudy','$fac1','$dept1','$doe','$moe','$bname','$acctname','$acctnum','$scode','$sid','$sid','$thumbnail','$Cverify')")or die(mysql_error());
}
mysql_query("insert into activity_log (date,username,action) values(NOW(),'$admin_username','Staff Details of $sname $oname with staff id $sid  was Add')")or die(mysql_error()); 
// ob_start();
$res="<font color='green'><strong>New Staff [$sname $oname] was Successfully Added !</strong></font><br>";
				$resi=1;
}else{
if($config['emailver'] == '1') {

$msg = nl2br("Dear $sname $mname,.\n
	The Message was Send To You From ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
	..................................................................\n
	The Following is Your Login Information:.\n
	User Name:   ".$sid."\n
	User Password: ".$sid."\n
	Date: ".$time."\n
	
	..................................................................\n
	
	Thank You Admin!\n\n");
	
	
	
//$random_hash = md5(date('r', time()));
$subject="Staff Login Information "; 
//define the headers we want passed. Note that they are separated with \r\n
 $headers      = "From:Message From Admin\r\n $subject <$webaddress>\r\n";
 //define the body of the message.
ob_start(); //Turn on output buffering
mail($email, $subject, $msg, $headers);


mysql_query("insert into staff_details (sname,mname,oname,mstatus,Gender,dob,hobbies,height,phone,email,paddress,caddress,town,lga,state,nation,job_desc,heq,cos,s_fac,s_dept,doe,e_mode,b_name,b_acct_name,b_acct_num,b_sort,usern_id,password,image,r_status) values('$sname','$mname','$oname','$Mstatus','$sex','$dob','$hobbies','$sheight','$phone','$eaddress','$paddress','$caddress','$stown','$lga','$state','$nation','$jdesc','$heq','$Cstudy','$fac1','$dept1','$doe','$moe','$bname','$acctname','$acctnum','$scode','$sid','$sid','$thumbnail','$Cverify')")or die(mysql_error());

}else{

mysql_query("insert into staff_details (sname,mname,oname,mstatus,Gender,dob,hobbies,height,phone,email,paddress,caddress,town,lga,state,nation,job_desc,heq,cos,s_fac,s_dept,doe,e_mode,b_name,b_acct_name,b_acct_num,b_sort,usern_id,password,image,r_status) values('$sname','$mname','$oname','$Mstatus','$sex','$dob','$hobbies','$sheight','$phone','$eaddress','$paddress','$caddress','$stown','$lga','$state','$nation','$jdesc','$heq','$Cstudy','$fac1','$dept1','$doe','$moe','$bname','$acctname','$acctnum','$scode','$sid','$sid','$thumbnail','$Cverify')")or die(mysql_error());
}
mysql_query("insert into activity_log (date,username,action) values(NOW(),'$admin_username','Staff Details of $sname $oname with staff id $sid  was Add')")or die(mysql_error()); 
// ob_start();
$res="<font color='green'><strong>New Staff [$sname $oname] was Successfully Added !</strong></font><br>";
				$resi=1;
}

}}}$_SESSION['insidf'] = rand();
?>

<?php 

@$cat=$_GET['fac1']; // Use this line or below line if register_global is off
//if(strlen($cat) > 0 and !is_numeric($cat)){ // to check if $cat is numeric data or not. 
//echo "Data Error";
//exit;
//}
						if(isset($cat) and strlen($cat) > 0){
$resultdep = mysql_query("SELECT DISTINCT d_name FROM dept where fac_did=$cat ORDER BY d_name  ASC"); 
 }
?>
<?php
$myreturn=explode(";",$_COOKIE['return']);
?>
<div class="x_panel">
                
             
                <div class="x_content">

                    <form id="form_name"   method="post" enctype="multipart/form-data" data-parsley-validate >
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      
                      <span class="section">Add Staff Infomation  <?php
                                          if($resi == 1)
{


					echo " 
		
			    <center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res</font></label></center>
			 
			  ";
}
?></span>

                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Surname </label>
                            	  <input type="text" class="form-control " name='sname' id="sname" onkeyup="sync()" onchange="sync()"  required="required">
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Middle Name </label>
                            	  <input type="text" class="form-control " name='mname' id="mname"  required="required" value="<?php echo $myreturn[0]; ?>">
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Other Name </label>
                            	  <input type="text" class="form-control " name='oname' id="oname"  required="required">
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Gender</label>
                      
                          <select name='sex' id="sex" class="form-control" required>
                            <option value="">Select..</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                          
                          </select> </div>
                             <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Marital Status</label>
                      
                          <select name='Mstatus' id="Mstatus" class="form-control" required>
                            <option value="">Select Marital Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                              <option value="Widow">Widow</option>
                            <option value="Widower">Widower</option>
                            <option value="Divorcy">Divorcy</option>
                          
                          </select> </div>
                          
                          <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Date Of Birth</label>
                            	 
                            	  <input  type="date" name="dob" size="30"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed"   readonly="readonly">
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Hobbies</label>
                            	  <input type="text" class="form-control " name='hobbies' id="hobbies"  >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Staff Height</label>
                            	  <input type="text" class="form-control " name='shight' id="hobbies"  >
                      </div>
                     
                          <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Mobile Number</label>
                            	  <input type="text" class="form-control " name='phone' id="phone"  required="required" onkeypress="return isNumber(event);">
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Email Address</label>
                            	  <input type="text" class="form-control " name='eaddress' id="eaddress" required>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Postal Address</label>
                            	  <input type="text" class="form-control " name='paddress' id="paddress"  >
                      </div>
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Contact Address</label>
                            	  <input type="text" class="form-control " name='caddress' id="caddress"  >
                      </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Town/City</label>
                            	  <input type="text" class="form-control " name='stown' id="stown" required >
                      </div>
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Local Government </label>
                            	  <input type="text" class="form-control " name='lga' id="lga" required >
                      </div>
                   
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">State</label>
                        
                            	  <select name="state" id="state" class="form-control " required>
              <option value="" selected="selected">- Select -</option>
              <option value="Abuja FCT">Abuja FCT</option>
              <option value="Abia">Abia</option>
              <option value="Adamawa">Adamawa</option>
              <option value="Akwa Ibom">Akwa Ibom</option>
              <option value="Anambra">Anambra</option>
              <option value="Bauchi">Bauchi</option>
              <option value="Bayelsa">Bayelsa</option>
              <option value="Benue">Benue</option>
              <option value="Borno">Borno</option>
              <option value="Cross River">Cross River</option>
              <option value="Delta">Delta</option>
              <option value="Ebonyi">Ebonyi</option>
              <option value="Edo">Edo</option>
              <option value="Ekiti">Ekiti</option>
              <option value="Enugu">Enugu</option>
              <option value="Gombe">Gombe</option>
              <option value="Imo">Imo</option>
              <option value="Jigawa">Jigawa</option>
              <option value="Kaduna">Kaduna</option>
              <option value="Kano">Kano</option>
              <option value="Katsina">Katsina</option>
              <option value="Kebbi">Kebbi</option>
              <option value="Kogi">Kogi</option>
              <option value="Kwara">Kwara</option>
              <option value="Lagos">Lagos</option>
              <option value="Nassarawa">Nassarawa</option>
              <option value="Niger">Niger</option>
              <option value="Ogun">Ogun</option>
              <option value="Ondo">Ondo</option>
              <option value="Osun">Osun</option>
              <option value="Oyo">Oyo</option>
              <option value="Plateau">Plateau</option>
              <option value="Rivers">Rivers</option>
              <option value="Sokoto">Sokoto</option>
              <option value="Taraba">Taraba</option>
              <option value="Yobe">Yobe</option>
              <option value="Zamfara">Zamfara</option>
     <option value="Outside Nigeria">Outside Nigeria</option>
            </select>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Nationality</label>
                            	  <input type="text" class="form-control " name='nation' id="nation"  >
                      </div>
                      
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Job Description </label>
                            	 <select name='jdesc' id="jdesc" class="form-control" required>
                            <option value="">Select..</option>
                            <option value="Academic Staff">Academic Staff</option>
                             <option value="Non Academic Staff">Non Academic Staff</option>
                                                        <?php  
$resultpro = mysql_query("SELECT DISTINCT job_desc FROM staff_details ORDER BY job_desc  ASC");
while($rspro = mysql_fetch_array($resultpro))
{
echo "<option value='$rspro[job_desc]'>$rspro[job_desc]</option>";	
}
?>
                            <option value="Others">Others</option>
                          
                          </select> 
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard" style="display: none;" id="addjob0">Add Job Description</label>
                            	  <input type="text" class="form-control " name='addjob' id="addjob" style="display: none;"  >
                      </div>
					  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Highest Education Qualification</label>
                            	  <select name='heq' id="heq" class="form-control" >
                            <option value="">Select..</option>
                            <option value="Olevel">Olevel</option>
                            <option value="OND">OND</option>
                            <option value="HND">HND</option>
                            <option value="BSC">BSC</option>
                              <option value="MSC">MSC</option>
                                <option value="PHD">PHD</option>
                                 <option value="Others">Others</option>
                          
                          </select>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Course Studied</label>
                            	  <input type="text" class="form-control " name='cstudy' id="cstudy"  >
                      </div>
					    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Faculty</label>
                            	  <select name='fac1' id="fac1" onchange="reload(this.form)" class="form-control" >
                            <option value="">Select..</option>
                            <?php  
$resultfac = mysql_query("SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
while($rsfac = mysql_fetch_array($resultfac))
{  
if($rsfac['fac_id']==@$cat){echo "<option selected value='$rsfac[fac_id]'>$rsfac[fac_name]</option>"."<BR>";}
else{echo "<option value='$rsfac[fac_id]'>$rsfac[fac_name]</option>";}

//echo "<option value='$rsfac[fac_name]'>$rsfac[fac_name]</option>";	
}
?>
                            
                          
                          </select>
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Department</label>
                            	  <select name='dept1' id="dept1" class="form-control"  >
                            <option value="">Select Department</option>
                            <?php 
	
while($rsdep = mysql_fetch_array($resultdep))
{
echo "<option value='$rsdep[d_name]'>$rsdep[d_name]</option>";	
}
?>
                            
                          
                          </select>
                      </div>
                      
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Date Of Employement</label>
                            	    <input  type="date" name="doe" size="30"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed1"   readonly="readonly">
                            	  
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Mode Of Employment</label>
                            	  <select name='moe' id="moe" class="form-control" >
                            <option value="">Select..</option>
                            <option value="FulL Time">FulL Time</option>
                            <option value="Part Time">Part Time</option>
                            <option value="Contract Staff">Contract Staff</option>
                          
                          </select>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Employee Bank Name </label>
                            	  <input type="text" class="form-control " name='bname' id="bname"  >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Employee Account Name </label>
                            	  <input type="text" class="form-control " name='acctname' id="acctname"  >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Employee Account Number </label>
                            	  <input type="text" class="form-control " name='acctnum' id="acctnum" onkeypress="return isNumber(event);"  >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Bank Sort Code </label>
                            	  <input type="text" class="form-control " name='scode' id="scode" onkeypress="return isNumber(event);"  >
                      </div>
					 
                      
                      
                          <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Staff Id</label>
                            	  <input type="text" class="form-control " name='sid' id="sid" readonly >
                      </div>
						  
						  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Upload Staff Photo </label>
                            	<input name="pic" class="input-file uniform_on" id="fileInput" type="file" >
                      </div>
                      
                      
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Record Status</label>
                      
                          <select name='Cverify' id="Cverify" class="form-control" required>
                            <option value="">Select..</option>
                            <option value="2">Verified</option>
                            <option value="0">Not Verified</option>
                          
                          </select> </div>
             
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         
                        <button type="submit" name="addStaff"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click Here to Save Details" ><i class="fa fa-sign-in"></i> Save</button>
                        
                        <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                      </div>
                    </form>
                  </div>
                  