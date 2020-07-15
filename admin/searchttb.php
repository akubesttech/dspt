<?php 
//$_SESSION['sess']= $_POST['session'];
//$_SESSION['lev']= $_POST['level'];
//$_SESSION['seme']= $_POST['semester'];
?>
<div class="x_panel">
                
             
                <div class="x_content">
	                <form method="get" class="form-horizontal"  action="vtime_man.php?view=ltime" enctype="multipart/form-data">
                    
                      
                      <span class="section">Search Lecture Time Table<?php
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
          Please Select the appropriate information to view lecture Time table. 
                  </div>
                  
                  <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback" >
<label for="heard"><?php echo $SCategory; ?> </label>
<select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" required="required"  >
                            <option value="">Select <?php echo $SCategory; ?></option> <?php  
$resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
while($rsblocks = mysqli_fetch_array($resultblocks)){if($_GET['loadfac'] ==$rsblocks['fac_id'] ){
	echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";}else{
	echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";}}?></select></div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback"><label for="heard"><?php echo $SGdept1; ?></label>
 <select name='dept1' id="dept1" class="form-control" required="required" ><option value=''>Select <?php echo $SGdept1; ?></option></select></div>

<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"><label for="heard">Academic Session</label>
                            <select name="session" id="session"  required="required" class="form-control">
  <option value="">Select Session</option><?php  
$resultsec = mysqli_query($condb,"SELECT * FROM session_tb  ORDER BY session_name ASC");
while($rssec = mysqli_fetch_array($resultsec)){echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	}?>
</select></div>

                <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Level </label>
                      
                          <select name='level' id="level" class="form-control" required>
                            <option value="">Select level</option>
                              <?php 
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db WHERE prog = '".safee($condb,$class_ID)."'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2)){echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	}
?>
                           </select> </div>
                      
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Semester </label>
                      
                          <select name='semester' id="semester" class="form-control" required>
                            <option value="">Select Semester</option>
                            <option value="First">First</option>
                            <option value="Second">Second</option>
                          
                          </select> </div>
                     
                    
             
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <button type="submit" name="Search"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click To View Lecture Time table" ><i class="fa fa-clock"></i> View time table </button>
                        
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
                  