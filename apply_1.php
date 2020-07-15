<script type="text/javascript">   
$(document).ready(function() {   
$('#f_chalenge').change(function(){   
if($('#f_chalenge').val() === 'Yes')   
   { $('#s1_chalenge').show(); 
      $('#s_chalenge').show();    }   
else {   $('#s1_chalenge').hide(); 
      $('#s_chalenge').hide(); }   
});   
}); 

$(document).ready(function() {   
$('#state').change(function(){   
if($('#state').val() === 'Delta')   
   { $('#lgidno').show(); 
        }else {   $('#lgidno').hide(); 
 }   
});   
});  
</script>
<script type="text/javascript"> 
 window.onload = function (){
if($('#No_result').val() === '2')   
   {   
   $('#exam_t1').show(); 
      $('#exam_t2').show(); 
	  $('#exam_t3').show(); 
      $('#exam_t4').show(); 
	  $('#exam_t5').show(); 
      $('#exam_t6').show();  
   }   
else 
   {   
   $('#exam_t1').hide(); 
      $('#exam_t2').hide();
	  $('#exam_t3').hide();
	  $('#exam_t4').hide(); 
	   $('#exam_t5').hide();
	  $('#exam_t6').hide();     
   } 
}  
$(document).ready(function() {   
$('#No_result').change(function(){   
if($('#No_result').val() === '2')   
   {   
   $('#exam_t1').show(); 
      $('#exam_t2').show(); 
	  $('#exam_t3').show(); 
      $('#exam_t4').show(); 
	  $('#exam_t5').show(); 
      $('#exam_t6').show();  
   }   
else 
   {   
   $('#exam_t1').hide(); 
      $('#exam_t2').hide();
	  $('#exam_t3').hide();
	  $('#exam_t4').hide(); 
	   $('#exam_t5').hide();
	  $('#exam_t6').hide();     
   }   
});   
});   
</script>
<script type='text/javascript'>
function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>
<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
if (!isset($_SESSION['temppin']) ||(trim ($_SESSION['temppin']) == '')) {
	//header("location:apply_b.php");
	redirect("apply_b.php");
    exit();
}
$sql_pinf=mysqli_query($condb,"SELECT * FROM fshop_tb WHERE pin='".safee($condb,$_SESSION['temppin'])."'");
$find_old = mysqli_fetch_array($sql_pinf); $modeofentry = $find_old['moe']; $entryl = getelevel($modeofentry);
if($entryl <= 100){  $alart = " * " ; $req = 'required="required"';   }else{  $alart = "" ; $req = '';    }
//session_start();
	$s=10;
	while($s>0){ $AppNo .= rand(0,9); $s-=1; }
	  $sql_pin1="SELECT * FROM new_apply1 WHERE Pin='".safee($condb,$_SESSION['temppin'])."'";
$result_pin1 = mysqli_query($condb,$sql_pin1);
$num_pin1 = mysqli_num_rows($result_pin1); 
$find_record = mysqli_fetch_array($result_pin1);
$studentpics = $find_record['images']; $agen = $find_record['Age']; $gender_e = $find_record['Gender'];$dob_e = $find_record['dob'];
$oname_e = $find_record['Othername']; $phone_e = $find_record['phone']; $address_e = $find_record['address'];
 $email_e = $find_record['e_address']; $paddress_e = $find_record['postal_address']; $utmereg_e = $find_record['JambNo'];  $utmescore_e = $find_record['J_score']; $prayn = $find_record['password'];
 $hobbies_e = $find_record['hobbies']; 
 
//$sql_pin2="SELECT * FROM olevel_tb2 WHERE oPin='".safee($condb,$_SESSION['temppin'])."'";
$sql_pin2="SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$find_record['appNo'])."'";
$result_pin2 = mysqli_query($condb,$sql_pin2);
$num_pin2 = mysqli_num_rows($result_pin2);
$find_record2 = mysqli_fetch_array($result_pin2);

$sql_oresult1=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$find_record['appNo'])."' AND oNo_re = '1'");
$sql_oresult2=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$find_record['appNo'])."' AND oNo_re = '2'");
$count_olresult1 = mysqli_num_rows($sql_oresult1);
$count_olresult2 = mysqli_num_rows($sql_oresult2);
$sql_oresult10=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$find_record['appNo'])."' AND oNo_re = '1' limit 1");
$sql_oresult20=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$find_record['appNo'])."' AND oNo_re = '2' limit 1");
$countnosub = mysqli_num_rows($sql_oresult20);

