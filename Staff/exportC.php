
<div class="x_panel">
                
             
                <div class="x_content">
	                <form method="get" class="form-horizontal"  action="exportdata.php" enctype="multipart/form-data">
                    <input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      <input type='hidden' name="userid" value="<?php echo $session_id ; ?>" >
                      <span class="section">Export Student List To Excel Format<?php
                                          if($resi == 1)
{


					echo " 
		
			    <center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res</font></label></center>
			 
			  ";
}
?></span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Select Course Record You Wish To Export in Excel Formate,This will as well serve as Template for Student score entry .  
                  </div>
   
					    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard">Course Code </label>
						  	  
                            	  <select name='course_e' id="course_e"  class="form-control" >
                            <option value="">Select Course</option>
                            <?php  
$query = "SELECT DISTINCT course FROM course_allottb WHERE assigned='".safee($session_id)."' and session='".safee($default_session)."'";
 $result = mysql_query($query); 
 while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
  { 
  echo "<option value='$line[course]'> $line[course] </option>";
  }
?>
                          </select>
                      </div>
                   
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Academic Session</label>
                            <select name="session" id="session"  required="required" class="form-control">
  <option value="">Select Session</option>
<?php  
$resultsec = mysql_query("SELECT * FROM session_tb where action = '1' ORDER BY session_name ASC");
while($rssec = mysql_fetch_array($resultsec))
{
echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	
}
?>
</select>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Semester</label>
                            	  <select name='c_choice' id="c_choice" required="required" class="form-control"  >
                           <option value=''>Select Semester</option>
                          <?php  
$query_sem = "SELECT DISTINCT semester FROM course_allottb WHERE assigned='$session_id' and session='$default_session'";
 $result_sem = mysql_query($query_sem); 
 while ($line2 = mysql_fetch_array($result_sem, MYSQL_ASSOC))
  { 
  echo "<option value='$line2[semester]'> $line2[semester] </option>";
  }
?>
                          </select>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard">Level</label>
						  	  
                            	  <select name='level' id="level"  class="form-control" >
                            <option value="">Select Level</option>
                            <?php  
$query = "SELECT DISTINCT level FROM course_allottb WHERE assigned='$session_id' and session='$default_session'";
 $result = mysql_query($query); 
 while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
  { 
  echo "<option value='$line[level]'>".getlevel($line['level'])." </option>";
  }
?>
                            
                          
                          </select>
                      </div>
                     
                    
             
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <button type="submit" name="addStaff"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click To Export Student Detail for Result Processing" ><i class="fa fa-upload"></i> Export Data</button>
                        
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
                  