
<?php  include('header.php'); ?>
<?php include('session.php'); ?>
	
		    	

 <?php
 //error_reporting(E_ALL);
//ini_set('display_errors', 1);
  include('admin_slidebar.php'); ?>
   <script> //$(document).ready(function(){
       //$('#myModalat7').modal('close');
      // })  </script>
    <?php include('navbar.php'); ?>
  <?php $get_RegNo = $_GET['id']; ?>

    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>School Program Panel
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
					$num=$get_RegNo;
				if ($num!==null){
			include('editProgram.php');
			}else{
			
				include('addProgram.php'); }?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2> List Of Programs </h2>
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
                    <form action="Delete_pro.php" method="post">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#pro_delete" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show');
									 $('#delete').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr><!-- Assessment score --!>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                          <th>Program Name</th>
                          <th>Program Description</th>
                         <th>Duration</th>
                         <th>C A Scores <?php echo " ".getamax($class_ID)." %"; ?></th>
                          <th>Exam Scores <?php echo " ".getemax($class_ID)." %"; ?></th>
                           <th>Certificate in view</th>
                          <th>Status</th>
                      
                          
                          <th>Action</th>
                        </tr>
                      </thead>
                       <tbody>
 <?php
													$user_query = mysqli_query($condb,"select * from prog_tb ")or die(mysqli_error($condb));
													while($row_f = mysqli_fetch_array($user_query)){
													$id = $row_f['pro_id'];
													?>

                     
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
											
                          <td><?php echo $row_f['Pro_name']; ?></td>
                          <td><?php echo $row_f['pro_desc']; ?></td>
                          <td><?php echo getys($row_f['pro_dura'])." ".getfra($row_f['pro_dura']); ?></td>
                            <td><?php echo $row_f['assmax']; ?></td>
                              <td><?php echo $row_f['exammax']; ?></td>
                          <td><?php echo $row_f['certinview']; ?></td>
                          <td><?php if ($row_f['status']==1){
							echo "Enabled";
							}else{echo "Disabled";} ?></td>
                         
                          
                          
                          	<td width="120">
												<a rel="tooltip"  title="Edit Faculty Details" id="<?php echo $id; ?>" href="add_Program.php<?php echo '?id='.$id; ?>"  data-toggle="modal" class="btn btn-success"><i class="fa fa-pencil icon-large"> Edit Record</i></a>
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