if(isset($_POST['Continue'])){
 $Pin = $_POST["pin"];
$serial = $_POST["serial"];
$j_reg = $_POST['j_reg'];
$phone_no = $_POST["phone_no"];
//$mm = trim(strip_tags($_POST['mm']));
	//$dd = trim(strip_tags($_POST['dd']));
	//$yy = trim(strip_tags($_POST['yy']));
//$dob = $_POST['endDate'];
//$dob = $yy."-".$mm."-".$dd;
//$age=date('Y')- $yy;
$dob = $_POST['dob'];
$age=age_add($dob);
$pass = $_POST["pword"]; $pass2 = $_POST["pword2"];
if($prayn == $pass ){ $pass1 = $pass; }else{ $pass1 = substr(md5($pass.SUDO_M),14); }
	$sql_pin=mysqli_query($condb,"SELECT JambNo FROM new_apply1 WHERE JambNo='".safee($condb,$j_reg)."'");
$num_pin = mysqli_num_rows($sql_pin);
$sql_ph=mysqli_query($condb,"SELECT * FROM new_apply1 WHERE phone='".safee($condb,$phone_no)."'");
$num_ph = mysqli_num_rows($sql_ph);
$sql_email=mysqli_query($condb,"SELECT * FROM new_apply1 WHERE e_address='".safee($condb,$_POST['gemail'])."'");
$num_email = mysqli_num_rows($sql_email);

	if($Pin == "" AND $serial == "" ){
	message("Unable To Continue Registration Because Payment Information Not Verified", "error");
//echo "<script>alert('Unable To Continue Registration Because Payment Information Not Verified');</script>";
redirect("apply_b.php");
}elseif(strpos($j_reg," ") && ($entryl <= 100)){
	message("Please! Jamb Reg Number can not Contain a Space", "error");
				   redirect('apply_b.php?view=N_1');
				}elseif(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $_POST['gemail'])){
		message("Please! Provide a valid Email Address '$phone_no' Before", "error");
				   redirect('apply_b.php?view=N_1');
				   }elseif(strlen($pass) < 6 || strlen($pass) > 20) {
   message("Please! Password must be between 6-20 characters (letters and numbers)", "error");
   redirect('apply_b.php?view=N_1');
				}elseif($pass != $pass2){
	message("Please! Password  Did not Match.", "error");
		        redirect('apply_b.php?view=N_1');
				    }else{
				if($num_pin1 > 0){
				if(($num_pin > 1) && ($entryl <= 100)){
		message("This Jamb Registration Number '$j_reg' Has Applied Before2", "error");
				   redirect('apply_b.php?view=N_1');
				   //}elseif($num_ph > 1){
        //message("Another Applicant Has Applied with This Mobile Number '$phone_no' Before", "error");
				  // redirect('apply_b.php?view=N_1');}
				   }elseif(! preg_match("/^[0-3]?[0-9]\/[01]?[0-9]\/[12][90][0-9][0-9]$/",$dob)){ 
				 message("Date Formate should be in this Form example: 31/01/2019 !", "error");
				redirect('apply_b.php?view=N_1');
				   //}elseif($num_email > 1){
        //message("Another Applicant Has Applied with This email '$_POST[gemail]' Before", "error");
				   //redirect('apply_b.php?view=N_1');
				   }else{
				
				$sql_ME=mysqli_query($condb,"UPDATE new_apply1 SET FirstName='".safee($condb,$_POST['sname'])."',SecondName='".safee($condb,$_POST['sname'])."',Othername='".safee($condb,$_POST['mname'])."',Gender='".safee($condb,$_POST['gender'])."',dob='".safee($condb,$dob)."',hobbies='".safee($condb,$_POST['hobbies'])."',state='".safee($condb,$_POST['state'])."',lga='".safee($condb,$_POST['lga'])."',lgidno='".safee($condb,$_POST['lgidno'])."',nation='".safee($condb,$_POST['nation'])."',religion='".safee($condb,$_POST['studentreligion'])."',address='".safee($condb,$_POST['contactaddress'])."',e_address='".safee($condb,$_POST['gemail'])."',phone='".safee($condb,$_POST['phone_no'])."',postal_address='".safee($condb,$_POST['p_add'])."',any_fchalenge='".safee($condb,$_POST['f_chalenge'])."',State_chalenge='".safee($condb,$_POST['s_chalenge'])."',first_Choice='".safee($condb,$_POST['dept1'])."',Second_Choice='".safee($condb,$_POST['dept_2'])."',fact_1='".safee($condb,$_POST['fac_01'])."',fact_2='".safee($condb,$_POST['fac_02'])."',Age='".safee($condb,$age)."',bloodgroup='".safee($condb,$_POST['bloodgroup'])."',gtype='".safee($condb,$_POST['gtype'])."',Pin='".safee($condb,$Pin)."',SerialNo='".safee($condb,$serial)."',JambNo='".safee($condb,$j_reg)."',J_score='".safee($condb,$_POST['j_score'])."',app_type='".safee($condb,$_POST['prog'])."',moe = '".safee($condb,$modeofentry)."', Asession='".safee($condb,$_POST['session'])."',password = '".safee($condb,$pass1)."' WHERE Pin= '".safee($condb,$Pin)."'");
				message("Record Successfully Add Goto Step 2", "success");
		redirect("apply_b.php?view=N_1");
				}

				}else{
					if(($num_pin > 0) && ($entryl <= 100)){
		message("This Jamb Registration Number '$j_reg' Has Applied Before", "error");
				   redirect('apply_b.php?view=N_1');
				   }elseif($num_ph > 0){
        message("Another Person Has Applied with This Mobile Number '$phone_no' Before", "error");
				   redirect('apply_b.php?view=N_1');}
				   elseif(! preg_match("/^[0-3]?[0-9]\/[01]?[0-9]\/[12][90][0-9][0-9]$/",$dob)){ 
				 message("Date Formate should be in this Form example: 31/01/2019 !", "error");
				redirect('apply_b.php?view=N_1');
				     }elseif($num_email > 0){
        message("Another Applicant Has Applied with This email '$_POST[gemail]' Before", "error");
				   redirect('apply_b.php?view=N_1');
				   }else{
                 
				$sql = mysqli_query($condb,"INSERT INTO new_apply1 (appNo,FirstName,SecondName,Othername,Gender,dob,hobbies,state,lga,lgidno,nation,religion,address,e_address,phone,postal_address,any_fchalenge,State_chalenge,first_Choice,Second_Choice,fact_1,fact_2,Age,bloodgroup,gtype,moe,Pin,SerialNo,JambNo,J_score,app_type,Asession,course_choice,verify_apply,adminstatus,password)
VALUES('".safee($condb,$_POST['appNo'])."','".safee($condb,$_POST['sname'])."','".safee($condb,$_POST['mname'])."','".safee($condb,$_POST['oname'])."','".safee($condb,$_POST['gender'])."','".safee($condb,$dob)."','".safee($condb,$_POST['hobbies'])."','".safee($condb,$_POST['state'])."','".safee($condb,$_POST['lga'])."','".safee($condb,$_POST['lgidno'])."','".safee($condb,$_POST['nation'])."','".safee($condb,$_POST['studentreligion'])."','".safee($condb,$_POST['contactaddress'])."','".safee($condb,$_POST['gemail'])."','".safee($condb,$_POST['phone_no'])."','".safee($condb,$_POST['p_add'])."','".safee($condb,$_POST['f_chalenge'])."','".safee($condb,$_POST['s_chalenge'])."','".safee($condb,$_POST['dept1'])."','".safee($condb,$_POST['dept_2'])."','".safee($condb,$_POST['fac_01'])."','".safee($condb,$_POST['fac_02'])."','".safee($condb,$age)."','".safee($condb,$_POST['bloodgroup'])."','".safee($condb,$_POST['gtype'])."','".safee($condb,$modeofentry)."','".safee($condb,$Pin)."','".safee($condb,$serial)."','".safee($condb,$j_reg)."','".safee($condb,$_POST['j_score'])."','".safee($condb,$_POST['prog'])."','".safee($condb,$_POST['session'])."','1','FALSE','0','".safee($condb,$pass1)."')");
	if(!$sql){
		echo mysqli_error($condb);
		message("Unable to Continue Student Registration Please Try Again.", "error");
				   redirect('apply_b.php?view=N_1');}
	$sql2="UPDATE pin SET status='USED' WHERE pinnumber='$Pin'";
$result_upme = mysqli_query($condb,$sql2);
	message("Record Successfully Add Goto Step 2", "success");
		redirect("apply_b.php?view=N_1");
	}}
	
if($num_pin1 > 0){?> <script language="JavaScript" type="text/javascript">
	var tp1 = new Spry.Widget.TabbedPanels("AccountSummaryPanel", { defaultTab: 1}); </script>
		<?php 
			//echo "<script>alert('Record Successfully Add Goto Step 2');</script>";
		//echo "<script>window.location.assign('apply_b.php?view=N_1');</script>";
			//message("Record Successfully Add Goto Step 2", "success");
			//	echo "<script>window.location.assign('apply_b.php?view=N_1');</script>";
				//redirect("apply_b.php?view=N_1");
				
		}
		
}}

?>

<section id="content" role="document">
        <main style="min-height: 168px;">
                    <div class="container">
<div class="row">
    <div class="col-xs-12">
        <div id="breadcrumbs-share">
            <section id="breadcrumbs">
                <ul class="breadcrumb">
                                <li><a href="<?php echo  host(); ?>">Home</a> </li>

                </ul>
            </section>
        </div>
    </div>
