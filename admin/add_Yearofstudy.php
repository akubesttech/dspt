
<?php  include('header.php'); ?>
<?php include('session.php');$status = FALSE;
if ( authorize($_SESSION["access3"]["sConfig"]["ayos"]["create"]) || 
authorize($_SESSION["access3"]["sConfig"]["ayos"]["edit"]) || 
authorize($_SESSION["access3"]["sConfig"]["ayos"]["view"]) || 
authorize($_SESSION["access3"]["sConfig"]["ayos"]["delete"]) ) {
 $status = TRUE;
}
$get_RegNo = isset($_GET['id']) ? $_GET['id'] : '';
?>
<?php include('admin_slidebar.php'); ?>
 <script type="text/javascript">
 window.onload = function (){
 if($('#status').val() === '1')   
   {   
   $('#enable1').show(); 
      $('#enable2').show();
	   $('#enable2').select(); 
	   $('#enable3').show(); 
      $('#enable4').show(); 
	   $('#enable5').show(); 
      $('#enable6').show();    
   }   
else 
   {   
   $('#enable1').hide(); 
      $('#enable2').hide();
	   $('#enable2').select();   
	  $('#enable3').hide(); 
      $('#enable4').hide(); 
	  $('#enable5').hide(); 
      $('#enable6').hide();     
   }
 }
    
$(document).ready(function() {   
$('#status').change(function(){   
if($('#status').val() === '1')   
   {   
   $('#enable1').show(); 
      $('#enable2').show();
	   $('#enable2').select(); 
	   $('#enable3').show(); 
      $('#enable4').show(); 
	   $('#enable5').show(); 
      $('#enable6').show();    
   }   
else 
   {   
   $('#enable1').hide(); 
      $('#enable2').hide();
	   $('#enable2').select();   
	  $('#enable3').hide(); 
      $('#enable4').hide(); 
	  $('#enable5').hide(); 
      $('#enable6').hide();     
   }   
});   
});   
</script>
  <script type="text/javascript"> $(document).ready(function(){
       $('#myModalat').modal('close');
        })  </script>
       
    <?php include('navbar.php');	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} ?>


  <?php //$get_RegNo= $_GET['id']; ?>
    <!-- page content -->
    
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Add Year Of Study
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
			 if(empty($get_RegNo)){ include('addSession.php'); }else{ include('editSession.php');}?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2> List Of Academic Session </h2>
                    
                            
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
                           Please Note That The Green Button Is The Active Session!
                            </div></div>
                    <form action="Delete_sec.php" method="post">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                    <?php   if (authorize($_SESSION["access3"]["sConfig"]["ayos"]["delete"])){ ?>
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#sec_delete" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a> <?php } ?>
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
                          <th>Session Name</th>
                          <th>Programme</th>
                          <th>Session Start</th>
                         <th>Session End</th>
                          <th>Semester</th>
                        
                          
                          <th>Action</th>
                        </tr>
                      </thead>  <tbody>
 <?php
					$user_query = mysqli_query($condb,"select * from session_tb order by action desc")or die(mysqli_error($condb));
													while($row_s = mysqli_fetch_array($user_query)){
													$id = $row_s['session_id'];
													$caction=$row_s['action'];
													?>

                    
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
											
                          <td><?php echo $row_s['session_name']; ?></td>
                          <td><?php echo getprog($row_s['prog']); ?></td>
                          <td><?php echo $row_s['start_date']; ?></td>
                          <td><?php echo $row_s['start_end']; ?></td>
                          <td><?php echo $row_s['term']; ?></td>
                        
                          <?php  if ($caction == '1'){
											
											
											  ?>
                          
                          
                          	<td width="120">  <?php   if (authorize($_SESSION["access3"]["sConfig"]["ayos"]["edit"])){ ?>
												<a rel="tooltip"  title="This is The Active Session" id="<?php echo $id; ?>" href="add_Yearofstudy.php<?php echo '?id='.$id; ?>"  data-toggle="modal" class="btn btn-success"><i class="fa fa-check icon-large"> Edit Session</i></a>
												</td>
												<?php }}else { ?>
												
												<td width="120"><?php   if (authorize($_SESSION["access3"]["sConfig"]["ayos"]["edit"])){ ?>
												<a rel="tooltip"  title="Edit Session Details" id="<?php echo $id; ?>" href="add_Yearofstudy.php<?php echo '?id='.$id; ?>"  data-toggle="modal" class="btn btn-danger"><i class="fa fa-pencil icon-large"> Edit Record</i></a>
												</td>
												
													<?php } }?>
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