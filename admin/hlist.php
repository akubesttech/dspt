 
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
                    	<button  name="goback"  id="goback" type='button' onClick="window.location.href='add_Hostel.php?view=addH';" class="btn btn-primary col-md-4" title="Click Here to Add Hostel " ><i class="fa fa-plus"></i> Add Hostel</button>
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
                        <th>Action</th>
                          <th>Add Room</th>
                          
                        </tr>
                      </thead> <tbody >
 <?php
													$user_query = mysqli_query($condb,"select * from hostedb ")or die(mysqli_error($condb));
													while($row_hosted = mysqli_fetch_array($user_query)){
													$id = $row_hosted['h_code'];
													$croom=mysqli_num_rows(mysqli_query($condb,"select * from roomdb where h_coder='".safee($condb,$id)."' "));
													?>

                      
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
											
                          
                          <td><?php echo $row_hosted['h_code']; ?></td>
                          <td><?php echo $row_hosted['h_name']." "; ?><span class="badge bg-green"><?php echo $croom; ?></span></td>
                          <td><?php echo $row_hosted['h_desc']; ?></td>
                          <td><?php echo $row_hosted['h_cat']; ?></td>
                          <td><?php 
						  if($row_hosted['h_status']=='1'){
						echo "Available";
						}else{
					echo "Not Available";
					} ?></td>
                         
                          
                          
                          	<td width="117">
												<a rel="tooltip"  title="Edit Hostel Details" id="<?php echo $id; ?>" href="add_Hostel.php<?php echo '?view=ehostel&id='.$id; ?>"  data-toggle="modal" class="btn btn-success"><i class="fa fa-pencil icon-large"> Edit Hostel</i></a>
												</td>
												
												<td width="120">
												<a rel="tooltip"  title="Click Add Room" id="<?php echo $id; ?>" href="?addrooms&idroom=<?php echo $id;?>"  data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus icon-large"> Add Room</i></a>
												</td>
                        </tr>
                     
                        <?php } ?>
                      </tbody>
                      	</form>
                    </table>
                  </div>
                </div>
               