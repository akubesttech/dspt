
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2> Fee Type Configuration </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                   <form method="POST" action="Delete_feetype.php" >
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"> 
                      <a href="user_Private.php?view=apt" class="btn btn-info"  id="delete02" data-placement="right" title="Click to Add New Election" ><i class="fa fa-plus icon-large"></i> Add Fee Type</a>&nbsp;&nbsp;&nbsp; <a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#ftype_delete" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>

									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show');
									 $('#delete').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
										
                      <thead>
                        <tr>
                      <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th> 
                          <th>Fee Type</th>
                          <th>Fee Description</th>
                          <th>Fee Category</th>
                          <th>Fee Status</th> 
                           <th>Action</th>
                        </tr>
                      </thead>
                       <tbody>
 <?php
	$user_query = mysqli_query($condb,"select * from ftype_db Order by id ASC")or die(mysqli_error($condb));
													while($row_f = mysqli_fetch_array($user_query)){
													$id = $row_f['id'];
													?>  
													<tr id="row<?php echo $row_f['id'];?>">
             <td width="10"><input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>"></td>
            <td id="ftypea_val<?php echo $row_f['id'];?>" ><?php echo $row_f['f_type']; ?></td>
                <td id="fdesca_val<?php echo $row_f['id'];?>"><?php echo $row_f['d_desc']; ?></td>
                <td id="fcate_val<?php echo $row_f['id'];?>"><?php echo getfcate($row_f['f_category']); ?></td>
              <td id="status_val<?php echo $row_f['id'];?>"><?php if($row_f['status'] =="1"){echo "compulsory";}else{ echo "Optional";} ?></td>
                          
                          
                          
                          	<td>
                          	<a rel="tooltip"  title="Edit fee Type Details" id="<?php echo $id; ?>" href="user_Private.php?view=apt<?php echo '&id='.$id; ?>"  data-toggle="modal" class="btn btn-success"><i class="fa fa-pencil icon-large"> Edit </i></a><!--                       	
<input type='button' class="btn btn-success" id="edit_button<?php echo $row_f['id'];?>" value="edit" onclick="edit_row('<?php echo $row_f['id'];?>');">
<input type='button' class="btn btn-success" id="save_button<?php echo $row_f['id'];?>" value="save" onclick="save_row('<?php echo $row_f['id'];?>');" style="display: none;">
<input type='button' class="btn btn-danger" id="delete_button<?php echo $row_f['id'];?>" value="delete" onclick="delete_row('<?php echo $row_f['id'];?>');"> --!>
												</td>
                        </tr>
                     
                        <?php } ?>
                      </tbody>
                      </form>
                    <!--    <tr id="new_row"> <td></td>  <td><input type="text" class="form-control "  id="f_typea" name="f_typea" maxlength="40"  value="" placeholder="Fee type"   required="required">
                      </td>
					  <td><input type="text" class="form-control "  id="f_desca" maxlength="150"  value="" placeholder="Fee Description"   required="required"></td>
					    <td> <select  id="fcate" class="form-control" >
            <option value="">Select Category</option><option value="1">Fee</option><option value="2">Dues</option>
            <option value="3">Form</option><option value="0">Others</option></select>
                     </td>
					  <td> <select  id="status" class="form-control" >
            <option value="">Select Status</option><option value="1">compulsory</option><option value="0">Optional</option></select>
                     </td>
					    	<td><span id="user-result"></span>
												</td>
					  </tr> --!>
                      
                    </table>
                  </div>
                </div>
              
              
                 
          
              <!-- Bootstrap Modals -->
<!-- Modal - Add New Record/User -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
            </div>
            <div class="modal-body">
 
                <div class="form-group">
                    <label for="first_name">Fee Type</label>
                    <input type="text" class="form-control "  id="f_typea" maxlength="40"  value="" placeholder="Fee type"   required="required">
                </div>
 
                <div class="form-group">
                    <label for="last_name">Fee Description</label>
                    <input type="text" class="form-control "  id="f_desca" maxlength="150"  value="" placeholder="Fee Description"   required="required">
                </div>
 
                <div class="form-group">
                    <label for="email">Status</label>
                    <select  id="status" class="form-control" >
            <option value="">Select Status</option><option value="1">compulsory</option><option value="0">Optional</option></select>
                </div>
 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addRecord()">Add Record</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->
              
              <!-- Modal - Update User details -->
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Update</h4>
            </div>
            <div class="modal-body">
 
                <div class="form-group">
                    <label for="update_first_name">First Name</label>
                    <input type="text" id="update_first_name" placeholder="First Name" class="form-control"/>
                </div>
 
                <div class="form-group">
                    <label for="update_last_name">Last Name</label>
                    <input type="text" id="update_last_name" placeholder="Last Name" class="form-control"/>
                </div>
 
                <div class="form-group">
                    <label for="update_email">Email Address</label>
                    <input type="text" id="update_email" placeholder="Email Address" class="form-control"/>
                </div>
 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()" >Save Changes</button>
                <input type="hidden" id="hidden_user_id">
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->
                 