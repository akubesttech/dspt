<?php

if(isset($_POST['addSession'])){
$session = ucfirst($_POST['session']);
$status = $_POST['status'];
$semester = $_POST['enable2'];
$Sstart = $_POST['Sstart'];
$Send = $_POST['Send'];

$query = mysqli_query($condb,"select * from session_tb where session_name = '".safee($condb,$session)."' ")or die(mysqli_error($condb));
$count = mysqli_num_rows($query);
$query_check = mysqli_query($condb,"select * from session_tb where action = '1'")or die(mysqli_error($condb));
$action = mysqli_num_rows($query_check);
$count2 = mysqli_fetch_array($query_check);
//$action=$count2['action'];
if ($count > 0){ 
message("This Session Already Exist,Try Again!", "error");
			redirect('add_Yearofstudy.php?id='.$get_RegNo);
	
}else{
if($status=="1"){
if($action > 0){
message("This Session Duration Has Not Expire Look at the Admin Dashboard For Verification !", "error");
			redirect('add_Yearofstudy.php?id='.$get_RegNo);
}else{
mysqli_query($condb,"insert into session_tb (session_name,start_date,start_end,term,action) values('".safee($condb,$session)."','".safee($condb,$Sstart)."','".safee($condb,$Send)."','".safee($condb,$semester)."','".safee($condb,$status)."')")or die(mysqli_error($condb));

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'".safee($condb,$admin_username)."','Session Titled $session was Add')")or die(mysqli_error($condb)); 
 ob_start();
 message("New Session [$session] was Successfully Added as Default Session!", "success");
			redirect('add_Yearofstudy.php');

}
}else{
mysqli_query($condb,"insert into session_tb (session_name,action) values('".safee($condb,$session)."','".safee($condb,$status)."')")or die(mysqli_error($condb));

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'".safee($condb,$admin_username)."','Session Titled $session was Add')")or die(mysqli_error($condb)); 
// ob_start();
message("New Session [$session] was Successfully Added !", "success");
			redirect('add_Yearofstudy.php');

}
}

}
?>

<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      
                      <span class="section">Add New Academic Session  </span>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">Session </label>
                      
                          <input type="text" class="form-control " name='session' id="session"  value="" placeholder="Example : 2016/2017"  required="required"> </div>
                          
                          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard"  >Set As Default Session </label>
                      
                           <select name='status' id="status" class="form-control" required="required" >
                            <option value="">Select Status</option>
                             <option value="1">Enabled</option>
                              <option value="0">Disabled</option>
                            
                             </select> </div>
                          
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard" style="display: none;"  id="enable1">Semester</label>
                            	  <select name='enable2' id="enable2" class="form-control" style="display: none;"   >
                            <option value="">Select Semester</option>
                          
                            <option value="First">First</option>
                            <option value="Second">Second</option>
                          
                          </select>
                      </div>
                    
                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
						  	  <label for="heard"  style="display: none;"  id="enable3" >Semester Starts</label>
                            	  <input type="text" class="form-control " style="display: none;" type="hidden"  name='Sstart' id="enable4" placeholder="Example : 2009-10-11" >
                      </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
						  	  <label for="heard" style="display: none;" id="enable5" >Semester Ends</label>
                            	  <input type="text" class="form-control " style="display: none;" type="hidden"   name='Send' id="enable6"placeholder="Example : 2009-12-11" >
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
                         <?php   if (authorize($_SESSION["access3"]["sConfig"]["ayos"]["create"])){ ?>
                        <button  name="addSession"  id="addSession"  class="btn btn-primary col-md-4" title="Click Here to Save Program Details" ><i class="fa fa-sign-in"></i> Add Session</button><?php } ?>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addSession').tooltip('show');
	                                            $('#addSession').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 