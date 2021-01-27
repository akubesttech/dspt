<form action="" method="post" enctype="multipart/form-data">
                    
                     <table id="datatable-responsive" class="table table-striped table-bordered">
                      <!-- <table id="datatable" class="table table-striped table-bordered"> --!>
                       <a href="add_Staff.php?view=addStaff" class="btn btn-info"  id="delete02" data-placement="right" title="Click to Add New Employee" ><i class="fa fa-plus icon-large"></i> Add New Employee</a> 
                   <a data-placement="right" title="Click to Delete check item" style="display: none;"  data-toggle="modal" href="#Delete_staff" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
                        <button class="btn btn-danger" name="delete_staff" title="Click to Delete checked item" id="delete"><i class="fa fa-trash icon-large"></i> Delete </button>
				   
                   <a data-placement="right" href="download.php?ids=2" class="btn btn-info"  id="penper"  
                         title="Click to Download CSV template for Employee Record upload" ><i class="fa fa-download icon-large"></i>  
                         CSV Template</a>
                         
                         
                            <label class="chkPenalty"><input type="checkbox" id="chkPenalty"  onclick="ShowHideDiv2(this)" name="chkPenalty" value="1" /> Upload Employee Record(s) CSV </label>		
                                    
                                    <div style="display:none; " id="changestatus"> <br><label for="heard">Upload CSV file here: </label>
<input name="fileNames" class="input-file uniform_on" id="fileNames" type="file" readonly="readonly" >
<button type="submit" name="importstaff"  id="import" data-placement="right" class="btn btn-primary" title="Click To Import Employee Details" ><i class="glyphicon glyphicon-upload"></i> Upload</button>
                        <br> </div> 
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
                          <th>Staff Name</th>
                          <th>Gender</th>
                          <th>Mobile Number</th>
                          <th>Email Address</th>
                          <th>State</th>
                          <th>Job Description</th>
                          <th>Department</th>
                           <th>Access Level</th>
                            <th>Action</th>
                         <!-- <th>Info</th> --!>
                          <th>View</th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php //$admin_accesscheck
$user_query = mysqli_query($condb,"select * from staff_details ORDER by sname ASC ")or die(mysqli_error());
													while($row = mysqli_fetch_array($user_query)){
													$id = $row['staff_id'];
														$id3 = $row['staff_id'];
												      $is_active = $row['u_display'];
												      $picget = $row['image'];
								 $exists = imgExists($picget);
													?>
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
                          <td>
						   <img src="<?php 
											  if ($exists > 0 ){
	print $picget;
	}else{ print "./uploads/NO-IMAGE-AVAILABLE.jpg";}
 ?>" class="avatar" alt="user image">&nbsp;
						  <!--<a rel="facebox" title="View User Details" id="<?php echo $new_a_id; ?>"  onclick="window.open('?view=Employeelist&details&id2=<?php echo $id;?> ','_self')" data-toggle="modal" class="clickable2-row"><?php echo $row['sname'].'  '.$row['mname'].' '.$row['oname']; ?> </a>--!>
                           <a rel="facebox" href="staff_pop.php?details&id2=<?php echo $id;?>" title="" id="<?php echo $id; ?>" >
                           <?php echo $row['sname'].'  '.$row['mname'].' '.$row['oname']; ?> </a>
					</td>
                          
                          <td><?php echo $row['Gender']; ?></td>
                          <td><?php echo $row['phone']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['state']; ?></td>
                          <td><?php echo $row['job_desc']; ?></td>
                          <td><?php echo getdeptc($row['s_dept']); ?></td>
                          <td><?php echo getstatus($row['access_level2']); ?></td>
                          	<td width="120">
												<a rel="tooltip"  title="Edit School Details" id="<?php echo $id; ?>" href="add_Staff.php?view=editStaff<?php echo '&id='.$id; ?>"  data-toggle="modal" class="btn btn-success"><i class="fa fa-pencil icon-large"> Edit Record</i></a>
												</td>
												
										<!--		<td width="90">
			<a rel="tooltip"  title="View User Details" id="<?php echo $id; ?>" href="?details&id2=<?php echo $id;?>"
												
											
												  data-toggle="modal" class="btn btn-info"><i class="fa fa-file icon-large"> Info</i></a>
												</td> --!>
												<td width="90">
		<a href="javascript:changeUserStatus5(<?php echo $id3; ?>, '<?php echo $is_active; ?>');" class="btn btn-info" ><i class="fa fa-eye"></i>&nbsp;<?php echo $is_active == 'FALSE'? 'Show' : 'Hide'; ?></a>
												</td>
                        </tr>
                     
                        <?php } ?>
                      </tbody>
                      	</form>
                    </table>
                    