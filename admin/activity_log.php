
<?php  include('header.php'); ?>
<?php include('session.php');
$status = FALSE;
if ( authorize($_SESSION["access3"]["sLog"]["alog"]["create"]) || 
authorize($_SESSION["access3"]["sLog"]["alog"]["edit"]) || 
authorize($_SESSION["access3"]["sLog"]["alog"]["view"]) || 
authorize($_SESSION["access3"]["sLog"]["alog"]["delete"]) ) {
 $status = TRUE;
}
 
//if($admin_accesscheck == "1") {
	//}else{echo "<script>alert('Access Not Granted To This User Please Contact System Administrator!');</script>";
	//	redirect("index.php");}
?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');
	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}
	 ?>
  <?php $get_RegNo= $_GET['id'];  ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>System User Activity Logs</h3>
</div>
</div><div class="clearfix"></div>
            

          
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  
                    <h2>Activity Log List</h2>
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
                    <form action="delete_log.php" method="post">
                   		
              <table id="datatable-buttons" class="table table-striped table-bordered">
  
 <?php   if (authorize($_SESSION["access3"]["sLog"]["alog"]["delete"])){ ?>
                    	<a data-placement="right" title="Click to Delete check item"  data-toggle="modal" href="#bs-example-modal-lg" id="delete"  class="btn btn-danger" name=""><i class="fa fa-trash icon-large"> Delete</i></a> 
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show');
									 $('#delete').tooltip('hide');
									 });
									</script>
									<?php }?>
								<?php //include('user_pop_ups.php'); ?>
								<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                              <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                          <th>Date</th>
                          <th>System UserName</th>
                          <th>Full Name</th>
                         
                          <th>Activity</th>
                          
                        </tr>
                      </thead>


                      <tbody>
                      <?php
													$query_activity = mysqli_query($condb,"select * from activity_log LEFT JOIN admin ON activity_log.username = admin.username
										order by date DESC ")or die(mysqli_error($condb));
													while($row_activity = mysqli_fetch_array($query_activity)){
													$id = $row_activity['activity_log_id'];  $existso = imgExists($row['adminthumbnails']);
													?>
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
                          <td><?php echo $row_activity['date']; ?></td>
                           <td>
						    <img src="<?php if ($existso > 0 ){print $row_activity['adminthumbnails'];
	}else{ print "./uploads/NO-IMAGE-AVAILABLE.jpg";}
 ?>" class="avatar" alt="user image">&nbsp;
										 <?php echo $row_activity['username']; ?></td>
									  <td>	 <?php echo $row_activity['firstname']." ".$row_activity['lastname']; ?></td>
                         
                          <td><?php echo $row_activity['action']; ?></td>
                         
                          	
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