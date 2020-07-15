
<script type="text/javascript">
var xmlhttp

function loaddept(str1)
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
xmlhttp.onreadystatechange=stateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}

function stateChanged()
{
if (xmlhttp.readyState==4)
  {
  document.getElementById("dept_1").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';
  }
}

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
function loadlga(str1)
{var a=document.getElementById(str1)[document.getElementById(str1).selectedIndex].innerHTML;
if(a=='- Select State -'){ return;}
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
var url="load_lga.php";
url=url+"?loadfac="+d;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged2;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}
function stateChanged2()
{
if (xmlhttp.readyState==4)
  {
  document.getElementById("lga").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';
  }
}

function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}

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

if (!isset($_SESSION['temppin']) ||(trim ($_SESSION['temppin']) == '')) {
	header("location:apply_b.php");
    exit();
}

//session_start();
	$s=10;
	while($s>0){
		$AppNo .= rand(0,9);
		$s-=1;
	}
	  $sql_pin1="SELECT * FROM new_apply1 WHERE Pin='$_SESSION[temppin]'";
$result_pin1 = mysql_query($sql_pin1);
$num_pin1 = mysql_num_rows($result_pin1);
$find_record = mysql_fetch_array($result_pin1);

$sql_pin2="SELECT * FROM olevel_tb WHERE oPin='$_SESSION[temppin]'";
$result_pin2 = mysql_query($sql_pin2);
$num_pin2 = mysql_num_rows($result_pin2);
$find_record2 = mysql_fetch_array($result_pin2);
//if($_SESSION['temppin'] = "" ){

		//echo "<script>window.location.assign('apply_b.php?view=New');</script>";
		//}
//ini_set('display_errors', 1);
if($_SESSION['insid']==$_POST['insid'])
{
if(isset($_POST['Continue'])){
 $Pin = $_POST["pin"];
$serial = $_POST["serial"];
$j_reg = $_POST['j_reg'];
$phone_no = $_POST["phone_no"];
$mm = trim(strip_tags($_POST['mm']));
	$dd = trim(strip_tags($_POST['dd']));
	$yy = trim(strip_tags($_POST['yy']));
//$dob = $_POST['endDate'];
$dob = $yy."-".$mm."-".$dd;
$age=date('Y')- $yy;

	$sql_pin="SELECT * FROM new_apply1 WHERE JambNo='$j_reg'";
$result_pin = mysql_query($sql_pin);
$num_pin = mysql_num_rows($result_pin);

	$sql_ph="SELECT * FROM new_apply1 WHERE phone='$phone_no'";
$result_ph = mysql_query($sql_ph);
$num_ph = mysql_num_rows($result_ph);

	if($Pin == "" AND $serial == "" ){
echo "<script>alert('Unable To Continue Registration Because Payment Information Not Verified');</script>";
redirect("apply_b.php?view=New");
//echo "<script>window.location.assign('apply_b.php?view=New');</script>";
	//$res="<font color='Red'><strong>Unable To Continue Registration Please Or Payment Information Not Verified.Click Here to Try Again</strong></font><br>";
				$resi=1;
					}elseif($num_pin > 0){
		$res="<font color='Red'><strong>This Jamb Registration Number '$j_reg' Has Applied Before.</strong></font><br>";
				$resi=1;
				}elseif(strpos($num_pin," ")){
		$res="<font color='Red'><strong>Please! Jamb Reg Number can not Contain a Space..</strong></font><br>";
				$resi=1;
				}elseif(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $_POST['gemail'])){
		$res="<font color='Red'><strong>Please! Provide a valid Email Address...</strong></font><br>";
				$resi=1;
				}elseif($num_ph > 0){
        $res="<font color='Red'><strong>Another Person Has Applied with This Mobile Number '$phone_no' Before.</strong></font><br>";
				$resi=1;
				}else{
				if($num_pin1 > 0){
				$sql_ME="UPDATE new_apply1 SET FirstName='$_POST[sname]',SecondName='$_POST[sname]',Othername='$_POST[mname]',Gender='$_POST[gender]',dob='$dob',hobbies='$_POST[hobbies]',state='$_POST[state]',lga='$_POST[lga]',nation='$_POST[nation]',religion='$_POST[studentreligion]',address='$_POST[contactaddress]',e_address='$_POST[gemail]',phone='$_POST[phone_no]',postal_address='$_POST[p_add]',any_fchalenge='$_POST[f_chalenge]',State_chalenge='$_POST[s_chalenge]',first_Choice='$_POST[dept_1]',Second_Choice='$_POST[dept_2]',fact_1='$_POST[fac_01]',fact_2='$_POST[fac_02]',Age='$age',bloodgroup='$_POST[bloodgroup]',gtype='$_POST[gtype]',Pin='$Pin',SerialNo='$serial',JambNo='$j_reg',J_score='$_POST[j_score]',app_type='$_POST[prog]',Asession='$_POST[session]' WHERE Pin= '$Pin'";
					$result_qsql2 = mysql_query($sql_ME);

				}else{
				$sql="INSERT INTO new_apply1 (appNo,FirstName,SecondName,Othername,Gender,dob,hobbies,state,lga,nation,religion,address,e_address,phone,postal_address,any_fchalenge,State_chalenge,first_Choice,Second_Choice,fact_1,fact_2,Age,bloodgroup,gtype,Pin,SerialNo,JambNo,J_score,app_type,Asession,course_choice,verify_apply,adminstatus)
VALUES('$_POST[appNo]','$_POST[sname]','$_POST[mname]','$_POST[oname]','$_POST[gender]','$dob','$_POST[hobbies]','$_POST[state]','$_POST[lga]','$_POST[nation]','$_POST[studentreligion]','$_POST[contactaddress]','$_POST[gemail]','$_POST[phone_no]','$_POST[p_add]','$_POST[f_chalenge]','$_POST[s_chalenge]','$_POST[dept_1]','$_POST[dept_2]','$_POST[fac_01]','$_POST[fac_02]','$age','$_POST[bloodgroup]','$_POST[gtype]','$Pin','$serial','$j_reg','$_POST[j_score]','$_POST[prog]','$_POST[session]','1','FALSE','0'
)";
	if(!$qsql= mysql_query($sql))

	{
		echo mysql_error();
		//echo "<script>alert('Unable to Complete Student Registration Please Try Again..');</script>";
		//	echo "<script>window.location.assign('studentReg.php');</script>";
			$res="<font color='Red'><strong>Unable to Continue Application Please Try Again...</strong></font><br>";
				$resi=1;
			exit();
	}
}

	$sql2="UPDATE pin SET status='USED' WHERE pinnumber='$Pin'";
$result_upme = mysql_query($sql2);
//if(isset($_POST['Continue'])){
if($num_pin1 > 0){
				//header("location:apply_b.php?view=N_1");?>
				<script language="JavaScript" type="text/javascript">
	var tp1 = new Spry.Widget.TabbedPanels("AccountSummaryPanel", { defaultTab: 1});

</script>
		<?php 
		echo "<script>alert('Record Successfully Add Goto Step 2');</script>";
			//	echo "<script>window.location.assign('apply_b.php?view=N_1');</script>";
				redirect("apply_b.php?view=N_1");
		}	}

}}$_SESSION['insid'] = rand();


