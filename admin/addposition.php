<?php

if($class_ID > 0){}else{
message("ERROR:  No Programme Select,Please Select a Programme and continue.", "error");
		       redirect('lecture_time.php?view=opro');}
if(isset($_POST['setlectime'])){
$posit = $_POST['posit'];
$categ = trim($_POST['categ']);
$descd = $_POST['desc'];
$minGP = $_POST['gp'];
$mvote = $_POST['mvote'];
//$date  = date('l jS F Y').date('h:i:s a');

$query_ltime2 = mysqli_query($condb,"select * from post_tb where position = '".safee($condb,$posit)."' and ecate1 = '".safee($condb,$categ)."'")or die(mysqli_error($condb));
$row_ltime = mysqli_fetch_array($query_ltime2); $count = mysqli_num_rows($query_ltime2); 
if($count>0){	
//ob_start();
	message("Please This Position Already Exist In our Database", "error");
	redirect('election.php?view=add_post');
		}elseif($mvote < 1){
		message("you cannot select a Negative value ", "error");
	redirect('election.php?view=edit_posit');
}else{
$dbsettime = mysqli_query($condb,"INSERT INTO post_tb (position ,ecate1 ,description ,minGP,mvote) VALUES('".safee($condb,$posit)."','".safee($condb,$categ)."', '".safee($condb,$descd)."','".safee($condb,$minGP)."', '".safee($condb,$mvote)."')"); //or die(mysqli_error($condb));
	//$Querysettime = mysqli_query($condb,$dbsettime) or die(mysqli_error($condb));
		message(" <b> $posit </b> was successfully Added", "success"); 
		       redirect('election.php?view=viewpost');
}
}
?>

<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="user" method="post" enctype="multipart/form-data" id="user">
<input type="hidden" name="insidtime" value="<?php echo $_SESSION['insidtime'];?> " />
                     
	   
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Position *</label>
                            	  <input type="text" class="form-control " name='posit' id="posit" required="required" >
                      </div>
                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Description</label>
                            	  <input type="text" class="form-control " name='desc' id="desc"  >
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback"  >
						  	  <label for="heard"   id="enable3" >Min CGPA *</label>
                        <select name='gp' id="gp" class="form-control" required>
                            <option value="">Select </option>
                            <?php  
$resultproe = mysqli_query($condb,"SELECT DISTINCT gp FROM grade_tb WHERE prog = '".safee($condb,$class_ID)."' and grade_group = '01'  ORDER BY gp ASC");
while($rsproe = mysqli_fetch_array($resultproe)){echo "<option value='$rsproe[gp]'>$rsproe[gp]</option>";}?>
                            
                             </select>
                      </div>
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Maximum vote *</label>
                            	  <input type="number" class="form-control " name='mvote' id="mvote" required="required" >
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Election Category </label>
                      
                          <select name='categ' id="categ" class="form-control" required>
                            <option value="">Select Category</option>
                            <option value="3">General</option>
                            <option value="2"><?php echo $SCategory; ?></option>
                            <option value="1">Department</option>
                          
                          </select> </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  
                           </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <?php   if (authorize($_SESSION["access3"]["emanag"]["apost"]["create"])){ ?>
                       <button  name="setlectime"  id="setlectime"  class="btn btn-primary col-md-4" title="Click Here to Save Position" ><i class="fa fa-save"></i> Save </button><?php } ?><?php   if (authorize($_SESSION["access3"]["emanag"]["apost"]["view"])){ ?>
                      <a href='javascript:void(0);' onclick="window.open('election.php?view=viewpost','_self')" class="btn btn-primary"  id="delete02" data-placement="right" title="Click to View Details" ><i class="fa fa-file icon-large"></i> View Details</a><?php } ?>
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#setlectime').tooltip('show');
	                                            $('#setlectime').tooltip('hide');
	                                            });
	                                            </script>
	                                              <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 
           