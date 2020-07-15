
 
                    <form action="delete_cand.php" method="post">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                    <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Please click the Appropriate Candidate image to approve Election result (s) and <strong>Approve</strong> button to Approve Candidate for Election . 
                  </div>
                     <?php   if (authorize($_SESSION["access3"]["emanag"]["acand"]["create"])){ ?>
                <a href="election.php?view=add_cand" class="btn btn-info"  id="delete02" data-placement="right" title="Click to Add New Candidate" ><i class="fa fa-plus icon-large"></i> Add New Candidate</a>&nbsp;&nbsp;&nbsp; <?php } ?> <?php   if (authorize($_SESSION["access3"]["emanag"]["acand"]["delete"])){ ?>
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#delete_candi" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a><?php } ?>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show');$('#delete02').tooltip('show');
									 $('#delete').tooltip('hide');$('#delete02').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th></th>
                         <th>Photo</th>
                          <th>Election</th>
                          <th>Position</th>
                          <th>Matric / Reg No </th>
                          <th>Name</th>
                            <th>CGPA</th>
                          <th>No of Votes</th>
                          <th>Action</th>
                         
                        
                        </tr>
                      </thead>


                      <tbody>
                       <?php
                      /* "select * from courses  WHERE dept_c IS NOT NULL GROUP BY dept_c,C_title  ORDER BY dept_c ASC" */
  $user_query_b = mysqli_query($condb,"select * from candidate_tb  ORDER BY ecate ASC limit 0,1000")or die(mysqli_error($condb));
			$date_now =  date("Y-m-d");	while($row_b = mysqli_fetch_array($user_query_b)){ 
		$id = $row_b['candid'];$picget1 = $row_b['image'];$existsc1 = imgExists($picget1);
		$is_active = $row_b['approve']; $electid = getecated($row_b['ecate']);
$queryprog = mysqli_query($condb,"SELECT * FROM electiontb where   ecate ='".$row_b['ecate']."'  ORDER BY ecate DESC");
    $countersac = mysqli_num_rows($queryprog);	 
								 ?>  <tr>
                    <td width="30"> 
                   	<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">	
	</td><td><!--<a rel="tooltip"  title="View Candidate Details" id="<?php echo $new_a_id; ?>"  onclick="window.open('?details&id2=<?php echo $id;?> ','_self')" data-toggle="modal" class="clickable2-row"><img src="<?php if ($exists > 0 ){print $picget;}else{ print "./uploads/NO-IMAGE-AVAILABLE.jpg";}?>" class="avatar" alt="user image"> <progress value="25" max="200" id=p1>50%</progress> </a>--!>
					<a rel="facebox" href="cdetails.php?id=<?php echo $id; ?>"  title="View Candidate Details" id="<?php echo $new_a_id; ?>"><img src="<?php if ($existsc1 > 0 ){print $picget1;}else{ print "./uploads/NO-IMAGE-AVAILABLE.jpg";}?>" class="avatar" alt="user image"> </a>
					</td><td><?php echo getecate($row_b['ecate']); ?><?php if($electid == "2"){ echo $nelect = " (".getfacultyc($row_b['fac']).")"; }elseif($electid == "1"){ echo $nelect = " (".getdeptc($row_b['dept']).")";}else{}  ?></td>
                          <td><?php echo getelectpost($row_b['post']); ?></td>
                          <td><?php echo $row_b['regno']; ?></td>
                          <td><?php echo $row_b['fname']." ".$row_b['lname']; ?></td>
                          <td><?php echo $row_b['cgpa']; ?></td>
                          <td><a rel="facebox" href="lvotes.php?cid=<?php echo $row_b['regno']; ?>&posit=<?php echo $row_b['post']; ?>&ecate=<?php echo $row_b['ecate']; ?>&nov=<?php echo $row_b['votes']; ?>" title="click to view the breakdown of votes"><?php echo $row_b['votes']; ?></a></td>
                           <td> <?php   if (authorize($_SESSION["access3"]["emanag"]["acand"]["edit"])){ ?><?php if($is_active > 0){ }else{ ?><a rel="tooltip"  title="Edit Candidate" id="deletec" href="election.php?view=editcand&id=<?php echo $id; ?>"  data-toggle="modal" class="btn btn-success" name=""><i class="fa fa-edit icon-large"> Edit </i></a><?php } } ?> <?php   if (authorize($_SESSION["access3"]["emanag"]["acand"]["create"])){ ?>
                          <a href="javascript:changeUserStatus7(<?php echo $id; ?>, '<?php echo $is_active; ?>');" class="btn btn-info" ><i class=" <?php echo $is_active == '0'? 'fa fa-check' : 'fa fa-remove'; ?>"></i>&nbsp;<?php echo $is_active == '0'? 'Approve' : 'Decline'; ?></a><?php } ?>
						   </td>
                        </tr>
                     
                        <?php } ?>
                      </tbody>
                      
                      
                      	</form>
                    </table>
                    
                    
       