   
   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php 

$query= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $row_C = mysqli_fetch_array($query);
							  $s_utme = $row_C['p_utme'];$smato = $row_C['smat'];
                              $depart = isset($_GET['dept1_find']) ? $_GET['dept1_find'] : '';
                              $level = isset($_GET['level']) ? $_GET['level'] : '';
                              $semester = isset($_GET['semester']) ? $_GET['semester'] : '';
$sshow = $stud_row['istatus'];  $semailo = $stud_row['e_address'];
						?>
                    <h2>Registered Courses For The Session:</h2>
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
                 
                  
                    <form action="Delete_regcourse.php" method="post">
                    	<?php include('modal_delete.php'); ?>
                    	 <span id="printout"> <div id= "print_content">
                    	  <table  width="950px">
                    	 <style type="text/css" media="print"> @media print { a[href]:after {content: none !important;}} @page {size: auto;margin: 0;}
.row1 {background-color: #EFEFEF;border: 1px solid #98C1D1;
		height: 30px;	font-family:Verdana, Geneva, sans-serif; font-size:12px; }
.row2 {background-color: #DEDEDE;border: 1px solid #98C1D1;height: 30px; font-family:Verdana, Geneva, sans-serif; 
	font-size:12px; }
					  </style>
                    	 <tr >
                    	 <div   id="divTitle" name="divTitle">
                        <div class="col-xs-12 invoice-header" >
                          <h1 >
                            <i class="fa fa-graduation-cap" ></i><FONT COLOR = "BLUE" style="text-shadow:-1px 1px 1px gray;" ><?php echo $row_C['SchoolName'];  ?>    </FONT><br>
                                          <small class="pull-right">COURSE REGISTRATION FORM</small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                    	 <!-- info row -->
                    	 
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col" style="text-align:left;">
                         
                          <address>
  <strong>Student Name:</strong> <?php echo $stud_row['FirstName']." ".$stud_row['SecondName']." ".$stud_row['Othername'];?>
                                          <br><?php if(!empty($smato)){ if(empty($sshow)){ ?><b>Username: </b><?php echo $semailo; }else{ ?><b>Matric No:</b> <?php echo $stud_row['RegNo'];} }else{?><b>Matric No:</b> <?php echo $stud_row['RegNo'];}?>
                                          <br><b>Year of Study:</b> <?php echo $default_session;?>
                                          <br><b><?php echo $SCategory; ?> :</b><?php echo getfacultyc($stud_row['Faculty']);?>
                                          <br><b><?php echo $SGdept1; ?>:</b> <?php echo getdeptc($stud_row['Department']);?>
                                          <br><b>Level:</b> <?php echo getlevel($student_level,$student_prog); ?>
                                          
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col" >
                         
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                         <address>
                          <div class="rounded" align="right">
   <img id="admin_avatar" class="img-rectangle" width="120px" height="100px" src="<?php 
  if ($exists > 0 ){ print $stud_row['images'];
	}else{ print "uploads/NO-IMAGE-AVAILABLE.jpg";}
				//  if ($stud_row['images']==NULL ){print "uploads/NO-IMAGE-AVAILABLE.jpg";}else{print $stud_row['images'];}
				  
				  
				 // echo $row['adminthumbnails']; ?>">
  </div> </address>
                        </div>
                        <hr>
                        <!-- /.col -->
                      </div> </tr>
                      <!-- /.row -->
                    	 <div class="alert alert-info alert-dismissible fade in" role="alert">
                    
          <strong> Courses Registered for First Semester <?php echo $default_session; ?> Academic Session .</strong>
                  </div>
                    
                    <table  class="table table-striped jambo_table bulk_action" border="1" width="950px"><div id="cccv" >
     </div>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
									
                      <thead>
                        <tr style="background-color: gray; color: white;font-family:Verdana, Geneva, sans-serif;font-size:12px;" >
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                         <th>S/N</th>
						 <th>Course Code</th>
                         <th>Course Title</th>
                          <th>Credit Unit</th>
                       <th>Status</th>
                           <!--  <th>Level</th>
                         <th>Session</th> --!>
                         <th>Course Lecturer Approve</th>
                         
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php



//if($depart == Null AND $session == Null){
$viewutme_query = mysqli_query($condb,"select ctb.c_code,ctb.semester,ctb.c_unit,ctb.lect_approve,ctb.creg_id,ctb.course_id,cn.c_cat,cn.C_title from coursereg_tb ctb LEFT JOIN courses cn ON ctb.course_id = cn.C_id where sregno='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' and ctb.semester='First'and creg_status='1' ORDER BY C_code,C_title  DESC ")or die(mysqli_error($condb));
// collage of education
/*$viewutme_query = mysqli_query($condb,"select SUBSTRING(cn.C_code, 1,3) AS ccode,ctb.c_code,ctb.semester,ctb.c_unit,ctb.lect_approve,ctb.creg_id,ctb.course_id,cn.c_cat,cn.C_title from coursereg_tb ctb LEFT JOIN courses cn ON ctb.course_id = cn.C_id where sregno='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' and ctb.semester='First'and creg_status='1' ORDER BY FIELD(ccode, 'GSE', 'EDU') DESC, C_code, C_title")or die(mysqli_error($condb)); */

 ?>
 

	<?php		 		
											
							 if(mysqli_num_rows($viewutme_query)<1){
	  echo "<tr class='row2'><td colspan='9' style='text-align:centre;'><strong>No Course has been Registered in this First Semester.</strong></td></tr>";
 }?>
 						

