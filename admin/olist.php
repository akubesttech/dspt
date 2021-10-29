 <?php 
 $status = FALSE;
if ( authorize($_SESSION["access3"]["stMan"]["srv"]["create"]) || 
authorize($_SESSION["access3"]["stMan"]["srv"]["edit"]) || 
authorize($_SESSION["access3"]["stMan"]["srv"]["view"]) || 
authorize($_SESSION["access3"]["stMan"]["srv"]["delete"]) ) {
 $status = TRUE;
}
	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} 

 if($class_ID > 0){}else{
                  message("ERROR:  No Programme Select,Please Select a Programme and continue.", "error");
		       redirect('Student_Record.php?view=opro');
						}
                       
//$depart = $_GET['dept1_find'];
//$session=$_GET['session2'];
//$pro_level= $_GET['los'];
					
                    	?>
                          
                  <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
           This Page will Enable Admin To Verify Student Information,Update student Information,New Student Clearance and Generate Matric Number For New Students. 
                  </div>
                  <form action="" method="post" enctype="multipart/form-data">
                  <?php if(empty($depart) AND empty($session)){  }else{?>		
                  <label class="chkPenalty"><input type="checkbox" id="chkPenalty"  onclick="ShowHideDiv2(this)" name="chkPenalty" value="1" /> Upload Student Record(s) CSV </label>
                  <div style="display:none; " id="changestatus">
                  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"> <label for="heard">Upload CSV file here: </label>
<input name="fileNames" class="input-file uniform_on" id="fileNames" type="file" readonly="readonly" > </div>
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"><div class="col-md-6 col-md-offset-3">
<button type="submit" name="importstudent"  id="import" data-placement="right" class="btn btn-primary" title="Click To Import Student Details" ><i class="glyphicon glyphicon-upload"></i> Upload</button> </div> </div> 
                        <br> </div> <?php } ?>
                  </form>
                    <form action="" method="post" >
                    
                     <table id="datatable-responsive" class="table table-striped table-bordered">
<?php   if (authorize($_SESSION["access3"]["stMan"]["srv"]["delete"])){ ?>
<button class="btn btn-danger" name="delete_student" title="Click to Delete Un Verified / inactive Student(s) Record Selected" id="delete"><i class="fa fa-trash icon-large"></i> Delete </button>
				   <?php } ?>
                   <button class="btn btn-info" name="vegrecord" title="Select Appropriate Record to Verify Student (s) / Generate Matric No for New Students" id="vegrecord"><i class="fa fa-check"></i> Verify Student (s)</button>
						
                     <!-- &nbsp;&nbsp;&nbsp;<button class="btn btn-info" name="st_genmat" title="Click to Generate Matriculation Number" id="genmat"><i class="fa fa-user icon-large"></i> Generate Mat No </button>
				<a data-placement="top" title="Click to Delete check item"   data-toggle="modal" href="#student_delete" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>--!>
                    		<a href="javascript:void(0);" onclick="window.open('Student_Record.php?view=Clearance','_self')" data-placement="top" title="Click to Review Clearance files"    id="delete"  class="btn btn-info" name=""  ><i class="fa fa-file icon-large"> Review Clearance files <span class="badge bg-yellow"><?php echo $clearno; ?></span> </i></a>
                            <?php if(empty($depart) AND empty($session)){  }else{?>
				<?php if(!empty($depart) AND !empty($session)){	?>	
      <a 	href="javascript:void(0);" onclick="window.location.href='Print_students.php?Schd=<?php echo $depart; ?>&session2=<?php echo $session; ?>&lev=<?php echo $pro_level; ?>';" class="btn btn-info"  id="papp" data-placement = "right" title="Click to Print Student(s) Class List" ><i class="fa fa-print icon-large"></i>  Print Student(s) list</a>
<a 	href="javascript:void(0);" onclick="window.location.href='exportslist.php?Schd=<?php echo $depart; ?>&session2=<?php echo $session; ?>&lev=<?php echo $pro_level; ?>';" class="btn btn-info"  id="exp_excel" data-placement = "right" title="Click to export student record to Excel Format" ><i class="fa fa-file-excel-o"></i>  Export Student(s)</a>
<?php  } ?>
<a href="javascript:void(0);" onclick="window.open('Student_Record.php?view=l_s','_self')"
                         class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back to previous Page" ><i class="fa fa-file icon-large"></i>  Go Back</a>
<a href="javascript:void(0);" onclick="window.open('download.php?ids=1&dept1_find=<?php echo $depart; ?>&session2=<?php echo $session; ?>&lev=<?php echo $pro_level; ?>','_self')"
                         class="btn btn-info"  id="penper" data-placement="top" title="Click to Download CSV template for Student Record upload" ><i class="fa fa-download icon-large"></i>  CSV Template</a>
    <?php }  if(empty($shows) || $Rorder == 1 || $Rorder == 2 || $Rorder == 5 || $Rorder == 6 || $Rorder == 7){?>                     
<button class="btn btn-info" name="issuemat" title="Select Appropriate Record to Issue Matric Number so that student can see it on their dashboard" id="issuemat"><i class="fa fa-check"></i> Issue Mat No</button>
<?php } ?>
                             
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');$('#vegrecord').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');$('#vegrecord').tooltip('hide');
                                     $('#exp_excel').tooltip('show');$('#exp_excel').tooltip('hide'); $('#issuemat').tooltip('show');$('#issuemat').tooltip('hide');
                                     $('#penper').tooltip('show');$('#penper').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                                                  
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                         <th>Application No</th>
                         <th>Student Matric No</th>
                          <th>Student Name</th>
                          <th>Gender</th>
                          <th>Mobile Number</th>
                          <th>State</th>
                          <th>Year Of Admission</th>
                          <th><?php echo $SCategory; ?></th>
                          <th><?php echo $SGdept1; ?></th>
                           
                           <th>Student Status</th>
                            <th>Action</th>
                         <!-- <th>View Info</th> --!>
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php
                
