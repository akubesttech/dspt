<!-- <script type="text/javascript" src="validation/jquery.minv.js"></script> --!>

  <div class="col-md-12 col-sm-12 col-xs-12">
  <?php  
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
$depart = $_GET['Schd'];
$session=$_GET['sec'];
$coursecodes= $_GET['scos'];
$courselevel= $_GET['slos'];
  $serial=1;
   ?>
                <div class="x_panel">
                  <div class="x_title">
                  
                    <h2> List of Student(s) that Registered Courses in <?php echo getdeptc($depart)." ".getlevel($courselevel,$class_ID).", for ".$session." Academic Session";?> .</h2>
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
        Click On The Student Matric Number to approve Course Registration . 
                  </div>
                	<form  action="approve_course.php" name="formSubmit" class='form' id="formSubmit" method="post">
                    
                    <input type="hidden" name="type" value="<?php //echo $EmpID == '' ? 'Add' : 'Update'; ?>">
	     <input type="hidden" name="teacher" value="<?php echo $session_id; ?>">
	      <input type="hidden" name="sessionNow" value="<?php echo $default_session; ?>">
	    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" >
                    <!--	<a data-placement="top" title="Click to Delete check item"   data-toggle="modal" href="#student_delete" id="delete22"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
                    	&nbsp;&nbsp;&nbsp;
								<a href="new_apply.php?view=imp_a" class="btn btn-info"  id="delete21" data-placement="right" title="Click to import Student UTME Exam Result" ><i class="fa fa-file icon-large"></i> Import Data</a>
								onclick="setData()" &nbsp;&nbsp;&nbsp;
