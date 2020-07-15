
<?php
if(isset($_POST['addpro'])){
$pname = ucfirst($_POST['pname']);
$pdesc = ucfirst($_POST['pdesc']);
$pduration = $_POST['dura'];
$otherl = $_POST['othern'];
$other_fraction = ltrim(($otherl - floor($otherl)),"0.");
$other_round = round($_POST['othern']);
$status = $_POST['status'];
$certinview = $_POST['certv'];
$amax = $_POST['assmax']; $exmax = $_POST['exammax'];
if($other_fraction > 0){$neworder1= $otherl; }else{ $neworder1= $other_round;  }

$query_f = mysqli_query($condb,"select * from prog_tb where Pro_name = '".safee($condb,$pname)."'")or die(mysqli_error($condb));
$query_dura = mysqli_query($condb,"select * from prog_tb where pro_dura = '".safee($condb,$neworder1)."'")or die(mysqli_error($condb));
$row_fee = mysqli_num_rows($query_f); $count_dura = mysqli_num_rows($query_dura);
if ($row_fee>0){
message("The Program Entered  Already Exist Try Again".$neworder1, "error");
			redirect('add_Program.php?id='.$get_RegNo);
				}else{
if($pduration=="Others"){ 
if($count_dura > 0){ 
message("The Program Duration  Already Exist Try Again", "error");
			redirect('add_Program.php?id='.$get_RegNo); 
}else{
mysqli_query($condb,"insert into prog_tb (Pro_name,pro_desc,pro_dura,assmax,exammax,certinview,status) values('".safee($condb,$pname)."','".safee($condb,$pdesc)."','".safee($condb,$neworder1)."','".safee($condb,$amax)."','".safee($condb,$exmax)."','".safee($condb,$certinview)."','".safee($condb,$status)."')")or die(mysqli_error($condb));

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'".safee($condb,$admin_username)."','Fee Titled $pname was Add')")or die(mysqli_error($condb)); 
 ob_start();
 message("New Program [$pname] was Successfully Added", "success");
			redirect('add_Program.php');}
}else{
mysqli_query($condb,"insert into prog_tb (Pro_name,pro_desc,pro_dura,assmax,exammax,certinview,status) values('".safee($condb,$pname)."','".safee($condb,$pdesc)."','".safee($condb,$pduration)."','".safee($condb,$amax)."','".safee($condb,$exmax)."','".safee($condb,$certinview)."','".safee($condb,$status)."')")or die(mysqli_error($condb));

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'".safee($condb,$admin_username)."','Ptogram Titled $pname was Add')")or die(mysqli_error($condb)); 
// ob_start();
 message("New Program [$pname] was Successfully Added", "success");
			redirect('add_Program.php');
}
}}
?>

<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      
                      <span class="section">Add New Program </span>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">Program Name </label>
                      
                          <input type="text" class="form-control " name='pname' id="pname"  value=""  required="required"> </div>
                          
                          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">Program Description </label>
                      
                          <input type="text" class="form-control " name='pdesc' id="pdesc"  value=""  required="required"> </div>
                          
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Duration</label>
						  	   <select id="dura" onchange = "ShowHideDiv()" name="dura"  class="form-control" required="required" >
                            <option value="">Select Duration</option><?php //round($rspro['pro_dura'])."".getys(round($rspro['pro_dura'])) 
$resultpro = mysqli_query($condb,"SELECT DISTINCT pro_dura FROM prog_tb  ORDER BY pro_dura  ASC");
while($rspro = mysqli_fetch_array($resultpro)){echo "<option value='$rspro[pro_dura]'>".getys($rspro['pro_dura'])." ".getfra($rspro['pro_dura'])."</option>";	} ?>
                            <option value="Others">Add Duration</option>
                          
                          </select>
                      </div>
                    
                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" style="display: none;" id="other1"   >
						  	  <label for="heard"  >Add Duration</label>
<input type="text" class="form-control"    name="othern" onchange="validateFloatKeyPress(this);" placeholder="example:one year and eleven months = 1.11" autocomplete="off" maxlength="4" >
                      </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Program Status </label>
                            	  <select name='status' id="status" class="form-control" >
                            <option value="">Select Status</option>
                             <option value="1">Enabled</option>
                              <option value="0">Disabled</option>
                            
                             </select>
                      </div>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">Certificate in View </label>
                      
                          <input type="text" class="form-control " name='certv' id="certv"  value=""  required="required"> </div>
               <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Max Assessment Score </label><input type="text" class="form-control " name='assmax' id="assmax"   placeholder="eg.Assessment (30%)" onkeypress="return isNumber(event);" required="required"> </div>
                          
                          <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Max Exam Score  </label><input type="text" class="form-control " name='exammax' id="exammax"   placeholder="eg.Exam (70%)" onkeypress="return isNumber(event);" required="required"> </div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                      
                      
                      
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         
                        <button  name="addpro"  id="addpro"  class="btn btn-primary col-md-4" title="Click Here to Save Program Details" ><i class="fa fa-sign-in"></i> Add Program</button>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addpro').tooltip('show');
	                                            $('#addpro').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
      