//if($depart == Null AND $session == Null){
if(empty($depart) AND empty($session)){
$view_queryn = "select * from student_tb WHERE Asession = '".safee($condb,$default_session)."' and app_type='".safee($condb,$class_ID)."' and verify_Data = 'FALSE' ";
 if($Rorder > 2){ $view_queryn .= " AND Department = '$userdept'";}
 $view_queryn .= "order by stud_id DESC limit 0,600";
    $viewutme_query = mysqli_query($condb,$view_queryn)or die(mysqli_error($condb));
}else{
$viewutme_query = mysqli_query($condb,"select * from student_tb WHERE Department = '".safee($condb,$depart)."' AND Asession = '".safee($condb,$session)."' and app_type='".safee($condb,$class_ID)."' OR Department = '".safee($condb,$depart)."' AND Asession = '".safee($condb,$session)."' and p_level = '".safee($condb,$pro_level)."' and app_type='".safee($condb,$class_ID)."' order by stud_id DESC ")or die(mysqli_error($condb));
}

while($row_utme = mysqli_fetch_array($viewutme_query)){
$id = $row_utme['stud_id'];
$new_a_id = $row_utme['stud_id'];
$is_active = $row_utme['verify_Data']; $imatstatus = $row_utme['istatus'];
if(empty($row_utme['RegNo'])){$color="color: gray;";}else{if(empty($imatstatus)){ $color="color: gray;"; }else{ $color="color: green;";}}
 $countcleared = mysqli_num_rows(mysqli_query($condb,"SELECT matric_no FROM clearance_files WHERE status = 1 AND prog = '".safee($condb,$class_ID)."' AND student_id = '".safee($condb,$new_a_id)."' "));
	if($countcleared >= 4 ){ $npo = "<font color='green'> <i class='fa fa-check'></i> Cleared";}else{ $npo = "";}
?><?php include('toolttip_edit_delete.php'); ?> <tr>
                        	<td width="30">
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $new_a_id; ?>"> </td>
<td>

<!--<a rel="tooltip"  title="View Student  Details &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo getpayn($id,$default_session,$class_ID,$pro_level,0); ?>" data-placement = "button" id="t<?php echo $id; ?>"  
onclick="window.open('?details&userId=<?php echo $new_a_id;?>&dept1_find=<?php echo $depart; ?>&session2=<?php echo $session; ?>&los=<?php echo $pro_level; ?>','_self')"
data-toggle="modal" class="clickable2-row"><?php if($row_utme['verify_Data']=='TRUE'){ echo "<font color='green'>$row_utme[appNo]</font>";
						}else{ echo "<font color='red'>$row_utme[appNo]</font>"; } ?></a>--!>
    <a rel="facebox" href="std_pop.php?userId=<?php echo $new_a_id;?>&dept1_find=<?php echo $depart; ?>&session2=<?php echo $session; ?>&los=<?php echo $pro_level; ?>" title="View Student  Details &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo getpayn($id,$default_session,$class_ID,$pro_level,0); ?>" id="<?php echo $id; ?>" class="btn btn-info"><i class=""> <?php if($row_utme['verify_Data']=='TRUE'){ echo "<font color='green'>$row_utme[appNo]</font>";
						}else{ echo "<font color='red'>$row_utme[appNo]</font>"; } ?></i></a>                
                    
                    
                    </td>
					 <td style="<?php echo $color; ?>"><?php if($row_utme['RegNo']==Null){echo "No Matric Number";}else{ echo $row_utme['RegNo'];} ?></td>
                          <td><?php echo $row_utme['FirstName'].'  '.$row_utme['SecondName'].' '.$row_utme['Othername']; ?></td>
                          <td><?php echo $row_utme['Gender']; ?></td>
                          <td><?php echo $row_utme['phone']; ?></td>
                          <td><?php echo $row_utme['state']; ?></td>
                           <td><?php echo $row_utme['yoe']; ?></td>
                          <td><?php echo getfacultyc($row_utme['Faculty']); ?></td>
                          <td><?php echo getdeptc($row_utme['Department'])." ".$npo; ?></td>
                          
                          <td><?php if($is_active == 'TRUE'){ echo "<font color='green'> <i class='fa fa-check'></i>".getadminstatus($is_active)."</font>"; }else{ echo "<font color='red'><i class='fa fa-close'></i>".getadminstatus($is_active)." </font>";} if ($row_utme['RegNo'] > '0'){ ?> 
<a href="javascript:changeUserStatus20(<?php echo $new_a_id; ?>, '<?php echo $is_active; ?>','<?php echo $depart; ?>','<?php echo $session; ?>','<?php echo $pro_level; ?>');" class="btn btn-info" ><i class=" <?php echo $is_active == 'FALSE'? 'fa fa-check' : 'fa fa-remove'; ?>"></i>&nbsp;<?php echo $is_active == 'FALSE'? 'Verify' : 'Cancel'; ?></a> <?php } ?>
						  </td>
                          
                           <?php  if ($row_utme['RegNo'] > '0'){ ?>
                          	<td width="120">
<a rel="tooltip"  title="Edit Student Record" id="<?php echo $id; ?>" href="Student_Record.php?view=e_stud&<?php echo 'userId='.$new_a_id; ?>"  data-toggle="modal" class="btn btn-success"><i class="fa fa-pencil icon-large"> Edit Data</i></a>
												</td> <?php }else{ ?>
												
													<td width="120">
												<a rel="tooltip"  title="Click To Generate Matric No For The Student" id="<?php echo $id; ?>" 
                                                href="javascript:void(0);" onclick="window.open('Student_Record.php?view=G_Reg&<?php echo 'userId='.$new_a_id; ?>&<?php echo 'dp='.$depart; ?>','_self')"
                                                  data-toggle="modal" class="btn btn-danger"><i class="fa fa-gears icon-large"> Generate Matric No</i></a>
												</td>
												
												<?php } ?> <!--<td width="90">
<a rel="tooltip"  title="View Student  Details" id="<?php echo $id; ?>" href="?details&userId=<?php echo $new_a_id;?>"
data-toggle="modal" class="btn btn-info"><i class="fa fa-file icon-large"> Info</i></a></td> href="Student_Record.php?view=G_Reg&<?php echo 'userId='.$new_a_id; ?>" --!>
                        </tr>
                     
                     
                        <?php } ?>
                      </tbody>
                      
                      
                      	</form>
                    </table>
                    
                 
