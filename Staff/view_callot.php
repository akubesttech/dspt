  <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  
                    <h2>List of Courses Allocated</h2>
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
                  <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
        List of Courses Allocated To You. 
                  </div>
                  
                    <form action="Delete_student.php" method="post">
                    
                    <table id="datatable" class="table table-striped table-bordered">
                    <!--	<a data-placement="top" title="Click to Delete check item"   data-toggle="modal" href="#student_delete" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
                    	&nbsp;&nbsp;&nbsp;
								<a href="new_apply.php?view=imp_a" class="btn btn-info"  id="delete2" data-placement="right" title="Click to import Student UTME Exam Result" ><i class="fa fa-file icon-large"></i> Import Data</a> --!>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
										<?php include('../admin/modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                         <th>Department</th>
                         <th>Course Code</th>
                          <th>Course Title</th>
                          <th>Session</th>
                          <th>Semester</th>
                          <th>Level</th>
                          <th>Date Allocated</th>
                         <th>View Info</th>
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php
$depart = $_GET['dept1_find'];
$session=$_GET['session2'];
$entry_mode= $_GET['moe2'];


$viewcourseallot1=mysqli_query($condb,"select * from course_allottb where assigned ='". safee($condb,$session_id) ."' and session ='". safee($condb,$default_session)."'  and semester='". safee($condb,$default_semester) ."' ");
		while($row_allot = mysqli_fetch_array($viewcourseallot1)){
		$id = $row_allot['class_id'];
		$course_id = $row_allot['course'];
?>     
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
						  <td><?php 
						  echo getdeptc($row_allot['dept']);?></td>
					 <td><?php  echo $row_allot['course']; ?></td>
                          <td><?php echo getcourse($row_allot['course']); ?></td>
                          <td><?php echo $row_allot['session']; ?></td>
                          <td><?php echo $row_allot['semester']; ?></td>
                          <td><?php echo getlevel($row_allot['level']); ?></td>
                           <td><?php echo $row_allot['a_lotdate']; ?></td>
                          
												<td width="90">
			<a rel="tooltip"  title="View Student offering This Course <?php echo $row_allot['course']; ?>" id="delete1" href="?view=clist&userId=<?php echo $course_id;?>" 	  data-toggle="modal" class="btn btn-info"><i class="fa fa-file icon-large"> View Class</i></a>
												</td>
                        </tr>
                     
                     
                        <?php } ?>
                      </tbody>
                      
                      
                      	</form>
                    </table>
                  </div>
                </div>
              </div>