</div>
                    </div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-9 link-icons">
            <div class="row">
                <div class="col-xs-12">
            <h3>Welcome to the Online Application For Admission  </h3>
        </div>
        <div class="col-xs-12 primary-content link-icons">
<p class="first-paragraph">Kindly fill the following Application form with valid records. </p>
                </div>
                
        <div class="margin-md-top row cards section-cards">
           <div class="col-xs-12">
           
            <div class="row nopadding nomargin" id="cards">
            
					<!-- form window  --!>	
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<!-- <h3 class="panel-title">Please sign up for Bootsnipp <small>It's free!</small></h3> --!>
			    		<h4 class="panel-title">Fill in your details </h4>
			 			</div>
			 			<div class="TabbedPanels" id="AccountSummaryPanel">
		<ul class="TabbedPanelsTabGroup"> 
			<li class="TabbedPanelsTab" tabindex="0" ><img src="css/images/tab1.png"></li>
			<li class="TabbedPanelsTab" tabindex="0" ><img src="css/images/tab2.png" ></li>
			<li class="TabbedPanelsTab" tabindex="0"><img src="css/images/tab3.png"></li>
		</ul>
		<div class="TabbedPanelsContentGroup">
			<div class="TabbedPanelsContent">
		   	<div id="center">
		   	
			 			<div class="panel-body">
			    		<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			<input type="hidden" name="insid" value="<?php echo $_SESSION['insid']; ?> " />
			<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
			<input type="hidden" name="appNo" value="<?php echo "A". $AppNo;?>"  />
			<input type="hidden" name="prog" value="<?php echo $find_old['ftype']; ?>"  />
			
			
			    		<div class="panel-heading">
			    	<h5 class="panel-title"> Basic Details </h5>
			 			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    					<label class="head">Pin <span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    					<input type="text" name="pin" id="pin" class="form-control input-sm"   tabindex="1" value="<?php echo $_SESSION['temppin']; ?>" readonly>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    					<label class="head">Serial<span class="w3l-star"> *  </span></label>
<div class="form-group"><input type="text" name="serial" id="serial" class="form-control input-sm" tabindex="1" value="<?php echo $_SESSION['tempserial']; ?>" readonly></div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4" style="display: none;">
			    					<label class="head">Application Type<span class="w3l-star"> * </span></label>
			    					<div class="form-group"><select class="form-control input-sm"   name="progx" id="progx"  >
  <?php ///if($find_record['app_type'] == ""){ ?>
  <option value="">Select</option><?php //}else{ ?> <option value="<?php //echo $find_record['app_type']; ?>"><?php //echo getprog($find_record['app_type']); ?></option> <?php // } ?>
   
<?php  
//$resultcourse = mysqli_query($condb,"SELECT * FROM prog_tb where status = '1' ORDER BY Pro_name ASC");
//while($rscourse = mysqli_fetch_array($resultcourse))
//{
//echo "<option value='$rscourse[pro_id]'>$rscourse[Pro_name]</option>";	
//}
?>
</select>	</div>
			    				</div>
			    			</div>
			    			
<!--
			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div> --!>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Session<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    				<select class="form-control input-sm"   name="session" id="session"  required="required">
		<?php if($find_record['Asession'] == ""){ ?>
  <option value="">Select Session</option><?php }else{ ?> <option value="<?php echo $find_record['Asession']; ?>"><?php echo $find_record['Asession']; ?></option> <?php } ?> <?php  $resultsec = mysqli_query($condb,"SELECT * FROM session_tb where action = '1' ORDER BY session_name ASC");
while($rssec = mysqli_fetch_array($resultsec)){echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	} ?>
</select>	</div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Jamb Reg No<span class="w3l-star"><?php echo $alart; ?></span></label>
			    					<div class="form-group"><input type="text" name="j_reg" id="j_reg" class="form-control input-sm"   tabindex="1" value="<?php echo $utmereg_e; ?>" <?php echo $req; ?> >
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Jamb Score<span class="w3l-star"><?php echo $alart; ?></span></label>
			    					<div class="form-group"><input type="text" name="j_score" id="j_score" class="form-control input-sm" tabindex="1" onkeypress="return isNumber(event);" value="<?php echo $utmescore_e ;?>" <?php echo $req; ?>>    					</div>
			    				</div>
			    			</div>
			    			
			    			<div class="row"><div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Password *</label><div class="form-group" >
<input type="password" name="pword" id="pword"  <?php if($find_record['password'] == ""){ echo ""; }else{ echo "value='".$find_record['password']."'"; } ?> tabindex="1"  class="form-control input-sm" autcomplete="false" ></div> </div>		    			
			    			<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Comfirm Password *</label>
<div class="form-group" ><input type="password" name="pword2" id="pword2" <?php if($find_record['password'] == ""){ echo ""; }else{ echo "value='".$find_record['password']."'"; } ?>  tabindex="1"  class="form-control input-sm" autcomplete="false" > </div>
			    				</div>   			</div>
			    			<h5 class="panel-title"> Choice of Course/Program </h5>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">First Choice<span class="w3l-star"> * </span></label>
			    					<div class="form-group"> <select class="form-control input-sm"  name="fchoice" id="fchoice"  required="required">
			    					<?php if($find_record['fact_1'] == ""){ ?>
<option value="" selected="selected" disabled="disabled">Select</option><option  value="1">First</option><?php }else{ ?>
<option  value="1">First</option>
<?php } ?>
</select></div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head"><?php echo $SCategory; ?> *</label>
			    					<div class="form-group" ><select class="form-control input-sm"   name='fac_01' id='fac_01' onchange='loadDept(this.name);return false;'  required='required'>
 	<?php if($find_record['fact_1'] == ""){ ?>
  <option value="">Select <?php echo $SCategory; ?> </option><?php }else{ ?> <option value="<?php echo $find_record['fact_1']; ?>"><?php echo getfacultyc($find_record['fact_1']); ?></option> <?php } ?>
                            <?php  
$resultfac1 = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//$counter=1;
while($rsfac_1 = mysqli_fetch_array($resultfac1))
{
	if($_GET['loadfac'] ==$rsfac_1['fac_id'] )
	{
	echo "<option value='$rsfac_1[fac_id]' selected>$rsfac_1[fac_name]</option>";
//	$counter=$counter+1;
	}
	else
	{
	echo "<option value='$rsfac_1[fac_id]'>$rsfac_1[fac_name]</option>";
	//$counter=$counter+1;
	}
}
?>
</select></div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head"><?php echo $SGdept1; ?> *</label>
			    					<div class="form-group"><select class="form-control input-sm"   name="dept1" id="dept1"  required="required">
   <?php if($find_record['first_Choice'] == ""){ ?>
  <option value="">Select <?php echo $SGdept1; ?></option><?php }else{ ?> <option value="<?php echo $find_record['first_Choice']; ?>"><?php echo getdeptc($find_record['first_Choice']); ?></option> <?php } ?></select></div></div></div>
			    		
			    		<div class="row">
			    		<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Second Choice *</label>
