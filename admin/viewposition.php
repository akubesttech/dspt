
 
                    <form action="delete_posi.php" method="post">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                    <?php   if (authorize($_SESSION["access3"]["emanag"]["apost"]["create"])){ ?>
                <a href="election.php?view=add_post" class="btn btn-info"  id="delete02" data-placement="right" title="Click to Add New Position" ><i class="fa fa-plus icon-large"></i> Add New Position</a>&nbsp;&nbsp;&nbsp; <?php } ?><?php  if (authorize($_SESSION["access3"]["emanag"]["apost"]["view"])){ ?>
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#delete_position" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a><?php } ?>
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
                          <th>Position</th>
                          <th>Description</th>
                          <th>Category</th>
                          <th>Required CGPA</th>
                           <th>Maximum Vote</th>
                          <th>Action</th>
                         
                        
                        </tr>
                      </thead>


                      <tbody>
                       <?php
                      /* "select * from courses  WHERE dept_c IS NOT NULL GROUP BY dept_c,C_title  ORDER BY dept_c ASC" */
                       	$user_query_b = mysqli_query($condb,"select * from post_tb  ORDER BY position ASC limit 0,500")or die(mysqli_error($condb));
													while($row_b = mysqli_fetch_array($user_query_b)){
													$id = $row_b['postid'];?>  <tr>
                    <td width="30"> 
                   	<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">	
					</td><td><?php echo $row_b['position']; ?></td>
                          <td><?php echo $row_b['description']; ?></td>
                          <td><?php echo getcateg($row_b['ecate1']); ?></td>
                          <td><?php echo $row_b['minGP']; ?></td>
                          <td><?php echo $row_b['mvote']; ?></td>
                           <td><?php   if (authorize($_SESSION["access3"]["emanag"]["apost"]["edit"])){ ?><a rel="tooltip"  title="Edit Position" id="deletec" href="election.php?view=edit_posit&id=<?php echo $id; ?>"  data-toggle="modal" class="btn btn-success" name=""><i class="fa fa-edit icon-large"> Edit </i></a> <?Php } ?>
						   </td>
                        </tr>
                     
                        <?php } ?>
                      </tbody>
                      
                      
                      	</form>
                    </table>
                    
                    
       