
<?php  include('header.php'); ?>
<?php include('session.php');	$status = FALSE;
if ( authorize($_SESSION["access3"]["sConfig"]["afac"]["create"]) || 
authorize($_SESSION["access3"]["sConfig"]["afac"]["edit"]) || 
authorize($_SESSION["access3"]["sConfig"]["afac"]["view"]) || 
authorize($_SESSION["access3"]["sConfig"]["afac"]["delete"]) ) {
 $status = TRUE;
} ?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} ?>
  <?php $get_RegNo= $_GET['id']; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3><?php echo $SCategory; ?> Panel
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
					$num=$get_RegNo;
				if ($num!==null){
			include('editFac.php');
			}else{
			
				include('addFac.php'); }?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2> List Of <?php echo $SCategory; ?> </h2>
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
                    <form action="Delete_fac.php" method="post">
                    <table id="datatable-buttons" class="table table-striped table-bordered"><?php   if (authorize($_SESSION["access3"]["sConfig"]["afac"]["delete"])){ ?>
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#fac_delete" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a> <?php } ?>
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
                          <th><?php echo $SCategory; ?> Name</th>
                          <th><?php echo $SCategory; ?> Description</th>
                          <th>Email</th>
                          <th>Office Phone</th>
                          <th>Dean</th>
                         
                          <th>Action</th>
                        </tr>
                      </thead>
 <?php
													$user_query = mysqli_query($condb,"select * from faculty")or die(mysqli_error($condb));
													while($row_f = mysqli_fetch_array($user_query)){
													$id = $row_f['fac_id'];
													?>

                      <tbody>
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
												
                          <td><?php echo $row_f['fac_name']; ?></td>
                          <td><?php echo $row_f['fac_desc']; ?></td>
                          <td><?php echo $row_f['fac_email']; ?></td>
                          <td><?php echo $row_f['fac_phone']; ?></td>
                          <td><?php echo getdean($row_f['fac_dean']); ?></td>
                          
                          	<td width="120"><?php   if (authorize($_SESSION["access3"]["sConfig"]["afac"]["edit"])){ ?>
												<a rel="tooltip"  title="Edit <?php echo $SCategory; ?> Details" id="<?php echo $id; ?>" href="add_Faculty.php<?php echo '?id='.$id; ?>"  data-toggle="modal" class="btn btn-success"><i class="fa fa-pencil icon-large"> Edit Record</i></a><?php } ?>
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