<div class="form-group"><select class="form-control input-sm"  name="s_choice" id="s_choice" required="required" >
	<?php if($find_record['fact_2'] == ""){ ?><option value="" selected="selected" disabled="disabled">Select</option><option  value="2">Second</option><?php }else{ ?>
<option  value="2">Second</option><?php } ?></select></div>
			    				</div>
			    			
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head"><?php echo $SCategory; ?><span class="w3l-star"> * </span></label>
			    					<div class="form-group"><select class="form-control input-sm"   name="fac_02" id="fac_02" onchange="loaddept1(this.name);return false;"  required="required">
 	<?php if($find_record['fact_2'] == ""){ ?>
  <option value="">Select <?php echo $SCategory; ?></option><?php }else{ ?> <option value="<?php echo $find_record['fact_2']; ?>"><?php echo getfacultyc($find_record['fact_2']); ?></option> <?php } ?>
                          <?php  

$resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//$counter=1;
while($rsblocks = mysqli_fetch_array($resultblocks))
{
	if($_GET['loadfac'] ==$rsblocks['fac_id'] )
	{
	echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";
//	$counter=$counter+1;
	}
	else
	{
	echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";
	//$counter=$counter+1;
	}
}
?>
</select></div></div>
<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head"><?php echo $SGdept1; ?> *</label>
<div class="form-group"><select class="form-control input-sm"   name="dept_2" id="dept_2"  required="required">
 <?php if($find_record['Second_Choice'] == ""){ ?>
  <option value="">Select <?php echo $SGdept1; ?></option><?php }else{ ?> <option value="<?php echo $find_record['Second_Choice']; ?>"><?php echo getdeptc($find_record['Second_Choice']); ?></option> <?php } ?></select></div></div></div>
  

			    			<div class="row">
			    			<div class="panel-heading">
			    	<h5 class="panel-title"> Personal Data </h5>
			 			</div>
			    				
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Surname *</label>
			    					<div class="form-group"><input type="text" name="sname" id="sname" class="form-control input-sm"   tabindex="1" value="<?php echo $find_old['fsname']; ?>" required="required"></div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">First Name<span class="w3l-star"> * </span></label>
<div class="form-group"><input type="text" name="mname" id="mname" class="form-control input-sm" tabindex="1" value="<?php echo $find_old['foname']; ?>" required="required"></div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Other Name </label><div class="form-group"><input type="text" name="oname" id="oname" class="form-control input-sm" tabindex="2" value="<?php echo $oname_e; ?>" ></div></div>
			    			</div>
			    				<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Gender</label><?php $gender= $find_record['Gender']; ?>
			    					<div class="form-group"><div class="form-control input-sm"><input type="radio" value="Male" checked name="gender" id="Male" <?php
			echo ($gender == 'Male')?"checked":"" ;		?>> <span>Male</span> <input type="radio" value="Female"id="Female" name="gender" <?php
			echo ($gender == 'Female')?"checked":"" ;		?>> <span>Female</span> </div>
			    					</div>
									
									</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Genotype</label>
			    					<div class="form-group"><select class="form-control input-sm"  name="gtype" id="gtype" >
	<?php if($find_record['gtype'] == ""){ ?>
  <option value="" selected="selected" >Select Genotype</option><?php }else{ ?> <option value="<?php echo $find_record['gtype']; ?>"><?php echo $find_record['gtype']; ?></option> <?php } ?>
<option  value="AA">AA</option>
<option value="AS">AS</option><option value="AC">AC</option><option value="SS">SS</option><option value="SC">SC</option><option value="CC">CC</option></select>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Blood group</label>
			    					<div class="form-group"><select name="bloodgroup" id="bloodgroup" class="form-control input-sm">
			    					
              <option value="A positive">A positive</option>
              <option value="A negative">A negative</option>
              <option value="B positive">B positive</option>
              <option value="B negative">B negative</option>
              <option value="AB positive">AB positive</option>
              <option value="AB negative">AB negative</option>
              <option value="O positive">O positive</option>
              <option value="O negative">O negative</option>
            </select></div></div>
			    			</div>
			    				<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Any Physical Disability *</label>
			    					<div class="form-group"><select name="f_chalenge" id="f_chalenge" class="form-control input-sm" required="required">
			    					<?php if($find_record['any_fchalenge'] == ""){ ?>
  <option value="" selected="selected" >Select</option><?php }else{ ?> <option value="<?php echo $find_record['any_fchalenge']; ?>"><?php echo $find_record['any_fchalenge']; ?></option> <?php } ?>
              <?php
//	$arr = array("Select","Yes", "No");
	//foreach($arr as $val)
	//{
		//echo "<option value=''>Select</option>";
		echo "<option value='Yes'>Yes</option>";
		echo "<option value='No'>No</option>";
	//}
	?></select></div></div>		<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head" id="s1_chalenge" style="display: none;">If Yes Spacify</label><div class="form-group"><textarea name="s_chalenge" id="s_chalenge" tabindex="2" style="display: none;" class="form-control input-sm"> <?php echo $_POST['contactaddress']; ?></textarea></div></div><div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head">Date of Birth *</label><div class="form-group">
<input   value="<?php echo $find_record['dob']; ?>"  type="text" placeholder="Date format: 31/01/2019" name="dob" class="form-control input-sm w8em format-d-m-y highlight-days-67 range-middle-today" id="ed12" required="required">
			    					</div>
			    				</div>
			    					</div>
			    				<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Hobbies</label>
<div class="form-group"><input type="text" class="form-control input-sm" name="hobbies" id="hobbies" tabindex="1" value="<?php echo $hobbies_e; ?>"></div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Religion</label><div class="form-group"><select class="form-control input-sm"  name="studentreligion" id="studentreligion"  required="required">
<?php if($find_record['religion'] == ""){ ?>
  <option value="" selected="selected" disabled="disabled">Select</option><?php }else{ ?> <option value="<?php echo $find_record['religion']; ?>"><?php echo $find_record['religion']; ?></option> <?php } ?>
<option  value="Hindu">Hindu</option>
<option value="Muslim">Muslim</option>
<option value="Christian">Christian</option>
<option value="Jain">Jain</option>
<option value="Jewish">Jewish</option>
<option value="Pagan">Pagan</option>
<option value="Other">Other</option>
</select>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Postal Address</label>
			    					<div class="form-group"><textarea class="form-control input-sm" name="p_add" id="p_add" tabindex="2"> <?php echo $paddress_e; ?></textarea>	</div></div>
			    	</div>
			    			<div class="row">
			    						<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Phone *</label>
