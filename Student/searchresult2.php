
<div class="x_panel">
                
             
                <div class="x_content">
	                <form method="post" class="form-horizontal"  action="result_manage.php?view=l_gp" enctype="multipart/form-data">
                    
                      
                      <span class="section">Calculate CGPA Here</span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Please Select the level / Semester for which you want to Calculate CGPA in the list box below, and click Calculate CGPA. 
                  </div>
     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Academic Session</label>
                            <select name="session" id="session"  required="required" class="form-control">
  <option value="">Select Session</option>
<?php  
$resultsec = mysqli_query($condb,"SELECT * FROM session_tb  ORDER BY session_name ASC");
while($rssec = mysqli_fetch_array($resultsec))
{echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	}
?>
</select>
                      </div>
                <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
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
                      
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Semester </label>
                      
                          <select name='semester' id="semester" class="form-control" required>
                            <option value="">Select Semester</option>
                            <option value="First">First</option>
                            <option value="Second">Second</option>
                          <option value="Annual">Annual</option>
                          </select> </div>
                     
                    
             
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <button type="submit" name="Search"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click To Calculate GPA" ><i class="fa fa-file"></i> Calculate CGPA</button>
                        
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
                  