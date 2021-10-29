<?php if(($student_level < "200") OR ($student_level > "300")){ $display = "display:none;";}else{ $display = ""; } ?>
<div class="x_panel">
                
             
                <div class="x_content">
	                <form method="get" class="form-horizontal"  action="course_manage.php?view=l_c" enctype="multipart/form-data">
                    
                      
                      <span class="section">Select Course Information </span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Please Select the level for which you want to register courses in the list box below, and click continue. 
                  </div>
   
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display: none;" >
					    <label for="heard"><?php echo $SCategory; ?> </label>
						  	  <select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" disabled >
                            <option value="<?php echo $student_facut; ?>"><?php echo getfacultyc($student_facut);//$SCategory; ?></option>
<?php  $resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
while($rsblocks = mysqli_fetch_array($resultblocks)){  if($_GET['loadfac'] ==$rsblocks['fac_id'] ){
echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";
//	$counter=$counter+1;
}else{echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";
//$counter=$counter+1;
}}?></select></div>
                     
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display: none;">
<label for="heard"><?php echo $SGdept1; ?></label>
                            	  <select name='dept1_find' id="dept1" required="required" class="form-control" disabled >
                           <option value='<?php echo $student_dept;?>'><?php echo getdeptc($student_dept); //$SGdept1; ?></option>
                          </select>
                      </div>
                    
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Level </label>
                      
                          <select name='level' id="level" class="form-control" required>
                            <option value="">Select level</option>
                                             <?php 
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db WHERE prog = '".safee($condb,$student_prog)."'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2))
{
echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	
}
?>
                           </select> </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Semester </label>
                      
                          <select name='semester' id="semester" class="form-control" required>
                            <option value="">Select Semester</option>
                            <option value="First">First</option>
                            <option value="Second">Second</option>
                            <option value="both">All</option>
                          
                          </select> </div>
                     
                    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="<?php echo $display; ?>">
<label for="chkPenalty"> </label><br><br><label class="chkPenalty">
<input type="checkbox" id="chkroc"   name="chkroc" value="1" /> Register Outstanding Courses</label></div>
  
             
                      <div  class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <div class="col-md-6 col-md-offset-3">
                         <button type="submit" name="Search"  id="save" data-placement="right" class="btn btn-primary" title="Click To Continue Course Registration" ><i class="fa fa-sign-in"></i> Continue</button>
                        
                        <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='../admin/uploads/tabLoad.gif'></div>
                        </div>
                        
                      </div>
                    </form>
                  </div>
                  