?>
  <div class="container">
   <br><br>
    <h1 class="shadowed" style="color:black;text-shadow:-1px 1px 1px #000;">Welcome to the Online Application For Admission </h1>
     	
		 <div class="boxes-holder" style="background-color:#D9F7FD;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:980px;min-width:150px">
   
       <div class="entry products">
       <h3 style="color:orange;text-shadow:0 2px 1px black;">Kindly fill the following registration form with valid records.</h3><br>
       
		 <div class="TabbedPanels" id="AccountSummaryPanel">
		<ul class="TabbedPanelsTabGroup"> 
			<li class="TabbedPanelsTab" tabindex="0" ><img src="css/images/tab1.png"></li>
			<li class="TabbedPanelsTab" tabindex="0" ><img src="css/images/tab2.png" ></li>
			<li class="TabbedPanelsTab" tabindex="0"><img src="css/images/tab3.png"></li>
		</ul>
		<div class="TabbedPanelsContentGroup">
			<div class="TabbedPanelsContent">
		   	<div id="center">

		<div class="inner_right_demo">
		<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			<input type="hidden" name="insid" value="<?php echo $_SESSION['insid']; ?> " />
			<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
			<input type="hidden" name="appNo" value="<?php echo "A". $AppNo;?>"  />
			<div class="form_box">
			 <div class="clear">
        <table width="400" height="100" >
        
        <tr style="">
    <td colspan="4" height="36" width="69%"><center><?php
if($resi == 1)
{

echo " <div class=\"alert alert-info\"><i class=\"icon-info-sign\"></i> $res </div> ";
					//echo " $res";
}
?></center></td>

    </tr>
    
 

		 <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
    <td colspan="5" height="39" style="text-shadow: 2px 2px white;"><strong>&nbsp;Basic Details</strong></td>
    
    </tr>
  <tr >
            <td width="27%" height="40">Pin:</td>
            <td width="24%" ><input type="text" name="pin" id="pin"   tabindex="1" value="<?php echo $_SESSION['temppin']; ?>" readonly></td>
            <td width="26%">Serial</td>
            <td width="23%"><input type="text" name="serial" id="serial" tabindex="1" value="<?php echo $_SESSION['tempserial']; ?>" readonly></td>
          </tr>
  <tr>
    <td width="19%">Application Type:</td>
    <td width="31%"><select class="input-medium"   name="prog" id="prog"  required="required">
  <option value="">Select</option>
   
<?php  
$resultcourse = mysql_query("SELECT * FROM prog_tb where status = '1' ORDER BY Pro_name ASC");
while($rscourse = mysql_fetch_array($resultcourse))
{
echo "<option value='$rscourse[Pro_name]'>$rscourse[Pro_name]</option>";	
}
?>
</select></td>
    <td width="19%">Session:</td>
    <td width="31%"><select class="input-medium"   name="session" id="session"  required="required">
  <option value="">Select Session</option>
