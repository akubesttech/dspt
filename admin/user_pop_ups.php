<script>
function isNumber(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>



<!--Delete Member Modal -->
    <div class="modal fade" id="member_record" tabindex="-1" role="dialog" aria-hidden="true">
    
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Delete Member Records?</h4>
                        </div>
                       <div class="modal-body">
					<div class="alert alert-danger">
					<p>Are you sure you want to delete the Member Record you checked?</p>
					</div>
					</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>Close</button>
                          <button  name="delete_member" class="btn btn-primary"><i class="fa fa-check icon-large"></i>Yes</button>
                        </div>

                      </div>
                    </div>
                  </div>
<!-- end  Modal -->

<div id="myModal3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
                      <div class="modal-content">

 <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Change Picture</h4>
                        </div>
    
		<div class="modal-body">
				<!--	<form method="post" class="form-horizontal" action="admin_pic.php" enctype="multipart/form-data"> --!>							<form action="" role="form" method="post" enctype="multipart/form-data" class="ngnix_transfer" id="updatePictureForm">
							
								
								<div class="form-group">
								<label class="heard" for="inputPassword">Browse Your Computer</label>
									<div class="controls">
<div class="fileinput fileinput-new" data-provides="fileinput">
<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
<img src="<?php  
				  if ($rs2['image']==NULL ){
	print "uploads/NO-IMAGE-AVAILABLE.jpg";
	}else{
	print $rs2['image'];}?>" alt=""> </div>
<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
<div>
<span class="btn default btn-file">
<span class="fileinput-new btn bg-green btn-sm"> Select image </span>
<span class="fileinput-exists btn bg-red"> Change </span>
<input name="image_name" type="file"> </span>
<input value="yhUr56e78tfotyfcyd" name="token" type="hidden">
<a href="javascript:;" class="btn default fileinput-exists btn bg-red" data-dismiss="fileinput"> Remove </a>
</div>
</div>
</div></div>

	<div class="margin-top-10">
<button type="submit" class="btn btn-success" name="imageupload"><i class="fa fa-save"></i> Upload Avatar </button>
<span id="updatePictureForm_mesage"></span>
<span id="page_feed"></span>
</div>					
		</div>
			
					<div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i>Close</button>
                          <button  name="change" class="btn btn-primary"><i class="fa fa-check icon-large"></i>Yes</button>
                        </div>
					
					</form>
					 </div>
                    </div>
</div>
<!-- end  Modal -->


<?php //if(isset($_GET['choose_patient'])){ ?>
 
 <script type="text/javascript"> 
function sendValue(value) 
{ 
    var parentId = <?php echo json_encode($_GET['id']); ?>; 
    window.opener.updateValue(parentId, value); 
    window.close(); 
} 
</script> 

<div id="myModal4" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
                      <div class="modal-content">

 <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Select Staff </h4>
                        </div>
                        
    
		<div class="modal-body">
					<form method="post"  action="admin_pic.php" enctype="multipart/form-data">							  
							 <table  id="datatable-keytable" class="table table-striped table-bordered">
							    <thead>
                  <tr>
                         <th><input type="checkbox" name="chkall2" id="chkall2" onclick="return checkall2('selector[]');"></th>
                          <th>Staff Username</th>
                          <th>Name In Full</th>
                          <th>Email Address</th>
                          <th>Phone</th>
                          <th>User Status</th>
                          <th>Select</th>
                         
                        
                        </tr>
				   </thead>
				   
				      <tbody>
				         <?php
													$user_query = mysqli_query($condb,"select * from staff_details")or die(mysqli_error($condb));
													while($row_b = mysqli_fetch_array($user_query)){
													$id = $row_b['staff_id'];
													?>
			   <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
												
                          <td><?php echo $row_b['usern_id']; ?></td>
                          <td><?php echo $row_b['sname'].'  '.$row_b['oname']; ?></td>
                          <td><?php echo $row_b['email']; ?></td>
                          <td><?php echo $row_b['phone']; ?></td>
                           <td><?php if($row_b['r_status']='1'){
						echo "Verified";}else{echo "Not Verified";}
						 ?></td>
                        
                          
                          	<td width="120">
												<a rel="tooltip"  title="add selected user" id="choose_patient" href="add_Users.php<?php echo '?d_id='.md5($id); ?>"  data-toggle="modal" class="btn btn-success" ><i class="fa fa-plus icon-large">Add Staff</i></a>
												</td>
												<script type="text/javascript">
									 $(document).ready(function(){
									 $('#choose_patient').tooltip('show');
									 $('#choose_patient').tooltip('hide');
									 });
									</script> 
                        </tr>
                        
                     	   <?php } ?>
							    					
				   </tbody>
				</table>
		</div>
			
					<div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i>Close</button>
                         <!-- <button  name="change" class="btn btn-primary"><i class="fa fa-check icon-large"></i>Yes</button> --!>
                        </div>
					
					</form>
					 </div>
                 
				    </div>
</div><?php //} ?>
<!-- end  Modal -->


<!-- Load Lectures  Modal -->
<div id="myModal15" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
                      <div class="modal-content">

 <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Select Staff / Lecturer </h4>
                        </div>
                        
    
		<div class="modal-body">
					<form method="post"  action="" enctype="multipart/form-data">							  
							 <table  id="datatable" class="table table-striped table-bordered">
							    <thead>
                  <tr>
                         <th><input type="checkbox" name="chkall2" id="chkall2" onclick="return checkall2('selector[]');"></th>
                          <th>Staff Username</th>
                          <th>Name In Full</th>
                          <th>Email Address</th>
                          <th>Field of Study</th>
                          <th>Phone</th>
                          <th>User Status</th>
                          <th>Select</th>
                         
                        
                        </tr>
				   </thead>
				   
				      <tbody>
				         <?php
		$user_query = mysqli_query($condb,"select * from staff_details where job_desc ='Academic Staff' ")or die(mysqli_error($condb));
													while($row_b = mysqli_fetch_array($user_query)){
													$id = $row_b['staff_id'];
													?>
			   <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
												
                          <td><?php echo $row_b['usern_id']; ?></td>
                          <td><?php echo $row_b['sname'].'  '.$row_b['oname']; ?></td>
                          <td><?php echo $row_b['email']; ?></td>
                          <td><?php echo $row_b['cos']; ?></td>
                          <td><?php echo $row_b['phone']; ?></td>
                           <td><?php if($row_b['r_status']='1'){
						echo "Verified";}else{echo "Not Verified";}
						 ?></td>
                        
                          
                          	<td width="120">
												<a rel="tooltip"  title="add selected user" id="choose_patient" href="allot_Courses.php<?php echo '?allot_id='.md5($id); ?>"  data-toggle="modal" class="btn btn-success" ><i class="fa fa-plus icon-large">Add Staff</i></a>
												</td>
												<script type="text/javascript">
									 $(document).ready(function(){
									 $('#choose_patient').tooltip('show');
									 $('#choose_patient').tooltip('hide');
									 });
									</script> 
                        </tr>
                        
                     	   <?php } ?>
							    					
				   </tbody>
				</table>
		</div>
			
					<div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i>Close</button>
                         <!-- <button  name="change" class="btn btn-primary"><i class="fa fa-check icon-large"></i>Yes</button> --!>
                        </div>
					
					</form>
					 </div>
                 
				    </div>
</div><?php //} ?>
<!-- end  Modal -->

                 <!-- Small loadbank modal -->
 <div id="myModal200" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content" style="overflow: auto; width:500px;">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">List Of Bank (s)</h4>
                        </div>
                        <div class="modal-body" >
<div class="alert alert-info alert-dismissible fade in" role="alert" >You Can pay you School Fees in any of This Bank listed below.</div>
<form method="post"  action="" enctype="multipart/form-data">							  
							 <table  id="datatable" class="table table-striped table-bordered" >
							    <thead>
                  <tr>
                         <th><input type="checkbox" name="chkall2" id="chkall2" onclick="return checkall2('selector[]');"></th>
                          <th>Bank Name</th>
                          <th>Account Name</th>
                          <th>Account Number</th>
                          </tr>
				   </thead>
				   
				      <tbody>
				         <?php
		$user_query = mysqli_query($condb,"select * from bank ")or die(mysqli_error($condb));
													while($row_b = mysqli_fetch_array($user_query)){
													$id = $row_b['b_id'];
													?>
			   <tr>
<td width="30"><input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>"></td>
						<td><?php echo $row_b['b_name']; ?></td>
                          <td><?php echo $row_b['acc_name']; ?></td>
                          <td><?php echo $row_b['acc_num']; ?></td>
                          	<td width="120" style="display:none;">
												<a rel="tooltip"  title="add selected user" id="choose_patient" href="allot_Courses.php<?php echo '?allot_id='.md5($id); ?>"  data-toggle="modal" class="btn btn-success" ><i class="fa fa-plus icon-large">Add Staff</i></a>
												</td>
												<script type="text/javascript">
									 $(document).ready(function(){
									 $('#choose_patient').tooltip('show');
									 $('#choose_patient').tooltip('hide');
									 });
									</script> 
                        </tr>
                        
                     	   <?php } ?>
							    					
				   </tbody>
				</table>
				 </div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div></form>
                      </div>
                    </div>
                  </div>
                  <!-- /modals -->