<?php
$serial=1;
$i = "0";
while($row_utme = mysqli_fetch_array($viewutme_query)){ 
$coursstatus = $row_utme['c_cat']; if($coursstatus > 0){  $cstat = "Compulsory";}else{  $cstat = "Elective";}
//$id = $row_utme['appNo'];
if ($i%2) {$classo1 = 'row1';} else {$classo1 = 'row2';}$i += 1;
//$new_a_id = $row_utme['stud_id'];
$viewreg_query = mysqli_query($condb,"select DISTINCT lect_approve  from coursereg_tb WHERE sregno = '".safee($condb,$student_RegNo)."' AND c_code = '".safee($condb,$row_utme['c_code'])."' and lect_approve = '1'")or die(mysqli_error($condb));
?>     
                        <tr class="<?php echo $classo1; ?>">
                        	<?php if(mysqli_num_rows($viewreg_query)>0){
							$status = 'Approved';
							 ?>
							<td width="30" style="text-align:centre;">
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" disabled CHECKED="CHECKED" value="<?php echo $row_utme['creg_id']; ?>">  
                        
													</td> <?php }else{
													$status = 'Not Approved';
													 ?>
														<td width="30" style="text-align:center;">
           	<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox"  value="<?php echo $row_utme['creg_id']; ?>">
													</td>
													<?php } ?>
														<td  align='center'>
<?php echo $serial++; ?>
												</td>
						  <td><?php 
					
						echo "<font color='green'>$row_utme[c_code]</font>";
					 ?></td>
					 <td><?php echo getcourseid($row_utme['course_id']); ?></td>
                          <td align='center'><?php echo $row_utme['c_unit']; ?></td>
                       <td><?php echo $cstat; ?></td>
                           <!--  <td><?php //echo getlevel($row_utme['level'],$student_prog); ?></td>
                         <td width="120">
<?php //echo $row_utme['session']; ?>	</td> --!>
<td style="text-align:justify;"><?php echo $status; ?></td>
									 		
											
												
												
										
                        </tr>
                    <?php } ?>
                   
								<?php 
$sumnet="select SUM(c_unit) from coursereg_tb where sregno='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' and semester='First'";
  $resultsumnet = mysqli_query($condb,$sumnet); 
  $num_rows2 =mysqli_num_rows($resultsumnet);
 
 while($get_infc = mysqli_fetch_row($resultsumnet))
 {
	  foreach ($get_infc as $sumcredit)
								?>				
											
								<tfoot>
    <tr class="text-offset">
      <td colspan="4"><strong>Total Credit Unit:</strong></td>
  <!--  <td align='center'></td><td align='center'></td> --!><td align='center'><strong> <?php if($sumcredit > 0){ echo $sumcredit;}else{echo "0";} ?></strong></td>
    </tr>
   </tfoot> 	<?php } ?>			
												
										
                     
                      </tbody>
                      
                      
                      <div class="btn-group" id="divButtons" name="divButtons">
                    <div id="ccc2">	
					<a data-placement="top" title="Click to Delete Selected Courses"    data-toggle="modal" href="#delete_rcourse" id="delete"  class="btn btn-danger" name="delete_course"  ><i class="fa fa-trash icon-large"> Delete Course</i></a>
<a href="#" onclick="window.open('course_manage.php?view=S_CO','_self')" class="btn btn-info" name="delete_course" id="delete2" data-placement="right" title="Click to Go back to Course Registration" ><i class="fa fa-backward icon-large"></i> Course Registration</a>
<a href="#" onclick="window.open('courseregprint.php','_self')" class="btn btn-info" name="delete_course" id="delete2" data-placement="right" title="Click to Print Course Registration" ><i class="fa fa-print icon-large"></i> Print Course Registration</a>
				<!--	   <input type="button" value="Print" onclick="return Clickheretoprint();" class="btn btn-default"> --!></div>
                      	 </div>
                    </table>
                    
                    
                     <table  class="table table-striped jambo_table bulk_action" border="1" width="950px">
                    
                    
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
									
                      <thead>
                      <br><br>
                      	 <div class="alert alert-info alert-dismissible fade in" role="alert">
                    
          <strong> Courses Registered for Second Semester <?php echo $default_session; ?> Academic Session .</strong>
                  </div><br>
                        <tr style="background-color: gray; color: white;font-family:Verdana, Geneva, sans-serif;font-size:12px;">
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                         <th>S/N</th>
						 <th>Course Code</th>
                         <th>Course Title</th>
                          <th>Credit Unit</th>
                         <th>Status</th>
                          <!--  <th>Level</th>
                         <th>Session</th> --!>
                         <th>Course Lecturer Approve</th>
                         
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php
///$depart = $_GET['dept1_find'];
//$level=$_GET['level'];
//$semester= $_GET['semester'];


