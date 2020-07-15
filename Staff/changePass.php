

<?php
if(isset($_POST['cpass'])){
//$h_name = ucfirst($_POST['h_name']);
$o_pass = $_POST['o_pass'];
$n_pass = $_POST['n_pass'];
$r_pass = $_POST['r_pass'];
$oldme = $_POST['oldme'];

if($o_pass != $oldme){
message("$o_pass Password does not match with your Old Password", "error");
		        redirect('staff_Private.php?view=SUP');
}elseif(strpos($n_pass," ")){
	message("Please! Password  can not Contain a Space.", "error");
		        redirect('staff_Private.php?view=SUP');
		}elseif($n_pass != $r_pass){
		message("Please! Password  Did not Match..", "error");
		        redirect('staff_Private.php?view=SUP');
	
}else{

mysqli_query($condb,"update staff_details set password = '$n_pass' where staff_id = '$session_id'")or die(mysqli_error($condb));

//mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Hostel Titled $h_name was Add')")or die(mysqli_error($condb)); 
 ob_start();
 	message("Your Password was Successfully Changed", "success");
		        redirect('staff_Private.php?view=SUP');

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
								$query_change = mysqli_query($condb,"select * from staff_details where staff_id = '".safee($condb,$session_id)."'")or die(mysqli_error($condb));
								$row_change = mysqli_fetch_array($query_change);
								?>
                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
<input type="hidden" name="oldme" value="<?php echo $row_change['password'];?>" />
                      
                      <span class="section">System User Change Password </span>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">
Staff User Name</label>
                      
                          <input type="text" class="form-control "  name='u_name' id="u_name"  value="<?php echo $row_change['usern_id']; ?>"  readonly> </div>
                          
                          
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
                 