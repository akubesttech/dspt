<?php 	$status = FALSE;
if ( authorize($_SESSION["access3"]["sConfig"]["eup"]["create"]) || 
authorize($_SESSION["access3"]["sConfig"]["eup"]["edit"]) || 
authorize($_SESSION["access3"]["sConfig"]["eup"]["view"]) || 
authorize($_SESSION["access3"]["sConfig"]["eup"]["delete"]) ) {
 $status = TRUE;
 }
 	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}
  ?>
 
 <?php if($class_ID > 0){}else{
                  message("ERROR:  No Programme Select,Please Select a Programme and continue.", "error");
		       redirect('new_apply.php?view=spro');
						}

				$serial=1;			?>
 <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
           Listed Below are the available permission, for update select appropriate checkbox and click Save <strong><?php //echo getprog($class_ID); ?></strong>. 
                  </div>
                  
                   <!-- <form action="Delete_sapp.php" method="post"> --!>
                    <form action="savepermission.php" method="post"> <div  id="print_content">
                    <table id="datatable-responsive" class="table table-striped jambo_table bulk_action" cellspacing="0" width="100%" border="1">
                <!--    	<a data-placement="top" title="Click to Delete check item"   data-toggle="modal" href="#student_app" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
                    	&nbsp;&nbsp;&nbsp;  --!><div id="cccv" > 
								<a href="#" onclick="window.open('userPermission.php?view=Add','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back" ><i class="fa fa-backward icon-large"></i> Go back</a>
							&nbsp;&nbsp;&nbsp; <?php   if (authorize($_SESSION["access3"]["sConfig"]["eup"]["edit"])){ ?>
						<a data-placement="top" title="Click to Save Role Permission"   data-toggle="modal" href="#save_perm" id="divButton2"  class="btn btn-primary" name="divButton2"  ><i class="fa fa-save icon-large"> Save</i></a><?php } ?> </div>	<div	id="ccc2"></div>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
						
                      <thead >
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                         <th>S/N</th>
						 <th>Role</th>
                          <th>Module</th>
                          <th>Add</th>
                          <th>Edit</th>
                          <th>Delete</th>
                          <th>View</th>
                          <th></th>
                        
                          
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php

$viewutme_query = mysqli_query($condb,"select * from role_rights LEFT JOIN module ON role_rights.rr_modulecode = module.mod_modulecode  GROUP BY rr_rolecode, rr_modulecode ORDER BY rr_rolecode ASC,rr_modulecode ASC  ")or die(mysqli_error($condb));


while($row_utme = mysqli_fetch_array($viewutme_query)){
$id = $row_utme['rr_rolecode'];
$new_a_id = $row_utme['rr_modulecode'];

?>     
                        <tr>
 <td width="30"> <input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $new_a_id; ?>" checked>
											
												</td>
												<input type="hidden" name="role1[]" value="<?php echo $id; ?>">
												 <input type="hidden" name="module1[]" value="<?php echo $new_a_id; ?>"  >
											
												<td width="30"> <?php echo $serial++;?> </td>
						  <td><a rel="tooltip"  title="View form Order Details" id="<?php echo $new_a_id; ?>"  data-toggle="modal" class="btn btn-info"><i class=""> <?php 
echo getstatus($row_utme['rr_rolecode']); ?></i></a></td>
                          <td><?php echo $row_utme['mod_modulename']; ?></td>
                          <td><input type="checkbox" value="1" name="perma[]" <?php echo ($row_utme['rr_create'] == '1')? "checked":"" ;		?>></td>
                          <td><input type="checkbox" value="1" name="permb[]" <?php echo ($row_utme['rr_edit'] == '1')? "checked":"" ;		?>></td>
                          <td><input type="checkbox" value="1" name="permc[]" <?php echo ($row_utme['rr_delete'] == '1')? "checked":"" ;		?>></td>
                          <td><input type="checkbox" value="1" name="permd[]" <?php echo ($row_utme['rr_view'] == '1')? "checked":"" ;		?>></td>
          <td width="120">
		  <a rel="tooltip"  title="Click to Remove Permission" id="delete" href="userPermission.php?delid=<?php echo $row_utme['rr_modulecode']; ?>&p2=<?php echo $id; ?> "  data-toggle="modal" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash icon-large"> Remove</i></a>
												</td>                
												
                        </tr>
                     
                     
                        <?php }  ?>
                      </tbody>
                      
                      
                      	</form>
                    </table></div>