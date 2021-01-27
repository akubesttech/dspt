
<?php  include('header.php'); ?>
<?php include('session.php');
	$status = FALSE;
if ( authorize($_SESSION["access3"]["sConfig"]["aer"]["create"]) || 
authorize($_SESSION["access3"]["sConfig"]["aer"]["edit"]) || 
authorize($_SESSION["access3"]["sConfig"]["aer"]["view"]) || 
authorize($_SESSION["access3"]["sConfig"]["aer"]["delete"]) ) {
 $status = TRUE;
}
 ?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} ?>
  <?php $get_RegNo = isset($_GET['id']) ? $_GET['id'] : ''; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Roles Management
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
				if (!empty($get_RegNo)){
			include('editrole.php'); }else{ include('addrole.php'); }?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2> List Of Added Roles </h2>
                    
                            
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                            <i class="fa fa-exclamation-circle"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    This roles can be edited by selecting the role choice to edit or rename
                            </div></div>
                    <form action="Delete_role.php" method="post">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                     <?php   if (authorize($_SESSION["access3"]["sConfig"]["aer"]["delete"])){ ?>
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#delete_role" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show');
									 $('#delete').tooltip('hide');
									 });
									</script><?php } ?>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                          <th>Role Name</th>
                          <th>Role Description</th>
                          <th>Action</th>
                        </tr>
                      </thead>
 

                      <tbody>
                      <?php
													$user_query = mysqli_query($condb,"select * from role Order by role_rolename ASC")or die(mysqli_error($condb));
													while($row_s = mysqli_fetch_array($user_query)){
													$id = $row_s['role_rolecode'];
											
								//$date_now = date("Y-m-d");
													?>
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
											
                          <td><?php echo $row_s['role_rolename']; ?></td>
                          <td><?php echo $row_s['role_desc']; ?></td>
                          <td width="120">  <?php   if (authorize($_SESSION["access3"]["sConfig"]["aer"]["edit"])){ ?>
												<a rel="tooltip"  title="Click to Update Role" id="<?php echo $id; ?>" onClick="window.location.href='add_role.php<?php echo '?id='.$id; ?>';"  data-toggle="modal" class="btn btn-success"><i class="fa fa-check icon-large"> Update Role</i></a><?php }?>
												</td>
                        </tr>
                     
                     
                      
                      
                      
                      
                      
                       
                       
                       
                      
                      
                      
                        <?php } ?>
                      </tbody>
                      	</form>
                    </table>
                  </div>
                </div>
              </div>



            
            
          </div>
        </div>
        <!-- /page content -->
        
  
         <?php include('footer.php'); ?>