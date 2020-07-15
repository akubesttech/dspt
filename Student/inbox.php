 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2>Received Messages</h2>
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
                    	
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show');
									 $('#delete').tooltip('hide');$('#delete1').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                          <th>Sender Image</th>
						  <th>From</th>
                          <th>Subject</th>
                         <th>Time Sent</th>
                          <th>Delete</th>
                       
                        </tr>
                      </thead>


                      <tbody>
                       <?php
                             if($_GET['unread'] == "235"){
$user_query = mysqli_query($condb,"select * from b_pms where receiver='$student_RegNo' and hasread = '0' order by therealtime DESC")or die(mysqli_error($condb));
					}else{
$user_query = mysqli_query($condb,"select * from b_pms where receiver='$student_RegNo' order by therealtime DESC")or die(mysqli_error($condb));
				}
					while($row_f = mysqli_fetch_array($user_query)){
													$id = $row_f['news_id']; $senderin = $row_f['sender'];
													 $is_active = $row_f['s_status'];
													 $is_active2 = $row_f['r_status'];
					$studentimagein = mysqli_fetch_array(mysqli_query($condb,"SELECT * from student_tb where RegNo = '$senderin'"));
					$staffimagevin = mysqli_fetch_array(mysqli_query($condb,"SELECT * from staff_details where usern_id = '$senderin'"));
					$adminimagevin = mysqli_fetch_array(mysqli_query($condb,"SELECT * from admin where admin_id = '$senderin'"));
			$exists2 = imgExists($studentimage['images']);
   $exists3 = imgExists("../admin/".$staffimagev['image']);
   $exists4 = imgExists("../admin/".$adminimagevin['adminthumbnails']);		
													?>
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
	<td>
		<?php  if($row_f['r_status']=='1'){ ?>
	
<img src="<?php //if($studentimagein['images']==NULL ){print "./uploads/NO-IMAGE-AVAILABLE.jpg";}else{print $studentimagein['images'];} 
	if ($exists2 > 0 ){print $studentimagein['images'];
	}else{ "./uploads/NO-IMAGE-AVAILABLE.jpg";}

	?>" style="width:50px;height:30px;" class="avatar" alt="image" />
	<?php	}elseif($row_f['r_status']=='2'){ ?>
	<img src="../admin/<?php //if($staffimagevin['image']==NULL ){print "./uploads/NO-IMAGE-AVAILABLE.jpg";}else{print $staffimagevin['image'];}
	if ($exists3 > 0 ){print $staffimagev['image'];
	}else{ print "./uploads/NO-IMAGE-AVAILABLE.jpg";}
	 ?>" style="width:50px;height:30px;" class="avatar" alt="image" />	<?php }else{ ?>
<img src="../admin/<?php //if($adminimagevin['adminthumbnails']==NULL ){print "./uploads/NO-IMAGE-AVAILABLE.jpg";}else{ print $adminimagevin['adminthumbnails'];}
if ($exists4 > 0 ){print $adminimagevin['adminthumbnails']; }else{ print "./uploads/NO-IMAGE-AVAILABLE.jpg";}
 ?>" style="width:50px;height:30px;" class="avatar" alt="image" /><?php	}  ?>
	</td>
                          <td><?php 
								  if($row_f['r_status']=='1'){
							echo ucfirst($row_f['sender']) ." (Student)";
							}elseif($row_f['r_status']=='2'){
						echo ucfirst(getstaff2($row_f['sender']))  ." (Staff)";
						}else{ 
					echo ucfirst(getadmin2($row_f['sender']))  ." (Admin)";
					} ?></td>
					<?php if($row_f['hasread'] > 0){  ?>
        <td><a href='message_m.php?view=sendM&ID=<?php echo $row_f['pmID']; ?>'><?php echo $row_f['subject']; ?></a></td>
        <?php }else{  ?>
        <td><a href='message_m.php?view=sendM&ID=<?php echo $row_f['pmID']; ?>'><font color="green"><?php echo $row_f['subject']; ?></font></a></td>
         <?php }  ?>
                          <td><?php echo $row_f['vartime']; 
						  //echo ucfirst(substr($row_f['message'],0,60)); ?></td>
                         
                          	<td width="120">
											
					<a rel="tooltip"  title="Click to Delete Message" id="delete" href="message_m.php?delid=<?php echo $row_f['pmID']; ?> "  data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash icon-large"> Delete</i></a>
												</td>
											
                        </tr>
                     
            
                        <?php } ?>
                      </tbody>
                      	</form>
                    </table>
                  </div>
                </div>
              </div>