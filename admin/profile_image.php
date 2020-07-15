<?php
$sql2="SELECT * FROM admin where admin_id = '$session_id' ";
  $qsql2= mysqli_query($condb,$sql2);
$rs2 = mysqli_fetch_array($qsql2);

$staffdb = mysqli_query($condb,"SELECT * FROM staff_details  where usern_id = '$admin_username'");
$rs23 = mysqli_fetch_array($staffdb);


if(isset($_POST['imageupload'])){
 $name4     = $_FILES['image_name']['name'];
    $tmpName  = $_FILES['image_name']['tmp_name'];
    
            $ext      = strtolower(pathinfo($name4, PATHINFO_EXTENSION));
           $maxsize    = 300000;
if(!in_array($ext, array('jpg','jpeg','png','gif')) ){
message("Invalid file type. Only  JPG, GIF and PNG types are accepted", "error");
				   redirect('user_Private.php?view=UIm');
 
			}elseif($_FILES["image_name"]["size"] > $maxsize)  {

		message("File size should be less than 300kb.", "error");
				   redirect('user_Private.php?view=UIm');	
}else{
if ($_FILES['image_name']['size'] !== 0){

	                                while($r < 8){
								   $dig .=rand(3,9);
                                    $r+=1;
                                          }
                                         $newname=$dig . ".gif";
                                          $uploadfile = $newname;
;
$image = addslashes(file_get_contents($_FILES['image_name']['tmp_name']));
                                $image_name = addslashes($_FILES['image_name']['name']);
                                $image_size = getimagesize($_FILES['image_name']['tmp_name']);
                                move_uploaded_file($_FILES["image_name"]["tmp_name"], "uploads/$uploadfile");
                                $adminthumbnails = "uploads/" .$newname;
                                
mysqli_query($condb,"update admin set adminthumbnails = '".safee($condb,$adminthumbnails)."' where admin_id  = '$session_id' ");
if($session_id > 0){
mysqli_query($condb,"update staff_details set image = '".safee($condb,$adminthumbnails)."' where usern_id  = '$admin_username' ");
}								
unset($dig);
$r=0;
if($session_id > 0){
	unlink("$rs2[adminthumbnails]");
	}else{
unlink("$rs23[image]");
}
	
} 
 ob_start();
//$res="<font color='green'><strong>Picture Update Was sucessfully Thank You!</strong></font><br>";
				//$resi=1;
message("Picture Update Was sucessfully Thank You!", "success");
				   redirect('user_Private.php?view=UIm');
}
}
?>

<div class="x_panel">
                
             
                <div class="x_content">
	<?php
$query_change = mysqli_query($condb,"select * from admin where admin_id = '$session_id'")or die(mysqli_error($condb));
$row_change = mysqli_fetch_array($query_change);
								?>
    <form action="" role="form" method="post" enctype="multipart/form-data" class="ngnix_transfer" id="updatePictureForm">
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
<input type="hidden" name="oldme" value="<?php echo $row_change['password'];?>" />
                      
                      <span class="section">Change Profile Picture
 <?php
                                          if($resi == 1)
{


					echo " 
		
			    <center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res</font></label></center>
			 
			  ";
}
?> </span>


               	<div class="modal-body">
				<!--	<form method="post" class="form-horizontal" action="admin_pic.php" enctype="multipart/form-data"> --!>						
							
								
								<div class="form-group">
								<label class="heard" for="inputPassword">Browse Your Computer</label>
									<div class="controls">
<div class="fileinput fileinput-new" data-provides="fileinput">
<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
<img src="<?php  
				  if ($row_change['adminthumbnails']==NULL ){
	print "uploads/NO-IMAGE-AVAILABLE.jpg";
	}else{
	print $row_change['adminthumbnails'];}?>" alt=""> </div>
<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>

<div>
<span class="btn default btn-file">
<span class="fileinput-new btn bg-green btn-sm"><i class="fa fa-globe"></i> Select image </span>
<span class="fileinput-exists btn bg-red"> Change </span>
<input name="image_name" type="file"> </span>
<a href="javascript:;" class="btn default fileinput-exists btn bg-red" data-dismiss="fileinput"> Remove </a>
<input value="yhUr56e78tfotyfcyd" name="token" type="hidden">
</div>

</div>
</div></div>
					
		</div>
         
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <button type="submit" id="imageupload" class="btn btn-success col-md-4" name="imageupload" title="Click Here to Upload Profile Photo"><i class="fa fa-save"></i> Upload Photo </button>
                       
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#imageupload').tooltip('show');
	                                            $('#imageupload').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 