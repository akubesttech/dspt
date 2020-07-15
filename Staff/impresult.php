<script language="javascript" type="text/javascript">
function checkUpload()
{
	var a=document.frmResult.fileName.value;
	
	//var validExts = new Array(".xlsx", ".xls");
	var validExts = new Array(".xls");
	//var fileExt = sender.value;
    fileExt = a.substring(a.lastIndexOf('.'));
	if(a.length<=0){ alert("You have not selected a valid file for upload. Use the browse button to browse for a valid file and then click 'Import Result'");
		return false;}
		else if(validExts.indexOf(fileExt) < 0){
	
      alert("Invalid file selected, valid files are of " +
               validExts.toString() + " types.");
               return false;
	}
	else{ return true;
	}
}	


</script>
<div class="x_panel">
                
             
                <div class="x_content">
<form name='frmResult' method="post" onsubmit='return checkUpload(this);' class="form-horizontal"  action="Result_m.php?view=v_re" enctype="multipart/form-data">
                    <input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      <input type='hidden' name="userid" value="<?php echo $session_id ; ?>" >
                      <span class="section">Import Student Result<?php
?></span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Note: That you will use The downloaded Excel template for entry of student scores and The Excel file will be in .xls and not .csv Formate. 
                  </div>
   
					    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard">Course Code </label>
						  	  
                            	  <select name='course_e' id="course_e"  class="form-control" >
                            <option value="">Select Course</option>
                            <?php  
$query = "SELECT DISTINCT course FROM course_allottb WHERE assigned='".safee($condb,$session_id)."' and session='".safee($condb,$default_session)."'";
 $result = mysqli_query($condb,$query); 
 while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC))
  { 
  echo "<option value='$line[course]'> $line[course] </option>";
  }
?>
                          </select>
                      </div>
                   
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Academic Session</label>
                            <select name="session" id="session"  required="required" class="form-control">
  <option value="">Select Session</option>
<?php  
$resultsec = mysqli_query($condb,"SELECT * FROM session_tb where action = '1' ORDER BY session_name ASC");
while($rssec = mysqli_fetch_array($resultsec))
{
echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	
}
?>
</select>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Semester</label>
                            	  <select name='semester' id="semester" required="required" class="form-control"  >
                           <option value=''>Select Semester</option>
                          <?php  
$query_sem = "SELECT DISTINCT semester FROM course_allottb WHERE assigned='".$session_id."' and session='".$default_session."'";
 $result_sem = mysqli_query($condb,$query_sem); 
 while ($line2 = mysqli_fetch_array($result_sem, MYSQLI_ASSOC))
  { 
  echo "<option value='$line2[semester]'> $line2[semester] </option>";
  }
?>
                          </select>
                      </div>
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard">Level</label>
						  	  
                            	  <select name="level" id="level"  class="form-control" >
                            <option value="">Select Level</option>
                            <?php  
$query = "SELECT DISTINCT level FROM course_allottb WHERE assigned='".safee($condb,$session_id)."' and session='".safee($condb,$default_session)."'";
 $result = mysqli_query($condb,$query); 
 while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC))
  { 
  echo "<option value='$line[level]'> ".getlevel($line['level'])." </option>";
  }
?>
                            
                          
                          </select>
                      </div>
                     
                     <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Select Excel File To Upload </label>
                            
                          <input name="fileName" class="input-file uniform_on" id="fileInput" type="file" readonly="readonly" >

                      </div>
             
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <button type="submit" name="addStaff"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click To Export Student Detail for Result Processing" ><i class="fa fa-download"></i> Import Result</button>
                        
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
                  