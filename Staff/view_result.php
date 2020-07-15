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
$level= $row_fend['level'];
	//extract($row);
	$serial=1;
                  ?>
                    <h2>Student Results On <?php echo $recode; ?> For <?php echo $semester." Semester ".$level; ?> level. </h2>
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
                 
                    <?php include('../admin/modal_delete.php'); ?>
                    <form action="../admin/Delete_staffupresult.php" method="post">
                    <span id="printout">
                    
                     <div class="alert alert-info alert-dismissible fade in" role="alert"><font color="green" style="text-shadow:0 1px 1px #ff0;">
                  
      Student Results On <?php echo $recode; ?> For <?php echo $semester." Semester ".$level; ?> level. </font>
                  </div>
                  
                    <table  class="table table-striped jambo_table bulk_action" border="1">
                  <!--
                  <a data-placement="top" title="Click to Delete check item"   data-toggle="modal" href="#delete_upresult" id="divButton2"  class="btn btn-danger" name="divButton2"  ><i class="fa fa-trash icon-large"> Delete</i></a> --!>
                    <div class="btn-group" id="divButtons" name="divButtons">
                      <input type="button" value="Print" onclick="tablePrint();" class="btn btn-info">
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
                         <th>S/N<!--<input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">--!></th>
                         <th>Registration No</th>
                          <th>Student Name</th>
                          <th>Course Title</th>
                          <th>Continuous Assessment</th>
                          <th>Exam</th>
                          <th>Total</th>
                          <th>Grade</th>
                         <th>View Info</th>
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php

$viewupco=mysqli_query($condb,"select * from results where course_code ='". safee($condb,$recode) ."' and session ='". safee($condb,$session) ."' and semester='". safee($condb,$semester) ."' and level='". safee($condb,$level) ."' ");
		while($row_upfile = mysqli_fetch_array($viewupco)){
		$id = $row_upfile['up_id'];
		$course_id = $row_upfile['course'];
		$student_regno = $row_upfile['student_id'];
?>     
                        <tr>
                        	<td width="30"> <?php echo $serial++;?><!--
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php //echo $id; ?>"> --!>
												</td>
						<td><?php  echo $row_upfile['student_id']; ?></td>
                          <td><?php echo getname($row_upfile['student_id']); ?></td>
                          <td><?php echo getcourse($row_upfile['course_code']); ?></td>
                          <td><?php echo $row_upfile['assessment']; ?></td>
                          <td><?php echo $row_upfile['exam']; ?></td>
                           <td><?php echo $row_upfile['total']; ?></td>
                           <td><?php echo $row_upfile['grade']; ?></td>
                          	<td width="90">
<a rel="tooltip"  title="Click to Edit The Selected Student Result <?php echo $row_upfile['course_code']; ?>" id="divButtons2" href="?view=e_res&userId=<?php echo $student_regno;?>&cos_id=<?php echo $row_upfile['course_code'];?>&lev_id=<?php echo $level;?>&ses_id=<?php echo $session;?>&sem_id=<?php echo $semester;?>" 	  data-toggle="modal" class="btn btn-info" name="divButtons2"><i class="fa fa-file icon-large"> Edit Result</i></a>
			</td>
                        </tr>
                     
                     
                        <?php } ?>
                      </tbody>
                      
                      
                      	</form> </span>
                    </table>
                  </div>
                </div>
              </div>
               
                 <script>
function tablePrint(){ 
 document.all.divButtons.style.visibility = 'hidden'; 
  //document.all.divButton2.style.visibility = 'hidden'; 
  
    var display_setting="toolbar=no,location=no,directories=no,menubar=no,";  
    display_setting+="scrollbars=no,width=500, height=500, left=100, top=25";  
 //   var tableData = '<table border="1">'+document.getElementsByTagName('table')[0].innerHTML+'</table>';
    var content_innerhtml = document.getElementById("printout").innerHTML;  
    var document_print=window.open("","",display_setting);  
    document_print.document.open();  
    document_print.document.write('<body style="font-family:verdana; font-size:12px;" onLoad="self.print();self.close();" >');  
    document_print.document.write(content_innerhtml);  
    document_print.document.write('</body></html>');  
    document_print.print();  
    document_print.document.close(); 
   
    return false;  
    } 
  $(document).ready(function() {
    oTable = jQuery('#example').dataTable({
    "bJQueryUI": true,
    "sPaginationType": "full_numbers"
    } );
  });   
</script>