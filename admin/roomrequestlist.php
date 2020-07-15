 <?php
$status = FALSE;
if ( authorize($_SESSION["access3"]["hMan"]["vrr"]["create"]) || 
authorize($_SESSION["access3"]["hMan"]["vrr"]["edit"]) || 
authorize($_SESSION["access3"]["hMan"]["vrr"]["view"]) || 
authorize($_SESSION["access3"]["hMan"]["vrr"]["delete"]) ) {
 $status = TRUE;
}
 if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} ?>
 <div class="x_panel">
                  <div class="x_title">
                 
                    <h2> List Of Hostel Request </h2>
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
                    <form action="Delete_hostel.php" method="post">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                    <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Please Make Sure that payment Status is Successful Before Room request Approval. 
                  </div>
                    <!--	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#hostel_delete" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a> --!>
                    	<button  name="goback"  id="goback" type='button' onClick="window.location.href='add_Hostel.php?view=allotR';" class="btn btn-primary col-md-4" title="Click Here to View Alloted Rooms " ><i class="fa fa-eye"></i> View Alloted Rooms</button>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show');
									 $('#delete').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                          <th>Student Regno</th>
						  <th>Department</th>
                          <th>Programme</th>
                         <th>Hostel Name</th>
                          <th>Room No</th>
                        <th>payment status</th>
                          <th>Request date</th>
                          
                          <th>Action</th>
                          
                        </tr>
                      </thead>
 <?php
$hallot_query = mysqli_query($condb,"select * from hostelallot_tb left join hostedb ON hostedb.h_code = hostelallot_tb.h_code WHERE  validity = '0'   AND session = '".safee($condb,$default_session)."' AND prog = '".safee($condb,$class_ID)."' AND rchange = '1' order by allot_id DESC LIMIT 0,400")or die(mysqli_error($condb));
													while($row_hrequest = mysqli_fetch_array($hallot_query)){
													$id = $row_hrequest['allot_id'];
													$is_active2 = $row_hrequest['validity'];
													$hostelid = $row_hrequest['h_code'];
													$croom=mysqli_num_rows(mysqli_query($condb,"select * from roomdb where h_coder='".safee($condb,$hostelid)."' "));
													?>

                      <tbody>
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
											
                          
                          <td><?php echo $row_hrequest['studentreg']; ?></td>
                          <td><?php echo getdeptc($row_hrequest['dept'])." "; ?></td>
                          <td><?php echo getprog($row_hrequest['prog']); ?></td>
                          <td><?php echo $row_hrequest['h_name']; ?><span class="badge bg-green"><?php echo " ".$croom; ?></span></td>
                          <td><?php echo getroomno($row_hrequest['roomno']); ?></td>
                         <td width="117"><?php echo getpaystatus($row_hrequest['paystatus']); ?> </td>
												<td><?php echo $row_hrequest['rdate']; ?></td>
												
												
													<td width="120">
										<!--	<a rel="tooltip"  title="Click Add Room" id="<?php echo $id; ?>" href="?addrooms&idroom=<?php echo $id;?>"  data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus icon-large"> Add Room</i></a>
											 <td> --!> <?php   if (authorize($_SESSION["access3"]["hMan"]["vrr"]["create"])){ ?> <a href="javascript:changeUserStatus4(<?php echo $id; ?>, '<?php echo $is_active2; ?>');" class="btn btn-info" ><i class="fa fa-check"></i>&nbsp;<?php echo $is_active2 == '0'? 'Approve' : 'Decline'; ?></a> <?php } ?></td>
												
                        </tr>
                     
                     
                      
                      
                      
                      
                      
                       
                       
                       
                      
                      
                      
                        <?php } ?>
                      </tbody>
                      	</form>
                    </table>
                  </div>
                </div>
               