<?php  
$resultsec = mysql_query("SELECT * FROM session_tb where action = '1' ORDER BY session_name ASC");
while($rssec = mysql_fetch_array($resultsec))
{
echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	
}
?>
</select></td>
    
    
  </tr>
  
  <tr >
            <td width="27%" height="40">Jamb Reg No:</td>
            <td width="24%" ><input type="text" name="j_reg" id="j_reg"   tabindex="1" value="<?php echo $_POST['sname']; ?>" required="required"></td>
            <td width="26%">Jamb Score</td>
            <td width="23%"><input type="text" name="j_score" id="j_score" tabindex="1" onkeypress="return isNumber(event);" value="0" required="required"></td>
          </tr>
          
          	 <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
    <td colspan="5" height="39" style="text-shadow: 2px 2px white;"><strong>&nbsp;Choice of Course/Program</strong></td>
    
    </tr>
    
    <tr >
            <td height="30">First Choice:</td>
            <td>
                           <select class="input-large"  name="fchoice" id="fchoice"  required="required">
<option value="" selected="selected" disabled="disabled">Select</option>
<option  value="1">First</option>

</select>
            
            </td>
            <td>Second Choice:</td>
            <td> <select class="input-large"  name="s_choice" id="s_choice"  required="required">
<option value="" selected="selected" disabled="disabled">Select</option>
<option  value="2">Second</option>

</select></td>
             </tr>
             
               <tr>
    <td width="19%">Faculty:</td>
    <td width="31%"><select class="input-medium"   name='fac_01' id='fac_01' onchange='loaddept(this.name);return false;'  required='required'>
  <option value="">Select Faculty</option>
                            <?php  
