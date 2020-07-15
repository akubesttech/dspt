
<?php  include('header.php'); ?>
<?php include('session.php');//if(($admin_accesscheck == "1") or ($admin_accesscheck == "2")) {
	//}else{echo "<script>alert('Access Not Granted To This User Please Contact System Administrator!');</script>";
		//redirect("index.php");} 
		$status = FALSE;
if ( authorize($_SESSION["access3"]["sMan"]["aes"]["create"]) || 
authorize($_SESSION["access3"]["sMan"]["aes"]["edit"]) || 
authorize($_SESSION["access3"]["sMan"]["aes"]["view"]) || 
authorize($_SESSION["access3"]["sMan"]["aes"]["delete"]) ) {
 $status = TRUE;
}	
		?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');
		if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} ?>
  <?php $get_RegNo= $_GET['id']; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Staff Employment Details
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
					
					$num=$get_RegNo;
				if ($num!==null){
			include('editStaff.php');
			}else{
			
				include('addStaff.php');
				//statusUser();
				//
				 }?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  
                    <h2>List of Staff</h2>
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
                    <form action="Delete_staff.php" method="post">
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <!-- <table id="datatable" class="table table-striped table-bordered"> --!>
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#Delete_staff" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
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
                          <th>Staff Name</th>
                          <th>Gender</th>
                          <th>Mobile Number</th>
                          <th>Email Address</th>
                          <th>State</th>
                          <th>Job Description</th>
                          <th>Department</th>
                           <th>Access Level</th>
                            <th>Action</th>
                         <!-- <th>Info</th> --!>
                          <th>View</th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php
													$user_query = mysqli_query($condb,"select * from staff_details ORDER by sname ASC ")or die(mysqli_error());
													while($row = mysqli_fetch_array($user_query)){
													$id = $row['staff_id'];
														$id3 = $row['staff_id'];
												      $is_active = $row['u_display'];
												      $picget = $row['image'];
								 $exists = imgExists($picget);
													?>
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
                          <td>
						   <img src="<?php 
											  if ($exists > 0 ){
	print $picget;
	}else{ print "./uploads/NO-IMAGE-AVAILABLE.jpg";}
 ?>" class="avatar" alt="user image">&nbsp;
						  <a rel="tooltip"  title="View User Details" id="<?php echo $new_a_id; ?>"  onclick="window.open('?details&id2=<?php echo $id;?> ','_self')" data-toggle="modal" class="clickable2-row"><?php echo $row['sname'].'  '.$row['mname'].' '.$row['oname']; ?> </a></td>
                          <td><?php echo $row['Gender']; ?></td>
                          <td><?php echo $row['phone']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['state']; ?></td>
                          <td><?php echo $row['job_desc']; ?></td>
                          <td><?php echo getdeptc($row['s_dept']); ?></td>
                          <td><?php echo getstatus($row['access_level2']); ?></td>
                          	<td width="120">
												<a rel="tooltip"  title="Edit School Details" id="<?php echo $id; ?>" href="add_Staff.php<?php echo '?id='.$id; ?>"  data-toggle="modal" class="btn btn-success"><i class="fa fa-pencil icon-large"> Edit Record</i></a>
												</td>
												
										<!--		<td width="90">
			<a rel="tooltip"  title="View User Details" id="<?php echo $id; ?>" href="?details&id2=<?php echo $id;?>"
												
											
												  data-toggle="modal" class="btn btn-info"><i class="fa fa-file icon-large"> Info</i></a>
												</td> --!>
												<td width="90">
		<a href="javascript:changeUserStatus5(<?php echo $id3; ?>, '<?php echo $is_active; ?>');" class="btn btn-info" ><i class="fa fa-eye"></i>&nbsp;<?php echo $is_active == 'FALSE'? 'Show' : 'Hide'; ?></a>
												</td>
                        </tr>
                     
                        <?php } ?>
                      </tbody>
                      	</form>
                    </table>
                  </div>
                </div>
              </div>



            
            
          </div>
        </div>
        <!-- /page content -->
        
        
        <?php 
if(isset($_GET['details'])){

?>

<script>
    $(document).ready(function(){
        $('#myModal5').fadeIn('fast');
    });
    
    $(document).ready(function(){
        $('#close').click(function(){
            $('#myModal5').fadeOut('fast');
            windows.location = "add_Staff.php";
        })
    })

</script>

<?php }?>
        <!-- start  Staff details Pop up -->
<?php //if(isset($_GET['choose_patient'])){ ?>
 
  