//if($depart == Null AND $session == Null){
$viewutme_query2 = mysqli_query($condb,"select ctb.c_code,ctb.semester,ctb.c_unit,ctb.lect_approve,ctb.creg_id,ctb.course_id,cn.c_cat,cn.C_title from coursereg_tb ctb LEFT JOIN courses cn ON ctb.course_id = cn.C_id where sregno='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' and ctb.semester='Second'and creg_status='1' ORDER BY C_code,C_title  DESC ")or die(mysqli_error($condb));
// COLLAGE OF EDU
/* $viewutme_query2 = mysqli_query($condb,"select SUBSTRING(cn.C_code, 1,3) AS ccode,ctb.c_code,ctb.semester,ctb.c_unit,ctb.lect_approve,ctb.creg_id,ctb.course_id,cn.c_cat,cn.C_title from coursereg_tb ctb LEFT JOIN courses cn ON ctb.course_id = cn.C_id where sregno='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' and ctb.semester='Second'and creg_status='1' ORDER BY FIELD(ccode, 'GSE', 'EDU') DESC, C_code, C_title ")or die(mysqli_error($condb)); */ ?>

 <tr>

	<?php		 		
											
							 if(mysqli_num_rows($viewutme_query2)<1){
	  echo "<td colspan='9' style='text-align:centre;' class='row2'><strong>No Course has been Registered in this Second Semester.</strong></td>";
 }?>
 						
</tr>
<?php

$serial=1; $io = 0;

while($row_utme = mysqli_fetch_array($viewutme_query2)){
if ($io%2) {$classo = 'row1';} else {$classo = 'row2';}$io += 1;
$coursstatus2 = $row_utme['c_cat']; if($coursstatus2 > 0){  $cstat = "Compulsory";}else{  $cstat = "Elective";}
//$new_a_id = $row_utme['stud_id'];
$viewreg_query = mysqli_query($condb,"select DISTINCT lect_approve  from coursereg_tb WHERE sregno = '".safee($condb,$student_RegNo)."' AND c_code = '".safee($condb,$row_utme['c_code'])."' and lect_approve = '1' ")or die(mysqli_error($condb));
?>    
                        <tr class="<?php echo $classo; ?>">
                        	<?php 
						
							if(mysqli_num_rows($viewreg_query)>0){
							$status = 'Approved';
							 ?>
							<td width="30" style="text-align:centre;">
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" disabled CHECKED="CHECKED" value="<?php echo $row_utme['creg_id']; ?>">  
                        
													</td> <?php }else{
													$status = 'Not Approved';
													 ?>
														<td width="30" style="text-align:centre;">
           	<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox"  value="<?php echo $row_utme['creg_id']; ?>">
													</td>
													<?php } ?>
														<td  align='center'>
<?php echo $serial++; ?>
												</td>
						  <td><?php 
					
						echo "<font color='green'>$row_utme[c_code]</font>";
					 ?></td>
					 <td><?php echo getcourseid($row_utme['course_id']); ?></td>
                          <td align='center'><?php echo $row_utme['c_unit']; ?></td>
                        <td><?php echo $cstat; ?></td>
                         <!--   <td><?php echo getlevel($row_utme['level'],$student_prog); ?></td>
                         <td width="120">
<?php echo $row_utme['session']; ?>	</td> --!>
<td style="text-align:justify;"><?php echo $status; ?></td>
						
												
										
                        </tr>
                    <?php } ?>
                   
	<?php 
$sumnet2="select SUM(c_unit) from coursereg_tb where sregno='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' and semester='Second'";
  $resultsumnet2 = mysqli_query($condb,$sumnet2); 
  $num_rows2 =mysqli_num_rows($resultsumnet2);
 
 while($get_infc = mysqli_fetch_row($resultsumnet2))
 {
	  foreach ($get_infc as $sumcredit2)
								?>				
											
								<tfoot>
    <tr class="text-offset">
      <td colspan="4"><strong>Total Credit Unit:</strong></td>
   <!-- <td align='center'></td><td align='center'></td>--!> <td align='center'><strong><?php if($sumcredit2 > 0){ echo $sumcredit2;}else{echo "0";} ?></strong></td>
    </tr>
   </tfoot> 	<?php } ?>			
												
										
                     
                      </tbody>
                      
                      
                      
                      	</form> </table> 
                    </table> <?php
                    $grand = $sumcredit2 + $sumcredit;
 echo "<table><tr align='left'><td><br><br<strong>The Grand total of course units for both semesters is $grand. Credit Unit</strong></td>";
 print "</table>\n"; ?>
 </div>
                    </span>
                  </div>
                </div>
              </div>
              
                 
  