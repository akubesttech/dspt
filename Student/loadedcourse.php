   <?php $depart = $student_dept;
$level=$_GET['level'];
$semester= $_GET['semester']; ?>
   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  
                    <h2>Course Registration list:</h2>
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
           Please Note that all Carryover courses must be Registered first before any other Course Registration. 
                  </div>
                  
                    <form action="Reg_course.php" method="post">
                    
                    <table id="datatable-button" class="table table-striped table-bordered">
                    	<a data-placement="top" title="Click to Register Selected Courses"   data-toggle="modal" href="#reg_course" id="delete"  class="btn btn-info" name=""  ><i class="fa fa-plus icon-large"> Register Courses</i></a>
                    		<a href="#" onclick="window.open('course_manage.php?view=S_CO','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back" ><i class="fa fa-backward icon-large"></i> Go back</a>
                    
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr >
                        <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th> 
                     <!--  <th></th>--!>
                         <th>Course Code</th>
                         <th>Course Title</th>
                          <th>Credit Unit</th>
                          <th>Semester</th>
                          <th>Level</th>
                          <th>Course Status</th>
                         <th>Registration Status</th>
                            <th>Remark</th>
                         
                        </tr>
                      </thead>
                      
                      
 <tbody> <?php if($semester == "Second"){ $nsem = $semester; }else{ $nsem = "First"; } ?>
 <tr ><td colspan="9" style="text-align:justify; font-size: 15px;font-weight:bold"> <?php echo $nsem."  Semester"; ?></td></tr>
                 <?php
$sql_gradesetl = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$student_prog)."' and grade_group ='01' Order by b_max ASC limit 1 ")or die(mysqli_error($condb)); $getmg2 = mysqli_fetch_array($sql_gradesetl);    $getpassl = $getmg2['b_max'];
$sql1="select * from results where  total <= '".safee($condb,$getpassl)."' and student_id='".safee($condb,$student_RegNo)."' ";
$result1=mysqli_query($condb,$sql1) or die("Could not access table".mysqli_error($condb));
while($row1=mysqli_fetch_array($result1)){ 
$result2=mysqli_query($condb,"select * from results where course_code = '".$row1['course_code']."' and student_id='".safee($condb,$student_RegNo)."' and total > '".safee($condb,$getpassl)."' " ) or die(mysqli_error($condb));

$viewreg_query1 = mysqli_query($condb,"select * from coursereg_tb WHERE sregno = '".safee($condb,$student_RegNo)."' AND c_code = '".safee($condb,$row1['C_code'])."' and creg_status='1'")or die(mysqli_error($condb)); if(mysqli_num_rows($viewreg_query1)>0){ $status2 = 'Already Registered';  $enebles = "disabled"; }else{ $status2 = 'Not Registered'; $enebles = ""; }

if(mysqli_num_rows($result2) > 0){ continue; }else{
$result3=mysqli_query($condb,"select * from courses where C_code ='".$row1['course_code']."' order by semester  ASC") or die(mysqli_error($condb));
if(mysqli_num_rows($result3)>0){ $row_utme3=mysqli_fetch_array($result3); ?>
<tr> <td width="30"><input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $row_utme3['C_code']; ?>" CHECKED="CHECKED" <?php echo $enebles; ?> >
	</td><td><?php echo "<font color='red'>$row_utme3[C_code]</font>"; ?></td>
					 <td><?php echo $row_utme3['C_title']; ?></td>
                          <td><?php echo $row_utme3['C_unit']; ?></td>
                          <td><?php echo $row_utme3['semester']; ?></td>
                          <td><?php echo getlevel($row_utme3['C_level'],$student_prog); ?></td>
                          <td>-------</td>
<td> <?php echo $status2; ?> </td> <td>Carryover</td></tr> <?php }else{echo "No Course was found ";}} $sumcunit1 += $row_utme3['C_unit']; }
 //GROUP BY dept_c,C_title order by semester  ASC
 //  order by C_id  DESC
