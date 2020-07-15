<script type="text/javascript">
/*
function loaddept1(str1)
{var a=document.getElementById(str1)[document.getElementById(str1).selectedIndex].innerHTML;
if(a=='Select Faculty'){ return;}
else{
var e=document.getElementById('imgHolder2');
e.style.visibility='visible';
xmlhttp=GetXmlHttpObject();

setTimeout(function(){if (xmlhttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  }

var d=document.getElementById(str1)[document.getElementById(str1).selectedIndex].innerHTML;
var url="loadDept.php";
url=url+"?loadfac="+d;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged1;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}
function stateChanged1()
{
if (xmlhttp.readyState==4)
  {
  document.getElementById("dept_2").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';
  }
}
*/
</script>
<script type="text/javascript">   
$(document).ready(function() {   
$('#f_chalenge').change(function(){   
if($('#f_chalenge').val() === 'Yes')   
   {   
   $('#s1_chalenge').show(); 
      $('#s_chalenge').show();    
   }   
else 
   {   
   $('#s1_chalenge').hide(); 
      $('#s_chalenge').hide();      
   }   
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
//session_start();
if (!isset($_SESSION['temppin']) ||(trim ($_SESSION['temppin']) == '')) {
	//header("location:apply_b.php");
	//redirect("apply_b.php");
	redirect("apply_b.php?view=Old");
    exit();
}

//session_start();
	$s=10;
	while($s>0){
		$AppNo .= rand(0,9);
		$s-=1;
	}
	
	  $sql_pin1="SELECT * FROM student_tb WHERE RegNo='".safee($condb,$_SESSION['temppin'])."'";
$result_pin1 = mysqli_query($condb,$sql_pin1);
$num_pin1 = mysqli_num_rows($result_pin1);
$find_record = mysqli_fetch_array($result_pin1);
$studentpics = $find_record['images']; $agen = $find_record['dob']; $fname_e = $find_record['FirstName'];$sname_e = $find_record['SecondName'];
$oname_e = $find_record['Othername']; $phone_e = $find_record['phone']; $address_e = $find_record['address'];
 $email_e = $find_record['e_address']; $paddress_e = $find_record['postal_address']; $paddress_e = $find_record['postal_address'];
 $hobbies_e = $find_record['hobbies'];
$sql_pin2="SELECT * FROM olevel_tb WHERE oPin='".safee($condb,$_SESSION['temppin'])."'";
$result_pin2 = mysqli_query($condb,$sql_pin2);
$num_pin2 = mysqli_num_rows($result_pin2);
$find_record2 = mysqli_fetch_array($result_pin2);  $prayn = $find_record['password'];
//if($_SESSION['temppin'] = "" ){

		//echo "<script>window.location.assign('apply_b.php?view=New');</script>";
		//}
//ini_set('display_errors', 1);
//if($_SESSION['insid']==$_POST['insid'])
//{
if(isset($_POST['old_register'])){
 $regnumber = $_POST["regnumber"];
$serial = $_POST["serial"];
$j_reg = $_POST['j_reg'];
$dgroup = $_POST['d_group1'];
$phone_no = $_POST["phone_no"];
$mm = trim(strip_tags($_POST['mm']));
	$dd = trim(strip_tags($_POST['dd']));
	$yy = trim(strip_tags($_POST['yy']));
$pass = $_POST["pword"]; $pass2 = $_POST["pword2"];
if($prayn == $pass ){ $pass1 = $pass; }else{ $pass1 = substr(md5($pass.SUDO_M),14); }

$dob = $_POST['dob'];
$csession = $_POST['session']; $secn = substr($csession,0,4);
$yoe = $_POST['yoe'];
$age=age_add($dob);
$p_dura = getdura($_POST['prog']);
$yearofgrag = $_POST['yoe'] + $p_dura;
//$time=date('l jS \of F Y h:i:s A');
	$sql_pin="SELECT * FROM student_tb WHERE RegNo='".safee($condb,$_SESSION['temppin'])."'";
$result_pin = mysqli_query($condb,$sql_pin);
$num_pin = mysqli_num_rows($result_pin);

$result_ph = mysqli_query($condb,"SELECT * FROM student_tb WHERE phone='".safee($condb,$_POST['phone_no'])."' ");
	
	$num_ph = mysqli_num_rows($result_ph);

	//$sql_ph="SELECT * FROM student_tb WHERE phone='".safee($condb,$phone_no)."' LIMIT 1";
//$result_ph = mysqli_query($condb,$sql_ph);
//$num_ph = mysqli_num_rows($result_ph);
       //if($num_pin > 0){
//$res="<font color='Red'><strong>This Student Registration Number '".safee($condb,$_SESSION['temppin'])."' already Registered.</strong></font><br>";
				//$resi=1;
			//	}elseif(strpos($num_pin," ")){
		//$res="<font color='Red'><strong>Please! Jamb Reg Number can not Contain a Space..</strong></font><br>";
				//$resi=1;
			if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $_POST['gemail'])){
		//$res="<font color='Red'><strong>Please! Provide a valid Email Address...</strong></font><br>";
				//$resi=1;
				message("Please! Provide a valid Email Address!", "error");
		        redirect('apply_b.php?view=O_C');
		        }elseif($secn < $yoe){
	message("Please! Select Correct Year of Admission.", "error");
		        redirect('apply_b.php?view=O_C');
				 }elseif(! preg_match("/^[0-3]?[0-9]\/[01]?[0-9]\/[12][90][0-9][0-9]$/",$dob)){ 
				 message("Date Formate should be in this Form example: 31/01/2019 !", "error");
				redirect('apply_b.php?view=O_C');
				 }elseif(strlen($pass) < 6 || strlen($pass) > 20) {
   message("Please! Password must be between 6-20 characters (letters and numbers)", "error");
   redirect('apply_b.php?view=O_C');
				}elseif($pass != $pass2){
	message("Please! Password  Did not Match.", "error");
		        redirect('apply_b.php?view=O_C');
				//(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$Sstart))
        //$res="<font color='Red'><strong>Another Student Has Registered with This Mobile Number '$phone_no' Before.</strong></font><br>";
				//$resi=1;
				}else{
				if($num_pin > 0){
				$sql_ME="UPDATE student_tb SET FirstName='".safee($condb,$_POST['sname'])."',SecondName='".safee($condb,$_POST['mname'])."',Othername='".safee($condb,$_POST['oname'])."',Gender='".safee($condb,$_POST['gender'])."',dob='".safee($condb,$dob)."',hobbies='".safee($condb,$_POST['hobbies'])."',state='".safee($condb,$_POST['state'])."',lga='".safee($condb,$_POST['lga'])."',nation='".safee($condb,$_POST['nation'])."',religion='".safee($condb,$_POST['studentreligion'])."',address='".safee($condb,$_POST['contactaddress'])."',e_address='".safee($condb,$_POST['gemail'])."',phone='".safee($condb,$_POST['phone_no'])."',postal_address='".safee($condb,$_POST['p_add'])."',any_fchalenge='".safee($condb,$_POST['f_chalenge'])."',State_chalenge='".safee($condb,$_POST['s_chalenge'])."',Faculty='".safee($condb,$_POST['fac_01'])."',Department='".safee($condb,$_POST['dept1'])."',Age='".safee($condb,$age)."',bloodgroup='".safee($condb,$_POST['bloodgroup'])."',gtype='".safee($condb,$_POST['gtype'])."',RegNo='".safee($condb,$_SESSION['temppin'])."',app_type='".safee($condb,$_POST['prog'])."',Asession='".safee($condb,$csession)."',Moe='".safee($condb,$_POST['moe'])."',yoe='".safee($condb,$yoe)."',yog='".safee($condb,$yearofgrag)."',prog_dura='".safee($condb,$p_dura)."',p_level='".safee($condb,$_POST['level'])."',dateofreg=NOW(),reg_status='0',Cert_inview = '".safee($condb,$_POST['prog'])."',password = '".safee($condb,$pass1)."',lginno = '".safee($condb,$_POST['lgidno'])."' WHERE RegNo= '".safee($condb,$_SESSION['temppin'])."'";
					$result_qsql2 = mysqli_query($condb,$sql_ME);
				}else{
				if($num_ph > 0){
				message("Another Student Has Registered with This Mobile Number '$phone_no' Before!", "error");
				   redirect('apply_b.php?view=O_C');
				   }else{
				$sql="INSERT INTO student_tb (appNo,FirstName,SecondName,Othername,Gender,dob,hobbies,state,lga,nation,religion,address,e_address,phone,postal_address,any_fchalenge,State_chalenge,Faculty,Department,Age,bloodgroup,gtype,RegNo,app_type,Asession,Moe,yoe,yog,p_level,dateofreg,prog_dura,reg_status,Cert_inview,password,lgidno)
VALUES('".safee($condb,$_POST['appNo'])."','".safee($condb,$_POST['sname'])."','".safee($condb,$_POST['mname'])."','".safee($condb,$_POST['oname'])."','".safee($condb,$_POST['gender'])."','".safee($condb,$dob)."','".safee($condb,$_POST['hobbies'])."','".safee($condb,$_POST['state'])."','".safee($condb,$_POST['lga'])."','".safee($condb,$_POST['nation'])."','".safee($condb,$_POST['studentreligion'])."','".safee($condb,$_POST['contactaddress'])."','".safee($condb,$_POST['gemail'])."','".safee($condb,$_POST['phone_no'])."','".safee($condb,$_POST['p_add'])."','".safee($condb,$_POST['f_chalenge'])."','".safee($condb,$_POST['s_chalenge'])."','".safee($condb,$_POST['fac_01'])."','".safee($condb,$_POST['dept1'])."','".safee($condb,$age)."','".safee($condb,$_POST['bloodgroup'])."','".safee($condb,$_POST['gtype'])."','".safee($condb,$_SESSION['temppin'])."','".safee($condb,$_POST['prog'])."','".safee($condb,$csession)."','".safee($condb,$_POST['moe'])."','".safee($condb,$yoe)."','".safee($condb,$yearofgrag)."','".safee($condb,$_POST['level'])."',NOW(),'".safee($condb,$p_dura)."','0','".safee($condb,$_POST['prog'])."','".safee($condb,$pass1)."','".safee($condb,$_POST['lgidno'])."')";
	if(!$qsql= mysqli_query($condb,$sql))

	{
		echo mysqli_error($condb);
		message("Unable to Continue Student Registration Please Try Again.", "error");
				   redirect('apply_b.php?view=O_C');
		//$res="<font color='Red'><strong>Unable to Continue Student Registration Please Try Again...</strong></font><br>";
				//$resi=1;
			//exit();
	}}
}

if($studentpics == Null){
				//header("location:apply_b.php?view=N_1");?>
				<script language="JavaScript" type="text/javascript">
	var tp1 = new Spry.Widget.TabbedPanels("AccountSummaryPanel", { defaultTab: 1});

</script>
		<?php 
		//message("Record Successfully Added, Please Complete the Final Step.", "info");
		echo "<script>alert('Record Successfully Added Goto Final Step');</script>";
		echo "<script>window.location.assign('apply_b.php?view=O_C');</script>";
			///redirect("apply_b.php?view=O_C");
		}	}

}//}$_SESSION['insid'] = rand();



?>

<section id="content" role="document">
        <main style="min-height: 168px;">
                    <div class="container">
<div class="row">
    <div class="col-xs-12">
        <div id="breadcrumbs-share">
            <section id="breadcrumbs">
                <ul class="breadcrumb">
                                <li><a href="<?php  echo host(); ?>">Home</a> </li>


                    

                    

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
            <h3>Old/Returning Student Record Validation Form   </h3>
        </div>
        <div class="col-xs-12 primary-content link-icons">
<p class="first-paragraph">Kindly fill the following registration form with valid records and submit the Student Information form to Admin for verification </p>
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
		
			<li class="TabbedPanelsTab" tabindex="0"><img src="css/images/tab3.png"></li>
		</ul>
		<div class="TabbedPanelsContentGroup">
			<div class="TabbedPanelsContent">
		   	<div id="center">
		   	
			 			<div class="panel-body">
			    		<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			    			<input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
			<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
			<input type="hidden" name="appNo" value="<?php echo "O". $AppNo;?>"  />
			    		<div class="panel-heading">
			    	<h5 class="panel-title"> Entry Information </h5>
			 			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    					<label class="head">Matric Number <span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			        <input type="text" name="regnumber" id="regnumber" class="form-control input-sm"   tabindex="1" value="<?php echo $_SESSION['temppin']; ?>" readonly>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    					<label class="head">Programme of study<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    					<select class="form-control input-sm"   name="prog" id="prog"  onchange='loadlevel(this.name);return false;' required="required">
  		<?php if($find_record['app_type'] == ""){ ?>
  <option value="">Select</option><?php }else{ ?> <option value="<?php echo $find_record['app_type']; ?>"><?php echo getprog($find_record['app_type']); ?></option> <?php } ?> <?php  
$resultcourse = mysqli_query($condb,"SELECT * FROM prog_tb where status = '1' ORDER BY Pro_name ASC");
while($rscourse = mysqli_fetch_array($resultcourse))
{if($_GET['proid'] ==$rscourse['pro_id'] )
	{echo "<option value='$rscourse[pro_id]' selected>$rscourse[Pro_name]</option>";}
	else{echo "<option value='$rscourse[pro_id]'>$rscourse[Pro_name]</option>";}} ?></select>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    					<label class="head">Mode of entry<span class="w3l-star"> * </span></label>
			    					<div class="form-group"><select class="form-control input-sm"   name="moe" id="moe"  required="required">
			    					<?php if($find_record['Moe'] == ""){ ?>
  <option value="">Select Mode</option><?php }else{ ?> <option value="<?php echo $find_record['Moe']; ?>"><?php echo getamoe($find_record['Moe']); ?></option> <?php } ?>
 <?php
$resultsec2 = mysqli_query($condb,"SELECT * FROM mode_tb  ORDER BY id ASC");
while($rssec2 = mysqli_fetch_array($resultsec2)){echo "<option value='$rssec2[id]'>$rssec2[entrymode]</option>";	}?></select>
			    					</div>
			    				</div>
			    			</div>
<!--
			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div> --!>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Current Session<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    				<select class="form-control input-sm"   name="session" id="session"  required="required">
			    				<?php if($find_record['Asession'] == ""){ ?>
  <option value="">Select Session</option><?php }else{ ?> <option value="<?php echo $find_record['Asession']; ?>"><?php echo $find_record['Asession']; ?></option> <?php } ?>  <?php  $resultsec = mysqli_query($condb,"SELECT * FROM session_tb  ORDER BY session_name ASC");
while($rssec = mysqli_fetch_array($resultsec)){echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	} ?>
</select>	</div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Year Of Entry<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    				<select class="form-control input-sm" name="yoe" id="yoe"  required="required">
			    								<?php if($find_record['yoe'] == ""){ ?>
  <option>Select Year</option><?php }else{ ?> <option value="<?php echo $find_record['yoe']; ?>"><?php echo $find_record['yoe']; ?></option> <?php } ?><?php for($x=2010;$x<2025;$x++){ echo '<option value="'.$x.'">'.$x.'</option>'; } ?></select>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Level of study<span class="w3l-star"> * </span></label>
			    					<div class="form-group"><select class="form-control"   name="level" id="level"  required="required">
								<?php if($find_record['p_level'] == ""){ ?>	
<option value="">Select Level</option> <?php }else{ ?><option value="<?php echo $find_record['p_level']; ?>"><?php echo getlevel($find_record['p_level'],$find_record['app_type']); ?></option><?php } ?>
  </select>
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head"><?php echo $SCategory; ?><span class="w3l-star"> * </span></label>
			    					<div class="form-group"><select class="form-control input-sm"   name='fac_01' id='fac_01' onchange='loadDept(this.name);return false;'  required='required'>
			    								    								<?php if($find_record['Faculty'] == ""){ ?>
  <option value="">Select <?php echo $SCategory; ?></option><?php }else{ ?> <option value="<?php echo $find_record['Faculty']; ?>"><?php echo getfacultyc($find_record['Faculty']); ?></option> <?php } ?>
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
</select>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Department<span class="w3l-star"> * </span></label>
			    					<div class="form-group"><select class="form-control input-sm"   name="dept1" id="dept1" onchange="showgroup(this.value)" required="required"> <?php if($find_record['Department'] == ""){ ?>
  <option value="">Select Department</option><?php }else{ ?> <option value="<?php echo $find_record['Department']; ?>"><?php echo getdeptc($find_record['Department']); ?></option> <?php } ?>
									 </select></div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Department Group</label>
			    					<div class="form-group" ><div  id="txtroomno" ><input type="text" name="d_group1" id="d_group1"   tabindex="1"  class="form-control input-sm" readonly> </div></div>
			    				</div>
			    				
			    			</div>
<div class="row"><div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Password *</label><div class="form-group" >
<input type="password" name="pword" id="pword"  <?php if($find_record['password'] == ""){ echo ""; }else{ echo "value='".$find_record['password']."'"; } ?> tabindex="1"  class="form-control input-sm" autcomplete="false" ></div> </div>		    			
			    			<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Comfirm Password *</label>
<div class="form-group" ><input type="password" name="pword2" id="pword2" <?php if($find_record['password'] == ""){ echo ""; }else{ echo "value='".$find_record['password']."'"; } ?>  tabindex="1"  class="form-control input-sm" autcomplete="false" > </div>
			    				</div>   			</div>
			    				<h5 class="panel-title"> Bio Data </h5>
			    		<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Surname<span class="w3l-star"> * </span></label>
			    					<div class="form-group"><input type="text" class="form-control input-sm" name="sname" id="sname"   tabindex="1" value="<?php echo $fname_e; ?>" required="required"></div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">First Name<span class="w3l-star"> * </span></label>
			    					<div class="form-group"><input type="text" class="form-control input-sm" name="mname" id="mname" tabindex="1" value="<?php echo $sname_e; ?>" required="required">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Other Name </label><div class="form-group"><input type="text" class="form-control input-sm" name="oname" id="oname" tabindex="2" value="<?php echo $oname_e; ?>" >
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Blood group</label>
			    					<div class="form-group"><select name="bloodgroup" id="bloodgroup"class="form-control input-sm" >
              <option value="A positive">A positive</option>
              <option value="A negative">A negative</option>
              <option value="B positive">B positive</option>
              <option value="B negative">B negative</option>
              <option value="AB positive">AB positive</option>
              <option value="AB negative">AB negative</option>
              <option value="O positive">O positive</option>
              <option value="O negative">O negative</option>
            </select></div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Gender<span class="w3l-star"> * </span></label>
			    				<?php $gender= $find_record['Gender']; ?>
			    					<div class="form-group"><div class="form-control input-sm"><input type="radio" value="Male" checked name="gender" id="Male" <?php
			echo ($gender == 'Male')?"checked":"" ;		?>> <span>Male</span> <input type="radio" value="Female"id="Female" name="gender" <?php
			echo ($gender == 'Female')?"checked":"" ;		?>> <span>Female</span> </div>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-3">
			    				<label class="head">Date of Birth * </label><div class="form-group">
<input   value="<?php echo $find_record['dob']; ?>" placeholder="Date format: 31/01/2019"  type="text" name="dob" class="form-control input-sm w8em format-d-m-y highlight-days-67 range-middle-today" id="ed12" >
			    					</div>
			    				</div>
			    			</div>
			    				<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Hobbies</label>
			    					<div class="form-group"><input type="text" class="form-control input-sm" name="hobbies" id="hobbies" tabindex="1" value="<?php echo $hobbies_e; ?>"></div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Genotype</label>
			    					<div class="form-group"><select class="form-control input-sm"  name="gtype" id="gtype"  >
			    					<?php if($find_record['gtype'] == ""){ ?>
  <option value="" selected="selected" >Select Genotype</option><?php }else{ ?> <option value="<?php echo $find_record['gtype']; ?>"><?php echo $find_record['gtype']; ?></option> <?php } ?>
<option  value="AA">AA</option>
<option value="AS">AS</option>
<option value="AC">AC</option><option value="SS">SS</option><option value="SC">SC</option><option value="CC">CC</option>

</select>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Religion</label><div class="form-group"><select class="form-control input-sm"  name="studentreligion" id="studentreligion"  >
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
			    			</div>
			    				<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Postal Address</label>
			    					<div class="form-group"><input type="text" class="form-control input-sm" name="p_add" id="p_add" tabindex="1" value="<?php echo $paddress_e; ?>"></div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Any Physical Disability?</label>
			    					<div class="form-group"><select name="f_chalenge" id="f_chalenge" class="form-control input-sm">
			    						<?php if($find_record['any_fchalenge'] == ""){ ?>
  <option value="" selected="selected" >Select</option><?php }else{ ?> <option value="<?php echo $find_record['any_fchalenge']; ?>"><?php echo $find_record['any_fchalenge']; ?></option> <?php } ?>
              <?php
	//echo "<option value=''>Select</option>";
		echo "<option value='Yes'>Yes</option>";
		echo "<option value='No'>No</option>";
	//}
	?>
              </select>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head" id="s1_chalenge" style="display: none;">If Yes Spacify</label><div class="form-group"><textarea name="s_chalenge" id="s_chalenge" tabindex="2" style="display: none;" class="form-control input-sm"> <?php echo $_POST['contactaddress']; ?></textarea></div></div>
			    				</div>
			    				<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Phone * </label>
			    					<div class="form-group"><input class="form-control input-sm" id="phone" type="tel" pattern="[+]?[\.\s\-\(\)\*\#0-9]{3,}" onkeypress="return isNumber(event);" maxlength="11" name="phone_no" required="required" tabindex="1" value="<?php echo $phone_e; ?>"/></div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Email Address *</label>
			    					<div class="form-group"> <input type="text" class="form-control input-sm" name="gemail" id="email" tabindex="4" value="<?php echo $email_e; ?>" >	</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
<label class="head" id="s1_chalenge">Contact Address</label><div class="form-group"><textarea name="contactaddress" id="contactaddress" tabindex="2" class="form-control input-sm"> <?php echo $address_e; ?></textarea></div>
			    				</div>
			    				
			    				
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">State *</label>
		<div class="form-group"><select name="state" id="state" class="form-control input-sm" onchange='loadlga(this.name);return false;'  required="required"> <?php if($find_record['state'] == ""){ ?>
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
			    					<div class="form-group"><select class="form-control input-sm"  name="lga" id="lga"  required="required" >
 <?php if($find_record['lga'] == ""){ ?>
  <option value="" selected="selected" >Select LGA</option><?php }else{ ?> <option value="<?php echo $find_record['lga']; ?>"><?php echo $find_record['lga']; ?></option> <?php } ?>
</select></div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head" id="s1_chalenge">Nationality</label><div class="form-group"><select class="form-control input-sm"  name="nation" id="nation"  > <?php if($find_record['nation'] == ""){ ?>
  <option value="" selected="selected" >Select Nationality</option><?php }else{ ?> <option value="<?php echo $find_record['nation']; ?>"><?php echo $find_record['nation']; ?></option> <?php } ?>
<option  value="Nigeria">Nigeria</option>
<option value="Others">Others</option>

</select></div>
			    				</div>
			    				
			    				
			    			</div>
                            <div class="row">
<div class="col-xs-6 col-sm-6 col-md-4" style="display: none;" id="lgidno">
			    				<label class="head">LG Identification Number </label>
<div class="form-group"><input class="form-control input-sm" id="lgidno" type="text"  name="lgidno"  tabindex="1" value="<?php echo $find_record['lgidno']; ?>"/></div></div>
</div>
			    		
			    				<button  name="old_register"  class="btn btn-primary"  title="Click Here to Save " type="submit">Save</button>
			    			<button  name="submit"  class="btn btn-primary"  title="Click Here to Exit Application Panel" id="button1"  onClick="window.location.href='index.php';" type="reset">Exit</button>
			    		<div class='imgHolder2' id='imgHolder2'><img src='css/images/tabLoad.gif'></div>
			    		</form>
			    	</div>
			    	</div></div>
			    	
	    		<div class="TabbedPanelsContent">
					<div id="center">
					<?php
				//$agens=	date("Y-m-d", strtotime($agen));
					//$age2=birthday($agens); 
						$school_form = mysqli_fetch_array(mysqli_query($condb," SELECT * FROM schoolsetuptd "));
						$schoolinitial =$school_form['initial'];
 $sql2="SELECT * FROM student_tb where RegNo = '$_POST[regnopic]' ";
  $qsql2= mysqli_query($condb,$sql2);
$rs2 = mysqli_fetch_array($qsql2);
$existn = imgExists("Student/".$rs2['images']);
$staffdb = mysqli_query($condb,"SELECT * FROM student_tb  where RegNo = '$_POST[regnopic]'");
$rs23 = mysqli_fetch_array($staffdb);

//if($_SESSION['insid3']==$_POST['insid3'])
//{
if(isset($_POST['SubmitForm'])){
 $name4     = $_FILES['image_name']['name'];
$tmpName  = $_FILES['image_name']['tmp_name'];
 $ext = strtolower(pathinfo($name4, PATHINFO_EXTENSION));
$maxsize = 300000;

if($_FILES['image_name']['name'] == Null)  {
	//$res="<font color='Red'><strong>Please Select an Image Before You Submit Your Application.</strong></font><br>";
				//$resi=1;
				message("Please Select an Image Before You Submit Your Application.", "error");
				   redirect('apply_b.php?view=O_C');
				}elseif($_SESSION['temppin'] == "" or $_POST['app_No'] == "" ){
message("You Have Not Completed Stage One Please Fill up and Continue.", "error");
				   redirect('apply_b.php?view=O_C');
//$res="<font color='Red'><strong>You Have Not Completed Stage One Please Fill up and Continue.</strong></font><br>";
			//	$resi=1;

}elseif(!in_array($ext, array('jpg','jpeg','png','gif')) ){
 	//$res="<font color='Red'><strong>Invalid file type. Only  JPG, GIF and PNG types are accepted.</strong></font><br>";
				//$resi=1;
		message("Invalid file type. Only  JPG, GIF and PNG types are accepted.", "error");
				   redirect('apply_b.php?view=O_C');
			}elseif(getimagesize($_FILES['image_name']['tmp_name']) < $maxsize){
	//$res="<font color='Red'><strong>File size should be greater than 300kb.</strong></font><br>";
				//$resi=1;
				message("File size should be greater than 300kb", "error");
				   redirect('apply_b.php?view=O_C');
			}elseif(!$_POST['approve']){
		//$res="<font color='Red'><strong>Your Have Not Approve Your Registration Information Click The Check Box to Approve !</strong></font><br>";
				//$resi=1;
			
					message("Your Have Not Approve Your Registration Information Click The Check Box to Approve", "error");
				   redirect('apply_b.php?view=O_C');

}else{
	$sql_complete="UPDATE student_tb SET reg_status ='$_POST[approve]',dateofreg = NOW() WHERE RegNo = '$_POST[regnopic]'";
					$result_complete = mysqli_query($condb,$sql_complete);
	list($txt2, $ext2) = explode(".", $_FILES['image_name']['name']);
if ($_FILES['image_name']['size'] !== 0){
                             
	                                while($r < 6){
								   $dig .=rand(3,9);
                                    $r+=1;
                                          }
                                         $newname=$dig . ".gif";
                                          //$newname = $dig.'.'.$ext2;
                                    $watermark = $schoolinitial;
							      	
							      //	$uploadfile = $newname;
							      	
					
$image = addslashes(file_get_contents($_FILES['image_name']['tmp_name']));
                                $image_name = addslashes($_FILES['image_name']['name']);
                                $image_size = getimagesize($_FILES['image_name']['tmp_name']);
                               $recordimage = move_uploaded_file($_FILES["image_name"]["tmp_name"], "Student/uploads/$newname");
                                $adminthumbnails = "uploads/" .$newname;
                               textwatermark($newname, $watermark, $newname);
mysqli_query($condb,"update student_tb set images = '".safee($condb,$adminthumbnails)."' where RegNo = '$_POST[regnopic]'");
								 
unset($dig);
$r=0;
//unlink("Student/uploads/$rs23[images]");
} 
 ob_start();
	echo "<script>alert('Your Have Sucessfully Completed The Form!');</script>";
		echo "<script>window.location.assign('studregprint.php?stid=".md5($_POST['regnopic'])."');</script>";
	

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
			    		<input type="hidden" name="insid3" value="<?php echo $_SESSION['insid3'];?> " />
			<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
			    		<div class="panel-heading">
			    	<h5 class="panel-title"> Registration ID </h5>
			 			</div>
				
					<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Matric Number</span></label>
			    					<div class="form-group"><input type="text" class="form-control input-sm" name="regnopic" id="regnopic"   tabindex="1" value="<?php echo $_SESSION['temppin']; ?>" readonly></div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Track No</label>
			    					<div class="form-group"><input type="text" class="form-control input-sm" name="app_No" id="app_No" tabindex="1"  value="<?php echo $find_record['appNo']; ?>" readonly>
			    					</div>
			    				</div>
			    				
			    			</div>
					<div class="panel-heading">
			    	<h5 class="panel-title"><strong>&nbsp;Upload Your Passport <font color="red"  size="2">(Note :Image Size Should Not be more than 300kb.)</font>&nbsp;&nbsp;</strong></h5>
			 			</div>
				<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Upload Passport</span></label>
			    <div class="form-group"><input name="image_name" class="form-control input-sm" id="fileInput" type="file" accept="image/*" onchange="preview_image(event)" style="width:200px;"></div></div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				<label class="head">Passport Preview</label>
			    					<div class="form-group"><div class="otherinputs"><div class="fileinput-new thumbnail" style="width: 200px; height: 150px; border: 1px solid #0080e5;">
<img src="<?php    if ($existn > 0 ){ echo "Student/".$rs2['images'];
	}else{ echo "Student/uploads/NO-IMAGE-AVAILABLE.jpg";}
	//if ($rs2['image']==NULL ){print "./Student/uploads/NO-IMAGE-AVAILABLE.jpg";}else{print $rs2['image'];}?>" alt="" id="output_image" style="width:200px;height: 150px;"> </div> </div>
			    					</div>
			    				</div></div>
				<div class="panel-heading">
			    	<h5 class="panel-title"><strong>&nbsp;Declaration and Undertaking <font color="red" size="2">(Note :After This Final Stage Information update will not be possible.)</font>&nbsp;&nbsp;</strong></h5>
			 			</div>
				
				<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-12">
			    			
			    					<div class="form-group">  <input id="approve" name="approve" value="1"  onclick="javascript: toggleCheckBox();" type="checkbox">
			
		I hereby acknowledge by ticking this check box that all the information Supplied are Correct and has been Verify By me.</div></div>
			    				</div>
			<!--	<input type="submit" value="Submit" class="btn btn-primary" title="Click to Submit Your Registration"> --!>
				 <button name="SubmitForm" class="btn btn-primary"  data-placement="right" type="submit" title="Click to Submit Your Registration">Submit</button>
				
				</div> 	</form> </div>
			
				</div>
				
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
 
   if($num_pin1 > 0 and $studentpics == Null){ ?>
<script language="JavaScript" type="text/javascript">
	var tp1 = new Spry.Widget.TabbedPanels("AccountSummaryPanel", { defaultTab: 1});

</script>

      <?php }else{ ?>
      <script language="JavaScript" type="text/javascript">
	var tp1 = new Spry.Widget.TabbedPanels("AccountSummaryPanel", { defaultTab: 0});

</script>
      <?php } ?>
      <?php if($num_pin1 < 1 ){ ?>
 <script language="JavaScript" type="text/javascript">
	var tp1 = new Spry.Widget.TabbedPanels("AccountSummaryPanel", { defaultTab: 0});
<?php } ?>
</script>

    
</div>


        </main>
    </section>
    
    