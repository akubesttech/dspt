   <?php $depart = $student_dept;
$level=$_GET['level'];
$semester= $_GET['semester'];
$roc = isset($_GET['chkroc']) ? $_GET['chkroc'] : '';
if(empty($roc)){ $faction = "Reg_course.php"; $mess = "Please Note that all Carryover courses must be Registered first before any other Course Registration."; if($level >= $student_level){$ckn = "0";
}else{$ckn = "1";} }else{ $faction = ""; $ckn = "0"; $mess = "Please Select Appropriate Outstanding Course (s) to Register.";}
$sumcunit1 = 0;
$sumcunit2 = 0;
$sumcunit3 = 0;
$sumcunit4 = 0;

 ?>
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
                    </button>  <?php echo $mess; ?> 
                  </div>
             
                    <form action="<?php echo $faction; ?>" method="post">
                    
                    <table id="datatable-button" class="table table-striped table-bordered"><?php if(empty($roc)){ ?>
                    	<a data-placement="top" title="Click to Register Selected Courses"   data-toggle="modal" href="#reg_course" id="delete"  class="btn btn-info" name=""  ><i class="fa fa-plus icon-large"> Register Courses </i></a> <?php }else{ ?>
                        <button class="btn btn-info" name="outreg" title="Click to Register Selected Outstanding Courses" id="delete"><i class="fa fa-plus icon-large"></i> Register Courses </button><?php } ?>

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

$sql1="select * from results where  total <= '".safee($condb,$getpassl)."' and student_id='".safee($condb,$student_RegNo)."' and semester = 'First'";
$result1=mysqli_query($condb,$sql1) or die("Could not access table".mysqli_error($condb));
while($row1=mysqli_fetch_array($result1)){ 
//$result2=mysqli_query($condb,"select * from results where course_code = '".$row1['course_code']."' and student_id='".safee($condb,$student_RegNo)."' and total > '".safee($condb,$getpassl)."' and semester = 'First' " ) or die(mysqli_error($condb));
//AND c_code = '".safee($condb,$row1['course_code'])."'
$viewreg_query1 = mysqli_query($condb,"select * from coursereg_tb WHERE sregno = '".safee($condb,$student_RegNo)."' AND creg_status='1' AND semester = 'First' AND course_id = '".safee($condb,$row1['course_id'])."' ")or die(mysqli_error($condb)); if(mysqli_num_rows($viewreg_query1)>0){ $status2 = 'Already Registered';  $enebles = "disabled"; }else{ $status2 = 'Not Registered'; $enebles = ""; }
//if(mysqli_num_rows($result2) > 0){ continue; }else{
$result3=mysqli_query($condb,"select * from courses where dept_c = '".safee($condb,$depart)."' AND semester = 'First' AND C_id = '".safee($condb,$row1['course_id'])."' ") or die(mysqli_error($condb));
if(mysqli_num_rows($result3)>0){ $row_utme3 = mysqli_fetch_array($result3); ?>
<tr> <td width="30"><input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" payamt="<?php echo $row_utme3['C_unit']; ?>" value="<?php echo $row_utme3['C_id']; ?>" CHECKED="CHECKED" <?php echo $enebles; ?> >
	</td><td><?php echo "<font color='red'>$row_utme3[C_code]</font>"; ?></td>
					 <td><?php echo $row_utme3['C_title']; ?></td>
                          <td><?php echo $row_utme3['C_unit']; ?></td>
                          <td><?php echo $row_utme3['semester']; ?></td>
                          <td><?php echo getlevel($row_utme3['C_level'],$student_prog); ?></td>
                          <td>-------</td>
<td> <?php echo $status2; ?> </td> <td>Carryover</td></tr> <?php }else{echo ".";}//} 
$sumcunit1 += $row_utme3['C_unit'];
 }

 //GROUP BY dept_c,C_title order by semester  ASC
 //  order by C_id  DESC