$resultfac1 = mysql_query("SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//$counter=1;
while($rsfac_1 = mysql_fetch_array($resultfac1))
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
</select></td>
    <td width="19%">Faculty:</td>
    <td width="31%"><select class="input-medium"   name="fac_02" id="fac_02" onchange="loaddept1(this.name);return false;"  required="required">
  <option value="">Select Faculty</option>
                          <?php  

$resultblocks = mysql_query("SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//$counter=1;
while($rsblocks = mysql_fetch_array($resultblocks))
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
</select></td>
    </tr>
  
    <tr>
    <td width="19%">Department:</td>
    <td width="31%"><select class="input-medium"   name="dept_1" id="dept_1"  required="required">
  <option value="">Select Department</option>


</select></td>

    <td width="19%">Department:</td>
    <td width="31%"><select class="input-medium"   name="dept_2" id="dept_2"  required="required">
  <option value="">Select Department</option>


</select></td>
    
    
  </tr>
             
   <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
            <td height="39" colspan="4" style="text-shadow: 2px 2px white;"><strong>&nbsp;Personal Data:</strong></td>
          </tr>
          <tr >
            <td width="27%" height="40">Surname:</td>
            <td width="24%" ><input type="text" name="sname" id="sname"   tabindex="1" value="<?php echo $_POST['sname']; ?>" required="required"></td>
            <td width="26%">First Name </td>
            <td width="23%"><input type="text" name="mname" id="mname" tabindex="1" value="<?php echo $_POST['mname']; ?>" required="required"></td>
          </tr>
          <tr >
            <td height="43">Other Name:</td>
            <td><input type="text" name="oname" id="oname" tabindex="2" value="<?php echo $_POST['oname']; ?>" required="required"></td>
            <td>Blood group:</td>
            <td><select name="bloodgroup" id="bloodgroup">
              <option value="A positive">A positive</option>
              <option value="A negative">A negative</option>
              <option value="B positive">B positive</option>
              <option value="B negative">B negative</option>
              <option value="AB positive">AB positive</option>
              <option value="AB negative">AB negative</option>
              <option value="O positive">O positive</option>
              <option value="O negative">O negative</option>
            </select></td>
          </tr>
          <tr >
            <td height="30">Gender:</td>
            <td> 
<div class="otherinputs"><input type="radio" value="Male" checked name="gender" id="Male"> <span>Male</span> <input type="radio" value="Female"id="Female" name="gender"> <span>Female</span> </div>
</td>
            <td>Date of Birth:</td>
           
			<td>
<select class="input-small" name="mm" id="mm" style="width:100px;" >
<option value="00">MM</option>
<option value="01">January</option>
<option value="02">February</option> 
<option value="03">March</option>
<option value="04">April</option> 
<option value="05">May</option> 
<option value="06">June</option> 
<option value="07">July</option> 
<option value="08">August</option> 
<option value="09">September</option> 
<option value="10">October</option> 
<option value="11">November</option> 
<option value="12">December</option> 
</select>

 <select class="input-small" name="dd" id="dd" style="width:65px;">
<option value="00">DD</option>
<?php for($x=1;$x<32;$x++){
	echo '<option value="'.$x.'">'.$x.'</option>';
	} ?>
    </select>
    
     <select class="input-small" name="yy" id="yy" style="width:70px;">
<option>YY</option>
<?php for($x=1950;$x<2020;$x++){
	echo '<option value="'.$x.'">'.$x.'</option>';
	} ?>
    </select>

</td>
			</td>
          </tr>
           <tr >
            <td height="30">Hobbies:</td>
            <td><input type="text" name="hobbies" id="hobbies" tabindex="1" value="<?php echo $_POST['hobbies']; ?>"></td>
           <td>Genotype:</td>
            <td><!-- <input type="text" name="gtype" id="gtype" tabindex="1" value="<?php echo $_POST['gtype']; ?>"> --!>
							<select class="input-large"  name="gtype" id="gtype"  >
<option value="" selected="selected" >Select Genotype</option>
<option  value="AA">AA</option>
<option value="AS">AS</option>
<option value="AC">AC</option><option value="SS">SS</option><option value="SC">SC</option><option value="CC">CC</option>

</select>
			</td>
          </tr>
          <tr >
            <td height="30">Religion:</td>
            <td>
                           <select class="input-large"  name="studentreligion" id="studentreligion"  required="required">
<option value="" selected="selected" disabled="disabled">Select</option>
<option  value="Hindu">Hindu</option>
<option value="Muslim">Muslim</option>
<option value="Christian">Christian</option>
<option value="Jain">Jain</option>
<option value="Jewish">Jewish</option>
<option value="Pegan">Pegan</option>
<option value="Other">Other</option>
</select>
            
            </td>
            <td>Postal Address:</td>
            <td><input type="text" name="p_add" id="p_add" tabindex="1" value="<?php echo $_POST['gtype']; ?>"></td>
             </tr>
              <tr>
            <td>Any Physical Disability?</td>
            <td><p>
              <select name="f_chalenge" id="f_chalenge">
              <?php
//	$arr = array("Select","Yes", "No");
	//foreach($arr as $val)
	//{
		echo "<option value=''>Select</option>";
		echo "<option value='Yes'>Yes</option>";
		echo "<option value='No'>No</option>";
	//}
	?>
              </select>
            </p>
            </td>
            <td id="s1_chalenge" style="display: none;">If Yes Explain:</td>
          <td id="contact Address" ><textarea name="s_chalenge" id="s_chalenge" tabindex="2" style="display: none;"> <?php echo $_POST['contactaddress']; ?></textarea></td>
          </tr>
            <tr >
            <td>Phone:</td>
            <td>
			<input class="medium" id="phone" type="tel" pattern="[+]?[\.\s\-\(\)\*\#0-9]{3,}" onkeypress="return isNumber(event);" maxlength="11" name="phone_no" required="required" tabindex="1" value="<?php echo $_POST['gphone']; ?>"/>
			</td>
			 <td height="43">Email Address:</td>
            <td>
                <input type="text" name="gemail" id="email" tabindex="4" value="<?php echo $_POST['gemail']; ?>" >
             </td
          </tr>
          <tr >
          <td>Contact Address:</td>
          <td id="contact Address"><textarea name="contactaddress" id="contactaddress" tabindex="2"> <?php echo $_POST['contactaddress']; ?></textarea></td>
           <td height="30">State:</td>
          <td><p id="mobile  number">
          <select name="state" id="state" onchange='loadlga(this.name);return false;'>
              <option value="" selected="selected">- Select -</option>
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
            </select>
          </p></td>
        </tr>
        <tr >
         
              <td>Nationality:</td>
          <td> <!-- <input type="text" name="nation" id="nation" tabindex="1" value="<?php //echo $_POST['nation']; ?>"> --!>
		                            
									<select class="input-large"  name="nation" id="nation"  required="required">
<option value="" selected="selected" >Select Nationality</option>
<option  value="Nigeria">Nigeria</option>
<option value="Others">Others</option>

</select>
		  </td>
		  
         <td>Local Government:</td>
          <td> <!-- <input type="text" name="lga" id="lga" tabindex="12" value="<?php //echo $_POST['lga']; ?>"> --!>
		  						<select class="input-large"  name="lga" id="lga"  >
<option value="" selected="selected" >Select LGA</option>



</select>
		  </td>
   
        </tr>
        <tr >
     
   <tr >
    <td width="19%" height="20"></td>
    
  </tr>
		
		<tr >
          <td height="10">
		  
		  </td>
          <td  height="10">
          
          <button name="Continue" class="Button1"  id="button1" data-placement="right" type="submit" title="Click to Contine">Save</button>
												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#Button1').tooltip('show');
	                                            $('#Button1').tooltip('hide');
	                                            });
	                                            </script>
           <td height="10"><button  name="submit"  class="button1"  title="Click Here to Exit Application Panel" id="button1"  onClick="window.location.href='cancel.php';" type="reset">Exit</button></td>
              <div class='imgHolder2' id='imgHolder2'><img src='css/images/tabLoad.gif'></div>
											
          </td>
          
          
        </tr>
		</table>
            
      </div>
	
			</div>
			</form>
		</div></div>
	
			</div>
			<div class="TabbedPanelsContent">
				<div id="center">
				<?php
 

