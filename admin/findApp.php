<?php
include('lib/dbcon.php'); 
dbcon();
$find_app = $_GET['loadapp1'];
$viewutme_query = mysqli_query($condb,"select * from new_apply1 where reg_status = '1' and first_Choice ='$find_app'")or die(mysqli_error($condb));
while($row_utme = mysqli_fetch_array($viewutme_query)){
//$id = $row_utme['appNo'];
$new_a_id = $row_utme['stud_id'];
?>     
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
						  <td><?php echo $row_utme['appNo']; ?></td>
                          <td><?php echo $row_utme['FirstName'].'  '.$row_utme['SecondName'].' '.$row_utme['Othername']; ?></td>
                          <td><?php echo $row_utme['Gender']; ?></td>
                          <td><?php echo $row_utme['phone']; ?></td>
                          <td><?php echo $row_utme['state']; ?></td>
                           <td><?php echo $row_utme['Asession']; ?></td>
                          <td><?php echo getdeptc($row_utme['first_Choice']); ?></td>
                          <td><?php echo getdeptc($row_utme['Second_Choice']); ?></td>
                          <td><?php echo $row_utme['J_score']; ?></td>
                          <td><?php echo getadminstatus($row_utme['adminstatus']);
						  
						   ?></td>
                          
                          	<td width="120">
												<a rel="tooltip"  title="Click To Process Student Admission" id="<?php echo $id; ?>" href="new_apply.php<?php echo '?id='.$id; ?>"  data-toggle="modal" class="btn btn-success"><i class="fa fa-gears icon-large"> Process Data</i></a>
												</td>
												
												<td width="90">
			<a rel="tooltip"  title="View Student Application Details" id="<?php echo $id; ?>" href="?details&userId=<?php echo $new_a_id;?>"
												
											
												  data-toggle="modal" class="btn btn-info"><i class="fa fa-file icon-large"> Info</i></a>
												</td>
                        </tr>
                     
                     
                        <?php } ?>
                        