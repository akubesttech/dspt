  <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php 
$sql="select * from uploadrecord where up_id='".safee($condb,$_GET['userId'])."' ";
			$resultso=mysqli_query($condb,$sql) or die(mysqli_error($condb));
		//	$count=mysql_num_rows($result);
		$row_fend=mysqli_fetch_array($resultso);
		$recode = $row_fend['course'];$semester=$row_fend['semester'];
$session=$row_fend['session'];
$level= $row_fend['level']; $dept = $row_fend['dept'];
$pmaxn = getpmax($recode,$dept);
$queryrapp = "select * from resultapproval_tb WHERE prog = '".safee($condb,$class_ID)."' AND dept = '".safee($condb,$dept)."' AND session = '".safee($condb,$session)."' AND level = '".safee($condb,$level)."' AND apstatus = '1' ";
if($semester != null){ $queryrapp .= " AND semester='$semester'";}
$queryresultapp = mysqli_query($condb,$queryrapp)or die(mysqli_error($condb));
$rowapp = mysqli_fetch_array($queryresultapp); $aptatus = mysqli_num_rows($queryresultapp); 
 if($aptatus > 0){  $bst = "disabled"; $pbcstatus= "Result Successfully Published for Student to access, Edit is Not Possible"; }else{ $bst = "";$pbcstatus="Result Has not been Published for Student to access Edit is possible";} 
	
	//extract($row);
	$serial=1;
                  ?>
                    <h2>Student Results On <?php echo $recode; ?> For <?php echo $semester." Semester ".getlevel($level,$class_ID); ?> level. </h2>
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
                 
                    
                    <form action="saveresultedit.php" method="post">
                    <?php include('../admin/modal_delete.php'); ?>
                    <span id="printout1"> 	<div  id="print_content">
                    
 <div class="alert alert-info alert-dismissible fade in" role="alert"  id="ccc2"><font color="white" style="text-shadow:0 1px 1px #ff0;">
Student Results On <?php echo $recode; ?> For <?php echo $semester." Semester ".getlevel($level,$class_ID); ?> level. </font></div>
  <table id="datatable-responsive" class="table table-striped jambo_table bulk_action" cellspacing="0" width="100%" border="1">
  <div class="panel-heading" style="color:blue;font-size:15px;padding: 9px 6px 9px 0px;" id="ccc3"><b> <center> Student Results On <?php echo $recode; ?> For <?php echo $semester." Semester ".getlevel($level,$class_ID)."  level ,".$session; ?> .</center></b>