if($_SESSION['insid2']==$_POST['insid2'])
{
if(isset($_POST['Continue2'])){
 $Pin = $_POST["pin"];
$serial = $_POST["serial"];
$j_reg = $_POST['j_reg'];
$phone_no = $_POST["phone_no"];
$mm = trim(strip_tags($_POST['mm']));
	$dd = trim(strip_tags($_POST['dd']));
	$yy = trim(strip_tags($_POST['yy']));
//$dob = $_POST['endDate'];
$dob = $yy."-".$mm."-".$dd;
$age=date('Y')- $yy;

	$sql_olevelpin="SELECT * FROM olevel_tb WHERE oJambNo='$_POST[j_reg2]'";
$result_olevelp = mysql_query($sql_olevelpin);
$num_opin = mysql_num_rows($result_olevelp);

	//$sql_ph="SELECT * FROM new_apply1 WHERE phone='$phone_no'";
//$result_ph = mysql_query($sql_ph);
//$num_ph = mysql_num_rows($result_ph);
	if($Pin == "" AND $serial == "" ){
echo "<script>alert('Unable To Continue Registration Because Payment Information Not Verified');</script>";
//echo "<script>window.location.assign('apply_b.php?view=New');</script>";
redirect("apply_b.php?view=New");
					}elseif($num_opin > 1){

		$res="<font color='Red'><strong>This Jamb Registration Number '$_POST[j_reg2]' Has Applied Before.</strong></font><br>";
				$resi=1;
				}elseif(strpos($_POST['j_reg2']," ")){
		$res="<font color='Red'><strong>Please! Jamb Reg Number can not Contain a Space..</strong></font><br>";
				$resi=1;
			
				}else{
				if($num_pin2 > 0){
				$sql_ME2="UPDATE olevel_tb SET oPin='$_POST[pin]',oJambNo='$_POST[j_reg2]',oapp_No='$_POST[app_No]',oNo_re='$_POST[No_result]',oExam_t1='$_POST[exam_type]',oExam_t2='$_POST[exam_type2]',oExam_no1='$_POST[e_number]',oExam_no2='$_POST[e_number1]',oExam_y1='$_POST[e_date]',oExam_y2='$_POST[e_date1]',oSub1='$_POST[Sub_1]',oSub2='$_POST[Sub_2]',oSub3='$_POST[Sub_3]',oSub4='$_POST[Sub_4]',oSub5='$_POST[Sub_5]',oSub6='$_POST[Sub_6]',oSub7='$_POST[Sub_7]',oGrade_1='$_POST[grade_1]',oGrade_2='$_POST[grade_2]',oGrade_3='$_POST[grade_3]',oGrade_4='$_POST[grade_4]',oGrade_5='$_POST[grade_5]',oGrade_6='$_POST[grade_6]',oGrade_7='$_POST[grade_7]' WHERE oPin= '$_POST[pin]'";
					$result_qsql20 = mysql_query($sql_ME2);

				}else{
				$sql_OLEVEL="INSERT INTO olevel_tb (oPin,oJambNo,oapp_No,oNo_re,oExam_t1,oExam_t2,oExam_no1,oExam_no2,oExam_y1,oExam_y2,oSub1,oSub2,oSub3,oSub4,oSub5,oSub6,oSub7,oGrade_1,oGrade_2,oGrade_3,oGrade_4,oGrade_5,oGrade_6,oGrade_7)
VALUES('$_POST[pin]','$_POST[j_reg2]','$_POST[app_No]','$_POST[No_result]','$_POST[exam_type]','$_POST[exam_type2]','$_POST[e_number]','$_POST[e_number1]','$_POST[e_date]','$_POST[e_date1]','$_POST[Sub_1]','$_POST[Sub_2]','$_POST[Sub_3]','$_POST[Sub_4]','$_POST[Sub_5]','$_POST[Sub_6]','$_POST[Sub_7]','$_POST[grade_1]','$_POST[grade_2]','$_POST[grade_3]','$_POST[grade_4]','$_POST[grade_5]','$_POST[grade_6]','$_POST[grade_7]')";
	if(!$qsqlo= mysql_query($sql_OLEVEL))
	{
		echo mysql_error();
		//echo "<script>alert('Unable to Complete Student Registration Please Try Again..');</script>";
		//	echo "<script>window.location.assign('studentReg.php');</script>";
			$res="<font color='Red'><strong>Unable to Continue Application Please Try Again...</strong></font><br>";
				$resi=1;
			exit();
	}
}

if($num_pin2 > 0){
				//header("location:apply_b.php?view=N_1");?>
				<script language="JavaScript" type="text/javascript">
	var tp1 = new Spry.Widget.TabbedPanels("AccountSummaryPanel", { defaultTab: 2});

</script>
		<?php 
		echo "<script>alert('Record Successfully Add Goto Final Step');</script>";
			//echo "<script>window.location.assign('apply_b.php?view=N_1');</script>";
			redirect("apply_b.php?view=N_1");
			
		}	}

}}$_SESSION['insid2'] = rand();
?>
		<div class="inner_right_demo">
		<form name="register3" action="" method="post" enctype="multipart/form-data" id="register3">
			<input type="hidden" name="insid2" value="<?php echo $_SESSION['insid2'];?> " />
			<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
			<input type="hidden" name="appNo" value="<?php echo "A". $AppNo;?>"  />
			<div class="form_box">
			 <div class="clear">
        <table width="400" height="70" >
        
        <tr style="">
    <td colspan="4" height="36" width="69%"><center><?php
