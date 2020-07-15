   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  
                    <h2>Payment Record:</h2>
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
           Listed Below are your Payment (s). 
                  </div>
                  
                    <form action="" method="post">
                    
                    <table id="datatable" class="table table-striped table-bordered">
                    <!--	<a data-placement="top" title="Click to Register Selected Courses"   data-toggle="modal" href="#reg_course" id="delete"  class="btn btn-info" name=""  ><i class="fa fa-plus icon-large"> Register Courses</i></a> --!>
                    
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                         <th>Transction ID</th>
                         <th>Reg/Mat No</th>
                          <th>Fee Type</th>
                          <th>Department</th>
                          <th>Session</th>
                          <th>level</th>
                          <th>Payment Mode</th>
                           <th>Amount paid</th>
                            <th>Date</th>
                            <th>Payment Status</th>
                          <th>View Info</th>
                         
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php

//if($depart == Null AND $session == Null){
$viewpay_query = mysqli_query($condb,"select * from payment_tb where stud_reg ='".safee($condb,$student_RegNo)."'  order by session  DESC")or die(mysqli_error($condb));
//$viewpay_query = mysql_query("select * from payment_tb where stud_reg ='$student_RegNo' order by session  DESC")or die(mysqli_error($condb));
 ?>
 <tr><?php	if(mysqli_num_rows($viewpay_query)<1){
	  echo "<td colspan='12' style='text-align:centre;'><strong>No Payment Record Found.</strong></td>"; }?> </tr>

<?php 
while($row_vpay = mysqli_fetch_array($viewpay_query)){
//$id = $row_utme['appNo'];
$payvid = $row_vpay['pay_id'];
$pay_status = $row_vpay['pay_status'];
$pay_Reg = $row_vpay['stud_reg'];
$pay_Reg = $row_vpay['app_no']; $feetype = $row_vpay['fee_type'];
$trans_id = $row_vpay['trans_id'];
if(substr($feetype,0,1) == "B"){ $feet = getfeecat($row_vpay['ft_cat']);}else{ $feet = getftype($row_vpay['fee_type']);}
?>     
                        <tr>
                        	<?php if($pay_status > 0){
							$status = 'Approved';
							 ?>
							<td width="30">
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" disabled CHECKED="CHECKED" value="<?php echo $id; ?>">
                        
													</td> <?php }else{
													$status = 'Pending';
													 ?>
														<td width="30">
           	<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $row_utme['C_code']; ?>">
													</td>
													<?php } ?>
						
					 <td><?php echo $row_vpay['trans_id']; ?></td>
                <td><?php if(empty($row_vpay['stud_reg'])){ echo $row_vpay['app_no'] ;}else{ echo $row_vpay['stud_reg']; } ?></td>
                          <td><?php echo $feet; ?></td>
                          <td><?php echo getdeptc($row_vpay['department']); ?></td>
                          <td><?php echo $row_vpay['session']; ?></td>
                          <td><?php echo getlevel($row_vpay['level'],$student_prog); ?></td>
                          <td><?php echo $row_vpay['pay_mode']; ?></td>
                          <td><?php echo number_format($row_vpay['paid_amount'],2); ?></td>
                          <td><?php echo $row_vpay['pay_date']; ?></td>
                           
												  <td style="text-align:justify;"><?php 
						if($pay_status > 0){
						echo "<font color='green'>$status</font>";
						}else{
					echo "<font color='red'>$status</font>";
					} ?></td>
				
							<td> <?php if($pay_status > 0){ ?>  <a  href="../paymentslip.php?<?php  echo "p_id=".md5($trans_id); ?>"  rel="tooltip" id="addpay" class="btn btn-info" title="Click Print Payment Slip"><i class="icon-money"></i>&nbsp;View Slip</a></td>			<?php	}else{ ?> ---------- <?php } ?>
												
												
										
                        </tr>
                     
                     
                        <?php } ?>
                      </tbody>
                      
                      
                      	</form>
                    </table>
                  </div>
                </div>
              </div>