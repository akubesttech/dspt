



<?php

if(isset($_POST['addperm'])){
$userrole = $_POST['role1'];
$accesmodule = $_POST['module1'];
$addrole = gnum($_POST['perm'][0]) ; $addupdate = gnum($_POST['perm'][1]) ; 
 $adddelete = gnum($_POST['perm'][2]) ; $addview = gnum($_POST['perm'][3]) ;

$salot_session = $_POST['session'];
$sql_alldept="SELECT * FROM role_rights WHERE  rr_rolecode ='".safee($condb,$userrole)."' and rr_modulecode ='".safee($condb,$accesmodule)."'";
$result_alldept = mysqli_query($condb,$sql_alldept);
$num_alldept = mysqli_num_rows($result_alldept);

if($num_alldept > 0){
	message("Select Permission Already Exit , Please Try Again", "error");
		        redirect('userPermission.php?view=Add'); 
      
}else{
mysqli_query($condb,"insert into role_rights (rr_rolecode,rr_modulecode,rr_create,rr_edit,rr_delete,rr_view) values('".safee($condb,$userrole)."','".safee($condb,$accesmodule)."','".safee($condb,$addrole)."','".safee($condb,$addupdate)."','".safee($condb,$adddelete)."','".safee($condb,$addview)."')")or die(mysqli_error($condb));
	message("Permission Successful Added", "success");
		        redirect('userPermission.php?view=Edit');

}

}
?>

<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="user" method="post" enctype="multipart/form-data" id="user">
<input type="hidden" name="insidtime" value="<?php echo $_SESSION['insidtime'];?> " />
                      
                      <span class="section">Add Permission </span>
<div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback"  >
						  	  <label for="heard"   id="enable3" >Role *</label>
          <select name='role1' id="role1" class="form-control"  required>
                            <option value="">Select Role</option>
                           <?php 
$resultfee = mysqli_query($condb,"SELECT * FROM role   ORDER BY role_rolename  ASC");
while($rsfee = mysqli_fetch_array($resultfee)){ echo "<option value='$rsfee[role_rolecode]'>$rsfee[role_rolename]</option>";}?>
                        </select>
                      </div>
                       <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Module *</label>
                            	  <select name='module1' id="module1" class="form-control" required>
                            <option value="">Select Module</option>
 <?php  $resultproe = mysqli_query($condb,"SELECT * FROM module  GROUP BY mod_modulegroupname,mod_modulename,mod_modulecode ORDER BY mod_modulegroupname ASC,mod_modulename ASC ");
while($rsproe = mysqli_fetch_array($resultproe)){echo "<option value='$rsproe[mod_modulecode]'>".$rsproe['mod_modulegroupname']." > ".$rsproe['mod_modulename']."</option>";}?>
                            </select>
                      </div>
  
                       <div class="form-group">
                         <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
<label for="heard" >Permission *</label><br>
<label class="radio-inline"><input type="checkbox" name="perm[]" value="1"> ADD </label>
<label class="radio-inline"><input type="checkbox" name="perm[]" value="1"> EDIT </label>
<label class="radio-inline"> <input type="checkbox" name="perm[]" value="1"> VIEW </label>
<label class="radio-inline"><input type="checkbox" name="perm[]" value="1"> DELETE </label>
</div></div>

                 
                  
                    
                     
               
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <?php   if (authorize($_SESSION["access3"]["sConfig"]["aup"]["create"])){ ?>
                        <button  name="addperm"  id="addperm"  class="btn btn-primary col-md-4" title="Click Here to Add Permission" ><i class="fa fa-plus"></i> Add  </button> <?php } ?><?php   if (authorize($_SESSION["access3"]["sConfig"]["aup"]["edit"])){ ?>
<a rel="tooltip"  title="View / Edit Permission " id="<?php echo $new_a_id; ?>"  onclick="window.open('userPermission.php?view=Edit','_self')" data-toggle="modal" class="btn btn-info"><i class="fa fa-search-plus"> View Added Permission</i></a>  <?php } ?>                     

                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#viewPay').tooltip('show');
	                                            $('#viewPay').tooltip('hide');
	                                            });
	                                            </script>
	                                              <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 
                  