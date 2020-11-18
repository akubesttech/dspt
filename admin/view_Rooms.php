
<?php  include('header.php'); ?>
<?php include('session.php');
$status = FALSE;
if ( authorize($_SESSION["access3"]["hMan"]["vroom"]["create"]) || 
authorize($_SESSION["access3"]["hMan"]["vroom"]["edit"]) || 
authorize($_SESSION["access3"]["hMan"]["vroom"]["view"]) || 
authorize($_SESSION["access3"]["hMan"]["vroom"]["delete"]) ) {
 $status = TRUE;
}
 ?>
	
		         
        <?php 
if(isset($_GET['editrooms'])){
?>

<script>
    $(document).ready(function(){
        $('#myModal7').fadeIn('fast');
    });
    
    $(document).ready(function(){
        $('#close').click(function(){
            $('#myModal7').fadeOut('fast');
            windows.location = "view_rooms.php";
        })
    })

</script>

<?php }?>	

 <?php include('admin_slidebar.php'); 
  if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}
 ?>
    <?php include('navbar.php') ?>
  <?php  $get_RegNo = isset($_GET['id']) ? $_GET['id'] : ''; 
 $get_Room = isset($_GET['idroom']) ? $_GET['idroom'] : '';
  ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>View Hostel Rooms
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				<?php if (empty($get_RegNo)){ include('viewRooms.php');}else{ include('edit_Hostel.php');}?>
				<!-- /Organization Setup Form End -->