</div>
                    <!--<table  class="table table-striped jambo_table bulk_action" border="1"> <div class="btn-group" id="divButtons" name="divButtons">  --!> 
               <div class="btn-group" id="cccv" > 
                  <a data-placement="top" title="Click to Save Result"   data-toggle="modal" href="#save_upresult" id="divButton2"  class="btn btn-primary" name="divButton2"  ><i class="fa fa-save icon-large"> Save</i></a>&nbsp;&nbsp;
                    <a data-placement="top" title="Click Here to Go Back"    href="#" onClick="window.location.href='Result_am.php?view=v_upa';" id="divButton2"  class="btn btn-primary" name="divButton2"  ><i class="fa fa-arrow-left icon-large"> Go Back</i></a>
                      <input type="button" value="Print" onClick="return Clickheretoprint();" class="btn btn-info">
                     <div style="text-align: center;width: 750px;color: green;margin-top: -10px;margin-left: 40px;"><b> <?php echo $pbcstatus; ?></b> </div>
                      	 </div><br><br> <!--	
								<a href="new_apply.php?view=imp_a" class="btn btn-info"  id="delete2" data-placement="right" title="Click to import Student UTME Exam Result" ><i class="fa fa-file icon-large"></i> Import Data</a> --!>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#divButton2').tooltip('show'); $('#delete1').tooltip('show'); $('#divButtons2').tooltip('show');
									 $('#divButton2').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#divButtons2').tooltip('hide');
									 });
									</script>
										
                      <thead>
                        <tr>
                         <th></th>
                         <th>S/N<!--<input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">--!></th>
                         <th>Mat No</th>
                          <th>Student Name</th>
                          <th>Course Title</th>
                          <th>Credit Unit</th>
                          <th>C A Score <?php echo " ".getamax($recode,$amax,$dept)." %"; ?></th>
                          <?php if(!empty($pmaxn)){ ?> <th>Practical <?php echo " ".$pmaxn." %"; ?></th> <?php } ?>
                          <th>Exam Score <?php echo " ".getemax($recode,$emax,$dept)." %"; ?></th>
                          <th>Total</th>
                          <th>Grade</th>
                        <!-- <th>View Info</th> --!>
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php
$viewupco=mysqli_query($condb,"select * from results where course_code ='". safee($condb,$recode) ."' and session ='". safee($condb,$session) ."' and semester='". safee($condb,$semester) ."' and level='". safee($condb,$level) ."' ");
		while($row_upfile = mysqli_fetch_array($viewupco)){
		if(!empty($pmaxn)){ $cell = 5; }else{ $cell = 4;}
		$course_id = $row_upfile['course_code']; $escore = $row_upfile['exam'];
		$student_regno = $row_upfile['student_id']; $stprogram = getstudentpro($row_upfile['student_id']);
?>     
<tr><td width="30"><input id="optionsCheckbox" class="uniform_on1" name="selector[]"  type="checkbox" value="<?php echo $student_regno; ?>"   checked>
												</td>
                        	<td width="30"> <?php echo $serial++;?><!--
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php //echo $id; ?>"> --!>
												</td>
												 <input type="hidden" name="recid[]" value="<?php echo $_GET['userId']; ?>">
												 <input type="hidden" name="prog[]" value="<?php echo $stprogram; ?>">
												 <input type="hidden" name="ccode[]" value="<?php echo $recode; ?>">
												 <input type="hidden" name="csession[]" value="<?php echo $session; ?>">
												 <input type="hidden" name="csemester[]" value="<?php echo $semester; ?>">
												 <input type="hidden" name="clevel[]" value="<?php echo $level; ?>">
						<td><?php  echo $row_upfile['student_id']; ?></td>
                          <td><?php echo getsname($row_upfile['student_id']); ?></td>
                          <td><?php echo getcourse($row_upfile['course_code']); ?></td>
                          <td><input type="text" class="form-control " name='chour[]' id="chour" onkeyup="calculate();javascript:checkNumber(this); " onkeypress="return isNumber(event);" value="<?php echo $row_upfile['c_unit']; ?> " style="<?php echo $bst; ?>"   maxlength="2" readonly ></td>
                          <?php if(empty($escore)){ ?>
                            <td colspan="<?php echo $cell; ?>" style="text-align: center;font-size: medium;color: red;"> Absent </td>
                          <?php }else{?>
                          <td> <input type="text" class="form-control " name='assess[]' id="assess" onkeyup="calculate();javascript:checkNumber(this); " onkeypress="return isNumber(event);" value="<?php echo $row_upfile['assessment']; ?>"  <?php echo $bst; ?> maxlength="2" ></td>
                          <?php if(!empty($pmaxn)){ ?>
                           <td> <input type="text" class="form-control " name='assess2[]' id="assess2" onkeyup="calculate();javascript:checkNumber(this); " onkeypress="return isNumber(event);" value="<?php echo $row_upfile['passessment']; ?>"  <?php echo $bst; ?>  maxlength="2" ></td>
                           <?php } ?>
                          <td><input type="text" class="form-control " name='exams[]' id="exams" onkeyup="calculate();javascript:checkNumber(this); " onkeypress="return isNumber(event);" value="<?php echo $row_upfile['exam']; ?>" <?php echo $bst; ?>   maxlength="3" ></td>
                           <td><?php echo $row_upfile['total']; ?></td>
                           <td><?php echo grading($row_upfile['total'],$stprogram); ?></td><?php } ?>
<!--		<td width="90">
	<a rel="tooltip"  title="Click to Edit The Selected Student Result <?php echo $row_upfile['course_code']; ?>" id="divButtons2" href="?view=e_ares&userId=<?php echo $student_regno;?>&cos_id=<?php echo $row_upfile['course_code'];?>&lev_id=<?php echo $level;?>&ses_id=<?php echo $session;?>&sem_id=<?php echo $semester;?>" 	  data-toggle="modal" class="btn btn-info" name="divButtons2"><i class="fa fa-file icon-large"> Edit Result</i></a>				</td> --!>
                        </tr>
                     
                     
                        <?php } ?>
                      </tbody>
                      
                      
                      	</form> </span>
                    </table> </div>
                  </div>
                </div>
              </div>
               
              