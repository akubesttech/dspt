 <?php
$status = FALSE;
if ( authorize($_SESSION["access3"]["hMan"]["arooms"]["create"]) || 
authorize($_SESSION["access3"]["hMan"]["arooms"]["edit"]) || 
authorize($_SESSION["access3"]["hMan"]["arooms"]["view"]) || 
authorize($_SESSION["access3"]["hMan"]["arooms"]["delete"]) ) {
 $status = TRUE;
}
 if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} ?>
 <div class="x_panel">
                  <div class="x_title">
                 
                    <h2> List Of Alloted Room (s)</h2>
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
                    <form action="Delete_roomallot.php" method="post">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                    <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          This page will enable Hostel Administrator to edit , Delete and view Room allocation Details.
                  </div>
                <a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#delete_rallot" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a> 
                    
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show');
									 $('#delete').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th></th>
                          <th>Hostel Name</th>
                          <th>Room No</th>
						  <th>Alloted to</th>
						  <th>Date of Allotment</th>
                          <th>Expiring Date</th>
                         <th>Duration</th>
                         <th>Validity</th>
                        <th>Authorized by</th>
                          <th>Action</th>
                          
                        </tr>
                      </thead>
 <?php
$hallot_query = mysqli_query($condb,"select * from hostelallot_tb left join hostedb ON hostedb.h_code = hostelallot_tb.h_code WHERE  allotstatus = '1'   order by allot_id DESC LIMIT 0,500")or die(mysqli_error($condb));
 // session = '".safee($condb,$default_session)."' AND prog = '".safee($condb,$class_ID)."'
													while($row_hrequest = mysqli_fetch_array($hallot_query)){
													$id = $row_hrequest['allot_id'];
													$is_active2 = $row_hrequest['validity'];
													$hostelid = $row_hrequest['h_code'];
													$hduration = $row_hrequest['duration'];
													$expiredate = $row_hrequest['allotexpire'];
													$croom=mysqli_num_rows(mysqli_query($condb,"select * from roomdb where h_coder='".safee($condb,$hostelid)."' and room_status = '1' "));
													$dayx = dayCount($expiredate);
 if(!is_positive_integer($dayx)){ $dayremain = "0"; }else{ $dayremain = $dayx;  }
 
													?>

                      <tbody>
                        <tr>
                        	<td width="30"><?php if($dayremain > 0){ ?>
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" disabled value="<?php echo $id; ?>"><?php }else{ ?>
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox"   value="<?php echo $id; ?>"><?php } ?>
												</td>
								<td><?php echo $row_hrequest['h_name']; ?><span class="badge bg-green"><?php echo " ".$croom; ?></span></td>			<td><?php echo getroomno($row_hrequest['roomno']); ?></td>
								<td><?php echo getsname($row_hrequest['studentreg']); ?></td>
                          <td><?php echo $row_hrequest['allotdate']; ?></td>
                          <td><?php echo $row_hrequest['allotexpire']; ?></td>
                          <td><?php if($hduration <=1){ echo $hduration." Month";}elseif($hduration > 0 and $hduration < 12){ echo $dr=$hduration; echo " Months";}elseif($hduration = 12 ){ echo "One Year";} ?>
						  </td>
                          <td><?php if($dayremain > 0 ){ echo "<font color='green'> <i class='fa fa-check'></i>"." Active"."</font>"; }else{ echo "<font color='red'><i class='fa fa-close'></i>"." Expired"." </font>";}  ?></td>
                          
                          
                         <td width="117"><?php echo getstaff($row_hrequest['approve_by']); ?> </td>
												
												
												
													<td width="120">
										<!--	<a rel="tooltip"  title="Click Add Room" id="<?php echo $id; ?>" href="?addrooms&idroom=<?php echo $id;?>"  data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus icon-large"> Add Room</i></a>
											 <td> --!> <?php   if (authorize($_SESSION["access3"]["hMan"]["arooms"]["edit"])){ ?> 
									<a rel="tooltip"  title="Click Edit Room Allocation" id="<?php echo $id; ?>" onClick="window.location.href='add_Hostel.php?view=aedit&idroom=<?php echo $id;?>';" href="javascript:void(0);"  data-toggle="modal" class="btn btn-info"><i class="fa fa-pencil icon-large"> Edit</i></a>	<?php } ?>	 
											 
											 </td>
												
                        </tr>
                     
                        <?php } ?>
                      </tbody>
                      	</form>
                    </table>
                  </div>
                </div>
               