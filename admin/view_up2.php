 <?php $status = FALSE;
if ( authorize($_SESSION["access3"]["rMan"]["vure"]["create"]) || 
authorize($_SESSION["access3"]["rMan"]["vure"]["edit"]) || 
authorize($_SESSION["access3"]["rMan"]["vure"]["view"]) || 
authorize($_SESSION["access3"]["rMan"]["vure"]["delete"]) ) {
 $status = TRUE;
}
if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}
  ?>
  <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  
                    <h2>List of Uploaded Results</h2>
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
        This page will Enable you to Delete Wrongly uploaded Result. <?php //echo $admin_valid ; ?>
                  </div>
                  
                    <form action="Delete_adminupresult.php" method="post">
                    
                    <table id="datatable-responsive" class="table table-striped table-bordered"><?php   if (authorize($_SESSION["access3"]["rMan"]["vure"]["delete"])){ ?>
                  <a data-placement="top" title="Click to Delete check item"   data-toggle="modal" href="#delete_adminupresult" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a> <?php } ?>
                    	&nbsp;&nbsp;&nbsp;  <!--	
								<a href="new_apply.php?view=imp_a" class="btn btn-info"  id="delete2" data-placement="right" title="Click to import Student UTME Exam Result" ><i class="fa fa-file icon-large"></i> Import Data</a> --!>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
										<?php include('../admin/modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                         <th>Course Code</th>
                          <th>Course Title</th>
                          <th>Session</th>
                          <th>Semester</th>
                          <th>Level</th>
                          <th>Date Uploaded</th>
                          <th>Uploaded By</th>
                         <th>View Info</th>
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php

$depart = $_GET['dept1_find'];
$session=$_GET['session2'];
$entry_mode= $_GET['moe2'];
//and session ='".$default_session."'  and semester='".$default_semester."'
if (authorize($_SESSION["access3"]["rMan"]["vure"]["delete"])){
$viewupco=mysqli_query($condb,"select * from uploadrecord ORDER BY up_id desc ");
}else{
$viewupco=mysqli_query($condb,"select * from uploadrecord where staff_id ='".safee($condb,$session_id)."'   ORDER BY up_id desc ");
}

		while($row_upfile = mysqli_fetch_array($viewupco)){
		$id = $row_upfile['up_id']; $scat = $row_upfile['scat'];
		$course_id = $row_upfile['course'];
?>     
                        <tr>
                        	<td width="30" >
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
						<td><?php  echo $row_upfile['course']; ?></td>
                          <td><?php echo getcourse($row_upfile['course']); ?></td>
                          <td><?php echo $row_upfile['session']; ?></td>
                          <td><?php echo $row_upfile['semester']; ?></td>
                          <td><?php echo getlevel($row_upfile['level'],$class_ID); ?></td>
                           <td><?php echo $row_upfile['date_up']; ?></td>
<td><?php if($scat > 1){ echo getstaff2($row_upfile['staff_id']); }elseif($scat == 1){echo getadmin2($row_upfile['staff_id']); }else{ echo "unknown staff" ;};
					//	}else{ echo getstaffr($row_upfile['staff_id']);}
					
							 ?></td>
                          
												<td width="90"><?php   if (authorize($_SESSION["access3"]["rMan"]["vure"]["view"])){ ?>
			<a rel="tooltip"  title="View Student Results For The selected Course <?php echo $row_upfile['course']; ?>" id="delete1" href="?view=v_ares&userId=<?php echo $id;?>" 	  data-toggle="modal" class="btn btn-info"><i class="fa fa-file icon-large"> View Result</i></a> <?php } ?>
												</td>
                        </tr>
                     
                     
                        <?php } ?>
                      </tbody>
                      
                      
                      	</form>
                    </table>
                  </div>
                </div>
              </div>