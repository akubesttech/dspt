                    
					    
                      
                       <?php  		 
					   $q=$_GET['loadcos'];
	if($q > 0){	
	include('lib/dbcon.php'); dbcon(); 	
	include('session.php');						
$user_query = mysqli_query($condb,"select * from courses  WHERE dept_c = '".safee($condb,$q)."' and dept_c IS NOT NULL GROUP BY dept_c,C_title,C_id  ORDER BY dept_c ASC")or die(mysqli_error($condb));
}else{
$user_query = mysqli_query($condb,"select * from courses  WHERE  dept_c IS NOT NULL GROUP BY dept_c,C_title,C_id  ORDER BY dept_c ASC Limit 1,1000")or die(mysqli_error($condb));  $countrecord = mysqli_num_rows($user_query);
}$i = 0; ///if($countrecord > 0){
													while($row = mysqli_fetch_array($user_query)){
													$id = $row['C_id']; 
														if ($i%2) {$class = 'row1';} 
	else {$class = 'row2';}
	$i += 1;
												?>
                        <tr class="<?php echo $class; ?>">
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
												<td><?php echo getdeptc($row['dept_c']); ?></td>
                          <td><?php echo $row['C_title']; ?></td>
                          <td><?php echo $row['C_code']; ?></td>
                          <td><?php echo $row['C_unit']; ?></td>
                          <td><?php echo $row['semester']; ?></td>
                          <td><?php echo getlevel($row['C_level'],$class_ID); ?></td>
                          
                          	<td width="120">
                         <?php   if (authorize($_SESSION["access3"]["sConfig"]["avc"]["edit"])){ ?> 
												<a rel="tooltip"  title="Edit Course Details" id="deletec" href="add_Courses.php?view=editc&id=<?php echo ''.$id; ?>"  data-toggle="modal" class="btn btn-success" name=""><i class="fa fa-pencil icon-large"> Edit Record</i></a><?php } ?>
												<script type="text/javascript">
									 $(document).ready(function(){
									 $('#deletec').tooltip('show');
									 $('#deletec').tooltip('hide');
									 });
									</script>
												</td>
									
                        </tr>
                     
                      
                        <?php }  ?>
               
                      	