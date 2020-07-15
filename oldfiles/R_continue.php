
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
xmlhttp.onreadystatechange=stateChanged1;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}
function stateChanged1()
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
<script>
function showgroup(str)
{
if (str=="")
  {
  //document.getElementById("txtroomno").innerHTML="Amount was Not Loaded Because Form Type was Not Selected";
 // return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtroomno").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","loadd_group.php?q="+str,true);
xmlhttp.send();
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
	  $sql_pin1="SELECT * FROM student_tb WHERE RegNo='".mysql_real_escape_string($_SESSION['temppin'])."'";
$result_pin1 = mysql_query($sql_pin1);
$num_pin1 = mysql_num_rows($result_pin1);
$find_record = mysql_fetch_array($result_pin1);
$studentpics = $find_record['images'];

$sql_pin2="SELECT * FROM olevel_tb WHERE oPin='".mysql_real_escape_string($_SESSION['temppin'])."'";
$result_pin2 = mysql_query($sql_pin2);
$num_pin2 = mysql_num_rows($result_pin2);
$find_record2 = mysql_fetch_array($result_pin2);
//if($_SESSION['temppin'] = "" ){

		//echo "<script>window.location.assign('apply_b.php?view=New');</script>";
		//}
//ini_set('display_errors', 1);
if($_SESSION['insid']==$_POST['insid'])
{
if(isset($_POST['old_register'])){
 $regnumber = $_POST["regnumber"];
$serial = $_POST["serial"];
$j_reg = $_POST['j_reg'];
$dgroup = $_POST['d_group1'];
$phone_no = $_POST["phone_no"];
$mm = trim(strip_tags($_POST['mm']));
	$dd = trim(strip_tags($_POST['dd']));
	$yy = trim(strip_tags($_POST['yy']));
//$dob = $_POST['endDate'];
$dob = $yy."-".$mm."-".$dd;
$age=date('Y')- $yy;
$p_dura = getdura($_POST['prog']);
$yearofgrag = $_POST['yoe'] + $p_dura;
$time=date('l jS \of F Y h:i:s A');
	$sql_pin="SELECT * FROM student_tb WHERE RegNo='".mysql_real_escape_string($_SESSION['temppin'])."'";
$result_pin = mysql_query($sql_pin);
$num_pin = mysql_num_rows($result_pin);

$result_ph = mysql_query("SELECT * FROM student_tb WHERE phone='".mysql_real_escape_string($_POST['phone_no'])."' ");
	
	$num_ph = mysql_num_rows($result_ph);

	//$sql_ph="SELECT * FROM student_tb WHERE phone='".mysql_real_escape_string($phone_no)."' LIMIT 1";
//$result_ph = mysql_query($sql_ph);
//$num_ph = mysql_num_rows($result_ph);
       //if($num_pin > 0){
//$res="<font color='Red'><strong>This Student Registration Number '".mysql_real_escape_string($_SESSION['temppin'])."' already Registered.</strong></font><br>";
				//$resi=1;
			//	}elseif(strpos($num_pin," ")){
		//$res="<font color='Red'><strong>Please! Jamb Reg Number can not Contain a Space..</strong></font><br>";
				//$resi=1;
			if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $_POST['gemail'])){
		$res="<font color='Red'><strong>Please! Provide a valid Email Address...</strong></font><br>";
				$resi=1;
				}elseif($num_ph > 0){
        $res="<font color='Red'><strong>Another Student Has Registered with This Mobile Number '$phone_no' Before.</strong></font><br>";
				$resi=1;
				}else{
				if($num_pin > 0){
				$sql_ME="UPDATE student_tb SET FirstName='$_POST[sname]',SecondName='$_POST[sname]',Othername='$_POST[mname]',Gender='$_POST[gender]',dob='$dob',hobbies='$_POST[hobbies]',state='$_POST[state]',lga='$_POST[lga]',nation='$_POST[nation]',religion='$_POST[studentreligion]',address='$_POST[contactaddress]',e_address='$_POST[gemail]',phone='$_POST[phone_no]',postal_address='$_POST[p_add]',any_fchalenge='$_POST[f_chalenge]',State_chalenge='$_POST[s_chalenge]',Faculty='$_POST[fac_01]',Department='$_POST[dept_1]',Age='$age',bloodgroup='$_POST[bloodgroup]',gtype='$_POST[gtype]',RegNo='$_SESSION[temppin]',app_type='$_POST[prog]',Asession='$_POST[session]',Moe='$_POST[moe]',yoe='$_POST[yoe]',yog='".mysql_real_escape_string($yearofgrag)."',prog_dura='".mysql_real_escape_string($p_dura)."',p_level='$_POST[los]',dateofreg='".mysql_real_escape_string($time)."',reg_status='0' WHERE RegNo= '".mysql_real_escape_string($_SESSION['temppin'])."'";
					$result_qsql2 = mysql_query($sql_ME);
				}else{
				$sql="INSERT INTO student_tb (appNo,FirstName,SecondName,Othername,Gender,dob,hobbies,state,lga,nation,religion,address,e_address,phone,postal_address,any_fchalenge,State_chalenge,Faculty,Department,Age,bloodgroup,gtype,RegNo,app_type,Asession,Moe,yoe,yog,p_level,dateofreg,prog_dura,reg_status)
VALUES('".mysql_real_escape_string($_POST['appNo'])."','".mysql_real_escape_string($_POST['sname'])."','".mysql_real_escape_string($_POST['mname'])."','".mysql_real_escape_string($_POST['oname'])."','".mysql_real_escape_string($_POST['gender'])."','".mysql_real_escape_string($dob)."','".mysql_real_escape_string($_POST['hobbies'])."','".mysql_real_escape_string($_POST['state'])."','".mysql_real_escape_string($_POST['lga'])."','".mysql_real_escape_string($_POST['nation'])."','".mysql_real_escape_string($_POST['studentreligion'])."','".mysql_real_escape_string($_POST['contactaddress'])."','".mysql_real_escape_string($_POST['gemail'])."','".mysql_real_escape_string($_POST['phone_no'])."','".mysql_real_escape_string($_POST['p_add'])."','".mysql_real_escape_string($_POST['f_chalenge'])."','".mysql_real_escape_string($_POST['s_chalenge'])."','".mysql_real_escape_string($_POST['fac_01'])."','".mysql_real_escape_string($_POST['dept_1'])."','".mysql_real_escape_string($age)."','".mysql_real_escape_string($_POST['bloodgroup'])."','".mysql_real_escape_string($_POST['gtype'])."','".mysql_real_escape_string($_SESSION['temppin'])."','".mysql_real_escape_string($_POST['prog'])."','".mysql_real_escape_string($_POST['session'])."','".mysql_real_escape_string($_POST['moe'])."','".mysql_real_escape_string($_POST['yoe'])."','".mysql_real_escape_string($yearofgrag)."','".mysql_real_escape_string($_POST['los'])."','".mysql_real_escape_string($time)."','".mysql_real_escape_string($p_dura)."','0')";
	if(!$qsql= mysql_query($sql))

	{
		echo mysql_error();
		//echo "<script>alert('Unable to Complete Student Registration Please Try Again..');</script>";
		//	echo "<script>window.location.assign('studentReg.php');</script>";
			$res="<font color='Red'><strong>Unable to Continue Student Registration Please Try Again...</strong></font><br>";
				$resi=1;
			exit();
	}
}

if($studentpics == Null){
				//header("location:apply_b.php?view=N_1");?>
				<script language="JavaScript" type="text/javascript">
	var tp1 = new Spry.Widget.TabbedPanels("AccountSummaryPanel", { defaultTab: 1});

</script>
		<?php 
		echo "<script>alert('Record Successfully Added Goto Final Step');</script>";
		//echo "<script>window.location.assign('apply_b.php?view=O_C');</script>";
			redirect("apply_b.php?view=O_C");
		}	}

}}$_SESSION['insid'] = rand();