<div class="form-group"><input class="form-control input-sm" id="phone" type="text" pattern="[+]?[\.\s\-\(\)\*\#0-9]{3,}" onkeypress="return isNumber(event);" maxlength="11" name="phone_no" required="required" tabindex="1" value="<?php echo $find_old['fphone']; ?>"/></div></div>
			    			<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Email Address *</label>
			    					<div class="form-group"> <input type="text" class="form-control input-sm" name="gemail" id="email" tabindex="4" value="<?php echo $find_old['femail']; ?>" >	</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head" id="s1_chalenge">Contact Address</label><div class="form-group"><textarea name="contactaddress" id="contactaddress" tabindex="2" class="form-control input-sm"> <?php echo $address_e; ?></textarea></div>
			    				</div>
			    	
			    	
					</div><div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">State *</label>
			    					<div class="form-group"><select name="state" id="state" class="form-control input-sm" onchange='loadlga(this.name);return false;' required="required">  <?php if($find_record['state'] == ""){ ?>
  <option value="" selected="selected">- Select State -</option><?php }else{ ?> <option value="<?php echo $find_record['state']; ?>"><?php echo $find_record['state']; ?></option> <?php } ?>
              <option value="Abuja">Abuja</option>
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
            </select></div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Local Government *</label>
			    					<div class="form-group"><select class="form-control input-sm"  name="lga" id="lga"  required="required">
 <?php if($find_record['lga'] == ""){ ?>
  <option value="" selected="selected" >Select LGA</option><?php }else{ ?> <option value="<?php echo $find_record['lga']; ?>"><?php echo $find_record['lga']; ?></option> <?php } ?> </select></div>
			    				</div>
			    						<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head" id="s1_chalenge">Nationality *</label><div class="form-group"><select class="form-control input-sm"  name="nation" id="nation" required="required" >
<?php if($find_record['nation'] == ""){ ?> <option value="" selected="selected" >Select Nationality</option><?php }else{ ?>
<option value="<?php echo $find_record['nation']; ?>"><?php echo $find_record['nation']; ?></option> <?php } ?>
<option  value="Nigeria">Nigeria</option>
<option value="Others">Others</option>

</select></div></div></div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-4" style="display: none;" id="lgidno">
			    				<label class="head">LG Identification Number </label>
<div class="form-group"><input class="form-control input-sm" id="lgidno" type="text"  name="lgidno"  tabindex="1" value="<?php echo $find_record['lgidno']; ?>"/></div></div>
</div>
			    		<button name="Continue" class="btn btn-primary" data-placement="right" type="submit" title="Click to Contine">Save</button>
			    		<button  name="submit"  class="btn btn-primary"  title="Click Here to Close Application Panel" id="button1"  onClick="window.location.href='cancel.php';" type="reset">Close</button>
			    		<div class='imgHolder2' id='imgHolder2'><img src='css/images/tabLoad.gif'></div>
			    		</form>
			    	</div>
			    	</div></div>
			    	
	    		<div class="TabbedPanelsContent">
					<div id="center">
							<?php
 


if(isset($_POST['Continue2'])){
 $Pin = $_POST["pin"];
$serial = $_POST["serial"];
$j_reg = $_POST['j_reg'];
$phone_no = $_POST["phone_no"];
$oselect = $_POST["selector"];$osuba = $_POST["suba"]; $ogradea = $_POST["gradea"];
$oselect2 = $_POST["selector2"]; $osubb = $_POST["subb"]; $ogradeb = $_POST["gradeb"];
$mm = trim(strip_tags($_POST['mm']));
	$dd = trim(strip_tags($_POST['dd']));
	$yy = trim(strip_tags($_POST['yy']));
//$dob = $_POST['endDate'];
$dob = $yy."-".$mm."-".$dd;
$age=date('Y')- $yy;

	$sql_olevelpin="SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$_POST['app_No'])."'";
$result_olevelp = mysqli_query($condb,$sql_olevelpin);
$num_opin = mysqli_num_rows($result_olevelp);

	//$sql_ph="SELECT * FROM new_apply1 WHERE phone='$phone_no'";
//$result_ph = mysqli_query($condb,$sql_ph);
//$num_ph = mysqli_num_rows($result_ph);
	if($Pin == "" AND $serial == "" ){
message("Unable To Continue Registration Because Payment Information Not Verified", "error");
redirect("apply_b.php");
					/*}elseif($num_opin > 1){
message("This Jamb Registration Number '$_POST[j_reg2]' Has Applied Before", "error");
				   redirect('apply_b.php?view=N_1');
				}elseif(strpos($_POST['j_reg2']," ")){
	message("Please! Jamb Reg Number can not Contain a Space", "error");
				   redirect('apply_b.php?view=N_1'); */
			
				}else{
	for($cn=0; $cn<count($oselect); $cn++)
		{ 
		//$sql_OLEVEL=mysqli_query($condb,"REPLACE into olevel_tb2(oapp_No,oNo_re,oExam_t1,oExam_no1,oExam_y1,oSub1,oGrade_1)values('".safee($condb,$_POST['app_No'])."','1','".safee($condb,$_POST['exam_type'])."','".safee($condb,$_POST['e_number'])."','".safee($condb,$_POST['e_date'])."','".safee($condb,$osuba[$cn])."','".$ogradea[$cn]."')")  or die(mysqli_error($condb));
		if($count_olresult1 > 0){
		$sql_OLEVEL=mysqli_query($condb,"UPDATE olevel_tb2 SET oapp_No='".safee($condb,$_POST['app_No'])."',oExam_t1='".safee($condb,$_POST['exam_type'])."',oExam_no1='".safee($condb,$_POST['e_number'])."',oExam_y1='".safee($condb,$_POST['e_date'])."',oSub1='".safee($condb,$osuba[$cn])."',oGrade_1='".$ogradea[$cn]."' WHERE oapp_No='".safee($condb,$_POST['app_No'])."' AND rec_id='".safee($condb,$oselect[$cn])."' AND oNo_re='1' ")  or die(mysqli_error($condb));
	}else{
	$sql_OLEVEL=mysqli_query($condb,"insert into olevel_tb2(oapp_No,oNo_re,oExam_t1,oExam_no1,oExam_y1,oSub1,oGrade_1)values('".safee($condb,$_POST['app_No'])."','1','".safee($condb,$_POST['exam_type'])."','".safee($condb,$_POST['e_number'])."','".safee($condb,$_POST['e_date'])."','".safee($condb,$osuba[$cn])."','".$ogradea[$cn]."')")  or die(mysqli_error($condb));}
	}
	for($cn2=0; $cn2<count($oselect2); $cn2++)
	{ 	if($count_olresult2 > 0){ $sql_OLEVEL2=mysqli_query($condb,"UPDATE olevel_tb2 SET oapp_No='".safee($condb,$_POST['app_No'])."',oExam_t1='".safee($condb,$_POST['exam_type2'])."',oExam_no1='".safee($condb,$_POST['e_number1'])."',oExam_y1='".safee($condb,$_POST['e_date1'])."',oSub1='".safee($condb,$osubb[$cn2])."',oGrade_1='".$ogradeb[$cn2]."' WHERE oapp_No='".safee($condb,$_POST['app_No'])."' AND rec_id='".safee($condb,$oselect2[$cn2])."' AND oNo_re='2' ")  or die(mysqli_error($condb));
		}else{
$sql_OLEVEL2=mysqli_query($condb,"insert into olevel_tb2(oapp_No,oNo_re,oExam_t1,oExam_no1,oExam_y1,oSub1,oGrade_1)values('".safee($condb,$_POST['app_No'])."','2','".safee($condb,$_POST['exam_type2'])."','".safee($condb,$_POST['e_number1'])."','".safee($condb,$_POST['e_date1'])."','".safee($condb,$osubb[$cn2])."','".$ogradeb[$cn2]."')")  or die(mysqli_error($condb));
}
}
	message("Result Record Successfully Added Goto Final Step", "success");
	redirect("apply_b.php?view=N_1");
if($num_pin2 > 0){
				//header("location:apply_b.php?view=N_1");?>
				<script language="JavaScript" type="text/javascript">
	var tp1 = new Spry.Widget.TabbedPanels("AccountSummaryPanel", { defaultTab: 2});

</script>
		<?php 
		//message("Result Record Successfully Added Goto Final Step", "success");
	//redirect("apply_b.php?view=N_1");
			
		}	}

}
?>
<div class="panel-body">
<form name="register3" action="" method="post" enctype="multipart/form-data" id="register3">
			<input type="hidden" name="insid2" value="<?php echo $_SESSION['insid2'];?> " />
			<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
			<input type="hidden" name="appNo" value="<?php echo "A". $AppNo;?>"  />
			    		<div class="panel-heading">
			    	<h5 class="panel-title"> Basic Details</h5>
			 			</div>
				
					<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head">Pin</span></label>
			    					<div class="form-group">
		<input type="text" name="pin" id="pin" class="form-control input-sm"   tabindex="1" value="<?php echo $_SESSION['temppin']; ?>" readonly>
									</div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head">Serial</label>
			    					<div class="form-group">
			    					<input type="text" class="form-control input-sm" name="serial" id="serial" tabindex="1" value="<?php echo $_SESSION['tempserial']; ?>" readonly>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head">Jamb Reg No:</label>
			    					<div class="form-group"><input type="text" class="form-control input-sm" name="j_reg2" id="j_reg2"   tabindex="1" value="<?php echo $find_record['JambNo']; ?>" readonly>
			    					</div>
			    				</div>
			    					<div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head">Application No</label>
			    					<div class="form-group">
	<input type="text" name="app_No" id="app_No" tabindex="1" class="form-control input-sm"  value="<?php echo $find_record['appNo']; ?>" readonly>
			    					</div>
			    				</div>
			    			</div>
					<div class="panel-heading">
			    	<h5 class="panel-title"><strong>&nbsp;Post Primary School Qualification ('O' Level Record)</strong> </h5>
			 			</div>
			 			
				<div class="row"><?php $orow_01 = mysqli_fetch_array($sql_oresult10); $orow_1 = mysqli_fetch_array($sql_oresult20); if($countnosub > 0){$subcont = $orow_1['oNo_re'];}else{ $subcont = $orow_01['oNo_re']; } ?>
			    				<div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head">Number Of Result</span></label>
			    					<div class="form-group">
	<select name="No_result" id="No_result" required="required" class="form-control input-sm">
	<?php if($num_pin2 > 0){ ?> <option value="<?php echo $subcont; ?>"><?php echo $subcont; ?></option><?php }else{ ?>  <option value="">Select</option><?php } ?> <option value="1">1</option>
              <option value="2">2</option>
             </select>
									</div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head">Exam Type</label>
			    					<div class="form-group">
			    				<select name="exam_type" id="exam_type" class="form-control input-sm"  required="required" >
			    				<?php if($num_pin2 > 0){ ?> <option value="<?php echo $orow_01['oExam_t1']; ?>"><?php echo getexamtype($orow_01['oExam_t1']); ?></option><?php }else{ ?>  <option value="">Exam Type One</option><?php } ?> <option value="1">WAEC</option>
              <option value="2">NECO</option>
              <option value="3">GCE O' LEVEL</option>
              <option value="4">GCE A' LEVEL</option>
              <option value="5">TC II</option>
              <option value="6">RSA</option>
              <option value="7">NABTEB</option>
              <option value="8">SSCE</option>
              <option value="9">ACE</option>
              <option value="10">IGCSE</option>
             <option value="11">WAEC Technical Examination</option>
