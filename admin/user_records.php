<form action="Delete_auser.php" method="post">
            <table id="datatable-buttons" class="table table-striped table-bordered">
             <?php   if (authorize($_SESSION["access3"]["sMan"]["asu"]["create"])){ ?>
              <a href="add_Users.php?view=addUser" class="btn btn-info"  id="delete02" data-placement="right" title="Click to Add New User" ><i class="fa fa-plus icon-large"></i> Add User</a> 
              <?php  } if (authorize($_SESSION["access3"]["sMan"]["asu"]["delete"])){ ?> 
                    	
                        <a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#user_delete" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show');
									 $('#delete').tooltip('hide');
									 });
									</script> <?php } ?>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th></th>
                          <th>User Name</th>
                          <th>Name In Full</th>
                          <th>Email Address</th>
                          <th>Phone</th>
                          <th>User Status</th>
                          <th>Action</th>
                         
                        
                        </tr>
                      </thead>


                      <tbody>
                       <?php
  if($Rorder == "1"){ $user_query = mysqli_query($condb,"select * from admin")or die(mysqli_error($condb)); }else{
$user_query = mysqli_query($condb,"select * from admin where roleorder > 1")or die(mysqli_error($condb));}
													while($row_b = mysqli_fetch_array($user_query)){
													$id = $row_b['admin_id'];   $is_active = $row_b['validate'];
											$idcheck = $row_b['access_level'];
												$idu = $row_b['username'];
/*$viewreg_query = mysqli_query($condb,"select  * from admin where admin_id='".safee($condb,$session_id)."' AND access_level = '1' ")or die(mysqli_error($condb));
$viewreg_query2 = mysqli_query($condb,"select  * from admin where admin_id='".safee($condb,$session_id)."' AND access_level = '".safee($condb,$admin_accesscheck)."'")or die(mysqli_error($condb));*/
							//$row_utme = mysqli_fetch_array($viewreg_query)
													?>
													
													
                        <tr>
                       <?php //if(mysqli_num_rows($viewreg_query)>0 ){ ?>
					<td width="30"> 
                   	<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">	
					</td>
												<?php// }else{ ?>
										<!--	<td width="30"> <input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" disabled CHECKED="CHECKED" value="<?php echo $id; ?>">	<?php //} ?></td> --!>
                           <td><?php echo $row_b['username']; ?></td>
                          <td><?php echo $row_b['firstname'].'  '.$row_b['lastname']; ?></td>
                          <td><?php echo $row_b['email']; ?></td>
                          <td><?php echo $row_b['phone']; ?></td>
                           <td><?php echo getstatus($idcheck); ?> <?php if($is_active == '1'){ echo "<font color='green'> <i class='fa fa-check'></i> Active </font>"; }else{ echo "<font color='red'><i class='fa fa-close'></i> Blocked </font>";} ?></td>
                        
                          
                          	<td width="120">
                          
                          <?php //if(mysqli_num_rows($viewreg_query)>0 and $idcheck=='1' )
//if(mysqli_num_rows($viewreg_query2)>0 and $idcheck==$admin_accesscheck and $id==$session_id ){ ?>
      <?php   if (authorize($_SESSION["access3"]["sMan"]["asu"]["edit"])){ ?>                  
<a rel="tooltip"  title="Edit User Details" id="<?php echo $id; ?>" href="add_Users.php?view=editUser&<?php echo 'id='.md5($id); ?>&<?php echo 'idu='.md5($idu); ?>" data-toggle="modal" class="btn btn-success"><i class="fa fa-pencil icon-large" > Edit Record</i></a>
  <?php }  if (authorize($_SESSION["access3"]["sMan"]["asu"]["delete"])){ ?> 
<a href="javascript:changeUserAccess(<?php echo $id; ?>, '<?php echo $is_active; ?>');" class="btn btn-info" ><i class=" <?php echo $is_active == '0'? 'fa fa-check' : 'fa fa-remove'; ?>"></i>&nbsp;<?php echo $is_active == '0'? 'Enable' : 'Block user'; ?></a>
                        <?php  }//}elseif(mysqli_num_rows($viewreg_query2)>0 and $admin_accesscheck=='1' ){?>
 <!--                                               
<a rel="tooltip"  title="Edit User Details" id="<?php echo $id; ?>" href="add_Users.php?<?php echo 'id='.md5($id); ?>&<?php echo 'idu='.md5($idu); ?>" data-toggle="modal" class="btn btn-success"><i class="fa fa-pencil icon-large" > Edit Record</i></a>
					
				<?php //	}else{ ?>
									<a rel="tooltip"  title="Edit User Details" id="<?php echo $id; ?>" href="#" data-toggle="modal" class="btn btn-danger"><i class="fa fa-pencil icon-large" > Edit Not Allow</i></a>	--!>	<?php //} ?>	
												</td>
                        </tr>
                     
                        <?php } ?>
                      </tbody>
                      
                      
                      	</form>
                    </table>