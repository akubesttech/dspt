 <?php 
 $status = FALSE;
if ( authorize($_SESSION["access3"]["stMan"]["coc"]["create"]) || 
authorize($_SESSION["access3"]["stMan"]["coc"]["edit"]) || 
authorize($_SESSION["access3"]["stMan"]["coc"]["view"]) || 
authorize($_SESSION["access3"]["stMan"]["coc"]["delete"]) ) {
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
           This Page is for Management of Student Change of Course,Sign Off,Accept and Update student Matric Number after being Accepted into Requested <?php echo $SGdept1; ?> . 
                  </div>
                  
                    <form action="" method="post">
                    
                     <table id="datatable-responsive" class="table table-striped table-bordered">
<?php  if (authorize($_SESSION["access3"]["stMan"]["coc"]["create"])){ ?><button class="btn btn-danger" name="delete_student" style="display: none;" title="Click to Delete Un Verified / inactive Student(s) Record Selected" id="delete"><i class="fa fa-trash icon-large"></i> Delete </button>
<button class="btn btn-info" name="caccept" title="Select Appropriate Record to Validate once it has been sign off and accepted" id="caccept"><i class="fa fa-check"></i> Validate Change of Course (s)</button>
 <?php } ?>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');$('#caccept').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');$('#caccept').tooltip('hide');
                                     $('#exp_excel').tooltip('show');$('#exp_excel').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                                        
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                         <th>Payment ID</th>
                         <th>Current Mat No</th><th>New Mat No</th>
                          <th>Student Name</th>
                          <th>Current Course</th>
                          <th>New Course</th>
                          <th>Prog Type</th>
                         <th>Pay Status</th>
                          <th>Sign Off</th> 
                          <th>Accept</th> 
                         <!-- <th>View Info</th> --!>
                        </tr>
                      </thead>
                      
                      
 <tbody> 
                 <?php
                //pt.RegNo,ct.a_app,ct.chod_app,ct.nhod_app,ct.pay_status,ct.cid,ct.sid,ct.c_dept,ct.n_dept
$viewutme_query = mysqli_query($condb,"SELECT * FROM student_tb pt LEFT JOIN coc_tb ct ON  ct.sid = pt.stud_id WHERE ct.prog ='".safee($condb,$class_ID)."' AND ct.pay_status = '1' order by cid DESC limit 0,600") or die(mysqli_error($condb));
while($row_utme = mysqli_fetch_array($viewutme_query)){
$id = $row_utme['cid'];
$new_a_id = $row_utme['sid'];
$is_active = $row_utme['chod_app'];
$is_active2 = $row_utme['nhod_app'];
$cdept = $row_utme['c_dept'];
$ndept = $row_utme['n_dept'];
$adapp = $row_utme['a_app'];
if(empty($is_active) || empty($is_active2)){ $enebles = "disabled";}else{$enebles = "";}
?><?php include('toolttip_edit_delete.php'); ?> <tr>
                        	<td width="30">
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $new_a_id; ?>" <?php echo $enebles; ?>> </td>
<td><a rel="tooltip"  title=""  data-placement = "button" id="t<?php echo $id; ?>"  ><?php echo $row_utme['trans_id'];?></a></td>
					 <td><?php if(empty($row_utme['c_matno'])){echo "No Matric Number";}else{ echo $row_utme['c_matno'];} ?></td>
                     <td><?php if(empty($adapp)){echo "No Matric Number"; $disp = "";$cno = "";}else{ echo $row_utme['RegNo'];$disp = "display: none;";$cno = "text-shadow:1px 1px 1px green;font-weight:bold;";} ?></td>
                          <td><?php echo getsnameid($row_utme['sid']); ?></td>
                          <td><?php echo getdeptc($cdept); ?></td>
                          <td style="<?php echo $cno; ?>"><?php echo getdeptc($ndept); ?></td>
                          <td><?php echo getprog($row_utme['prog']); ?></td>
                         <td><?php echo getpaystatus($row_utme['pay_status']); ?></td>
<td><?php if($is_active == '1'){ $noti = ""; echo "<font color='green'> <i class='fa fa-check'></i> Signed Off</font>"; }else{ $noti = "Click to Sign Off Student"; echo "<font color='red'><i class='fa fa-close'></i>Not Yet Signed Off </font>";} if ($row_utme['c_matno'] > '0'){ ?> 
 <?php   if (authorize($_SESSION["access3"]["stMan"]["coc"]["delete"])){ ?> <a href="javascript:changeSignoff(<?php echo $new_a_id; ?>, '<?php echo $is_active; ?>','<?php echo $cdept; ?>','<?php echo $session_id; ?>');" class="btn btn-info"  title="<?php echo $noti; ?>" style="<?php echo $disp;?>" ><i class=" <?php echo $is_active == '0'? 'fa fa-check' : 'fa fa-remove'; ?>" ></i>&nbsp;<?php echo $is_active == '0'? 'Signoff' : 'Cancel'; ?></a> <?php }} ?>
						  </td> 
                            
                           <?php  if(empty($is_active)){ ?> 
                           <td style="color: red;text-align: center;"> <?php echo "..waiting for Sign off From Current ".$SGdept1; ?>.</td>
                           <?php }else{ ?>
										<td><?php if($is_active2 > 0){ $noti = ""; echo "<font color='green'> <i class='fa fa-check'></i> Accepted</font>"; }else{ $noti = "Click to Accept Transfering Student"; echo "<font color='red'><i class='fa fa-close'></i> Not Accepted Yet </font>";} if ($row_utme['c_matno'] > '0'){ ?> 
<?php   if (authorize($_SESSION["access3"]["stMan"]["coc"]["edit"])){ ?>  
<a href="javascript:changeaccept(<?php echo $new_a_id; ?>, '<?php echo $is_active2; ?>','<?php echo $ndept; ?>','<?php echo $session_id; ?>');" class="btn btn-info" id="<?php echo $id; ?>"  title="<?php echo $noti; ?>" style="<?php echo $disp;?>" ><i class=" <?php echo $is_active2 == '0'? 'fa fa-check' : 'fa fa-remove'; ?>" ></i>&nbsp;<?php echo $is_active2 == '0'? 'Accept' : 'Cancel'; ?></a> 
						  </td>		<?php } }} ?> 
                        </tr>
                     
                     
                        <?php } ?>
                      </tbody>
                      
                      
                      	</form>
                    </table>
                    
                 
