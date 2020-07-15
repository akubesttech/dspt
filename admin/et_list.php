 
                    <form action="Delete_lectime.php" method="post">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                <a href="lecture_time.php?view=examt" class="btn btn-info"  id="delete02" data-placement="right" title="Click to Add Exam time Table" ><i class="fa fa-plus icon-large"></i> Add Exam Time</a>&nbsp;&nbsp;&nbsp;
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#LecSettime" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show');$('#delete02').tooltip('show');
									 $('#delete').tooltip('hide');$('#delete02').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                          <th>Department</th>
                          <th>Course Code</th>
                           <th>Course Title</th>
                            <th>Exam Date</th>
                       <th>Exam Time</th>
                          <th>Session</th>
                          <th>Semester</th>
                          <th>Level</th>
                         
                        
                        </tr>
                      </thead>


                      <tbody>
                       <?php
                      /* "select * from courses  WHERE dept_c IS NOT NULL GROUP BY dept_c,C_title  ORDER BY dept_c ASC" */
                       	$user_query_b = mysqli_query($condb,"select * from examtime_tb where prog = '".safee($condb,$class_ID)."'  ORDER BY t_dept  ASC limit 0,1000")or die(mysqli_error($condb));
													while($row_b = mysqli_fetch_array($user_query_b)){
													$id = $row_b['time_id'];   $start = $row_b['time'] ; $duration = $start + $row_b['duration'];
													$p_send = $row_b['date'];
                       $timestamp = strtotime($p_send);
$datetime	= date('l, jS F Y', $timestamp);
//$viewreg_query = mysql_query("select  * from admin where admin_id='$session_id' AND access_level = '1'")or die(mysql_error());
//$viewreg_query2 = mysql_query("select  * from admin where admin_id='$session_id' AND access_level = '$admin_accesscheck'")or die(mysql_error());
							//$row_utme = mysql_fetch_array($viewreg_query)
													?>
													
													
                        <tr>
                    <td width="30"> 
                   	<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">	
					</td>
										
                          <td><?php echo getdeptc($row_b['t_dept']); ?></td>
                          <td><?php echo $row_b['course']; ?></td>
                          <td><?php echo getcourse($row_b['course']); ?></td>
                          <td><?php echo $datetime; ?></td>
                          
                          <td><?php echo setStime($row_b['time'])." - " .setStime($duration); ?></td>
                           <td><?php echo $row_b['session'];//getstatus($idcheck); ?> </td>
                        <td><?php echo $row_b['semester'];//getstatus($idcheck); ?></td>
                        <td><?php echo getlevel($row_b['t_level'],$class_ID);//getstatus($idcheck); ?></td>
                        </tr>
                     
                        <?php } ?>
                      </tbody>
                      
                      
                      	</form>
                    </table>