function getdura($get_dura1)
{
$query2_fac = @mysql_query("select pro_dura from prog_tb where Pro_name = '$get_dura1' ")or die(mysql_error());
$count_fac = mysql_fetch_array($query2_fac);
 $nameclass2=$count_fac['pro_dura'];
return $nameclass2;
}

?>
  <div class="container">
    <h1 class="shadowed" style="color:black;text-shadow:-1px 1px 1px #000;">Old/Returning Student Registartion Form</h1>
     	
		 <div class="boxes-holder" style="background-color:#D9F7FD;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:980px;min-width:150px">
   
       <div class="entry products">
       <h3 style="color:orange;text-shadow:0 2px 1px black;">Kindly fill the following registration form with valid records.</h3><br>
       
		 <div class="TabbedPanels" id="AccountSummaryPanel">
		<ul class="TabbedPanelsTabGroup"> 
			<li class="TabbedPanelsTab" tabindex="0" ><img src="css/images/tab1.png"></li>
		
			<li class="TabbedPanelsTab" tabindex="0"><img src="css/images/tab3.png"></li>
		</ul>
		<div class="TabbedPanelsContentGroup">
			<div class="TabbedPanelsContent">
		   	<div id="center">

		<div class="inner_right_demo">
		<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			<input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
			<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
			<input type="hidden" name="appNo" value="<?php echo "O". $AppNo;?>"  />
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
?>

