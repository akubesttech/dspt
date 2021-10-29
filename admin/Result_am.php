
<?php  include('header.php'); ?>
<?php include('session.php'); ?>
<?php /*	$status = FALSE;
if ( authorize($_SESSION["access3"]["rMan"]["apc"]["create"]) || 
authorize($_SESSION["access3"]["rMan"]["apc"]["edit"]) || 
authorize($_SESSION["access3"]["rMan"]["apc"]["view"]) || 
authorize($_SESSION["access3"]["rMan"]["apc"]["delete"]) ) {
 $status = TRUE;
} 
	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}*/ ?>	
		    	
 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php') ?>
      
  <?php $get_RegNo = isset($_GET['userId']) ? $_GET['userId'] : '';
  $dep1 = isset($_GET['Schd']) ? $_GET['Schd'] : '';
  $sec1 = isset($_GET['sec']) ? $_GET['sec'] : '';
  $los = isset($_GET['slos']) ? $_GET['slos'] : '';
  $sumcreditunit = 0;
  //$dep1 = $_GET['Schd']; $sec1 = $_GET['sec']; $los = $_GET['slos'];
 if(empty($dep1)){ $links = "Result_am.php?view=caprove";}else{ $links = "Result_am.php?view=caprove&dlist&userId=".($get_RegNo)."&Schd=".$dep1."&sec=".$sec1."&slos=".$los;}
$links2 = "Result_am.php?view=caprove&userId=".($get_RegNo)."&Schd=".$dep1."&sec=".$sec1."&slos=".$los;


   ?>
    <!-- page content -->
    
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3><?php  if($Rorder == "10"){ echo getstatus($checkstatus)." Result  Management";}else{ echo "Admin Result  Management";}   ?>
 
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
						$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'aimp_re' :
		            $content    = 'admin_impresult.php';		
		            break;

	                case 'v_re' :
		            $content    = 'Previewresultup.php';		
		            break;
                   
                     case 'v_upa' :
		            $content    = 'view_up2.php';		
		            break;
		                
					case 'v_ares' :
		            $content    = 'view_aresult.php';		
		            break;
		            
		            case 'e_ares' :
		            $content    = 'edit_aresult.php';		
		            break;
		            
		              case 'v_so' :
		            $content    = 'MessageAlert.php';		
		            break;
		              case 'e_rec' :
		            $content    = 'exportrec.php';		
		            break;
		            case 'rbs' :
		            $content    = 'sbroadsheet.php';		
		            break;
		            case 'ras' :
		            $content    = 'sabroadsheet.php';
					break;
		            case 'apcs' :
		            $content    = 'selectappcourse.php';
		            break;
		            case 'pan' :
		            $content    = 'spanalysis.php';
					break;
		            case 'caprove' :
		            $content    = 'scourseapplist.php';		
		            break;
		            case 'asheet' :
		            $content    = 'easheet.php';		
		            break;
	                default :
		            $content    = 'admin_impresult.php';
                         }
                     require_once $content;
                     //statuscapp2();
				?>
				<!-- /Organization Setup Form End -->
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- /page content -->
<?php 