</div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2> List Of Hostel Block </h2>
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
                    <form action="Delete_hostel.php" method="post">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#hostel_delete" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
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
                          <th>Hostel Code</th>
						  <th>Hostel Name</th>
                          <th>Hostel Description</th>
                         <th>Hostel Category</th>
                          <th>Hostel Status</th>
                             <th>Number Of Rooms</th>
                        <th>Action</th>
                         
                          
                        </tr>
                      </thead>
 <?php
													$user_query = mysqli_query($condb,"select * from hostedb ")or die(mysqli_error($condb));
													while($row_hosted = mysqli_fetch_array($user_query)){
													$id = $row_hosted['h_code'];
													//$ho_d = $row_hosted['h_code'];
						$resultrooms = mysqli_query($condb,"SELECT room_no FROM roomdb where room_status = '1' AND h_coder = '$id'");
						$count=mysqli_num_rows($resultrooms);
													?>

                      <tbody>
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
											
                          
                          <td><?php echo $row_hosted['h_code']; ?></td>
                          <td><?php echo $row_hosted['h_name']; ?></td>
                          <td><?php echo $row_hosted['h_desc']; ?></td>
                          <td><?php echo $row_hosted['h_cat']; ?></td>
                          <td><?php 
						  if($row_hosted['h_status']=='1'){
						echo "Available";
						}else{
					echo "Not Available";
					} ?></td>
                         <td><?php echo $count; ?></td>
                          
                          
                          	<td width="117"> <?php   if (authorize($_SESSION["access3"]["hMan"]["vroom"]["edit"])){ ?> 
												<a rel="tooltip"  title="Edit Hostel Details" id="<?php echo $id; ?>" href="add_Hostel.php<?php echo '?id='.$id; ?>"  data-toggle="modal" class="btn btn-success"><i class="fa fa-pencil icon-large"> Edit Hostel</i> </a><?php } ?>
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
               <!-- /page content -->
        
     <?php include('footer.php'); ?>
        <!-- start  Staff details Pop up -->
<?php
//if($_SESSION['insidroom']==$_POST['insidroom'])
//{
if(isset($_POST['editroom2'])){
$h_code2 = $_POST['h_code2'];
$h_coder = $_POST['h_coder'];
$n_bed = $_POST['n_bed'];
$feetype = $_POST['ftype'];
$feeroom = $_POST['fee'];
$r_st = $_POST['r_st'];
$r_desc = $_POST['r_desc'];


$query_hoster = mysqli_query($condb,"select * from roomdb where room_no = '".safee($condb,$h_coder)."'")or die(mysqli_error($condb));
//$row = mysqli_fetch_array($query);
$row_hoster = mysqli_num_rows($query_hoster);

if ($row_hoster>1){
message("Please This Room Number Already Exist In our Database!", "error");
redirect('view_Rooms.php?editrooms&idroom='.$get_Room);
//$resroom="<font color='red'><strong>Please This Room Number Already Exist In our Database</strong></font><br>";
			//	$resi=1;
				}else{

mysqli_query($condb,"update roomdb set room_no='".safee($condb,$h_coder)."',h_nameen='".safee($condb,$h_code2)."',feetype='".safee($condb,$feetype)."',fee = '".safee($condb,$feeroom)."',no_of_bed='".safee($condb,$n_bed)."',description='".safee($condb,$r_desc)."',room_status='$r_st' where room_id='".safee($condb,$_GET['idroom'])."'")or die(mysqli_error($condb));
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Room  $h_coder was updated')")or die(mysqli_error($condb)); 
 ob_start();
 message("Room [$h_coder] was Successfully Updated!", "success");
redirect('view_Rooms.php?editrooms&idroom='.$get_Room); 
//$resroom="<font color='green'><strong> Room [$h_coder] was Successfully Updated!</strong></font><br>";
				//$resi=1;



}
}
?>
 
  

<div id="myModal7" class="modal dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
                      <div class="modal-content">

 <div class="modal-header">
                        <!--  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
                          </button> --!>
                          <h4 class="modal-title" id="myModalLabel">Edit Room Information </h4>
                        </div>
                        
    
		<div class="modal-body">
		   
		<div class="well profile_view" style="1px solid green;">
				
						<form name="editroom" method="post" enctype="multipart/form-data" id="editroom">
					  <?php
					$user_home = mysqli_query($condb,"select * from hostedb left join roomdb ON roomdb.h_coder = hostedb.h_code  where room_id='$_GET[idroom]'")or die(mysqli_error($condb));
													$row_ho = mysqli_fetch_array($user_home);
													$idhostel = $row_ho['h_code'];
													$hname = $row_ho['h_name'];
													$room_num = $row_ho['room_no'];
														$bed_num = $row_ho['no_of_bed'];
															$feetyp = $row_ho['feetype'];
														$roomfee = $row_ho['fee'];
															$descript1 = $row_ho['description'];
													?>
					<input type="hidden" name="insidroom" value="<?php echo $_SESSION['insidroom'];?> " />
                      
                      <span class="section" style="text-shadow:-1px 1px 1px #000;"><font color='darkblue'>Room Number : <?php echo ucfirst($room_num) ;?> </font> <?php
  //if($resi == 1){ echo "<center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$resroom</font></label></center>";}?> </span>

<div class="col-sm-12">
<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
<label for="heard">Hostel Name </label>
                      
                          <input type="text" class="form-control " readonly name='h_code2' id="h_code2"  value="<?php echo $hname ;?>"  required="required"> </div>


<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Room No </label>
                      
                          <input type="text" class="form-control" name="h_coder" id="h_coder" maxlength="4"  value="<?php echo $room_num; ?>" onkeypress="return isNumber(event);" readonly  required="required"> </div>



                          
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Number of Bed</label>
                            	  <select name='n_bed' id="n_bed"  class="form-control" required>
                            <option value="<?php echo $bed_num; ?>"><?php echo $bed_num; ?></option>
    
                            <option value="1">1</option>
                             <option value="2">2</option>
                             <option value="3">3</option>
                             <option value="4">4</option>
                              <option value="5">5</option>
                          
                          </select>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Fee Type</label>
                             <select name='ftype' id="ftype" class="form-control" required>
                            <option value="<?php echo $feetyp; ?>"><?php echo getftype($feetyp); ?></option>
                          <?php 
$resultfee = mysqli_query($condb,"SELECT * FROM ftype_db where  f_category = '5'  ORDER BY f_type  ASC");
while($rsfee = mysqli_fetch_array($resultfee)){ echo "<option value='$rsfee[id]'>$rsfee[f_type]</option>";}?>
                        <!--    <option value="Others">Other Fees</option> -->
                          
                          </select>
                      </div>
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Fee (Per Month)</label>
                      
                          <input type="text" class="form-control "  name='fee' id="fee"  value="<?php echo $roomfee; ?>" onkeypress="return isNumber(event);"  required="required"> </div>
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Room Status</label>
                            	  <select name='r_st' id="r_st"  class="form-control" required>
                            <option value="">Select Status</option>
                             <option value="1">Availiable</option>
                             <option value="0">Not Availiable</option>
                            
                          
                          </select>
                      </div>
                      <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Room Description </label>
                            	     <textarea name="r_desc" id="r_desc" class="form-control " style="width:498px;"required="required"><?php echo $descript1; ?></textarea></td>
                      </div>
                      
<div class="col-xs-12 bottom text-center">

</div>
</div>
</div>
			
<div class="modal-footer">
<a href="view_Rooms.php" class="btn btn-default"><i class="fa fa-remove"></i>&nbsp;Close</a>
<button  name="editroom2" class="btn btn-primary"><i class="fa fa-pencil icon-large"></i> Edit Room</button>
                        </div>
					
					</form>
					 </div>
                 
				    </div>
</div><?php //} ?>
<!-- end  Modal -->
  
       