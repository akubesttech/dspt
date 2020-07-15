<?php include('header.php'); ?>
<?php 
if($_SESSION['insid']==$_POST['insid'])
{
if(isset($_POST['passRe'])){
$username = stripslashes($_POST['username']);
$usercategory = $_POST['ucategory'];
$ourPath =  host()	;
$webaddress=$_SERVER['HTTP_HOST'];	
$query_recover = "SELECT * FROM admin WHERE username='".mysql_real_escape_string($username)."' OR email='".mysql_real_escape_string($username)."'  AND validate='1'";
$result = mysql_query($query_recover)or die(mysql_error());$row_recover = mysql_fetch_array($result); $num_recover = mysql_num_rows($result); $email20 = $row_recover['email']; $adminid = md5($row_recover['admin_id']); $adminuser = md5($row_recover['username']);

$query_student = mysql_query("SELECT * FROM student_tb WHERE RegNo ='".mysql_real_escape_string($username)."' OR e_address='".mysql_real_escape_string($username)."' AND verify_Data ='TRUE'")or die(mysql_error()); $num_row_student = mysql_num_rows($query_student);
		$row_student = mysql_fetch_array($query_student); $email21 = $row_student['e_address'];
		$studentid = md5($row_student['stud_id']); $regnopass = md5($row_student['RegNo']);
		
		$query_staff = mysql_query("SELECT * FROM staff_details WHERE usern_id='".mysql_real_escape_string($username)."' OR email='".mysql_real_escape_string($username)."' AND  r_status='2'")or die(mysql_error());$num_row_staff = mysql_num_rows($query_staff);
		$row_staff = mysql_fetch_array($query_staff); $email22 = $row_staff['email'];
		$staffid = md5($row_staff['staff_id']); $usern_id = md5($row_staff['usern_id']);
		
	if($usercategory == "sy"){
if($num_recover < 1){ 
$res="<font color='Red'><strong>ERROR:  Your Id $username is Incorrect please Comfirm and try Again.</strong></font><br>";
				$resi=1;}elseif(empty($email20)){
				$res="<font color='Red'><strong>ERROR:  Unable to send Recovered Password Because No Recovery Email Found .</strong></font><br>";$resi = 1;
}else{
$msg = nl2br("Dear $row_recover[firstname] $row_recover[lastname],.\n
	The Message was Send To You From ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
	..................................................................\n
	Please paste the following link in your browser to reset your Password:.\n
	
	$ourPath/changepassword.php?ID=$adminid&keyed=$adminuser&cat=$usercategory\n
	
	..................................................................\n
	
	Thank You System Administrator!\n
	For Support Call Akubest @ 08062475090 \n");
$subject="Admin Password Reset ";
 $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers      .= "From:Message From School Admin\r\n <$webaddress>\r\n".
                   //'Reply-To: '.$from."\r\n" .
                   'X-Mailer: PHP/' . phpversion();
//mail($email,$subject,$msg ,$headers ); 

if(mail($email20,$subject,$msg ,$headers )){
$res="<font color='green'><strong>Link For Your Password Reset have been mailed to This email $email20 .</strong></font><br>";$resi = 1;}else{
		$res="<font color='Red'><strong>ERROR:  Unable to  Recovered Password contact Admin For Assistance.</strong></font><br>";$resi = 1;				}}}
		
			if($usercategory == "xp"){
if($num_row_student < 1){ 
$res="<font color='Red'><strong>ERROR:  Your Id $username is Incorrect please Comfirm and try Again.</strong></font><br>";
				$resi=1;}elseif(empty($email21)){
				$res="<font color='Red'><strong>ERROR:  Unable to send Recovered Password Because No Recovery Email Found .</strong></font><br>";$resi = 1;
}else{
$msg = nl2br("Dear $row_student[FirstName] $row_student[SecondName],.\n
	The Message was Send To You From ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
	..................................................................\n
	Please paste the following link in your browser to reset your Password:.\n
	
	$ourPath/changepassword.php?ID=$studentid&keyed=$regnopass&cat=$usercategory\n
	
	..................................................................\n
	
	Thank You System Administrator!\n
	For Support Call Akubest @ 08062475090 \n");
$subject="Student Password Reset ";
 $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers      .= "From:Message From School Admin\r\n <$webaddress>\r\n".
                   //'Reply-To: '.$from."\r\n" .
                   'X-Mailer: PHP/' . phpversion();
//mail($email,$subject,$msg ,$headers ); 
if(mail($email21,$subject,$msg ,$headers )){
$res="<font color='green'><strong>Link For Your Password Reset have been mailed to This email $email21 .</strong></font><br>";$resi = 1;}else{
		$res="<font color='Red'><strong>ERROR:  Unable to  Recovered Password contact Admin For Assistance.</strong></font><br>";$resi = 1;				}}}
		
		if($usercategory == "ws"){
if($num_row_staff < 1){ 
$res="<font color='Red'><strong>ERROR:  Your Id $username is Incorrect please Comfirm and try Again.</strong></font><br>";
				$resi=1;}elseif(empty($email22)){
				$res="<font color='Red'><strong>ERROR:  Unable to send Recovered Password Because No Recovery Email Found .</strong></font><br>";$resi = 1;
}else{
$msg = nl2br("Dear $row_staff[sname] $row_staff[mname],.\n
	The Message was Send To You From ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
	..................................................................\n
	Please paste the following link in your browser to reset your Password:.\n
	
	$ourPath/changepassword.php?ID=$staffid&keyed=$usern_id&cat=$usercategory\n
	
	..................................................................\n
	
	Thank You System Administrator!\n
	For Support Call Akubest @ 08062475090 \n");
$subject="Staff Password Reset ";
 $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers      .= "From:Message From School Admin\r\n <$webaddress>\r\n".
                   //'Reply-To: '.$from."\r\n" .
                   'X-Mailer: PHP/' . phpversion();
//mail($email,$subject,$msg ,$headers ); 
if(mail($email22,$subject,$msg ,$headers )){
$res="<font color='green'><strong>Link For Your Password Reset have been mailed to This email $email22 .</strong></font><br>";$resi = 1;}else{
		$res="<font color='Red'><strong>ERROR:  Unable to  Recovered Password contact Admin For Assistance .</strong></font><br>";$resi = 1;				}}}

}}$_SESSION['insid'] = rand();
?>

<div class="container">
    <h1 class="shadowed" style="color:black;text-shadow:-1px 1px 1px #000;">Password Recovery Panel </h1>
      <div class="boxes-holder" style="background-color:#D9F7FD;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:980px;min-width:150px;box-shadow:0 1px 1px gray">
      
      <div class="entry products">
      <form id="login_form1" class="form-signin" method="POST">
			<input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
			
       <h4 style="color:orange;text-shadow:0 2px 1px black;"><?php if($resi == 1)
{echo " <div class=\"alert alert-info\"><i class=\"icon-info-sign\"></i> $res </div> ";}
//echo $email20;
?></h4><br>
      
		<div class="row-fluid">
		
			<div class="span8"><div class="pull-right">
      			  	<table width="100%">
<tbody><tr><td colspan="2" height="10" width="20%" ></td><td height="5">


			  <div id="layer-log" >
			  
			
			<br>
				<h3 class="form-signin-heading">
			
					<i class="icon-user"></i> User Identification 
				</h3>
					
				<input type="text"      class="input-block-level"  size="50" id="username" name="username" placeholder="Enter your Username or Reg No" required>
			<select class="input-block-level"   name="ucategory" id="ucategory"  required="required">
  <option value="">Select Category</option>
<option value='xp'>Student</option>
<option value='ws'>Staff</option>	
<option value='sy'>Admin</option>

</select>

				<br/>
				<button  title="Click Here to Recover Password" id="passRe" data-placement="right" name="passRe" class="btn btn-info" type="submit"><i class="icon-signin icon-large"></i> Submit</button>
				
				
				<script type="text/javascript">
				$(document).ready(function(){
				$('#passRe').tooltip('show');
				$('#passRe').tooltip('hide');
				});
				</script>  </td> <td colspan="2" height="10" ></td>
					<tr>
  <td colspan="2" height="10" valign="middle"></td>
  </tr>	
		
			</form>
		
					
			  </div>
			
			
</tr>
</tbody></table>
  <div class="cl">&nbsp;</div>
    </div>
    </div></div>
			
		</div>
	
      </div>

</div><br>
<?php include('footer.php'); ?>
   