if (isset($_POST['Courseapprove'])){
	if(empty($_POST['selector03'])){
				message("Select at least one Course Registration to proceed !", "error");
		        redirect($links);
				}else{ $id=$_POST['selector03'];  $N = count($id);$deptcp = $_POST['deptcp'];
          $sessions = $_POST['sessions']; $apr = 0;
             $cosd = $_POST['los'];
             $cosidd = $_POST['cosidd'];
for($i=0; $i < $N; $i++){
$sql2="select * from coursereg_tb where creg_id ='".$id[$i]."' and session = '".$sessions[$i]."' and dept = '".$deptcp[$i]."' and level = '".$cosd[$i]."'";
				$result2=mysqli_query($condb,$sql2) or die(mysqli_error($condb));
				$row=mysqli_fetch_array($result2);
                extract($row);
                //if(mysqli_num_rows($result2)>0){
                    if(empty($lect_approve)){ $apr = "1";}else{$apr = "0";} //,course_id = '".$cosidd[$i]."'
mysqli_query($condb,"UPDATE coursereg_tb  SET lect_approve = '1' where creg_id ='".$id[$i]."' ")or die(mysqli_error($condb));
//}else{mysqli_query($condb,"UPDATE coursereg_tb  SET lect_approve = '0' where creg_id ='".$id[$i]."'  ")or die(mysqli_error($condb));
				}//}
	message(" Selected Student Course Registration Successfully Approved.", "success");
	redirect($links2); }}
	
	if (isset($_POST['CCapprove'])){
	if(empty($_POST['selector03'])){
				message("Select at least one Course Registration to proceed !", "error");
		        redirect($links);
				}else{ $id=$_POST['selector03'];  $N = count($id);$deptcp = $_POST['deptcp'];
          $sessions = $_POST['sessions']; $apr = 0;
             $cosd = $_POST['los'];
             $cosidd = $_POST['cosidd'];
for($i=0; $i < $N; $i++){
$sql2="select * from coursereg_tb where creg_id ='".$id[$i]."' and session = '".$sessions[$i]."' and dept = '".$deptcp[$i]."' and level = '".$cosd[$i]."'";
				$result2=mysqli_query($condb,$sql2) or die(mysqli_error($condb));
				$row=mysqli_fetch_array($result2);
                extract($row);
                //if(mysqli_num_rows($result2)>0){
                    if(empty($lect_approve)){ $apr = "1";}else{$apr = "0";} //,course_id = '".$cosidd[$i]."'
mysqli_query($condb,"UPDATE coursereg_tb  SET lect_approve = '0' where creg_id ='".$id[$i]."' ")or die(mysqli_error($condb));
//}else{mysqli_query($condb,"UPDATE coursereg_tb  SET lect_approve = '0' where creg_id ='".$id[$i]."'  ")or die(mysqli_error($condb));
				}//}
	message(" Selected Student Course Registration Successfully Canceled.", "success");
	redirect($links2); }}
    
if (isset($_POST['removeCourses'])){
	if(empty($_POST['selector03'])){
				message("Select at least one Course Registration to proceed !", "error");
		       redirect($links);
				}else{ $id=$_POST['selector03'];  $N = count($id);
for($i=0; $i < $N; $i++){$resultd = mysqli_query($condb,"DELETE FROM coursereg_tb where creg_id ='".$id[$i]."'");}
	message(" Selected Student Course Registration Successfully Romoved .", "success");
	redirect($links); }}
if(isset($_GET['dlist'])){?>
<script>   $(document).ready(function(){  $('#Modallist').fadeIn('fast'); });
    $(document).ready(function(){ $('#close').click(function(){
            $('#Modallist').fadeOut('fast'); windows.location = "Result_am.php";})
})  

</script> <?php }?>
        

<div id="Modallist" class="modal dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
                      <div class="modal-content">

 <div class="modal-header">
<a href="javascript:void(0);" 	onclick="window.open('<?php echo $links2; ?>','_self')" class="close"><span aria-hidden="true"></i>x</span> </a>
<h4 class="modal-title" id="myModalLabel">Registered Course (s)  &nbsp;<?php echo strtoupper("   [".getname($get_RegNo))."] - ".getlevel($los,$class_ID) ; ?></h4>
                        </div>
        <div class="modal-body" style="overflow:auto;height:450px;">
         <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
       List of Courses Registered By <?php echo " ".$get_RegNo ." In ".getdeptc($dep1)." For ".$sec1." Academic Session."; ?> 
                  </div>
					<form method="post"  action="" enctype="multipart/form-data">	
					 <input type="hidden" name="deptcp[]" value="<?php echo $dep1; ?>">
	      <input type="hidden" name="sessions[]" value="<?php echo $sec1; ?>">
	     <input type="hidden" name="los[]" value="<?php echo $los; ?>">	
		<!-- <td>Search: <input type="text" name="filter" value="" id="filter" /></td>	--!>				  
			 <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" >
			 
<thead><tr > <th><input type="checkbox" name="checkall"  id="checkall" class="checkall" onClick="check_uncheck_checkbox(this.checked);" > </th>
                         <th>S/N</th>
                         <th>Course Code</th>
                         <th>Course Title</th>
                          <th>Credit Unit</th>
                         <th>Status</th>
                         <th>Action</th>
				   </thead>