</center>

</td>

    </tr>
    
 

		 <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
    <td colspan="5" height="39" style="text-shadow: 2px 2px white;"><strong>&nbsp;Entry Information</strong></td>
    
    </tr>
  <tr >
            <td width="27%" height="40">Registration Number:</td>
            <td width="24%" ><input type="text" name="regnumber" id="regnumber"   tabindex="1" value="<?php echo $_SESSION['temppin']; ?>" readonly></td>
            <td width="19%">Programme of study:</td>
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
          </tr>
  <tr>
    <td width="19%">Mode of entry:</td>
    <td width="31%"><select class="input-medium"   name="moe" id="moe"  required="required">
  <option value="">Select Mode</option>
   <option value="01">UTME</option>
    <option value="02">Pre_Science</option>
   <option value="03">Direct Entry</option>
   <option value="04">Undergraguate(Cep)</option>
  

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
            <td width="27%" height="40">Year Of Entry:</td>
            <td width="24%" >
			 <select class="input-medium" name="yoe" id="yoe"  required="required">
<option>Select Year</option>
<?php for($x=2000;$x<2020;$x++){
	echo '<option value="'.$x.'">'.$x.'</option>';
	} ?>
    </select>

			</td>
            <td width="26%">Level of study</td>
            <td width="23%">	 <select class="input-medium" name="los" id="los"  required="required">
<option>Select Level</option>
<option value="100">100</option>
<option value="200">200</option>
<option value="300">300</option>
<option value="400">400</option>
<option value="500">500</option>
<option value="600">600</option>
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
   <td width="19%">Department:</td>
    <td width="31%"><select class="input-medium"   name="dept_1" id="dept_1" onchange="showgroup(this.value)" required="required">
  <option value="">Select Department</option>


</select></td>
    </tr>
    
    <tr>
	 <td width="27%" height="40">Department Group:</td>
            <td width="24%" > <div  id="txtroomno" ><input type="text" name="d_group1" id="d_group1"   tabindex="1"  readonly> </div></td>
	</tr>
<tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
            <td height="39" colspan="4" style="text-shadow: 2px 2px white;"><strong>&nbsp;Bio Data:</strong></td>
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
              <option value="" selected="selected">- Select State -</option>
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
          
          <button name="old_register" class="Button1"  id="button1" data-placement="right" type="submit" title="Click to Contine">Save</button>
												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#Button1').tooltip('show');
	                                            $('#Button1').tooltip('hide');
	                                            });
	                                            </script>
           <td height="10"><button  name="submit"  class="button1"  title="Click Here to Exit Application Panel" id="button1"  onClick="window.location.href='index.php';" type="reset">Exit</button></td>
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
 $sql2="SELECT * FROM student_tb where RegNo = '$_POST[regnopic]' ";
  $qsql2= mysql_query($sql2);