</select>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head">Exam Number</label>
			    					<div class="form-group"><input type="text" name="e_number" id="e_number" class="form-control input-sm"  tabindex="1" value="<?php echo $orow_01['oExam_no1']; ?>" required="required">
			    					</div>
			    				</div>
			    					<div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head">Exam Year</label>
	<div class="form-group"><select class="form-control input-sm" name="e_date" id="e_date"  required="required">
<?php if($num_pin2 > 0){ ?> <option value="<?php echo $orow_01['oExam_y1']; ?>"><?php echo ($orow_01['oExam_y1']); ?></option><?php }else{ ?> <option value="">Year 1</option> <?php } ?>
<?php for($x=1980;$x<2021;$x++){
	echo '<option value="'.$x.'">'.$x.'</option>';
	} ?>
    </select>
			    					</div>
			    				</div>
								
								</div>
								<!-- 1 --!>
								<div class="row" style="border-bottom: 1px solid gray;margin-bottom:3px;">
								<div class="col-xs-1 col-sm-1 col-md-1"  >S/N  </div>
								<div class="col-xs-6 col-sm-6 col-md-3">Subjects </div>
			    				<div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head" >Grades</label></div>
<div class="col-xs-6 col-sm-6 col-md-3" ><label class="head" ></label>
</div>
			    					</div>
			   
 
  <div class="wrapper">
<?php  if($num_pin2 > 0){ $sn1=1; while($orow1 = mysqli_fetch_array($sql_oresult1)){   $id = $orow1['rec_id']; ?><br>
<div class="row<?php echo $id ?>"><input type="hidden" name="selector[]" value="<?php echo $id; ?>"><div class="col-xs-1 col-sm-1 col-md-1"><?php echo $sn1++ ?></div><div class="col-xs-6 col-sm-6 col-md-3" ><div class="form-group"  ><select class="form-control input-sm"   name="suba[]<?php echo $id; ?>"  required="required"  ><option value="<?php echo $orow1['oSub1'];  ?>"><?php echo getf_sub($orow1['oSub1']);  ?></option><?php  echo fill_sub();?> </select></div></div> <div class="col-xs-6 col-sm-6 col-md-3" ><div class="form-group"  ><select class="form-control input-sm"   name="gradea[]<?php echo getfgrade($orow1['oGrade_1']);  ?>" required="required"   ><option value="<?php echo $orow1['oGrade_1'];  ?>"><?php echo getfgrade($orow1['oGrade_1']);  ?></option><?php  echo fill_grade();?> </select></div></div><a  class="btn btn-danger" id="<?php echo $id; ?>" >X</a></div>
<?php }}  ?>
<br>
</div>