<tbody> <?php $user_query = mysqli_query($condb,"select ctb.c_code,ctb.semester,ctb.c_unit,ctb.lect_approve,ctb.creg_id,ctb.course_id,cn.c_cat,cn.C_title,cn.C_id from coursereg_tb ctb LEFT JOIN courses cn ON ctb.course_id = cn.C_id
 WHERE sregno = '".$_GET['userId']."' and level ='". safee($condb,$los) ."' and session ='". safee($condb,$sec1) ."' and dept='". safee($condb,$dep1)."' GROUP BY ctb.c_code,ctb.semester,ctb.c_unit,ctb.lect_approve,ctb.creg_id,ctb.course_id,cn.c_cat,cn.C_title ORDER BY ctb.semester ,ctb.c_code  ASC")or die(mysqli_error($condb)); $serial=1;
													while($row_b = mysqli_fetch_array($user_query)){
													$id = $row_b['creg_id']; $cosname = $row_b['C_id']; 
$user_query2 = mysqli_query($condb,"select * from coursereg_tb WHERE creg_id = '".$id."' and level ='". safee($condb,$los) ."' and session ='". safee($condb,$sec1) ."' and dept='". safee($condb,$dep1)."' and course_id = '".safee($condb,$cosname)."' GROUP BY c_code,semester ORDER BY semester ASC")or die(mysqli_error($condb));
	$row_b2 = mysqli_fetch_array($user_query2);	 $course_approve = 	$row_b2['lect_approve'];										
$coursstatus = $row_b['c_cat']; if($coursstatus > 0){  $cstat = "C";}else{  $cstat = "E";}
if($row_b2['lect_approve'] > 0){ $astatus = "color:green;";}else{$astatus = "";} //disabled		?>
			   <tr style="<?php echo $astatus; ?>"><td ><?php //echo $astatus; ?> 
<input    id="selector03<?php echo $id; ?>" class="uniform_on1" name="selector03[]" type="checkbox" value="<?php echo $id; ?>"  ></td>
<td><?php echo $serial++ ; ?>  <input type="hidden" name="cosidd[]" value="<?php echo $cosname; ?>"></td>
                          <td><?php echo $row_b["c_code"]; ?><i class="<?php echo $course_approve == '1'? 'fa fa-check' : ''; ?>"></i></td>
                          <td><?php echo $row_b["C_title"]; ?></td>
                          <td><?php echo $row_b['c_unit']; ?></td>
                <td> <?php echo $cstat ;?></td>
                           <td>
<a rel="tooltip"  title="Check Course Approval Status <?php echo $row_allot['course']; ?>" id="delete1" href="javascript:changeUserStatus60('<?php echo $id; ?>','<?php echo $los; ?>','<?php echo $depart; ?>','<?php echo $session; ?>','<?php echo $course_approve; ?>');" class="btn btn-info" >
<i class="fa fa-check  <?php echo $course_approve == '0'? 'fa fa-check' : 'fa fa-remove'; ?>"></i>&nbsp;<?php echo $course_approve == '0'? 'Approve' : 'Decline'; ?></a>
						  </td>
<script type="text/javascript"> $(document).ready(function(){
									 $('#com').tooltip('show');	 $('#com3').tooltip('show');
									 $('#com').tooltip('hide');$('#com3').tooltip('hide');
                                     $('#com2').tooltip('show');
									 $('#com2').tooltip('hide');$('#com4').tooltip('show');
									 $('#com4').tooltip('hide'); });
									</script> 
                        </tr><?php $sumcreditunit += $row_b['c_unit'];  } ?>
						 <tr><td colspan="4"><strong>Total Credit Unit:</strong></td ><td colspan="1"><?php if($sumcreditunit > 0){ echo $sumcreditunit;}else{ echo "0"; } ?></td><td colspan="2"> </td> </tr>	    					
				   </tbody>
				</table>
		</div>
			
					<div class="modal-footer">
<button class="btn btn-info" name="Courseapprove" title="Click to Approve course Registration" type="submit" id="com"><i class="icon-save icon-large"></i> Approve Courses </button>
<button class="btn btn-info" name="CCapprove" title="Click to Cancel course Registration" type="submit" id="com4"><i class="icon-save icon-large"></i> Cancel Courses Approval </button>

<button class="btn btn-info" name="removeCourses" title="Click to Remove course (s) " type="submit" id="com3"><i class="icon-trash icon-large"></i> Remove Courses </button>
<a href="javascript:void(0);" 	onclick="window.open('<?php echo $links2; ?>','_self')" class="btn btn-info" ><i class="fa fa-remove"></i>&nbsp;Close</a>
                        </div>
					
					</form>
					<script>
      
function check_uncheck_checkbox(isChecked) {
	if(isChecked) {
		$('input[name="selector03[]"]').each(function() { 
			this.checked = true; 
		});
	} else {
		$('input[name="selector03[]"]').each(function() {
			this.checked = false;
		});
	}
}
	 </script>
					 </div>
                 
				    </div>
</div>


  
         <?php include('footer.php'); ?>