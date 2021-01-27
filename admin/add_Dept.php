
<?php  include('header.php'); ?>
<?php include('session.php'); 
	$status = FALSE;
if ( authorize($_SESSION["access3"]["sConfig"]["adep"]["create"]) || 
authorize($_SESSION["access3"]["sConfig"]["adep"]["edit"]) || 
authorize($_SESSION["access3"]["sConfig"]["adep"]["view"]) || 
authorize($_SESSION["access3"]["sConfig"]["adep"]["delete"]) ) {
 $status = TRUE;
}

?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} ?>
  <?php $get_RegNo = isset($_GET['id']) ? $_GET['id'] : '';  ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Add <?php echo $SGdept1; ?> 
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
					$num=$get_RegNo;
                    if(!empty($get_RegNo)){
				include('editDept.php');}else{ include('addDept.php'); }?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2> List Of <?php echo $SGdept1; ?> </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                  
                    </p>
                    <form action="Delete_dept.php" method="post">
                   <!-- <table id="datatable-buttons" class="table table-striped table-bordered"> --!>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#dept_delete" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show');
									 $('#delete').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
										
                                                                  	<?php

  
?>
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                          <th>School/Faculty</th>
                          <th><?php echo $SGdept1; ?> Code</th>
                          <th><?php echo $SGdept1; ?> Name</th>
                          <th>Email</th>
                          <th>Office Phone</th>
                          <th>Hod</th>
                         
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
 <?php
$user_query = mysqli_query($condb,"select * from dept WHERE d_name IS NOT NULL GROUP BY fac_did,dept_id  ORDER BY fac_did ASC")or die(mysqli_error($condb));
													while($row = mysqli_fetch_array($user_query)){
													$id = $row['dept_id'];
													?>

                      
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
						 <td><?php echo getfacultyc($row['fac_did']); ?></td>				
                          <td><?php echo $row['d_code']; ?></td>
                          <td><?php echo $row['d_name']; ?></td>
                          <td><?php echo $row['d_email']; ?></td>
                          <td><?php echo $row['d_phone']; ?></td>
                          <td><?php echo gethod($row['d_hod']); ?></td>
                          
                          	<td width="120"><?php   if (authorize($_SESSION["access3"]["sConfig"]["adep"]["edit"])){ ?>
												<a rel="tooltip"  title="Edit <?php echo $SGdept1; ?> Details" id="<?php echo $id; ?>" href="add_Dept.php<?php echo '?id='.$id; ?>"  data-toggle="modal" class="btn btn-success"><i class="fa fa-pencil icon-large"> Edit Record</i></a><?php }?>
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