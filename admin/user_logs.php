
<?php  include('header.php'); ?>
<?php include('session.php');
$status = FALSE;
if ( authorize($_SESSION["access3"]["sLog"]["ulog"]["create"]) || 
authorize($_SESSION["access3"]["sLog"]["ulog"]["edit"]) || 
authorize($_SESSION["access3"]["sLog"]["ulog"]["view"]) || 
authorize($_SESSION["access3"]["sLog"]["ulog"]["delete"]) ) {
 $status = TRUE;
}
 ?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');
		if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}
	 ?>
  <?php $get_RegNo= $_GET['id']; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Users Log List</h3>
</div>
</div><div class="clearfix"></div>
            

          
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  
                    <h2>Log List</h2>
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
                    <form action="Delete_user.php" method="post">
                   		
               <table id="datatable-buttons" class="table table-striped table-bordered">
               <?php   if (authorize($_SESSION["access3"]["sLog"]["ulog"]["delete"])){ ?>
                    	<a data-placement="right" title="Click to Delete check item"  data-toggle="modal" href="#user_logs" id="delete"  class="btn btn-danger" name=""><i class="fa fa-trash icon-large"> Delete</i></a>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show');
									 $('#delete').tooltip('hide');
									 });
									</script>
										<?php }?>
											<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                              <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                          <th>Date of Last Login</th>
                          <th>Date of Last Logout</th>
                          <th>Username</th>
                         
                       
                        </tr>
                      </thead>


                      <tbody>
                      <?php
													$user_query = mysqli_query(Database::$conn,"select * from user_log order by login_date DESC ")or die(mysqli_error());
													while($row = mysqli_fetch_array($user_query)){
													$id = $row['user_log_id'];
													?>
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
                          <td><?php echo $row['login_date']; ?></td>
                          <td><?php echo $row['logout_date']; ?></td>
                          <td><?php echo $row['username']; ?></td>
                         
                          
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