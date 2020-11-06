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

							?>
 <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
           Listed Below are the available permission, for update select appropriate checkbox and click Save <strong><?php //echo getprog($class_ID); ?></strong>. 
                  </div>
                  
                   <!-- <form action="Delete_sapp.php" method="post">-responsive --!>
                    <form action="savepermission.php" method="post"> <div  id="print_content">
                    <table id="datatable" class="table table-striped jambo_table bulk_action" cellspacing="0" width="100%" border="1">
                <!--    	<a data-placement="top" title="Click to Delete check item"   data-toggle="modal" href="#student_app" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
                    	&nbsp;&nbsp;&nbsp;  --!><div id="cccv" > 
								<a href="#" onclick="window.open('userPermission.php?view=Add','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back" ><i class="fa fa-backward icon-large"></i> Go back</a>
							&nbsp;&nbsp;&nbsp; <?php   if (authorize($_SESSION["access3"]["sConfig"]["eup"]["edit"])){ ?>
						<a data-placement="top" title="Click to Save Role Permission"   data-toggle="modal" href="#save_perm" id="divButton2"  class="btn btn-primary" name="divButton2"  ><i class="fa fa-save icon-large"> Save</i></a><?php } ?> </div>	
                        <div	id="ccc2">
                        <?php $queryprog = mysqli_query($condb,"SELECT * FROM role  ORDER BY role_rolecode ASC"); foreach($queryprog as $rolname){?>
                         	<a href="#" onclick="filltablen('<?php echo $rolname['role_rolecode']; ?>')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Load permissions to this role" ><i class="fa fa-briefcase"></i> <?php echo $rolname['role_rolename'];?></a>
								
                                <?php } ?>	<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
             <div>
			<input class="form-control" style="min-width: 250px;max-width: 250px;" type="text" id="members" placeholder="Search By Module Name"  onkeyup="filltablen(this.value)" /><br>
		</div>
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
                 
                      </tbody>
                      
                      
                      	</form>
                    </table></div>