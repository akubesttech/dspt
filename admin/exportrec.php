<script type="text/javascript">
/*
var xmlhttp

function loadDept(str)
{var a=document.getElementById(str)[document.getElementById(str).selectedIndex].innerHTML;
if(a=='Select Faculty'){ return;}
else{
var e=document.getElementById('imgHolder2');
e.style.visibility='visible';
xmlhttp=GetXmlHttpObject();

setTimeout(function(){if (xmlhttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  }

var d=document.getElementById(str)[document.getElementById(str).selectedIndex].innerHTML;
var url="loadDept.php";
url=url+"?loadfac="+d;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}

function stateChanged()
{
if (xmlhttp.readyState==4)
  {
  document.getElementById("dept1").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';
  }
}

function loadCourse(str)
{var a=document.getElementById(str)[document.getElementById(str).selectedIndex].innerHTML;
if(a=='Select Department'){ return;}
else{
var e=document.getElementById('imgHolder2');
e.style.visibility='visible';
xmlhttp=GetXmlHttpObject();

setTimeout(function(){if (xmlhttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  }

var d=document.getElementById(str)[document.getElementById(str).selectedIndex].innerHTML;
var url="loadCourse.php";
url=url+"?loadcos="+d;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged2;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}

function stateChanged2()
{
if (xmlhttp.readyState==4)
  {
  document.getElementById("cos_load").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';
  }
}

function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}
*/


</script>
<?php $status = FALSE;
if ( authorize($_SESSION["access3"]["rMan"]["ecl"]["create"]) || 
authorize($_SESSION["access3"]["rMan"]["ecl"]["edit"]) || 
authorize($_SESSION["access3"]["rMan"]["ecl"]["view"]) || 
authorize($_SESSION["access3"]["rMan"]["ecl"]["delete"]) ) {
 $status = TRUE;
}
if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}
  ?>
<div class="x_panel">
                
             
                <div class="x_content">
                <form method="get" class="form-horizontal"  action="exportdata.php" enctype="multipart/form-data">
<!-- <form name='frmResult' method="post" onsubmit='return checkUpload(this);' class="form-horizontal"  action="Result_am.php?view=v_re" enctype="multipart/form-data"> --!>
                    <input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      <input type='hidden' name="userid" value="<?php echo $session_id ; ?>" >
                      <span class="section">Export Student List To Excel Format<?php
                                        //  if($resi == 1)
//{

echo $_COOKIE['showerror3'];
//}
?></span>

<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Select Course Record You Wish To Export in Excel Formate,This will as well serve as Template for Student score entry . 
                  </div>
                  
                  	  <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard"><?php echo $SCategory; ?> </label>
						  	  
                            	  <select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" >
                            <option value="">Select <?php echo $SCategory; ?></option>
                            <?php  
$resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//$counter=1;
while($rsblocks = mysqli_fetch_array($resultblocks))
{if($_GET['loadfac'] ==$rsblocks['fac_id'] )
	{echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";}
	else{echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";}}
?>
                            
                          
                          </select>
                      </div>
                     
                      
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard"><?php echo $SGdept1; ?></label>
                            	  <select name='dept1' id="dept1" onchange='loadCourse(this.name);return false;' class="form-control"  >
                           <option value=''>Select <?php echo $SGdept1; ?></option>
                          </select>
                      </div>
                      
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Course Code</label>
                            	  <select name='cos' id="cosload" class="form-control"  >
                           <option value=''>Select Courses</option>
                          </select>
                      </div>
                      
   
					   
                   
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Academic Session</label>
                            <select name="session" id="session"  required="required" class="form-control">
  <option value="">Select Session</option>
<?php  $resultsec = mysqli_query($condb,"SELECT * FROM session_tb  ORDER BY session_name ASC");
while($rssec = mysqli_fetch_array($resultsec))
{ echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	}
?>
</select>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Semester</label>
                            	  	 <select class="form-control" name="semester" id="semester"  required="required">
<option>Select Semester</option>
<option value="First">First</option>
<option value="Second">Second</option></select>
                      </div>
                      
                      	   <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Level</label>
                            	  	 <select class="form-control" name="level" id="level"  required="required">
<option>Select Level</option>
<?php 
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID' ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2))
{
echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	
}
?>
 </select>
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
                          <?php   if (authorize($_SESSION["access3"]["rMan"]["ecl"]["view"])){ ?> 
                         <button type="submit" name="export"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click To Export Student Detail for Result Processing" ><i class="fa fa-upload"></i> Export Data</button>
<!--<a href="#myModal221" data-placement="right" data-toggle="modal" class="btn btn-primary" title="Click to Generate Student Attendance Sheet" id="s_userid" ><i class="fa fa-th"></i> Generate Exam Attendance Sheet</a>--!>
<a data-placement="top" title="Click to Generate Student Attendance Sheet" href="javascript:void(0);" onClick="window.location.href='Result_am.php?view=asheet';" id="save2"  class="btn btn-primary" name="divButton2"  ><i class="fa fa-th icon-large"> Generate Exam Attendance Sheet</i></a>
                        <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');$('#save2').tooltip('show');
	                                            $('#save').tooltip('hide');$('#save2').tooltip('hide');
	                                            });
	                                            </script> <?php } ?>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
	                                            
                        </div>
                        
                      </div>
                    </form>
                  </div>
                  