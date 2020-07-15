 <?php if($class_ID > 0){}else{
                  message("ERROR:  No Programme Select,Please Select a Programme and continue.", "error"); redirect('new_apply.php?view=spro');}
					
                    //$depart = $_GET['dept1_find'];
//$session=$_GET['session2'];
//$c_choice= $_GET['c_choice']; 	
						?>
 <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
           The Applicant List below will Enable Admin To Verify Student Information,Update student Admission Status and update UTME/Entrance Exam Score - <strong><?php echo getprog($class_ID); ?></strong>. 
                  </div>
                  
                   <!-- <form action="Delete_sapp.php" method="post"> --!>
                    <form action="" method="post">
					<?php	$current_url21 = base64_encode($url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>
                       
                    <table id="datatable-responsive" class="table table-striped table-bordered">
                  <?php   if (authorize($_SESSION["access3"]["adm"]["nsp"]["delete"])){ ?><button class="btn btn-danger" name="delete_newapp" title="Click to Delete selected Applicant Records that are more than Five years " id="com"><i class="fa fa-trash icon-large"></i> Delete </button>
				   <?php } ?>
                    	&nbsp;<?php   if (authorize($_SESSION["access3"]["adm"]["nsp"]["create"])){ ?> 
								<a href="new_apply.php?view=imp_a" class="btn btn-info"  id="delete2" data-placement="top" title="Click to import Students Entrance Exam Result" ><i class="fa fa-file icon-large"></i> Import Data</a><?php } ?>
							
								<?php   if (authorize($_SESSION["access3"]["adm"]["nsp"]["edit"])){ ?>
<button class="btn btn-info" name="approveapp" title="Select Appropriate Record to Verify Application" id="com2"><i class="fa fa-check"></i> Verify Application</button>
								<button class="btn btn-info" name="bComfirm_record"  data-placement="top" title="Click to Transfer <?php echo $clearno; ?> admitted student  record (s) to Students Register" id="trans"><i class="fa fa-circle-o icon-large"></i> Transfer Record (s) <span class="badge bg-yellow"><?php echo $clearno; ?></span></button>

									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#trans').tooltip('show'); $('#com2').tooltip('show'); $('#delete2').tooltip('show');$('#com').tooltip('show');
									 $('#trans').tooltip('hide'); 	 $('#com2').tooltip('hide'); $('#delete2').tooltip('hide');$('#com').tooltip('hide');
									 $('#back').tooltip('show'); $('#pappd').tooltip('show');
                                     $('#back').tooltip('hide');  $('#pappd').tooltip('hide');
                                     });
									</script><?php } if(!empty($dep1) AND !empty($sec1)){//if($dep1 != Null AND $sec1 != Null){ ?> 
									<a 	onClick="window.location.href='Print_appd.php?dep=<?php echo $dep1; ?>&sec=<?php echo $sec1; ?>&ccho=<?php echo $los; ?>';" class="btn btn-info"  id="papp" data-placement="right" title="Click to Print Application Details" ><i class="fa fa-print icon-large"></i> Print Applicant(s)</a>
<a 	onClick="window.location.href='Print_appd.php?dep=<?php echo $dep1; ?>&sec=<?php echo $sec1; ?>&ccho=<?php echo $los; ?>&p1=2';" class="btn btn-info"  id="pappd" data-placement="top" title="Click to Print Application Details" ><i class="fa fa-print icon-large"></i>  Print Admission list</a>
<a href="javascript:void(0);" 	onClick="window.location.href='new_apply.php?view=sech_r';" class="btn btn-info"  id="back" data-placement="top" title="Click to go back to search record" ><i class="fa fa-arrow-left icon-large"></i> Go Back</a>
										<?php  } include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                         <th>Application No</th>
                          <th>Applicant Name</th>
                          <th>Gender</th>
                          <th>Mobile Number</th>
                          <th>State</th>
                          <th>Session</th>
                          <th>First Choice</th>
                          <th>Second Choice</th>
                           <th>Jamb Score</th>
                           <th>Verification Status</th>
                           <th>Admission Status</th>
                            <th>Action</th>
                          
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php