if($resi == 1)
{

echo " <div class=\"alert alert-info\"><i class=\"icon-info-sign\"></i> $res </div> ";
					//echo " $res";
}
?></center></td>

    </tr>
    
 

		 <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
    <td colspan="5" height="39" style="text-shadow: 2px 2px white;"><strong>&nbsp;Basic Details</strong></td>
    
    </tr>
  <tr >
            <td width="27%" height="40">Pin:</td>
            <td width="24%" ><input type="text" name="pin" id="pin"   tabindex="1" value="<?php echo $_SESSION['temppin']; ?>" readonly></td>
            <td width="26%">Serial</td>
            <td width="23%"><input type="text" name="serial" id="serial" tabindex="1" value="<?php echo $_SESSION['tempserial']; ?>" readonly></td>
          </tr>
 
  
  <tr >
            <td width="27%" height="40">Jamb Reg No:</td>
            <td width="24%" ><input type="text" name="j_reg2" id="j_reg2"   tabindex="1" value="<?php echo $find_record['JambNo']; ?>" readonly></td>
            <td width="26%">Application No</td>
            <td width="23%"><input type="text" name="app_No" id="app_No" tabindex="1"  value="<?php echo $find_record['appNo']; ?>" readonly></td>
          </tr>
          
          	 
             
   <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
            <td height="39" colspan="4" style="text-shadow: 2px 2px white;"><strong>&nbsp;Post Primary School Qualification (WAEC,NECO,GCE,NECO-GCE)&nbsp;&nbsp;</strong></td>
          </tr>
          <tr >
          <td  height="30" >Number Of Result:</td>
            <td><select name="No_result" id="No_result" required="required">
             <option value="">Select</option>
              <option value="1">1</option>
              <option value="2">2</option>
             </select></td>
            
            <td>Exam Type</td>
            <td>
		<select name="exam_type" id="exam_type" class="input-small" style="width:140px;" required="required" >
            <option value="">Exam Type One</option>
              <option value="WAEC">WAEC</option>
              <option value="NECO">NECO</option>
              <option value="GCE">GCE</option>
              <option value="NECO-GCE">NECO-GCE</option>
              <option value="NABTEB">NABTEB</option>
            </select>
           <select name="exam_type2"  id="exam_t6" style="display:none;" class="input-small" style="width:140px;"  >
              <option value="">Exam Type Two</option>
              <option value="WAEC">WAEC</option>
              <option value="NECO">NECO</option>
              <option value="GCE">GCE</option>
              <option value="NECO-GCE">NECO-GCE</option>
              <option value="NABTEB">NABTEB</option>
              </select>
			  
			  </td>
			  <td></td>
          </tr>
          
           
          <tr>
            <td width="26%">Exam Number </td>
            <td width="24%" ><input type="text" name="e_number" id="e_number"   tabindex="1" value="" required="required"></td>
            <td width="27%" height="40">Exam Year:</td>
            <td width="24%" >
			<select class="input-small" name="e_date" id="e_date" style="width:140px;" required="required">
<option value="">Year</option>
<?php for($x=1980;$x<2021;$x++){
	echo '<option value="'.$x.'">'.$x.'</option>';
	} ?>
    </select>
			</td>
          </tr>
          
           <tr >
            <td width="26%" style="display: none;" id="exam_t1">Exam Number2 </td>
            <td width="24%" style="display: none;" id="exam_t2"><input type="text" name="e_number1" id="e_number1"   tabindex="1" value="" ></td>
            <td width="27%" height="40" style="display: none;" id="exam_t3">Exam Year2:</td>
            <td width="24%" style="display: none;" id="exam_t4">
				<select class="input-small" name="e_date1" id="e_date1" style="width:140px;" >
<option value="">Year</option>
<?php for($x=1980;$x<2021;$x++){
	echo '<option value="'.$x.'">'.$x.'</option>';
	} ?>
    </select>
			
			</td>
          </tr>
          
          <tr >
            <td height="10">Subjects:</td><td height="10"></td>
            <td height="10">Grades:</td><td height="10"></td>
          </tr>
          
          <tr >
            <td height="10">1</td><td height="10"><select class="input-medium"   name="Sub_1" id="Sub_1"   required="required">
  <option value="">Select Subject</option>
 <?php  include('sub_load.php');   ?>
</select></td>
            <td height="10">1</td><td height="10"><select class="input-medium"   name="grade_1" id="grade_1"   required="required">
  <option value="">Select Grade</option>
  <?php  include('grade_load.php');   ?>
</select></td>
          </tr>
          
          <tr >
            <td height="10">2</td><td height="10"><select class="input-medium"   name="Sub_2" id="Sub_2"   required="required">
  <option value="">Select Subject</option>
  <?php  include('sub_load.php');   ?>
</select></td>
            <td height="10">2</td><td height="10"><select class="input-medium"   name="grade_2" id="grade_2"   required="required">
  <option value="">Select Grade</option>
 <?php  include('grade_load.php');   ?>
</select></td>
          </tr>
          
          <tr>
            <td height="10">3</td><td height="10"><select class="input-medium"   name="Sub_3" id="Sub_3"   required="required">
  <option value="">Select Subject</option>
  <?php  include('sub_load.php');   ?>
</select></td>
            <td height="10">3</td><td height="10"><select class="input-medium"   name="grade_3" id="grade_3"   required="required">
  <option value="">Select Grade</option>
  <?php  include('grade_load.php');   ?>
