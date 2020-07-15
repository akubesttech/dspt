
<?php  include('header.php'); ?>
<?php include('session.php');		$status = FALSE;
if ( authorize($_SESSION["access3"]["sMan"]["acos"]["create"]) || 
authorize($_SESSION["access3"]["sMan"]["acos"]["edit"]) || 
authorize($_SESSION["access3"]["sMan"]["acos"]["view"]) || 
authorize($_SESSION["access3"]["sMan"]["acos"]["delete"]) ) {
 $status = TRUE;
} ?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} ?>
  <?php $get_RegNo= $_GET['id']; 
  $get_staff= $_GET['allot_id'];
  	
  ?>
  <script type="text/javascript">

</script>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Staff / Lecturer Course Allocation
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
					$num=$get_RegNo;
				if ($num!==null){
			include('editUser.php');
			}else{
			
				include('allotCourse.php'); }?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2>List Of Alloted Course (s) To Lecture (s)</h2>
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
                    <form action="Delete_cosallot.php" method="post">
                   <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#Course_allot" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show');
									 $('#delete').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th></th>
                          <th>Assigned To</th>
                          <th>Course Code</th>
                          <th>Course Title</th>
                          <th>Session</th>
                          <th>Semester</th>
                          <th>Level</th>
                         
                        
                        </tr>
                      </thead>


                      <tbody>
                       <?php
                       	$user_query_b = mysqli_query($condb,"select * from staff_details s,course_allottb c where s.staff_id = c.assigned and c. 	a_lotstatus='1' ORDER BY course ASC ")or die(mysqli_error());
													while($row_b = mysqli_fetch_array($user_query_b)){
													$id = $row_b['a_lotid'];
                       
//$viewreg_query = mysqli_query($condb,"select  * from admin where admin_id='$session_id' AND access_level = '1'")or die(mysql_error());
//$viewreg_query2 = mysqli_query($condb,"select  * from admin where admin_id='$session_id' AND access_level = '$admin_accesscheck'")or die(mysql_error());
							//$row_utme = mysql_fetch_array($viewreg_query)
													?>
													
													
                        <tr>
                    <td width="30"> 
                   	<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">	
					</td>
						
											
												
												
												
                          <td><?php echo getlect($row_b['assigned']); ?></td>
                          <td><?php echo $row_b['course']; ?></td>
                          <td><?php echo getcourse($row_b['course']); ?></td>
                          <td><?php echo $row_b['session']; ?></td>
                           <td><?php echo $row_b['semester'];//getstatus($idcheck); ?> </td>
                        
                          
                          	<td width="120">
                        
                       	<?php echo getlevel($row_b['level'],$class_ID);//getstatus($idcheck); ?>
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
        <?php 

        ?>
  
         <?php include('footer.php'); ?>