<div id="myModal5" class="modal dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
                      <div class="modal-content">

 <div class="modal-header">
                          
                          <a href="add_Staff.php" class="close"><span aria-hidden="true"></i>x</span> </a>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Staff Profile </h4>
                        </div>
                        
    
		<div class="modal-body">
		   
		<div class="well profile_view" style="1px solid green;">
					<form method="post"  action="admin_pic.php" enctype="multipart/form-data" >
										   <?php
													$user_query = mysqli_query($condb,"select * from staff_details where Staff_id='$_GET[id2]'")or die(mysqli_error());
													$row_b = mysqli_fetch_array($user_query);
													$id3 = $row_b['staff_id'];
												$is_active = $row_b['u_display'];
												$picget = $row_b['image'];
								 $exists = imgExists($picget);
													?>		  
							 
							

<h4 class="brief" style="text-shadow:-1px 1px 1px #000;"> <font color='darkblue'>Username : <?php echo ucfirst($row_b['usern_id']) ;?> </font></h4>
<div class="col-sm-12">
<div class="left col-xs-10">
<h2 style="text-shadow:-1px 1px 1px #000;">Full Name: <b><?php echo ucwords($row_b['sname']).'  '.ucwords($row_b['mname']).' '.ucwords($row_b['oname']); ?></b> </h2>
<p><strong>Gender: </strong> <?php echo $row_b['Gender'] ;?> <strong>&nbsp;&nbsp;&nbsp;Marital Status: </strong> <?php echo $row_b['mstatus'] ;?> <strong>&nbsp;&nbsp;&nbsp;Date Of Birth: </strong> <?php echo $row_b['dob'] ;?> </p>

<p><strong>Hobbies: </strong> <?php echo $row_b['hobbies'] ;?> <strong>&nbsp;&nbsp;&nbsp;Moble Number: </strong> <?php echo $row_b['phone'] ;?>  </p>

<p><strong>Email Address: </strong> <?php echo $row_b['email'] ;?><strong>&nbsp;&nbsp;&nbsp;Postal Address: </strong> <?php echo $row_b['paddress'] ;?></p>

<p><strong>Contact Address: </strong> <?php echo $row_b['caddress'] ;?><strong>&nbsp;&nbsp;&nbsp;Home Address: </strong> <?php echo $row_b['town'] ;?></p>
<p><strong>State: </strong> <?php echo $row_b['state'] ;?><strong>&nbsp;&nbsp;&nbsp;Local Government: </strong> <?php echo $row_b['lga'] ;?><strong>&nbsp;&nbsp;&nbsp;Nationality: </strong> <?php echo $row_b['nation'] ;?></p>

<p><strong>Highest Education Qualification: </strong> <?php echo $row_b['heq'] ;?><strong>&nbsp;&nbsp;&nbsp;Course Studed: </strong> <?php echo $row_b['cos'] ;?><strong>&nbsp;&nbsp;&nbsp;Department: </strong> <?php echo getdeptc($row_b['s_dept']) ;?></p>

<p><strong>Bank: </strong> <?php echo $row_b['b_name'] ;?><strong>&nbsp;&nbsp;&nbsp;Account Name: </strong> <?php echo $row_b['b_acct_name'] ;?><strong>&nbsp;&nbsp;&nbsp;Account Number: </strong> <?php echo $row_b['b_acct_num'] ;?><strong>&nbsp;&nbsp;&nbsp;Bank Sort Code: </strong> <?php echo $row_b['b_sort'] ;?></p>

<p><strong>Date Of Employment: </strong> <?php echo $row_b['doe'] ;?> <strong>&nbsp;&nbsp;&nbsp;Mode of Employment: </strong> <?php echo $row_b['e_mode'] ;?> </p>
<p><strong>Registration Status: </strong> <?php if ($row_b['r_status']='2'){
						
						echo 'Verified';}else{echo 'Not Verified';}?> <strong>&nbsp;&nbsp;&nbsp;Staff Access Level: </strong> <?php echo getstatus($row_b['access_level2']) ;?> </p>

</div>
<div class="right col-xs-2 text-center" >
<img src="<?php  if ($exists > 0 ){ print $row_b['image']; }else{ print "./uploads/NO-IMAGE-AVAILABLE.jpg";}
	 ?>" alt="" class="img-circle img-responsive" height="180" width="180" >
</div>
</div>
<div class="col-xs-12 bottom text-center">

</div>
</div>

						
		</div>
			
					<div class="modal-footer">
					<a href="add_Staff.php" class="btn btn-default"><i class="fa fa-remove"></i>&nbsp;Close</a>
                  
                         <!-- <button  name="change" class="btn btn-primary"><i class="fa fa-check icon-large"></i>Yes</button> --!>
                        </div>
					
					</form>
					 </div>
                 
				    </div>
</div><?php //} ?>
<!-- end  Modal -->
   <?php 
 
//}
        ?>
        
        
         <?php include('footer.php'); ?>