</select></td>
          </tr>
         
         <tr >
            <td height="10">4</td><td height="10"><select class="input-medium"   name="Sub_4" id="Sub_4"   required="required">
  <option value="">Select Subject</option>
  <?php  include('sub_load.php');   ?>
</select></td>
            <td height="10">4</td><td height="10"><select class="input-medium"   name="grade_4" id="grade_4"   required="required">
  <option value="">Select Grade</option>
  <?php  include('grade_load.php');   ?>
</select></td>
          </tr>
         <tr >
            <td height="10">5</td><td height="10"><select class="input-medium"   name="Sub_5" id="Sub_5"   required="required">
  <option value="">Select Subject</option>
  <?php  include('sub_load.php');   ?>
</select></td>
            <td height="10">5</td><td height="10"><select class="input-medium"   name="grade_5" id="grade_5"   required="required">
  <option value="">Select Grade</option>
  <?php  include('grade_load.php');   ?>
</select></td>
          </tr>
          
          <tr >
            <td height="10">6</td><td height="10"><select class="input-medium"   name="Sub_6" id="Sub_6"   >
  <option value="">Select Subject</option>
  <?php  include('sub_load.php');   ?>
</select></td>
            <td height="10">6</td><td height="10"><select class="input-medium"   name="grade_6" id="grade_6"   >
  <option value="">Select Grade</option>
  <?php  include('grade_load.php');   ?>
</select></td>
          </tr>
          
          <tr >
            <td height="10">7</td><td height="10"><select class="input-medium"   name="Sub_7" id="Sub_7"   >
  <option value="">Select Subject</option>
  <?php  include('sub_load.php');   ?>
</select></td>
            <td height="10">7</td><td height="10"><select class="input-medium"   name="grade_7" id="grade_7"   >
  <option value="">Select Grade</option>
  <?php  include('grade_load.php');   ?>
</select></td>
          </tr>
        
        <tr >
     
   <tr >
    <td width="19%" height="20"></td>
    
  </tr>
		
		<tr >
          <td height="10">
		  
		  </td>
          <td  height="10">
          
          <button name="Continue2" class="Button1"  id="button1" data-placement="right" type="submit" title="Click to Contine">Save</button>
												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#Button1').tooltip('show');
	                                            $('#Button1').tooltip('hide');
	                                            });
	                                            </script>
           <td height="10"><button  name="submit"  class="button1"  title="Click Here to Exit Application Panel" id="button1"  onClick="window.location.href='cancel.php';" type="reset">Exit</button></td>
              <div class='imgHolder2' id='imgHolder2'><img src='css/images/tabLoad.gif'></div>
											
          </td>
          
          
        </tr>
		</table>
            
      </div>
	
			</div>
			</form>
		</div></div>
	
			</div>
		
			<div class="TabbedPanelsContent">
					<div id="center">
					
					<?php
						$school_form = mysql_fetch_array(mysql_query(" SELECT * FROM schoolsetuptd "));
						$schoolinitial =$school_form['initial'];
 $sql2="SELECT * FROM new_apply1 where appNo = '$_POST[app_No]' ";
  $qsql2= mysql_query($sql2);
$rs2 = mysql_fetch_array($qsql2);

$staffdb = mysql_query("SELECT * FROM new_apply1  where appNo = '$_POST[app_No]'");
$rs23 = mysql_fetch_array($staffdb);

if($_SESSION['insid3']==$_POST['insid3'])
{
if(isset($_POST['SubmitApp'])){
 $name4     = $_FILES['image_name']['name'];
$tmpName  = $_FILES['image_name']['tmp_name'];
 $ext = strtolower(pathinfo($name4, PATHINFO_EXTENSION));
$maxsize = 300000;

if($_FILES['image_name']['size'] == Null)  {
	$res="<font color='Red'><strong>Please Select an Image Before You Submit Your Application.</strong></font><br>";
				$resi=1;
				}elseif($_SESSION['temppin'] == "" AND $_SESSION['tempserial'] == "" ){
echo "<script>alert('Unable To Continue Registration Because Payment Information Not Verified');</script>";
//echo "<script>window.location.assign('apply_b.php?view=New');</script>";
	redirect("apply_b.php?view=New");

}elseif(!in_array($ext, array('jpg','jpeg','png','gif')) ){
 	$res="<font color='Red'><strong>Invalid file type. Only  JPG, GIF and PNG types are accepted.</strong></font><br>";
				$resi=1;
			//}elseif($_FILES["image_name"]["size"] > $maxsize)  {
			}elseif(getimagesize($_FILES['image_name']['tmp_name']) < $maxsize){
	$res="<font color='Red'><strong>File size should be less than 300kb.</strong></font><br>";
				$resi=1;
			}elseif(!$_POST['approve']){
		$res="<font color='Red'><strong>Your Have Not Approve Your Application Information Click The Check Box to Approve !</strong></font><br>";
				$resi=1;

}else{
	$sql_complete="UPDATE new_apply1 SET reg_status ='$_POST[approve]',dateofreg = NOW() WHERE appNo = '$_POST[app_No]'";
					$result_complete = mysql_query($sql_complete);

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
                                $adminthumbnails = "uploads/" .$newname;
                               textwatermark($newname, $watermark, $newname);
mysql_query("update new_apply1 set images = '".mysql_real_escape_string($adminthumbnails)."' where appNo = '".mysql_real_escape_string($_POST['app_No'])."'");
								 
unset($dig);
$r=0;
unlink("Student/$rs23[images]");
} 
 ob_start();
	echo "<script>alert('Your Application was Sucessfully Submited!');</script>";
		echo "<script>window.location.assign('studentappprint.php?applicationid=".md5($_POST['app_No'])."');</script>";
	

}
}}$_SESSION['insid3'] = rand();
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

				<div class="inner_right_demo">
		<form name="register3" action="" method="post" enctype="multipart/form-data" id="register3">
			<input type="hidden" name="insid3" value="<?php echo $_SESSION['insid3'];?> " />
			<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
			
			<div class="form_box">
			 <div class="clear">
        <table width="400" height="70" >
        
        <tr style="">
    <td colspan="4" height="36" width="69%"><center><?php
