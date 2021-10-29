 <form action="Delete_cosallot.php" method="post">
                   <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <?php   if (authorize($_SESSION["access3"]["sMan"]["acos"]["create"])){ ?>
              <a href="allot_Courses.php?view=allotCourse" class="btn btn-info"  id="delete02" data-placement="right" title="Click to Allocate Course To Staff" ><i class="fa fa-plus icon-large"></i> Add Course Allocation</a> 
              <a href="allot_Courses.php?view=Search_Record" class="btn btn-info"  id="delete02" data-placement="right" title="Click to Search for More Course Allocation" ><i class="fa fa-user icon-large"></i> View More Allocation</a> 
              
              <?php  } if (authorize($_SESSION["access3"]["sMan"]["acos"]["delete"])){ ?> 	
                        <a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#Course_allot" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
										<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
										<?php } include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th></th>
                          <th>Assigned To</th>
                          <th><?php echo $SGdept1; ?></th>
                          <th>Course Code</th>
                          <th>Course Title</th>
                          <th>Session</th>
                          <th>Semester</th>
                          <th>Level</th>
                         <th>View Info</th>
                        
                        </tr>
                      </thead>


                      <tbody>
                       <?php //echo $depart." ".$session." ".$pro_level ;
  if(empty($depart) AND empty($session)){
 $queryallot = "select * from staff_details s,course_allottb c where s.staff_id = c.assigned and c.a_lotstatus='1' ORDER BY staff_id ASC limit 0,1000 ";
 }else{
 $queryallot = "select * from staff_details s,course_allottb c where s.staff_id = c.assigned and c.a_lotstatus='1' and c.dept = '".safee($condb,$depart)."' ";
if(!empty($session)){ $queryallot .= " AND c.session = '".safee($condb,$session)."'";}
if(!empty($pro_level)){ $queryallot .= " AND c.level = '".safee($condb,$pro_level)."'";}
$queryallot .= "  ORDER BY staff_id DESC ";}
 $user_query_b = mysqli_query($condb,$queryallot)or die(mysqli_error($condb));
													while($row_b = mysqli_fetch_array($user_query_b)){
													$id = $row_b['a_lotid'];
                                                    
													?>
				<tr>
                    <td width="30"> 
                   	<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">	
					</td>
 <td><?php echo getlect($row_b['assigned'])." ( ".$row_b['usern_id']." )"; ?></td>
                       <td><?php echo getdeptc($row_b['dept']); ?></td>
                          <td><?php echo $row_b['course']; ?></td>
                          <td><?php echo getcourse($row_b['course']); ?></td>
                          <td><?php echo $row_b['session']; ?></td>
                           <td><?php echo $row_b['semester'];//getstatus($idcheck); ?> </td>
     <td width="120">	<?php echo getlevel($row_b['level'],$class_ID);//getstatus($idcheck); ?></td>
     <td width="120"><a  title="View Student offering This Course <?php echo $row_b['course']; ?>" id="<?php echo $id;?>" href="?view=clist&userId=<?php echo $id;?>" 	  data-toggle="modal" class="btn btn-info"><i class="fa fa-file icon-large"> View Class</i></a></td>
                        </tr>
                     
                        <?php } ?>
                      </tbody>
                      
                      
                      	</form>
                    </table>