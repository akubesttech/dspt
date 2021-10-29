<!-- <script type="text/javascript" src="validation/jquery.minv.js"></script> --!>
<?php  $serial=1;
$queryallot = mysqli_query($condb,"select * from course_allottb where a_lotid ='". safee($condb,$_GET['userId']) ."'  ");
$row_an = mysqli_fetch_assoc($queryallot); $ccode = $row_an['course'];  $level = $row_an['level']; $session = $row_an['session'];
$sem = $row_an['semester']; $depart =  $row_an['dept']; $lecs =  $row_an['assigned'];
?>
<?php if($Rorder == "10"){ $gback = "Course_m.php?view=v_allot"; ?> <div class="col-md-12 col-sm-12 col-xs-12">
  
                <div class="x_panel">
                  <div class="x_title">
                  
                    <h2> List of Student Registered for <?php echo getcourse($ccode);?> .</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div> <?php }else{ $gback = "allot_Courses.php";} ?>
                  
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                  <?php //check_message(); ?>
                    </p>
                  <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
        Click On The Checkbox By The right To Record Your Student Attendance and As well Comfirm their Course Registration . 
                  </div>
                	<form  action="" name="formSubmit" class='form' id="formSubmit" method="post" enctype="multipart/form-data" >
     <input type="hidden" name="type" value="<?php //echo $EmpID == '' ? 'Add' : 'Update'; ?>">
	     <input type="hidden" name="teacher" value="<?php echo $session_id; ?>">
	      <input type="hidden" name="sessionNow" value="<?php echo $default_session; ?>">
           <input type="hidden" name="ccode" value="<?php echo $ccode; ?>">
           <input type="hidden" name="sec" value="<?php echo $session; ?>">
           <input type="hidden" name="lev" value="<?php echo $level; ?>">
           <input type="hidden" name="dept" value="<?php echo $depart; ?>">
           <input type="hidden" name="lecid" value="<?php echo $lecs; ?>">
            <input type="hidden" name="alotid" value="<?php echo $_GET['userId']; ?>">
	 <input type="hidden" onchange="getData(this.value)" class="w8em format-d-m-y highlight-days-67 range-low-today" readonly style="margin-left: 20px; display:none;" name="date" id="datepicker_value" value="<?php echo date('Y-m-d'); ?>" >
	 
                    <table id="datatable-responsive" class="table table-striped table-bordered">
                    <!-- C_attend.php	<a data-placement="top" title="Click to Delete check item"   data-toggle="modal" href="#student_delete" id="delete22"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
                    	&nbsp;&nbsp;&nbsp;
								<a href="new_apply.php?view=imp_a" class="btn btn-info"  id="delete21" data-placement="right" title="Click to import Student UTME Exam Result" ><i class="fa fa-file icon-large"></i> Import Data</a>
								onclick="setData()" &nbsp;&nbsp;&nbsp;
	<input style="margin: 20px;cursor: pointer;" type="button" class="btn btn-info" id="save" name="save"  title="Click on left Checkbox to Approve Registered Courses" value="Approve" >
		<button name="addmemt" class="btn btn-info"  id="add2" data-placement="right" title="Click to add class Member"><i class="fa-plus icon-large"> Add Selected Student(s)</i></button>--!>
	    	<a data-placement="top" title="Click to Mark Student Attendance"    data-toggle="modal" href="#course_attendance" id="delete2"  class="btn btn-info" name=""  ><i class="fa fa-plus icon-large"> Mark Attendance</i></a>
			 <a href="#" onclick="window.open('<?php echo $gback; ?>','_self')" class="btn btn-info"  id="delete" data-placement="right" title="Click to Go back" ><i class="fa fa-backward icon-large"></i> Go back</a>
                <button class="btn btn-info" name="Courseapprove" title="Click to Approve course Registration" type="submit" id="com"><i class="icon-save icon-large"></i> Approve Courses </button>
			 <a 	href="javascript:void(0);" onclick="window.location.href='Classresult.php?userId=<?php echo $_GET['userId']; ?>';" class="btn btn-info"  id="delete1" data-placement = "right" title="Click to View Class Result" ><i class="fa fa-file"></i> View Result</a>
 		       		<a 	href="javascript:void(0);" onclick="window.location.href='exportdata.php?dept1=<?php echo $depart; ?>&session=<?php echo $session; ?>&level=<?php echo $level; ?>&semester=<?php echo $sem; ?>&cos=<?php echo $ccode; ?>';" class="btn btn-info"  id="penper" data-placement = "right" title="Click to export Class List to Excel Format (.xls) to be used as result upload template" ><i class="fa fa-file-excel-o"></i>  Export Class List</a>

   <script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');$('#penper').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');$('#penper').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                       <!-- <th><input type="checkbox" name="chkall3" id="chkall3" onclick="return checkall3('selector3[]');"> </th>--!>
                         <th></th>
                         <th>Mat No</th>
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
//$depart = $_GET['dept1_find'];
//$session=$_GET['session2'];
//$entry_mode= $_GET['moe2'];

$viewcourseallot1=mysqli_query($condb,"select * from coursereg_tb where c_code = '". safee($condb,$ccode) ."' and dept = '". safee($condb,$depart) ."' and session = '".safee($condb,$session)."'  and semester = '".safee($condb,$sem)."' and level = '".safee($condb,$level)."' ");
		while($row_allot = mysqli_fetch_array($viewcourseallot1)){
		$id = $row_allot['creg_id'];
		$course_id = $row_allot['course_id'];
		$course_approve = $row_allot['lect_approve'];
		$course_reg = $row_allot['sregno'];
?>     
<tr><td><input type='checkbox' name="selector3[]" id="optionsCheckbox2" class="selector3"  value="<?php echo $id; ?>" /></td>
                        <!--	<td width="30"><?php //echo $serial++; ?></td>--!>
						  <td><?php 
						  echo $row_allot['sregno'];?></td>
					 <td><?php  echo getname($row_allot['sregno']); ?></td>
                          <td><?php echo getcourse($row_allot['c_code']); ?></td>
                          <td><?php echo $row_allot['c_code']; ?></td>
                          <td><?php echo $row_allot['session']; ?></td>
                          <td><?php echo $row_allot['semester']; ?></td>
                          <td><?php echo getlevel($row_allot['level'],$class_ID); ?></td>
                          <input type="hidden" name="term" value="<?php echo $row_allot['semester']; ?>">
                           <td><input type='checkbox' name="selector[]" id="optionsCheckbox" class="selector"  value="<?php echo $row_allot['sregno']; ?>" /><span> Present   </span></td>
                          
<td width="90"><a rel="tooltip"  title="Check Course Approval Status <?php echo getccode2($course_id); ?>" id="delete1" href="javascript:changeUserStatus6('<?php echo $id; ?>','<?php echo $_GET['userId']; ?>','<?php echo $Rorder; ?>','<?php echo $lecs; ?>','<?php echo $course_approve; ?>');" class="btn btn-info" ><i class="fa fa-check  <?php echo $course_approve == '0'? 'fa fa-check' : 'fa fa-remove'; ?>"></i>&nbsp;<?php echo $course_approve == '0'? 'Approve' : 'Decline'; ?></a></td>
											
                        </tr>
                     
                     
                        <?php } ?>
                      </tbody>
                      
                       </table>
                      	</form>
                   
                  </div>
                  
                  
           <?php if($Rorder == "10"){ ?>  </div></div> <?php } ?>