if(empty($ckn)){ if($semester == "both"){ 
/*  college
$viewutme_query = mysqli_query($condb,"select SUBSTRING(C_code, 1,3) AS ccode, C_code,C_title,semester,C_level,C_unit,c_cat,C_id from courses where dept_c='".safee($condb,$depart)."' and C_level ='".safee($condb,$level)."' and semester ='First'  ORDER BY FIELD(ccode, 'GSE', 'EDU') DESC, C_code, C_title ")or die(mysqli_error($condb));
$viewutme_query2 = mysqli_query($condb,"select SUBSTRING(C_code, 1,3) AS ccode, C_code,C_title,semester,C_level,C_unit,c_cat,C_id from courses where dept_c='".safee($condb,$depart)."' and C_level ='".safee($condb,$level)."' and semester ='Second'  ORDER BY FIELD(ccode, 'GSE', 'EDU') DESC,C_code, C_title ")or die(mysqli_error($condb)); */
$viewutme_query = mysqli_query($condb,"select  * from courses where dept_c='".safee($condb,$depart)."' and C_level ='".safee($condb,$level)."' and semester ='First'  ORDER BY C_code,C_title  DESC ")or die(mysqli_error($condb));
$viewutme_query2 = mysqli_query($condb,"select * from courses where dept_c='".safee($condb,$depart)."' and C_level ='".safee($condb,$level)."' and semester ='Second'  ORDER BY C_code,C_title  DESC")or die(mysqli_error($condb));
 }else{
 /* college
$viewutme_query = mysqli_query($condb,"select SUBSTRING(C_code, 1,3) AS ccode, C_code,C_title,semester,C_level,C_unit,c_cat,C_id from courses where dept_c='".safee($condb,$depart)."' and semester = '".safee($condb,$semester)."' and C_level ='".safee($condb,$level)."' ORDER BY FIELD(ccode, 'GSE', 'EDU') DESC,C_code, C_title")or die(mysqli_error($condb)); */
$viewutme_query = mysqli_query($condb,"select C_code,C_title,semester,C_level,C_unit,c_cat,C_id from courses where dept_c='".safee($condb,$depart)."' and semester = '".safee($condb,$semester)."' and C_level ='".safee($condb,$level)."' ORDER BY C_code,C_title  DESC ")or die(mysqli_error($condb));
} 

 ?>

  <!-- First Semester Semester Courses --!>
<?php while($row_utme = mysqli_fetch_array($viewutme_query)){ 
$coursstatus = $row_utme['c_cat']; $glev = getlevel($row_utme['C_level'],$student_prog);
			if($coursstatus > 0){  $cstat = "checked"; $cstat2 ="C" ;}else{  $cstat = ""; $cstat2 ="E"; }
            if(!empty($roc)){  $cst = ""; }else{  $cst = $cstat; }
//$new_a_id = $row_utme['stud_id']; AND c_code = '".safee($condb,$row_utme['C_code'])."'
$viewreg_query = mysqli_query($condb,"select * from coursereg_tb WHERE sregno = '".safee($condb,$student_RegNo)."'  AND course_id = '".safee($condb,$row_utme['C_id'])."' AND creg_status='1' AND semester ='First'")or die(mysqli_error($condb));
?> <tr> <?php if(mysqli_num_rows($viewreg_query)>0){
							$status = 'Already Registered';
							 ?>
							<td width="30">
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" payamt="<?php echo $row_utme['C_unit']; ?>" disabled CHECKED="CHECKED" value="<?php echo $id; ?>">
</td> <?php }else{ $status = 'Not Registered'; ?>
<td width="30"> <input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" payamt="<?php echo $row_utme['C_unit']; ?>"  value="<?php echo $row_utme['C_id']; ?>" <?php echo $cst; ?> > </td> <?php } ?> <td> <?php 
						if(mysqli_num_rows($viewreg_query)>0){
						echo "<font color='green'>$row_utme[C_code]</font>";
						}else{
					echo "<font color='red'>$row_utme[C_code] </font>";
					} ?></td>
					 <td><?php echo $row_utme['C_title']; ?></td>
                          <td><?php echo $row_utme['C_unit']; ?></td>
                          <td> <select name='sem[]<?php echo $row_utme['C_id']; ?>' id="sem" class="form-control" >
                          <?php echo getSem($row_utme['semester']);?></select></td>
                          <td><select name='level[]<?php echo $row_utme['C_id']; ?>' id="level" class="form-control" >
                            <option value="<?php echo $row_utme['C_level']; ?>"><?php echo $glev; ?></option>
                                             <?php echo getRlev($student_prog); ?>  </select> 
                                             </td>
                          <td><?php echo $cstat2; ?></td>
                         <td style="text-align:justify;"><?php echo $status; ?></td>
<td width="120"> ---------------- </td> </tr>
                     <?php  $sumcunit2 += $row_utme['C_unit'];  } ?>
                    
                     <!-- Second Semester Courses --!>
					 <?php if($semester == "First" || $semester == "Second"){ }else{ ?>
					  <tr ><td colspan="9" style="text-align:justify; font-size: 15px;font-weight:bold"> Second Semester</td></tr>
                      
                       <?php  $sqls="select * from results where  total <= '".safee($condb,$getpassl)."' and student_id='".safee($condb,$student_RegNo)."' and semester ='Second' ";
$result1s=mysqli_query($condb,$sqls) or die("Could not access table".mysqli_error($condb));
while($row1s=mysqli_fetch_array($result1s)){  
//$result2s=mysqli_query($condb,"select * from results where course_code = '".$row1s['course_code']."' and student_id='".safee($condb,$student_RegNo)."' and total > '".safee($condb,$getpassl)."' and semester ='Second' " ) or die(mysqli_error($condb));
//AND c_code = '".safee($condb,$row1s['course_code'])."'
$viewreg_query1s = mysqli_query($condb,"select * from coursereg_tb WHERE sregno = '".safee($condb,$student_RegNo)."'  AND course_id = '".safee($condb,$row1s['course_id'])."' AND creg_status='1' AND semester ='Second' ")or die(mysqli_error($condb)); 
if(mysqli_num_rows($viewreg_query1s)>0){ $status2 = 'Already Registered';  $enebles = "disabled"; }else{ $status2 = 'Not Registered'; $enebles = ""; }
//if(mysqli_num_rows($result2s) > 0){ continue; }else{ //order by semester  ASC

$result3s=mysqli_query($condb,"select * from courses where dept_c = '".safee($condb,$depart)."' AND C_id ='".$row1s['course_id']."' and semester = 'Second'") or die(mysqli_error($condb));
if(mysqli_num_rows($result3s)>0){ $row_utme3s=mysqli_fetch_array($result3s); ?>
<tr> <td width="30"><input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" payamt="<?php echo $row_utme3s['C_unit']; ?>" value="<?php echo $row_utme3s['C_id']; ?>" CHECKED="CHECKED" <?php echo $enebles; ?> >
	</td><td><?php echo "<font color='red'>$row_utme3s[C_code]</font>"; ?></td>
					 <td><?php echo $row_utme3s['C_title']; ?></td>
                          <td><?php echo $row_utme3s['C_unit']; ?></td>
                          <td><?php echo $row_utme3s['semester']; ?></td>
                          <td><?php echo getlevel($row_utme3s['C_level'],$student_prog); ?></td>
                          <td>-------</td>
<td> <?php echo $status2; ?> </td> <td>Carryover</td></tr> <?php }else{echo ".";}//} 
$sumcunit4 += $row_utme3s['C_unit']; } ?>
                      
 <?php while($row_utme = mysqli_fetch_array($viewutme_query2)){ 
$coursstatus = $row_utme['c_cat'];
			if($coursstatus > 0){  $cstat = "checked"; $cstat2 ="C" ;}else{  $cstat = ""; $cstat2 ="E"; }
            if(!empty($roc)){  $cst = ""; }else{  $cst = $cstat; }
//$new_a_id = $row_utme['stud_id']; AND c_code = '".safee($condb,$row_utme['C_code'])."'
$viewreg_query = mysqli_query($condb,"select * from coursereg_tb WHERE sregno = '".safee($condb,$student_RegNo)."'  AND course_id = '".safee($condb,$row_utme['C_id'])."' AND creg_status='1' AND semester = 'Second'")or die(mysqli_error($condb));
?> <tr> <?php if(mysqli_num_rows($viewreg_query)>0){
							$status = 'Already Registered';
							 ?>
							<td width="30">
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" payamt="<?php echo $row_utme['C_unit']; ?>" disabled CHECKED="CHECKED" value="<?php echo $id; ?>">
</td> <?php }else{ $status = 'Not Registered'; ?>
<td width="30"> <input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" payamt="<?php echo $row_utme['C_unit']; ?>" value="<?php echo $row_utme['C_id']; ?>" <?php echo $cst; ?> > </td> <?php } ?> <td> <?php 
						if(mysqli_num_rows($viewreg_query)>0){
						echo "<font color='green'>$row_utme[C_code]</font>";
						}else{
					echo "<font color='red'>$row_utme[C_code] </font>";
					} ?></td>
					 <td><?php echo $row_utme['C_title']; ?></td>
                          <td><?php echo $row_utme['C_unit']; ?></td>
                          <td> <select name='sem[]<?php echo $row_utme['C_id']; ?>' id="sem" class="form-control" >
                          <?php echo getSem($row_utme['semester']);?></select></td>
                          <td><select name='level[]<?php echo $row_utme['C_id']; ?>' id="level" class="form-control" >
                            <option value="<?php echo $row_utme['C_level']; ?>"><?php echo $glev; ?></option>
                                             <?php echo getRlev($student_prog); ?>  </select></td>
                          <td><?php echo $cstat2; ?></td>
                         <td style="text-align:justify;"><?php echo $status; ?></td>
<td width="120"> ---------------- </td> </tr>
                     <?php  $sumcunit3 += $row_utme['C_unit'];  } } ?>
                     
					 
				<?php	 }else{   ?>
                        <tr>
						<td colspan="9" ><font color="red">The Selected <?php echo getlevel($level,$student_prog); ?> Level is lessthan your Current Level,Please try Again!</font> </td>
						<?php  }?>
						</tr>
</tbody>
<tfoot><tr class="text-offset"> <td colspan="3"><strong>Total Credit Unit:</strong></td>
   <td align='center'><strong><span id="tots"><?php $tunit = $sumcunit1 + $sumcunit2 + $sumcunit3; if($tunit > 0){ echo $tunit;}else{echo "0";} ?></span></strong></td>
    </tr>
   </tfoot>
                      
                      	</form>
                    </table>
                  </div>
                </div>
              </div>