$rs2 = mysql_fetch_array($qsql2);

$staffdb = mysql_query("SELECT * FROM student_tb  where RegNo = '$_POST[regnopic]'");
$rs23 = mysql_fetch_array($staffdb);

if($_SESSION['insid3']==$_POST['insid3'])
{
if(isset($_POST['SubmitForm'])){
 $name4     = $_FILES['image_name']['name'];
$tmpName  = $_FILES['image_name']['tmp_name'];
 $ext = strtolower(pathinfo($name4, PATHINFO_EXTENSION));
$maxsize = 300000;

if($_FILES['image_name']['name'] == Null)  {
	$res="<font color='Red'><strong>Please Select an Image Before You Submit Your Application.</strong></font><br>";
				$resi=1;
				}elseif($_SESSION['temppin'] == "" or $_POST['app_No'] == "" ){
//echo "<script>alert('Unable To Continue Registration Because Payment Information Not Verified');</script>";
//echo "<script>var tp1 = new Spry.Widget.TabbedPanels('AccountSummaryPanel', { defaultTab: 0});</script>";
$res="<font color='Red'><strong>You Have Not Completed Stage One Please Fill up and Continue.</strong></font><br>";
				$resi=1;

}elseif(!in_array($ext, array('jpg','jpeg','png','gif')) ){
 	$res="<font color='Red'><strong>Invalid file type. Only  JPG, GIF and PNG types are accepted.</strong></font><br>";
				$resi=1;
			//}elseif($_FILES["image_name"]["size"] > $maxsize)  {
			}elseif(getimagesize($_FILES['image_name']['tmp_name']) < $maxsize){
	$res="<font color='Red'><strong>File size should be greater than 300kb.</strong></font><br>";
				$resi=1;
			}elseif(!$_POST['approve']){
		$res="<font color='Red'><strong>Your Have Not Approve Your Registration Information Click The Check Box to Approve !</strong></font><br>";
				$resi=1;

}else{
	$sql_complete="UPDATE student_tb SET reg_status ='$_POST[approve]',dateofreg = NOW() WHERE RegNo = '$_POST[regnopic]'";
					$result_complete = mysql_query($sql_complete);
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
mysql_query("update student_tb set images = '".mysql_real_escape_string($adminthumbnails)."' where RegNo = '$_POST[regnopic]'");
								 
unset($dig);
$r=0;
//unlink("Student/uploads/$rs23[images]");
} 
 ob_start();
	echo "<script>alert('Your Have Sucessfully Completed The Form!');</script>";
		echo "<script>window.location.assign('studregprint.php?stid=".md5($_POST['regnopic'])."');</script>";
	

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
    <td colspan="5" height="39" style="text-shadow: 2px 2px white;"><strong>&nbsp;Registration ID</strong></td>
    
    </tr>
  <tr >
            <td width="27%" height="40">Registration Number:</td>
            <td width="24%" ><input type="text" name="regnopic" id="regnopic"   tabindex="1" value="<?php echo $_SESSION['temppin']; ?>" readonly></td>
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
			
		I hereby acknowledge by ticking this check box that all the information Supplied are Correct and has been Verify By me.

			</td>
          </tr>
<tr >
    <td width="19%" height="20"></td>
    
  </tr>
		
		<tr >
          <td height="10">
		  
		  </td>
          <td  height="10">
          
          <button name="SubmitForm" class="Button1"  id="button1" data-placement="right" type="submit" title="Click to Submit Your Registration">Submit</button>
												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#Button1').tooltip('show');
	                                            $('#Button1').tooltip('hide');
	                                            });
	                                            </script>

           
             
											
          </td>
          <td height="10"><button  name="submit"  class="button1"  title="Click Here to Exit Registration Panel" id="button1"  onClick="window.location.href='index.php';" type="reset">Exit</button>
		  
		  </td>
           
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
      <div class="cl">&nbsp;</div>
    </div>
    
    </div>
    
    <br><br>
  </div>
</div>