<p><button class="add_fields">Add Exam Results</button></p>
	<div class="row" id="exam_t6" style="display:none;"> 
								<div class="col-xs-6 col-sm-6 col-md-3"  >
			    				
			    				</div>
								<div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head" >Exam Type 2</label>
			    					<div class="form-group" > <select name="exam_type2"   class="form-control input-sm"  >
			    					 <?php if($countnosub > 0){ ?> <option value="<?php echo $orow_1['oExam_t1']; ?>"><?php echo getexamtype($orow_1['oExam_t1']); ?></option><?php }else{ ?> <option value="">Exam Type Two</option> <?php } ?>
            <option value="1">WAEC</option>
              <option value="2">NECO</option>
              <option value="3">GCE O' LEVEL</option>
              <option value="4">GCE A' LEVEL</option>
              <option value="5">TC II</option>
              <option value="6">RSA</option>
              <option value="7">NABTEB</option>
              <option value="8">SSCE</option>
              <option value="9">ACE</option>
              <option value="10">IGCSE</option>
             <option value="11">WAEC Technical Examination</option>
              </select></div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head" style="display: none;" id="exam_t1">Exam Number2 </label>
			    					<div class="form-group" style="display: none;" id="exam_t2">
	<input type="text" name="e_number1" id="e_number1"   tabindex="1" value="<?php echo $orow_1['oExam_no1']; ?>" class="form-control input-sm" >
									</div></div>
			    				
			    				<div class="col-xs-6 col-sm-6 col-md-3"  >
			    				<label class="head" >Exam Year 2</label>
			    					<div class="form-group"  >	<select class="form-control input-sm" name="e_date1" id="e_date1"  >
			    					<?php if($countnosub > 0){ ?> <option value="<?php echo $orow_1['oExam_y1']; ?>"><?php echo ($orow_1['oExam_y1']); ?></option><?php }else{ ?> <option value="">Year 2</option> <?php } ?> <?php for($x=1980;$x<2021;$x++){
	echo '<option value="'.$x.'">'.$x.'</option>';
	} ?>
    </select>
			    					</div>
			    				</div>
			    				
								
								</div>
									<!-- 2 --!>
								<div class="row" style="border-bottom: 1px solid gray;margin-bottom:3px;display: none;" id="exam_t4">
								<div class="col-xs-1 col-sm-1 col-md-1"  >S/N  </div>
								<div class="col-xs-6 col-sm-6 col-md-3">Subjects </div>
			    				<div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head" >Grades</label></div>
<div class="col-xs-6 col-sm-6 col-md-3" ><label class="head" ></label>
</div>
			    					</div>
			    
 
  <div class="wrapper2" style="display: none;" id="exam_t5">
<?php //if($num_pin2 > 0){echo "Add your Nine(9) Result Subjects ";} 
if($num_pin2 > 0){ $sn1=1; while($orow12 = mysqli_fetch_array($sql_oresult2)){   $id = $orow12['rec_id']; ?><br>
<div class="row<?php echo $id ?>"><input type="hidden" name="selector2[]" value="<?php echo $id; ?>"><div class="col-xs-1 col-sm-1 col-md-1"><?php echo $sn1++ ?></div><div class="col-xs-6 col-sm-6 col-md-3" ><div class="form-group"  ><select class="form-control input-sm"   name="subb[]<?php echo $id; ?>"  required="required"  ><option value="<?php echo $orow12['oSub1'];  ?>"><?php echo getf_sub($orow12['oSub1']);  ?></option><?php  echo fill_sub();?> </select></div></div> <div class="col-xs-6 col-sm-6 col-md-3" ><div class="form-group"  ><select class="form-control input-sm"   name="gradeb[]<?php echo getfgrade($orow12['oGrade_1']);  ?>" required="required"   ><option value="<?php echo $orow12['oGrade_1'];  ?>"><?php echo getfgrade($orow12['oGrade_1']);  ?></option><?php  echo fill_grade();?> </select></div></div><a  class="btn btn-danger btn_remove" id="<?php echo $id; ?>" >X</a></div>
<?php }}  ?><br>
</div>

<p style="display: none;" id="exam_t3" ><button class="add_fields2">Add 2nd Exam Results</button></p>
    					
<button name="Continue2" class="btn btn-primary"   data-placement="right" type="submit" title="Click to Contine">Save</button>
<button  name="Continue3"  class="btn btn-primary"  title="Click Here to Exit Application Panel" id="button1"  onClick="window.location.href='cancel.php';" type="reset">Close</button>				
				</div> 	</form> </div></div>
				
					<div class="TabbedPanelsContent">
					<div id="center">
					
					<?php
						$school_form = mysqli_fetch_array(mysqli_query($condb," SELECT * FROM schoolsetuptd "));
						$schoolinitial =$school_form['initial'];
 $sql2="SELECT * FROM new_apply1 where appNo = '$_POST[app_No]' ";
  $qsql2= mysqli_query($condb,$sql2);
$rs2 = mysqli_fetch_array($qsql2);

$staffdb = mysqli_query($condb,"SELECT * FROM new_apply1  where appNo = '$_POST[app_No]'");
$rs23 = mysqli_fetch_array($staffdb);
	$exists = imgExists("./Student/".$rs2['images']);
//if($_SESSION['insid3']==$_POST['insid3'])
//{
if(isset($_POST['SubmitApp'])){
 $name4     = $_FILES['image_name']['name'];
$tmpName  = $_FILES['image_name']['tmp_name'];
 $ext = strtolower(pathinfo($name4, PATHINFO_EXTENSION));
$maxsize = 300000;

if($_FILES['image_name']['size'] == Null)  {
	message("Please Select an Image Before You Submit Your Application", "error");
				   redirect('apply_b.php?view=N_1');
	
				}elseif($_SESSION['temppin'] == "" AND $_SESSION['tempserial'] == "" ){
//echo "<script>alert('Unable To Continue Registration Because Payment Information Not Verified');</script>";
message("Unable To Continue Registration Because Payment Information Not Verified", "error");
//echo "<script>window.location.assign('apply_b.php?view=New');</script>";
	redirect("apply_b.php");

}elseif(!in_array($ext, array('jpg','jpeg','png','gif')) ){
 	message("Invalid file type. Only  JPG, GIF and PNG types are accepted", "error");
				   redirect('apply_b.php?view=N_1');
			//}elseif($_FILES["image_name"]["size"] > $maxsize)  {
			}elseif(getimagesize($_FILES['image_name']['tmp_name']) < $maxsize){
	message("File size should be less than 300kb", "error");
				   redirect('apply_b.php?view=N_1');
			}elseif(!$_POST['approve']){
			message("Your Have Not Approve Your Application Information Click The Check Box to Approve !", "error");
				   redirect('apply_b.php?view=N_1');
		
}else{
	$sql_complete="UPDATE new_apply1 SET reg_status ='".safee($condb,$_POST['approve'])."',dateofreg = NOW() WHERE appNo = '".safee($condb,$_POST['app_No'])."'";
					$result_complete = mysqli_query($condb,$sql_complete);

if ($_FILES['image_name']['size'] !== 0){

	                                while($r < 6){
								   $dig .=rand(3,9);
                                    $r+=1;
                                          }
                                         $newname=$dig . ".gif";
                                          
                                    $watermark = $schoolinitial;
							      	
							      	$uploadfile = $newname;
$image = addslashes(file_get_contents($_FILES['image_name']['tmp_name']));
                                $image_name = addslashes($_FILES['image_name']['name']);
                                $image_size = getimagesize($_FILES['image_name']['tmp_name']);
                               //$recordimage = move_uploaded_file($_FILES["image_name"]["tmp_name"], "admin/apply_uploads/$uploadfile");
                                //$adminthumbnails = "apply_uploads/" .$newname;
                                $recordimage = move_uploaded_file($_FILES["image_name"]["tmp_name"], "Student/uploads/$uploadfile");
                                textwatermark($newname, $watermark, $newname);
								$adminthumbnails = "uploads/" .$newname;
                               
mysqli_query($condb,"update new_apply1 set images = '".safee($condb,$adminthumbnails)."' where appNo = '".safee($condb,$_POST['app_No'])."'");
								 
unset($dig);
$r=0;
unlink("Student/$rs23[images]");
} 
 ob_start();
	echo "<script>alert('Your Application was Sucessfully Submited!');</script>";
		echo "<script>window.location.assign('studentappprint.php?applicationid=".md5($_POST['app_No'])."');</script>";
	

}
}//}$_SESSION['insid3'] = rand();
// Function to add text water mark over image

