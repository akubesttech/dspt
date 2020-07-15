 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2>Sent Messages</h2>
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
                    <form action="Delete_pro.php" method="post">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                    	
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show');
									 $('#delete').tooltip('hide');$('#delete1').tooltip('hide');
									 });
									</script>
										<?php //include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                          
						  <th>Send To</th>
                          <th>Subject</th>
                         <th>Time Sent</th>
                          <th>Delete</th>
                       
                        </tr>
                      </thead>


                      <tbody>
                       <?php
$user_query = mysqli_query($condb,"SELECT *,UNIX_TIMESTAMP() - therealtime AS TimeSpent FROM b_pms WHERE sender='$staff_id' order by therealtime DESC limit 0,20")or die(mysqli_error($condb));
													while($row_f = mysqli_fetch_array($user_query)){
													$id = $row_f['news_id'];
													 $is_active = $row_f['s_status'];
													?>
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
	
                          <td><?php if($is_active == '0'){
						echo getemail($row_f['receiver']);
						}else{  echo $row_f['receiver']; }
						  ?></td>
        <td><a href='message_m.php?view=sendM&ID=<?php echo $row_f['pmID']; ?>'><?php echo $row_f['subject']; ?></a></td>
                          <td><?php echo $row_f['vartime']; 
						  //echo ucfirst(substr($row_f['message'],0,60)); ?></td>
                         
                          	<td width="120">
											
					<a rel="tooltip"  title="Click to Delete Message" id="delete" href="message_m.php?delid=<?php echo $row_f['pmID']; ?> "  data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash icon-large"> Delete</i></a>
												</td>
											
                        </tr>
                     
            
                        <?php } ?>
                      </tbody>
                      	</form>
                    </table>
                  </div>
                </div>
              </div>