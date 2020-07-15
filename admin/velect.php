
 
                    <form action="delete_elect.php" method="post">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                    <?php   if (authorize($_SESSION["access3"]["emanag"]["velect"]["create"])){ ?>
                <a href="election.php?view=addelect" class="btn btn-info"  id="delete02" data-placement="right" title="Click to Add New Election" ><i class="fa fa-plus icon-large"></i> Add New Election</a>&nbsp;&nbsp;&nbsp; <?php } ?><?php   if (authorize($_SESSION["access3"]["emanag"]["velect"]["delete"])){ ?><a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#delete_elect" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a><?php } ?>
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
                         <th>Election Title</th>
                          <th>Category</th>
                          <th><?php echo $SCategory; ?></th>
                          <th>Department</th>
                          <th>Start</th>
                           <th>End</th>
                          <th>Action</th>
                         
                        
                        </tr>
                      </thead>


                      <tbody>
                       <?php
                      /* "select * from courses  WHERE dept_c IS NOT NULL GROUP BY dept_c,C_title  ORDER BY dept_c ASC" */
 $user_query_b = mysqli_query($condb,"select * from electiontb  ORDER BY title ASC limit 0,1000")or die(mysqli_error($condb));
													while($row_b = mysqli_fetch_array($user_query_b)){
$eend2 = $row_b['eend']; $date_now = new DateTime(); $date2 = new DateTime($eend2); $is_active = $row_b['estatus']; $date_now2 =  date("Y-m-d");
$id = $row_b['id']; if($date_now > $date2){ $update20 = mysqli_query($condb,"UPDATE electiontb SET estatus = '1' WHERE eend < '".safee($condb,$date_now2)."' and id = '".safee($condb,$id)."' "); $hidem = "display: none;";}else{  $hidem = "";
$update20 = mysqli_query($condb,"UPDATE electiontb SET estatus = '0' WHERE eend > '".safee($condb,$date_now2)."' and id = '".safee($condb,$id)."' ");
}

 ?>  <tr>
                    <td width="30"> 
                   	<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">	
					</td><td><?php echo $row_b['title']; ?></td>
                          <td><?php echo getcateg($row_b['ecate']); ?></td>
                          <td><?php if($row_b['fac'] > 0){ echo getfacultyc($row_b['fac']);}else{ echo "------";} ?></td>
                          <td><?php if($row_b['dept'] > 0){ echo getdeptc($row_b['dept']);}else{ echo "-------";} ?></td>
                          <td><?php echo $row_b['estart']; ?></td>
                          <td><?php echo $row_b['eend']; ?></td>
                           <td><?php   if (authorize($_SESSION["access3"]["emanag"]["velect"]["edit"])){ ?><?php if($date_now > $date2){ ?><a rel="tooltip"  title="Election period expired" id="deletec" href="election.php?view=editelect&id=<?php echo $id; ?>"  data-toggle="modal" class="btn btn-danger" name=""><i class="fa fa-edit icon-large"> Edit </i></a> <?php }else{ ?>
                  <a rel="tooltip"  title="Edit Position" id="deletec" href="election.php?view=editelect&id=<?php echo $id; ?>"  data-toggle="modal" class="btn btn-success" name=""><i class="fa fa-edit icon-large"> Edit </i></a><?php } ?><a href="javascript:changeUserStatus9(<?php echo $id; ?>, '<?php echo $is_active; ?>');" class="btn btn-info" style="<?php echo $hidem; ?>" ><i class=" <?php echo $is_active == '1'? 'fa fa-check' : 'fa fa-remove'; ?>"></i>&nbsp;<?php echo $is_active == '1'? 'Start' : 'Stop'; ?></a>  <?php } ?>    
						   </td>
                        </tr>
                     
                        <?php } ?>
                      </tbody>
                      
                      
                      	</form>
                    </table>
                    
                    
       