function textwatermark($src, $watermark, $save=NULL) { 
 list($width, $height) = getimagesize($src);
 $image_p = imagecreatetruecolor($width, $height);
 $image = imagecreatefromjpeg($src);
 imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height); 
// $txtcolor = imagecolorallocate($image_p, 200, 255, 300);
$txtcolor = imagecolorallocate($image_p, 255, 200, 300);
 $font = 'monofont.ttf';
 $font_size = 20;
 //imagettftext($image_p, $font_size, 0, 50, 150, $txtcolor, $font, $watermark);
 imagettftext($image_p, $font_size, 0, 26, 88, $txtcolor, $font, $watermark);
 if ($save<>'') {
 imagejpeg ($image_p, $save, 100); 
 } else {
 header('Content-Type: image/jpeg');
 imagejpeg($image_p, null, 100);
 }
 imagedestroy($image); 
 imagedestroy($image_p); 
}
?>
<div class="panel-body">
<form name="register3" action="" method="post" enctype="multipart/form-data" id="register3">
			<input type="hidden" name="insid2" value="<?php echo $_SESSION['insid2'];?> " />
			<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
			<input type="hidden" name="appNo" value="<?php echo "A". $AppNo;?>"  />
			<div class="panel-heading">
			    	<h5 class="panel-title"> Basic Details</h5>
			 			</div>
				
					<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head">Pin</span></label>
			    					<div class="form-group">
		<input type="text" name="pin" id="pin" class="form-control input-sm"   tabindex="1" value="<?php echo $_SESSION['temppin']; ?>" readonly>
									</div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head">Serial</label>
			    					<div class="form-group">
			    					<input type="text" class="form-control input-sm" name="serial" id="serial" tabindex="1" value="<?php echo $_SESSION['tempserial']; ?>" readonly>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head">Jamb Reg No:</label>
			    					<div class="form-group"><input type="text" class="form-control input-sm" name="j_reg2" id="j_reg2"   tabindex="1" value="<?php echo $find_record['JambNo']; ?>" readonly>
			    					</div>
			    				</div>
			    					<div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head">Application No</label>
			    					<div class="form-group">
	<input type="text" name="app_No" id="app_No" tabindex="1" class="form-control input-sm"  value="<?php echo $find_record['appNo']; ?>" readonly>
			    					</div>
			    				</div>
			    			</div>				
				<div class="panel-heading">
			    	<h5 class="panel-title"> <strong>&nbsp;Upload Your Passport <font color="red" size="2">(Note :Image Size Should Not be more than 300kb.)</font>&nbsp;&nbsp;</strong></h5>
			 			</div>
					<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Upload Passport</span></label>
			    					<div class="form-group"><input name="image_name" class="form-control input-sm" id="fileInput" type="file" accept="image/*" onchange="preview_image(event)" style="width:200px;"></div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Passport Preview</label>
			    					<div class="form-group"><div class="otherinputs"><div class="fileinput-new thumbnail" style="width: 200px; height: 150px; border: 1px solid #0080e5;">
<img src="<?php  if ($exists > 0 ){print "./Student/".$rs2['images'];
	}else{ print "./Student/uploads/NO-IMAGE-AVAILABLE.jpg";}
				  ?>" alt="" id="output_image" style="width:200px;height: 150px;"> </div> </div>
			    					</div>
			    				</div></div>
				<div class="panel-heading">
			    	<h5 class="panel-title"><strong>&nbsp;Declaration and Undertaking <font color="red" size="2">(Note :After This Final Stage Information update will not be possible.)</font>&nbsp;&nbsp;</strong></h5>
			 			</div>
			 			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-12">
			    			
			    					<div class="form-group">  <input id="approve" name="approve" value="1"  onclick="javascript: toggleCheckBox();" type="checkbox"> I hereby acknowledge by ticking this check box that if it is discovered at any time that I do not possess any of the qualifications which I claim I have obtained,I will be expelled From The institution and shall not be re-admitted for the same or any other programme,even if I have upgraded my previous qualifications or possess additional qualifications.</div></div>
			    				</div>
	<button name="SubmitApp" class="btn btn-primary"   data-placement="right" type="submit" title="Click to Submit Application">Submit</button>
				
				
					</div> 	</form> </div></div>
				
				</div></div>
				</div>
    	
    	
    
    	
    	
						
                </div>
                
                
            </div>
        </div>



            </div>
            
        </div>
        <div class="col-xs-12 col-md-3 sidebar-right margin-lg-bottom">
            <!-- right feature space -->
            
   <!-- <div class="apply-box">
        <a class="btn btn-default expand padding-md" href="https://applyalberta.ca/APAS.Web.Public/ApplicationServices/default.aspx?StartingAction=ApplyNow">APPLY NOW</a>
    </div> --!>

            
<?php include("sidenews.php");?>
            
        </div>
    </div>
   <?php 
 
   if($num_pin1 > 0){ ?>
<script language="JavaScript" type="text/javascript">
	var tp1 = new Spry.Widget.TabbedPanels("AccountSummaryPanel", { defaultTab: 1});

</script>

      <?php }else{ ?>
      <script language="JavaScript" type="text/javascript">
	var tp1 = new Spry.Widget.TabbedPanels("AccountSummaryPanel", { defaultTab: 0});

</script>
      <?php } ?>
      <?php if($num_pin2 > 0){ ?>
 <script language="JavaScript" type="text/javascript">
	var tp1 = new Spry.Widget.TabbedPanels("AccountSummaryPanel", { defaultTab: 2});
<?php } ?>
</script>

    
</div>


        </main>
    </section>
    
    