<!-- <script type="text/javascript" src="validation/jquery.minv.js"></script> --!>

  <div class="col-md-12 col-sm-12 col-xs-12">
  <?php  $serial=1; ?>
                <div class="x_panel">
                  <div class="x_title">
                  
                    <h2> List of Student Registered for <?php echo getcourse($_GET['userId']);?> .</h2>
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
                  <?php check_message(); ?>
                    </p>
                  <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
        Click On The Checkbox By The right To Record Your Student Attendance and As well Comfirm their Course Registration . 
                  </div>
                	<form  action="C_attend.php" name="formSubmit" class='form' id="formSubmit" method="post">
                    
                    <input type="hidden" name="type" value="<?php //echo $EmpID == '' ? 'Add' : 'Update'; ?>">
	     <input type="hidden" name="teacher" value="<?php echo $session_id; ?>">
	      <input type="hidden" name="sessionNow" value="<?php echo $default_session; ?>">
	 <input type="text" onchange="getData(this.value)" class="w8em format-d-m-y highlight-days-67 range-low-today" readonly style="margin-left: 20px; display:none;" name="date" id="datepicker_value" value="<?php echo date('Y-m-d'); ?>" >
	 
                    <table id="datatable" class="table table-striped table-bordered">
                    <!--	<a data-placement="top" title="Click to Delete check item"   data-toggle="modal" href="#student_delete" id="delete22"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
                    	&nbsp;&nbsp;&nbsp;
								<a href="new_apply.php?view=imp_a" class="btn btn-info"  id="delete21" data-placement="right" title="Click to import Student UTME Exam Result" ><i class="fa fa-file icon-large"></i> Import Data</a>
								&nbsp;&nbsp;&nbsp;
	<input style="margin: 20px;cursor: pointer;" type="button" class="btn btn-info" id="save" name="save"  title="Click to Mark Student Attendance" value="Attendance" onclick="setData()">--!>
	    	<a data-placement="top" title="Click to Mark Student Attendance"    data-toggle="modal" href="#course_attendance" id="delete2"  class="btn btn-info" name=""  ><i class="fa fa-plus icon-large"> Mark Attendance</i></a>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
										<?php include('../admin/modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th>S/N</th>
                         <th>Registration No</th>
                         <th>Student Name</th>
                          <th>Course Title</th>
                          <th>Course Code</th>
                          <th>Session</th>
                          <th>Semester</th>
                          <th>Level</th>
                          <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> Attendance</th>
                         <th>Action</th>
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php
$depart = $_GET['dept1_find'];
$session=$_GET['session2'];
$entry_mode= $_GET['moe2'];
$viewcourseallot1=mysqli_query($condb,"select * from coursereg_tb where c_code ='". safee($_GET['userId']) ."' and session ='". safee($default_session) ."'  and semester='". safee($default_semester) ."' ");
		while($row_allot = mysqli_fetch_array($viewcourseallot1)){
		$id = $row_allot['class_id'];
		$course_id = $row_allot['course'];
		$course_approve = $row_allot['lect_approve'];
		$course_reg = $row_allot['sregno'];
?>     
                        <tr>
                        	<td width="30"><?php echo $serial++; ?>
											
												</td>
						  <td><?php 
						  echo $row_allot['sregno'];?></td>
					 <td><?php  echo getname($row_allot['sregno']); ?></td>
                          <td><?php echo getcourse($row_allot['c_code']); ?></td>
                          <td><?php echo $row_allot['c_code']; ?></td>
                          <td><?php echo $row_allot['session']; ?></td>
                          <td><?php echo $row_allot['semester']; ?></td>
                          <td><?php echo getlevel($row_allot['level']); ?></td>
                          <input type="hidden" name="term" value="<?php echo $row_allot['semester']; ?>">
                           <td><input type='checkbox' name="selector[]" id="optionsCheckbox" class="selector"  value="<?php echo $row_allot['sregno']; ?>" /><span> Present   </span></td>
                          
												<td width="90">
	
<a rel="tooltip"  title="Check Course Approval Status <?php echo $row_allot['course']; ?>" id="delete1" href="javascript:changeUserStatus6(<?php echo $course_reg; ?>, '<?php echo $course_approve; ?>');" class="btn btn-info" ><i class="fa fa-check"></i>&nbsp;<?php echo $course_approve == '0'? 'Not Approved' : 'Approved'; ?></a>
												</td>
											
                        </tr>
                     
                     
                        <?php } ?>
                      </tbody>
                      
                       </table>
                      	</form>
                   
                  </div>
                </div>
              </div>