if($resi == 1)
{

echo " <div class=\"alert alert-info\"><i class=\"icon-info-sign\"></i> $res </div> ";
					//echo " $res";
}
?></center></td>

    </tr>
    
 

		 <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
    <td colspan="5" height="39" style="text-shadow: 2px 2px white;"><strong>&nbsp;Basic Details</strong></td>
    
    </tr>
  <tr >
            <td width="27%" height="40">Pin:</td>
            <td width="24%" ><input type="text" name="pin" id="pin"   tabindex="1" value="<?php echo $_SESSION['temppin']; ?>" readonly></td>
            <td width="26%">Serial</td>
            <td width="23%"><input type="text" name="serial" id="serial" tabindex="1" value="<?php echo $_SESSION['tempserial']; ?>" readonly></td>
          </tr>
 
  
  <tr >
            <td width="27%" height="40">Jamb Reg No:</td>
            <td width="24%" ><input type="text" name="j_reg2" id="j_reg2"   tabindex="1" value="<?php echo $find_record['JambNo']; ?>" readonly></td>
            <td width="26%">Application No</td>
            <td width="23%"><input type="text" name="app_No" id="app_No" tabindex="1"  value="<?php echo $find_record['appNo']; ?>" readonly></td>
          </tr>
          
          	 
             
   <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
            <td height="39" colspan="4" style="text-shadow: 2px 2px white;"><strong>&nbsp;Upload Your Passport <font color="red">(Note :Image Size Should Not be more than 300kb.)</font>&nbsp;&nbsp;</strong></td>
          </tr>
          
          <tr >
        <td>Upload Passport:</td>
          <td >	<input name="image_name" class="input-file uniform_on" id="fileInput" type="file" accept="image/*" onchange="preview_image(event)" style="width:200px;"></td>
          
                     <td height="30"></td>
            <td> 
<div class="otherinputs"><div class="fileinput-new thumbnail" style="width: 200px; height: 150px; border: 1px solid #0080e5;">
<img src="<?php  
				  if ($rs2['image']==NULL ){
	print "uploads/NO-IMAGE-AVAILABLE.jpg";
	}else{
	print $rs2['image'];}?>" alt="" id="output_image" style="width:200px;height: 150px;"> </div> </div>
	
</td>
        
        </tr>
      
        <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
            <td height="39" colspan="4" style="text-shadow: 2px 2px white;"><strong>&nbsp;Declaration and Undertaking <font color="red" size="1">(Note :After This Final Stage Information update will not be possible.)</font>&nbsp;&nbsp;</strong></td>
          </tr>
           
            <tr style="background-color:white;text-align:justify;">
            <td height="39" colspan="4" style="" ><br>
            <input id="approve" name="approve" value="1"  onclick="javascript: toggleCheckBox();" type="checkbox">
			
		I hereby acknowledge by ticking this check box that if it is discovered at any time that I do not possess any of the qualifications which I claim I have obtained,I will be expelled From The institution and shall not be re-admitted for the same or any other programme,even if I have upgraded my previous qualifications or possess additional qualifications.

			</td>
          </tr>
<tr >
    <td width="19%" height="20"></td>
    
  </tr>
		
		<tr >
          <td height="10">
		  
		  </td>
          <td  height="10">
          
          <button name="SubmitApp" class="Button1"  id="button1" data-placement="right" type="submit" title="Click to Submit Application">Submit</button>
												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#Button1').tooltip('show');
	                                            $('#Button1').tooltip('hide');
	                                            });
	                                            </script>

           
             
											
          </td>
          <td height="10"><button  name="submit"  class="button1"  title="Click Here to Exit Application Panel" id="button1"  onClick="window.location.href='cancel.php';" type="reset">Exit</button></td>
           <div class='imgHolder2' id='imgHolder2'><img src='css/images/tabLoad.gif'></div>
        </tr>
		</table>
            
      </div>
	
			</div>
			</form>
		</div></div>
	
			</div>
				
			</div>
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
      <div class="cl">&nbsp;</div>
    </div>
    
    </div>
    
    <br><br>
  </div>
</div>
