<div class="x_panel">
<div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                  <span class="section">Uploaded Courses for <?php echo $SGdept1; ?> .</span>
                    </p>
                    <form action="Delete_courseup.php" method="post">
                    <table id="datatable-responsive" class="table table-striped table-bordered"><?php   if (authorize($_SESSION["access3"]["sConfig"]["avc"]["delete"])){ ?>
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#delete_courseup" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a> <?php } ?>
                    	<button  name="goback"  id="goback" type='button' onClick="window.location.href='add_Courses.php?view=impc';" class="btn btn-primary " title="Click to go back" ><i class="fa fa-backward icon-large"></i> Go Back </button>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show');
									 $('#delete').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
											<?php

  
?>
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                          <th><?php echo $SGdept1 ; ?></th>
                          <th><?php echo $SCategory; ?> </th>
                          <th>Level</th>
                          <th>No of Courses Uploaded</th>
                        </tr>
                      </thead> <tbody>
 <?php  $user_query = mysqli_query($condb,"select * from courses group by dept_c,C_id ORDER BY C_id DESC")or die(mysqli_error($condb));
while($row_f = mysqli_fetch_array($user_query)){ $id = $row_f['dept_c']; 
$no_of_courses = mysqli_num_rows(mysqli_query($condb,"select * from courses where dept_c='".safee($condb,$row_f['dept_c'])."'"));
?>
<tr> <td width="30"> <input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>"></td>
						<td><?php echo getdeptc($row_f['dept_c']); ?></td>		
                          <td><?php echo getfacultyc($row_f['fac_id']); ?></td>
                        <td><?php echo getlevel($row_f['C_level'],$class_ID); ?></td>
						<td><span class="badge bg-green"><?php echo $no_of_courses; ?></span></td>
						 </tr>
                     <?php } ?>
                      </tbody>
                      	</form>
                    </table>
                  </div>  </div>