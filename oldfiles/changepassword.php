<?php include('header.php'); ?>
<?php 
if (!isset($_GET['ID']) ||(trim ($_GET['keyed']) == '')) {
message("ERROR:  Password Request cannot be verify.", "error");
		        redirect('Up_recover.php');
    //exit();
	}
 ?>
<?php 
define(PW_SALT,'(+3%_');
$curDate = date("Y-m-d H:i:s");
$ID=$_GET['ID'];
$keyed=$_GET['keyed'];
$usercategory = $_GET['cat'];

  $checksendd =  mysql_query("SELECT userid FROM  p_reset WHERE key = '".$keyed."' AND userid = '".$ID."' AND expiredate >= '".$curDate."'");
  $counterrec mysql_num_rows($checksendd);
      $password = md5(trim($password) . PW_SALT);
       $del_rec = mysql_query("DELETE FROM p_reset WHERE key = '".$keyed."'");
       
if($_SESSION['insid']==$_POST['insid'])
{
if(isset($_POST['passRe'])){

$password = $_POST['password'];
$password2 = $_POST['password2'];


$ourPath =  host()	;
$webaddress=$_SERVER['HTTP_HOST'];
if($counterrec < 1){
   		message("Invalid password request key please try again! .", "error");
		        redirect('Up_recover.php');
}elseif(strpos($password," ")){
	message("Please! Password  can not Contain a Space.", "error");
		        redirect('Up_recover.php');
         }elseif(!ctype_alnum($_POST['password']) || strlen($_POST['password']) < 6 || strlen($_POST['password']) > 12) {
		message("Please! Password must be between 6-12 characters (letters and numbers).", "error");
		        redirect('Up_recover.php');
		}elseif($password != $password2){
	message("Please! Password must be between 6-12 characters (letters and numbers).", "error");
		        redirect('Please! Password  Did not Match');
		}else{
	if($usercategory == "sy"){ 
	mysql_query("update admin set password = '".$password."' where  md5(username) = '".mysql_real_escape_string($ID)."' ")or die(mysql_error());}
	
if($usercategory == "xp"){ mysql_query("update student_tb set password = '".$password."' where   md5(RegNo) = '".mysql_real_escape_string($ID)."'")or die(mysql_error()); }

if($usercategory == "ws"){ mysql_query("update staff_details set password = '".$password."' where  md5(usern_id) = '".mysql_real_escape_string($ID)."'")or die(mysql_error());
} $del_rec;
//$res="<font color='green'><strong>Your Password Reset was Successfully Click <a href='Userlogin.php'>Here</a> To login.</strong></font><br>";
//$resi=1; 
	echo "<script>alert('Your Password Reset was Successfully!');</script>";
		//echo "<script>window.location.assign('Userlogin.php');</script>";
		redirect('Userlogin.php');	
	}
}}$_SESSION['insid'] = rand();
?>

<div class="container">
    <h1 class="shadowed" style="color:black;text-shadow:-1px 1px 1px #000;">Password Reset Panel </h1>
      <div class="boxes-holder" style="background-color:#D9F7FD;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:980px;min-width:150px;box-shadow:0 1px 1px gray">
      
      <div class="entry products">
      <form id="login_form1" class="form-signin" method="POST">
			<input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
			
       <h4 style="color:orange;text-shadow:0 2px 1px black;"><?php if($resi == 1)
{echo " <div class=\"alert alert-info\"><i class=\"icon-info-sign\"></i> $res </div> ";}
//echo $email20;
?></h4><br>
      
		<div class="row-fluid">
		
			<div class="span7"><div class="pull-right">
      			  	<table width="100%">
<tbody><tr><td colspan="2" height="10" width="20%" ></td><td height="5">


			  <div id="layer-log" >
			  
			
			<br>
				<h3 class="form-signin-heading">
			
					<i class="icon-key"></i> Set New Password 
				</h3>
					
				<input type="password"      class="input-block-level"   id="password" name="password" placeholder="New Password" required>
		<input type="password"   class="input-block-level"   id="password2" name="password2" placeholder="Re-type Password" required>

				<br/>
				<button  title="Click Here to Save New Password" id="passRe" data-placement="right" name="passRe" class="btn btn-info" type="submit"><i class="icon-save icon-large"></i> Save</button>
				
				
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
   

