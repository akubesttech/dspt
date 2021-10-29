






<div class="x_panel">
                
             
                <div class="x_content">
	                <form name='frmResult' method="post" onsubmit='return checkUpload(this);' class="form-horizontal"  action="" enctype="multipart/form-data">
                    <input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      
                      <span class="section">Final Result Process<?php
//if($resi == 1){ echo "<center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res</font></label></center>";}
?></span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
Result Processing Transaction Report.
                  </div>
   <div id="content">
 
 	<?php 
	echo "<div id='c_header' style='margin-bottom:14px;'> SUCCESS MESSAGE:</div>";
	echo "<div style='font-size:25px;color:green;'>";
	$success_msg=$_GET['s2_msg'];
	//$success_msg=$_GET['success_msg'];
if($success_msg == '107'){$coursecode=$_GET['co'];}else{ $coursecode= "";}
	switch($success_msg)
	{
		case 104: echo "Post UTME Result Successful Processed.";
				break;
		//case 107: echo "Results for: ". $_SESSION['term']." Term, ". $count1['session']." Session Processed successfully.";
		case 107: echo "Result For $coursecode was Processed successfully.";
				break;
					case 108: echo "Termly Subject Results  was Processed successfully.";
				break;
		default: echo "Unable to determine the appropriate success message";
				break;
				
	}

	echo "</div>";
	?>
 
</div>
					  
                     <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                        	<?php if($coursecode = Null){ ?>
							<button  title="Click Here to Go Back" id="save" name="B2" class="btn btn-primary col-md-4" onClick="window.location.href='new_apply.php';" type="reset"><i class="fa fa-reply"></i>Go Back </button>
					<?php	}else{ ?>
							<button  title="Click Here to Go Back" id="save" name="B2" class="btn btn-primary col-md-4" onClick="window.location.href='Result_am.php';" type="reset"><i class="fa fa-reply"></i>Go Back </button>
                      	<?php	} ?>
                        
                        <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                      </div>
                    </form>
                  </div>
                  