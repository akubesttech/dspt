
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
  <?php $get_RegNo=  isset($_GET['id']) ? $_GET['id'] : ''; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Staff Record Management
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>

					<?php 
if(isset($_POST['delete_staff'])){
if(empty($class_ID)){
				message("No Programme Record Selected Yet,please select to continue", "error");
				redirect("add_Staff.php?view=Employeelist");
			}elseif(empty($_POST['selector'])){
				message("Select at least One Student Record to proceed !", "error");
		       redirect("add_Staff.php?view=Employeelist");
				}else{ $id=$_POST['selector']; $N = count($id);
for($i=0; $i < $N; $i++)
{$row = mysqli_fetch_array(mysqli_query($condb,"select * from staff_details where staff_id ='".$id[$i]."' "));
	extract($row); $userimage = imgExists($image); $staffsign = imgExists($sign_img); $usern = $usern_id;
	mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'".safee($condb,$admin_username)."','Staff Details of $sname $oname with staff username ".$usern_id."  was Deleted by ". $admin_username.". ')")or die(mysqli_error($condb));
	$result = mysqli_query($condb,"DELETE FROM staff_details where staff_id='$id[$i]'");
	if(!empty($userimage)){unlink("$image");}if(!empty($staffsign)){unlink("$sign_img");}
    $result = mysqli_query($condb,"DELETE FROM admin where admin_id='$usern[$i]'");
}
message("Employee Record Successfuly Deleted", "error");
redirect("add_Staff.php?view=Employeelist");
}}

                        // Student record upload in CSV
   if(isset($_POST['importstaff'])){
if(empty($class_ID)){
				message("No Programme Record Selected Yet,please select to continue", "error");
      redirect("add_Staff.php?view=Employeelist");}else{
    		//check if input file is empty
    		if(!empty($_FILES['fileNames']['name'])){
    			$filename = $_FILES['fileNames']['tmp_name'];
    			$fileinfo = pathinfo($_FILES['fileNames']['name']);
     //check file extension
    			if(strtolower($fileinfo['extension']) == 'csv'){
    				//check if file contains data
    				if($_FILES['fileNames']['size'] > 0){
     $file = fopen($filename, 'r'); $flag = true;  $k = 0; $s=10; $appnum = 0;
while(($impData = fgetcsv($file, 1000, ',')) !== FALSE){ 
 if($flag) { $flag = false; continue; } 
  $k++; if ( $k > 1 ) {
    //$fn = strtoupper(substr($impData[1],0,1)); $sn = strtoupper(substr($impData[2],0,1));
    if(!empty($impData[0])) {
 $empid = trim($impData[0]); $email = trim($impData[6]); 
 //$appnum = $fn.$sn.$studentRegno;
  //$state = trim($impData[5]); $yoe = trim($impData[8]); $yog = $yoe + $p_duration;
 $Qyrec = mysqli_query($condb,"select * from staff_details where usern_id = '".safee($condb,$empid)."' OR email = '".safee($condb,$email)."' ")or die(mysqli_error($condb));
 if(mysqli_num_rows($Qyrec)>0){
    		mysqli_query($condb,"update staff_details  set verify_Data='TRUE',reg_status = '1',
            sname='".safee($condb,$impData[1])."',mname ='".safee($condb,$impData[2])."', oname = '".safee($condb,$impData[3])."',Gender = '".safee($condb,$impData[4])."',phone = '".safee($condb,$impData[5])."',email ='".safee($condb,$impData[6])."',r_status = '2' where usern_id = '".safee($condb,$empid)."' ")or die(mysqli_error($condb));
			}else{
   $query = mysqli_query($condb,"INSERT INTO staff_details (usern_id,sname,mname,oname,Gender,phone,email,r_status) 
   VALUES ('".safee($condb,$empid)."','".safee($condb,$impData[1])."','".$impData[2]."', '".trim($impData[3])."', '".$impData[4]."','".safee($condb,$impData[5])."','".safee($condb,$impData[6])."','2')")or die(mysqli_error($condb)); //$query = mysqli_query($condb,$sql);
     if($query){ message("Data imported successfully.", "success");
		        redirect("add_Staff.php?view=Employeelist");
    						}else{ message("Cannot import data. Something went wrong.", "error");
		        redirect("add_Staff.php?view=Employeelist"); }  }
                      }  }}}else{ message("File contains empty data", "error");
		    redirect("add_Staff.php?view=Employeelist"); }
     }else{ message("Please upload CSV files only", "error");
		           redirect("add_Staff.php?view=Employeelist");}
  }else{ message("File empty", "error");
		           redirect("add_Staff.php?view=Employeelist");}
} } 
				?>
				
                


             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  
                    <h2><?php  if($_GET['view'] == "addStaff"){ echo "Add Employee Information" ;}if($_GET['view'] == "editStaff"){
echo "Edit Employee Information";}if($_GET['view'] == "Employeelist"){echo "List Of Employees";}
  ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 
                    
                     <?php 
						$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'addStaff' :
		            $content    = 'addStaff.php';
					break;
					case 'editStaff' :
		            $content    = 'editStaff.php';
					break;
                    case 'Employeelist' :
		            $content    = 'Staff_records.php';
					break;
		            default :
		            $content    = 'Staff_records.php';
                            }
                     require_once $content;
					?>

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
            windows.location = "add_Staff.php?view=Employeelist";
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
                          
                          <a href="#" onclick="window.open('add_Staff.php?view=Employeelist','_self')" class="close"><span aria-hidden="true"></i>x</span> </a>
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
<p><strong>State: </strong> <?php echo $row_b['state'] ;?><strong>&nbsp;&nbsp;&nbsp;Local Government : </strong> <?php echo $row_b['lga'] ;?><strong>&nbsp;&nbsp;&nbsp;Nationality: </strong> <?php echo $row_b['nation'] ;?></p>

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
					<a href="#" onclick="window.open('add_Staff.php?view=Employeelist','_self')" class="btn btn-default"><i class="fa fa-remove"></i>&nbsp;Close</a>
                  
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