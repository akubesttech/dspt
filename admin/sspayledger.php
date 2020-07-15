
<?php
if(isset($_POST['viewpedger'])){
$slevel = $_POST['level'];
$paydate = $_POST['pdate'];
$sregno = $_POST['regno'];
$salot_session = $_POST['session'];
$sql_alldept="SELECT * FROM payment_tb WHERE stud_reg ='".safee($condb,$sregno)."'";
$result_alldept = mysqli_query($condb,$sql_alldept);
$num_alldept = mysqli_num_rows($result_alldept);
//	$_SESSION['vsession']=$salot_session;

if($num_alldept < 1){
	message("No Payment information found for ".($sregno)." , Please Try Again", "error");
		        redirect('formSales.php?view=sledger'); 
      
}else{
	//$_SESSION['vsession']=$salot_session;

echo "<script>window.location.assign('formSales.php?view=ledger&sreg=".($sregno)."&xsec=".($salot_session)."&xdop=".$paydate."&xlev=".$slevel."');</script>";}

}
?>

<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="user" method="post" enctype="multipart/form-data" id="user">
<input type="hidden" name="insidtime" value="<?php echo $_SESSION['insidtime'];?> " />
                      
                      <span class="section">Search Record </span>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
						  	  <label for="heard"   id="other2" >Matric/Reg Number </label>
                            	  <input type="text" class="form-control "    name='regno' id="regno" required >
                      </div>

   
  <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Academic Session </label>
							   <select class="form-control"   name="session" id="session"  >
  <option value="">Select Session</option>
<?php  $resultsec = mysqli_query($condb,"SELECT * FROM session_tb  ORDER BY session_name ASC");
while($rssec = mysqli_fetch_array($resultsec)){ echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	}
?></select></div>
       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Level </label>
                            	  <select name='level' id="status" class="form-control" >
                            <option value="">Select Level</option>
                      <?php $resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2)){ echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	}
?></select></div>
 <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Payment Date</label>
<input  type="text" name="pdate" size="29"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed1"   readonly="readonly" style="height:32px;"></div>
                    
                      
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
                           <?php   if (authorize($_SESSION["access3"]["fIn"]["forms"]["view"])){ ?> 
                        <button  name="viewpedger"  id="viewpedger"  class="btn btn-primary col-md-4" title="Click Here to Load Student Ledger " ><i class="fa fa-search"></i> GO  </button> <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#viewPay').tooltip('show');
	                                            $('#viewPay').tooltip('hide');
	                                            });
	                                            </script> <?php } ?>
	                                              <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                        	
									
                        </form>
                        
                        
                       </div> </div>
                 
                  