if($level >= $student_level){ if($semester == "both"){ 
/*  college
$viewutme_query = mysqli_query($condb,"select SUBSTRING(C_code, 1,3) AS ccode, C_code,C_title,semester,C_level,C_unit,c_cat from courses where dept_c='".safee($condb,$depart)."' and C_level ='".safee($condb,$level)."' and semester ='First'  ORDER BY FIELD(ccode, 'GSE', 'EDU') DESC, C_code, C_title ")or die(mysqli_error($condb));
$viewutme_query2 = mysqli_query($condb,"select SUBSTRING(C_code, 1,3) AS ccode, C_code,C_title,semester,C_level,C_unit,c_cat from courses where dept_c='".safee($condb,$depart)."' and C_level ='".safee($condb,$level)."' and semester ='Second'  ORDER BY FIELD(ccode, 'GSE', 'EDU') DESC,C_code, C_title ")or die(mysqli_error($condb)); */
$viewutme_query = mysqli_query($condb,"select  * from courses where dept_c='".safee($condb,$depart)."' and C_level ='".safee($condb,$level)."' and semester ='First'  ORDER BY C_code,C_title  DESC ")or die(mysqli_error($condb));
$viewutme_query2 = mysqli_query($condb,"select * from courses where dept_c='".safee($condb,$depart)."' and C_level ='".safee($condb,$level)."' and semester ='Second'  ORDER BY C_code,C_title  DESC")or die(mysqli_error($condb));
 }else{
 /* college
$viewutme_query = mysqli_query($condb,"select SUBSTRING(C_code, 1,3) AS ccode, C_code,C_title,semester,C_level,C_unit,c_cat from courses where dept_c='".safee($condb,$depart)."' and semester = '".safee($condb,$semester)."' and C_level ='".safee($condb,$level)."' ORDER BY FIELD(ccode, 'GSE', 'EDU') DESC,C_code, C_title")or die(mysqli_error($condb)); */
$viewutme_query = mysqli_query($condb,"select C_code,C_title,semester,C_level,C_unit,c_cat from courses where dept_c='".safee($condb,$depart)."' and semester = '".safee($condb,$semester)."' and C_level ='".safee($condb,$level)."' ORDER BY C_code,C_title  DESC ")or die(mysqli_error($condb));
} 
$sumcunit1 = 0;
$sumcunit2 = 0;
$sumcunit3 = 0;
 ?>

  <!-- First Semester Semester Courses --!>
<?php while($row_utme = mysqli_fetch_array($viewutme_query)){ 
$coursstatus = $row_utme['c_cat'];
			if($coursstatus > 0){  $cstat = "checked"; $cstat2 ="C" ;}else{  $cstat = ""; $cstat2 ="E"; }
//$new_a_id = $row_utme['stud_id'];
$viewreg_query = mysqli_query($condb,"select * from coursereg_tb WHERE sregno = '".safee($condb,$student_RegNo)."' AND c_code = '".safee($condb,$row_utme['C_code'])."' and creg_status='1'")or die(mysqli_error($condb));
?> <tr> <?php if(mysqli_num_rows($viewreg_query)>0){
							$status = 'Already Registered';
							 ?>
							<td width="30">
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" disabled CHECKED="CHECKED" value="<?php echo $id; ?>">
</td> <?php }else{ $status = 'Not Registered'; ?>
<td width="30"> <input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $row_utme['C_code']; ?>" <?php echo $cstat; ?> > </td> <?php } ?> <td> <?php 
						if(mysqli_num_rows($viewreg_query)>0){
						echo "<font color='green'>$row_utme[C_code]</font>";
						}else{
					echo "<font color='red'>$row_utme[C_code] </font>";
					} ?></td>
					 <td><?php echo $row_utme['C_title']; ?></td>
                          <td><?php echo $row_utme['C_unit']; ?></td>
                          <td><?php echo $row_utme['semester']; ?></td>
                          <td><?php echo getlevel($row_utme['C_level'],$student_prog); ?></td>
                          <td><?php echo $cstat2; ?></td>
                         <td style="text-align:justify;"><?php echo $status; ?></td>
<td width="120"> ---------------- </td> </tr>
                     <?php  $sumcunit2 += $row_utme['C_unit'];  } ?>
                    
                     <!-- Second Semester Courses --!>
					 <?php if($semester == "First" || $semester == "Second"){ }else{ ?>
					  <tr ><td colspan="9" style="text-align:justify; font-size: 15px;font-weight:bold"> Second Semester</td></tr>
					 <?php while($row_utme = mysqli_fetch_array($viewutme_query2)){ 
$coursstatus = $row_utme['c_cat'];
			if($coursstatus > 0){  $cstat = "checked"; $cstat2 ="C" ;}else{  $cstat = ""; $cstat2 ="E"; }
//$new_a_id = $row_utme['stud_id'];
$viewreg_query = mysqli_query($condb,"select * from coursereg_tb WHERE sregno = '".safee($condb,$student_RegNo)."' AND c_code = '".safee($condb,$row_utme['C_code'])."' and creg_status='1'")or die(mysqli_error($condb));
?> <tr> <?php if(mysqli_num_rows($viewreg_query)>0){
							$status = 'Already Registered';
							 ?>
							<td width="30">
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" disabled CHECKED="CHECKED" value="<?php echo $id; ?>">
</td> <?php }else{ $status = 'Not Registered'; ?>
<td width="30"> <input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $row_utme['C_code']; ?>" <?php echo $cstat; ?> > </td> <?php } ?> <td> <?php 
						if(mysqli_num_rows($viewreg_query)>0){
						echo "<font color='green'>$row_utme[C_code]</font>";
						}else{
					echo "<font color='red'>$row_utme[C_code] </font>";
					} ?></td>
					 <td><?php echo $row_utme['C_title']; ?></td>
                          <td><?php echo $row_utme['C_unit']; ?></td>
                          <td><?php echo $row_utme['semester']; ?></td>
                          <td><?php echo getlevel($row_utme['C_level'],$student_prog); ?></td>
                          <td><?php echo $cstat2; ?></td>
                         <td style="text-align:justify;"><?php echo $status; ?></td>
<td width="120"> ---------------- </td> </tr>
                     <?php  $sumcunit3 += $row_utme['C_unit'];  } } ?>
                     
					 
				<?php	 }else{   ?>
                        <tr>
						<td colspan="8" ><font color="red">The Selected <?php echo getlevel($level,$student_prog); ?> Level is lessthan your Current Level,Please try Again!</font> </td>
						<?php  }?>
						</tr>
					</tbody>
<tfoot><tr class="text-offset"> <td colspan="3"><strong>Total Credit Unit:</strong></td>
   <td align='center'><strong><?php $tunit = $sumcunit1 + $sumcunit2 + $sumcunit3; if($tunit > 0){ echo $tunit;}else{echo "0";} ?></strong></td>
    </tr>
   </tfoot>
                      
                      	</form>
                    </table>
                  </div>
                </div>
              </div>