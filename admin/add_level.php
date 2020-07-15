
<?php  include('header.php'); ?>
<?php include('session.php'); 
	$status = FALSE;
if ( authorize($_SESSION["access3"]["sConfig"]["alev"]["create"]) || 
authorize($_SESSION["access3"]["sConfig"]["alev"]["edit"]) || 
authorize($_SESSION["access3"]["sConfig"]["alev"]["view"]) || 
authorize($_SESSION["access3"]["sConfig"]["alev"]["delete"]) ) {
 $status = TRUE;
}
?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');
		if ($status === FALSE) {
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
<h3>Programme level Panel
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
					$num=$get_RegNo;
				if ($num!==null){
			include('editlevel.php');
			}else{
			
				include('addlevel.php'); }?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2> List Of Programme Level </h2>
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
                    <form action="Delete_level.php" method="post">
                    <table id="datatable-buttons" class="table table-striped table-bordered"><?php   if (authorize($_SESSION["access3"]["sConfig"]["alev"]["create"])){ ?>
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#delete_lform" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a> <?php } ?>
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
                         <th>Programm</th>
                          <th>Level  Name</th>
                          <th>Level description</th>
                          <th>Level Order</th>
                        
                          <th>Action</th>
                         
                        
                        </tr>
                      </thead>
 <?php
													$user_queryl = mysqli_query($condb,"select * from level_db ORDER BY level_order DESC")or die(mysqli_error());
													while($row_b = mysqli_fetch_array($user_queryl)){
													$id = $row_b['id'];
													?>

                      <tbody>
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
											<td><?php echo getprog($row_b['prog']); ?></td>	
                          <td><?php echo $row_b['level_name']; ?></td>
                          <td><?php echo $row_b['level_desc']; ?></td>
                          <td><?php echo substr($row_b['level_order'],0,1); ?></td>
                     
                        
                          
                          	<td width="120"><?php   if (authorize($_SESSION["access3"]["sConfig"]["alev"]["edit"])){ ?>
												<a rel="tooltip"  title="Edit Level" id="<?php echo $id; ?>"  onClick="window.location.href='add_level.php<?php echo '?id='.$id; ?>';"  data-toggle="modal" class="btn btn-success"><i class="fa fa-pencil icon-large"> Edit Level</i></a> <?php }?>
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