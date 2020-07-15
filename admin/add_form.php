
<?php  include('header.php'); ?>
<?php include('session.php');	$status = FALSE;
if ( authorize($_SESSION["access3"]["sConfig"]["afm"]["create"]) || 
authorize($_SESSION["access3"]["sConfig"]["afm"]["edit"]) || 
authorize($_SESSION["access3"]["sConfig"]["afm"]["view"]) || 
authorize($_SESSION["access3"]["sConfig"]["afm"]["delete"]) ) {
 $status = TRUE;
} ?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');	if ($status === FALSE) {
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
<h3>Application Forms Management
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
					$num=$get_RegNo;
				if ($num!==null){
			include('editform.php');
			}else{
			
				include('addform.php'); }?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2> List Of Added Form(s) </h2>
                    
                            
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
                           Please Note That The Green Button Is The Active Form!
                            </div></div>
                    <form action="Delete_form.php" method="post">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                     <?php   if (authorize($_SESSION["access3"]["sConfig"]["afm"]["delete"])){ ?>
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#delete_appform" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a> <?php } ?>
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
                          <th>Year</th>
                          <th>Application Type</th>
                          <th>Amount</th> 
                           <th>Session</th>
                           <th>Application Period</th>
                        
                          
                          <th>Action</th>
                        </tr>
                      </thead>
 

                      <tbody>
                      <?php
													$user_query = mysqli_query($condb,"select * from form_db Order by session ASC")or die(mysqli_error($condb));
													while($row_s = mysqli_fetch_array($user_query)){
													$id = $row_s['id'];
												$setend2 = $row_s['f_end']; $emode = $row_s['mode'];
								$date_now = new DateTime(); $date2    = new DateTime($setend2);
								//$date_now = date("Y-m-d");
													?>
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
											
                          <td><?php echo $row_s['year']; ?></td>
                          <td><?php echo getprog($row_s['prog'])." (".getamoe($emode).") "; ?></td>
                          <td><?php echo $row_s['amount']; ?></td>
                          <td><?php echo $row_s['session']; ?></td>
                        <td><?php echo $row_s['f_start']." - ". $row_s['f_end'];  ?></td>
                         <?php   if (authorize($_SESSION["access3"]["sConfig"]["afm"]["edit"])){ ?>
                          <?php  if($date_now > $date2){
											
											
											  ?>
                          <td width="120"><a rel="tooltip"  title="Update Form set" id="<?php echo $id; ?>" onClick="window.location.href='add_form.php<?php echo '?id='.$id; ?>';" data-toggle="modal" class="btn btn-danger"><i class="fa fa-pencil icon-large"> Update Form</i></a>
												</td>
												<?php }else { ?><td width="120">
												<a rel="tooltip"  title="The form is still running" id="<?php echo $id; ?>" onClick="window.location.href='add_form.php<?php echo '?id='.$id; ?>';"  data-toggle="modal" class="btn btn-success"><i class="fa fa-check icon-large"> Update Form</i></a>
												</td><?php }}?>
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