<button name="addmemt" class="btn btn-info"  id="add2" data-placement="right" title="Click to add class Member"><i class="fa-plus icon-large"> Add Selected Student(s)</i></button>
	    	<a data-placement="top" title="Click to approve Selected Student Course Registration"    data-toggle="modal" href="#approve_c" id="delete2"  class="btn btn-info" name=""  ><i class="fa fa-check icon-large"> Approve Registered Courses</i></a>--!>
	    	<a data-placement="top" title="Click Here to Go Back"    href="javascript:void(0);" onClick="window.location.href='Result_am.php?view=apcs';" id="delete1"  class="btn btn-primary" name="divButton2"  ><i class="fa fa-arrow-left icon-large"> Go Back</i></a>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                     <th><input type="checkbox" name="chkall3" id="chkall3" onclick="return checkall3('selector3[]');"> </th>
                         <th>S/N</th>
                         <th>Matric No</th>
                         <th>Student Name</th>
                         <!-- <th>Course Title</th>
                          <th>Course Code</th>--!>
                          <th><?php echo $SGdept1; ?></th>
                          <th>Semester</th>
                          <th>Level</th>
                          <th>No Courses Registered</th>
                         <th>Remark</th>
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php
//$viewcourseallot1=mysqli_query($condb,"select * from coursereg_tb where c_code ='". safee($condb,$coursecodes) ."' and session ='". safee($condb,$session) ."'  and dept='". safee($condb,$depart) ."' ");
$viewcourseallot1=mysqli_query($condb,"select sregno,dept,session,level from coursereg_tb where level ='". safee($condb,$courselevel) ."' and session ='". safee($condb,$session) ."'  and dept='". safee($condb,$depart) ."' and creg_status = '1'  GROUP BY sregno");  
		while($row_allot = mysqli_fetch_array($viewcourseallot1)){
		$id = $row_allot['creg_id'];  $course_id = $row_allot['course_id'];
		$course_approve = $row_allot['lect_approve']; $course_reg = $row_allot['sregno'];
		$countreg = mysqli_query($condb,"select * from coursereg_tb where level ='". safee($condb,$courselevel) ."' and session ='". safee($condb,$session) ."'  and dept='". safee($condb,$depart) ."' and creg_status = '1' and sregno ='". safee($condb,$course_reg) ."'");
	$getnocreg = mysqli_num_rows($countreg);	
$resultapp = mysqli_query($condb,"select * from coursereg_tb where level ='". safee($condb,$courselevel) ."' and session ='". safee($condb,$session) ."'  and dept='". safee($condb,$depart) ."' and lect_approve ='0' and sregno ='". safee($condb,$course_reg) ."'  GROUP BY sregno,creg_id");   $getnounapproved = mysqli_num_rows($resultapp); ?>     
<tr><td> <?php if($getnounapproved > 0){ $status ="Not Approved"; ?><input type='checkbox' name="selector3[]" id="optionsCheckbox2" class="selector3"  value="<?php echo $row_allot['creg_id']; ?>" /> <?php }else{ $status ="Approved"; ?> <input type='checkbox' name="selector3[]" id="optionsCheckbox2" class="selector3" checked="checked" value="<?php echo $row_allot['creg_id']; ?>" />  <?php } ?></td>
     <input type="hidden" name="deptcp[]" value="<?php echo $depart; ?>">
	      <input type="hidden" name="sessions[]" value="<?php echo $session; ?>">
	     <input type="hidden" name="cosd[]" value="<?php echo $course_id; ?>">
                        	<td width="30"><?php echo $serial++; ?></td>
						  <td>
<a rel="tooltip"  title="View Student Registered Courses" id="<?php echo $new_a_id; ?>"  onclick="window.open('?view=caprove&dlist&userId=<?php echo $course_reg;?>&Schd=<?php echo $depart; ?>&sec=<?php echo $session; ?>&slos=<?php echo $courselevel; ?>','_self')" data-toggle="modal" class="btn btn-info"><i class=""><?php echo $row_allot['sregno'];?></i></a></td>
					 <td><?php  echo getname($row_allot['sregno']); ?></td>
                         <!-- <td><?php echo getcourse($row_allot['c_code']); ?></td>
                          <td><?php echo $row_allot['c_code']; ?></td>--!>
                          <td><?php echo getdeptc($row_allot['dept']); ?></td>
                          <td><?php echo $row_allot['session']; ?></td>
                          <td><?php echo getlevel($row_allot['level'],$class_ID); ?></td>
                          <td><?php echo $getnocreg; ?></td>
                          <input type="hidden" name="term" value="<?php echo $row_allot['semester']; ?>">
<!-- <td><input type="button" name="view" value="view" id="<?php echo $row_allot["sregno"]; ?>" class="btn btn-info btn-xs view_data" /></td>
<a rel="tooltip"  title="Check Course Approval Status <?php echo $row_allot['course']; ?>" id="delete1" href="javascript:changeUserStatus60('<?php echo $id; ?>','<?php echo $course_id; ?>','<?php echo $depart; ?>','<?php echo $session; ?>','<?php echo $course_approve; ?>');" class="btn btn-info" ><i class="fa fa-check  <?php echo $course_approve == '0'? 'fa fa-check' : 'fa fa-remove'; ?>"></i>&nbsp;<?php echo $course_approve == '0'? 'Approve' : 'Decline'; ?></a>
--!>
<td width="90"><?php echo $status; ?></td></tr>
                        <?php } ?>
                      </tbody>
                      
                       </table>
                      	</form>
                   
                  </div>
                </div>
              </div>
              
              <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content"> 	<form  action="" name="formSubmit" class='form' id="formSubmit" method="post"> 
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Registered Courses</h4>  
                </div>  
                <div class="modal-body" id="employee_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  <button type="submit" class="btn btn-default" data-dismiss="modal">Save</button>  
                </div> </form> 
           </div>  
      </div>  
 </div>  
 <script>  
 $(document).ready(function(){  
      $('.view_data').click(function(){  
           var employee_id = $(this).attr("id");  
           $.ajax({  
                url:"regcourse.php",  
                method:"post",  
                data:{employee_id:employee_id},  
                success:function(data){  
                     $('#employee_detail').html(data);  
                     $('#dataModal').modal("show");  
                }  
           });  
      });  
 });  
 </script>