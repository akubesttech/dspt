

<?php

if(isset($_POST['cpass'])){
//$h_name = ucfirst($_POST['h_name']);
$o_passn = $_POST['o_pass'];
$o_pass = substr(md5($o_passn.SUDO_M),14);
$n_passn = $_POST['n_pass'];
$n_pass = substr(md5($n_passn.SUDO_M),14);
$r_pass = $_POST['r_pass'];
$oldme = $_POST['oldme'];

//$query_hoste = mysql_query("select * from hostedb where h_name = '$h_name'")or die(mysql_error());
//$row = mysql_fetch_array($query);
//$row_hoste = mysql_num_rows($query_hoste);
//$query_hostec = mysql_query("select * from hostedb where h_code = '$h_code'")or die(mysql_error());
//$row = mysql_fetch_array($query);
//$row_hostec = mysql_num_rows($query_hostec);
if($o_pass != $oldme){
 message("$o_passn Password does not match with your Old Password ", "error");
		        redirect('user_Private.php?view=UP');
 }elseif(strpos($n_passn," ")){
	 message("Please! Password  can not Contain a Space", "error");
		        redirect('user_Private.php?view=UP');
 }elseif(strlen($n_passn) < 6 || strlen($n_passn) > 20) {
   message("Please! Password must be between 6-20 characters (letters and numbers)", "error");
   redirect('user_Private.php?view=UP');
   }elseif(!preg_match("#.*^(?=.{6,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $n_passn)){
   message("Your Password is not Strong try combination of Upper,Lower case letters,special character and numbers", "error");
		        redirect('user_Private.php?view=UP');
		      }elseif($n_passn != $r_pass){
	message("Please! Password  Did not Match.", "error");
		        redirect('user_Private.php?view=UP');
		
}else{

mysqli_query($condb,"update admin set password = '$n_pass' where admin_id = '$session_id'")or die(mysqli_error($condb));

//mysql_query("insert into activity_log (date,username,action) values(NOW(),'$admin_username','Hostel Titled $h_name was Add')")or die(mysql_error()); 
 ob_start();

  message("Your Password was successfully changed", "success");
		        redirect('user_Private.php?view=UP');


}
}
?>
<?php

$s=3;
	while($s>0){
	$AppNo .= rand(0,9);

		$s-=1;
	}
	

?>
<div class="x_panel">
                
             
                <div class="x_content">
	<?php
								$query_change = mysqli_query($condb,"select * from admin where admin_id = '$session_id'")or die(mysqli_error($condb));
								$row_change = mysqli_fetch_array($query_change);
								?>
                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
<input type="hidden" name="oldme" value="<?php echo $row_change['password'];?>" />
                      
                      <span class="section">System User Change Password
 <?php
                                          if($resi == 1)
{


					echo " 
		
			    <center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res</font></label></center>
			 
			  ";
}
?> </span>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">User Name </label>
                      
                          <input type="text" class="form-control "  name='u_name' id="u_name"  value="<?php echo $row_change['username']; ?>"  readonly> </div>
                          
                          
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">Old Password</label>
                      
                          <input type="password" class="form-control " name="o_pass" id="o_pass" maxlength="20"  value=""    > </div>

                          
                          
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">New Password</label>
                                         <input type="password" class="form-control " name="n_pass" id="n_pass" maxlength="20"  value=""    required="required">
                      </div>
                    
                     
                    
                     <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Re-type Password</label>
                            	             <input type="password" class="form-control " name="r_pass" id="r_pass" maxlength="20"  value=""    required="required">
                      </div>
               
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         
                        <button  name="cpass"  id="cpass"  class="btn btn-primary col-md-4" title="Click Here to Save Password Details" ><i class="fa fa-save"></i> Save</button>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addhostel').tooltip('show');
	                                            $('#addhostel').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 