//if($depart == Null AND $session == Null){
if(empty($dep1) AND empty($sec1)){
$view_queryn = "select * from new_apply1 where reg_status = '1' and Asession = '".safee($condb,$default_session)."' and app_type = '".safee($condb,$class_ID)."' and application_r = '0'  ";
if($Rorder > 2){ $view_queryn .= " AND first_Choice = '$userdept'";}
 $view_queryn .= "order by stud_id DESC limit 0,800";
    $viewutme_query = mysqli_query($condb,$view_queryn)or die(mysqli_error($condb));
}else{ if($los=='1'){
$viewutme_query = mysqli_query($condb,"select * from new_apply1 where reg_status = '1' and Asession = '".safee($condb,$sec1)."' and app_type = '".safee($condb,$class_ID)."' and first_Choice ='".safee($condb,$dep1)."' order by stud_id DESC ")or die(mysqli_error($condb));
}elseif($los=='2'){
$viewutme_query = mysqli_query($condb,"select * from new_apply1 where reg_status = '1' and Asession = '".safee($condb,$sec1)."' and app_type = '".safee($condb,$class_ID)."' and Second_Choice ='".safee($condb,$dep1)."' order by stud_id DESC ")or die(mysqli_error($condb));
}else{
$viewutme_query = mysqli_query($condb,"select * from new_apply1 where reg_status = '1' and Asession = '".safee($condb,$sec1)."' and app_type = '".safee($condb,$class_ID)."' and first_Choice ='".safee($condb,$dep1)."' or Second_Choice ='".safee($condb,$dep1)."' and reg_status = '1' and Asession = '".safee($condb,$sec1)."' and app_type = '".safee($condb,$class_ID)."'  order by stud_id DESC ")or die(mysqli_error($condb)); } }
while($row_utme = mysqli_fetch_array($viewutme_query)){ 
$id = $row_utme['appNo']; 
$new_a_id = $row_utme['stud_id'];
$newstatus = $row_utme['verify_apply']; $chot = $row_utme['course_choice']; $astatus2 =  $row_utme['adminstatus'];
if($astatus2 > 0){   $alert2 = "<font color='green'><i class='fa fa-check'></i></font>";   }else{ $alert2 = "";   }
if($chot > 1){   $adep = $row_utme['Second_Choice'];   }else{ $adep = $row_utme['first_Choice'];   }
$adep2 = $row_utme['Second_Choice']; $adep1 = $row_utme['first_Choice']; 
?>     <?php include('toolttip_edit_delete.php'); ?>
                        <tr>
                        	<td width="30">
                        	<?php if($row_utme['adminstatus']=='1'){ ?>
				<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $new_a_id; ?>" checked  >
												<?php }else{ ?>
				<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $new_a_id; ?>">
												<?php } ?>
												</td>
						  <td><a rel="tooltip"  title="View Student Application Details" id="<?php echo $id; ?>"  onclick="window.open('?details&userId=<?php echo $new_a_id;?>&dept1_find=<?php echo $dep1; ?>&session2=<?php echo $sec1; ?>&c_choice=<?php echo $los; ?>','_self')" data-toggle="modal" class="btn btn-info"><i class=""> <?php 
						  if($row_utme['adminstatus']=='1'){
						echo "<font color='green'>$row_utme[appNo]</font>";
						}else{
					echo "<font color='red'>$row_utme[appNo]</font>";
					} ?></i></a></td>
                          <td><?php echo $row_utme['FirstName'].'  '.$row_utme['SecondName'].' '.$row_utme['Othername']; ?></td>
                          <td><?php echo $row_utme['Gender']; ?></td> 
                          <td><?php echo $row_utme['phone']; ?></td>
                          <td><?php echo $row_utme['state']; ?></td> 
                           <td><?php echo $row_utme['Asession']; ?></td>
                          <td><?php echo($adep1 == $adep)? $alert2:"" ; ?><?php echo getdeptc($row_utme['first_Choice']); ?></td>
                          <td><?php echo($adep2 == $adep)? $alert2:"" ; ?><?php echo getdeptc($row_utme['Second_Choice']); ?></td>
                          <td><?php echo $row_utme['J_score']; ?></td>
                          <td><?php if($row_utme['verify_apply']=='TRUE'){ echo "<font color='green'> <i class='fa fa-check'></i>"." Verified"."</font>"; }else{ echo "<font color='red'><i class='fa fa-close'></i>"." Not Verified"." </font>";}  ?>
						  </td>
                          <td><?php echo getappstatus($row_utme['adminstatus']); ?></td>
                          	<td width="120"><?php   if (authorize($_SESSION["access3"]["adm"]["nsp"]["create"])){ if($row_utme['verify_apply']=='TRUE'){ ?>
<a rel="tooltip"  title="Click To Process Student Admission" id="<?php echo $new_a_id; ?>" href="javascript:void(0);" 	onClick="window.location.href='new_apply.php?view=P_admin&<?php echo 'userId='.$new_a_id; ?>&loc=<?php echo $current_url21; ?>';"
 data-toggle="modal" class="btn btn-success"><i class="fa fa-gears icon-large"> Process Data</i></a> <?php }else{ echo "-----";}} ?> </td> <!--<td width="90"> <a rel="tooltip"  title="View Student Application Details" id="<?php echo $new_a_id; ?>" href="?details&userId=<?php echo $new_a_id;?>" data-toggle="modal" class="btn btn-info"><i class="fa fa-file icon-large"> Info</i></a> </td>--!>
                        </tr>
                     
                     
                        <?php } ?>
                      </tbody>
                      
                      
                      	</form>
                    </table>