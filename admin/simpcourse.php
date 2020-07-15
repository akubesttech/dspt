
<script type="text/javascript">

</script>
<script type="text/javascript">   
$(document).ready(function() {   
$('#level').change(function(){   
if($('#level').val() === 'Others')   
   {   
   $('#otherl').show(); 
      $('#other2').show();    
   }   
else 
   {   
   $('#otherl').hide(); 
      $('#other2').hide();      
   }   
});   
});   
</script>
<style>img{width: 100%; max-width: 1363px;} </style>
<?php


if(isset($_POST['import'])){
$dept_c = $_POST['dept1'];
$facadd = $_POST['fac1'];
    		//check if input file is empty
    		if(!empty($_FILES['fileName']['name'])){
    			$filename = $_FILES['fileName']['tmp_name'];
    			$fileinfo = pathinfo($_FILES['fileName']['name']);
     //check file extension
    			if(strtolower($fileinfo['extension']) == 'csv'){
    				//check if file contains data
    				if($_FILES['fileName']['size'] > 0){
     $file = fopen($filename, 'r'); $flag = true;
     $resultcheck = mysqli_query($condb,"select * from courses where fac_id ='".safee($condb,$facadd)."' and dept_c = '".safee($condb,$dept_c)."' ")or die(mysqli_error($condb));	if(mysqli_num_rows($resultcheck)>0){ message("Courses already uploaded for ".getdeptc($dept_c), "error");redirect('add_Courses.php?view=impc');}else{
     while(($impData = fgetcsv($file, 1000, ',')) !== FALSE){ 
 if($flag) { $flag = false; continue; }
 $query = mysqli_query($condb,"INSERT INTO courses (dept_c,C_title,C_code,C_unit,semester,C_level,fac_id,c_cat) VALUES ('".safee($condb,$dept_c)."','".$impData[2]."', '".trim($impData[1])."', '".$impData[3]."','".$impData[4]."','".$impData[5]."','".safee($condb,$facadd)."','".$impData[6]."')")or die(mysqli_error($condb)); //$query = mysqli_query($condb,$sql);
     if($query){ message("Data imported successfully.", "success");
		        redirect('add_Courses.php?view=vupload');
    						}else{ message("Cannot import data. Something went wrong.", "error");
		        redirect('add_Courses.php?view=impc'); }  
    					}}redirect('add_Courses.php?view=impc');}
    				else{ message("File contains empty data", "error");
		        redirect('add_Courses.php?view=impc');
    				}}else{ message("Please upload CSV files only", "error");
		        redirect('add_Courses.php?view=impc');}}else{
    			message("File empty", "error");
		        redirect('add_Courses.php?view=impc');}}
     
    	//else{ 	message("Please import a file first", "error");
		        //redirect('add_Courses.php?view=impc');
    //	} 
     
?>
<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="register" method="post" enctype="multipart/form-data" id="register">
<input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
                      
                      <span class="section">Upload Courses</span>
                      <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
           Upload <?php echo $SGdept1; ?> courses  CSV file using this excel Formate below. 
                  </div> <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
<div id="patient_status"><img src="../assets/media/importtempimg.png"  style="box-shadow:0 2px 4px 3px gray; font-size:15px; ;"  alt="Sample Of How the Excel Sheet will Look like"></div></div><br>
  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard"><?php echo $SCategory; ?> </label>
						  	  
                            	  <select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" required="required"  >
                            <option value="">Select <?php echo $SCategory; ?></option>
                            <?php  

$resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//$counter=1;
while($rsblocks = mysqli_fetch_array($resultblocks))
{if($_GET['loadfac'] ==$rsblocks['fac_id'] )
	{echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";
//	$counter=$counter+1;
	}else{echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";
	//$counter=$counter+1;
	}}
?></select>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard"><?php echo $SGdept1; ?></label>
                            	  <select name='dept1' id="dept1" class="form-control" required="required" >
                           <option value=''>Select <?php echo $SGdept1; ?></option>
                          </select>
                      </div>
 
 <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback"><label for="heard">Upload CSV file here: </label>
<input name="fileName" class="input-file uniform_on" id="fileInput" type="file" readonly="readonly" >
</div>
               
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                    
                                     
                                       
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <?php   if (authorize($_SESSION["access3"]["sConfig"]["avc"]["create"])){ ?> 
                          <button type="submit" name="import"  id="import" data-placement="right" class="btn btn-primary col-md-4" title="Click To Import Student Details for Result Processing" ><i class="glyphicon glyphicon-upload"></i> Upload</button><?php } ?>   <?php   //if (authorize($_SESSION["access3"]["sConfig"]["avc"]["view"])){ ?> 
                        <button  name="goback"  id="goback" type='button' onClick="window.location.href='add_Courses.php?view=addc';" class="btn btn-primary " title="Click to go back" ><i class="fa fa-backward icon-large"></i> Go Back </button>
						<button  name="goback"  id="goback" type='button' onClick="window.location.href='add_Courses.php?view=vupload';" class="btn btn-primary " title="Click to view Uploaded Courses" ><i class="fa fa-eye icon-large"></i> View Course Upload </button>
						<?php //} ?> 
                       
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#import').tooltip('show');
	                                            $('#import').tooltip('hide');
	                                            });
	                                            </script>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div></form>
                        </div>
                        
                        	</div>
									
                        
                        
                        
                        
                       </div> 
                 