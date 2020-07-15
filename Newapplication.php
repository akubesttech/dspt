<?php
//session_start();
//ini_set('display_errors', 1);
//if($_SESSION['insid']==$_POST['insid'])
//{
unset($_SESSION['temppin']);
unset($_SESSION['tempserial']);
if(isset($_POST['Continue'])){
 $Pin = $_POST["pin"];
$serial = $_POST["serial"];
	
	//$sql_pin="SELECT * FROM pin WHERE pinnumber='$Pin' AND serial='$serial' AND status = 'NOTUSED'";
	$sql_pin="SELECT * FROM pin left join fshop_tb ON fshop_tb.ftrans_id = pin.trans_id WHERE pin.pinnumber='".safee($condb,$Pin)."' AND pin.serial='".safee($condb,$serial)."' AND pin.status = 'NOTUSED' AND fshop_tb.fpay_status ='1'";
$result_pin = mysqli_query($condb,$sql_pin);
$num_pin = mysqli_num_rows($result_pin);
if(strpos($Pin," ")){
				message("Please! Pin can not Contain a Space.", "error");
		        redirect('apply_b.php?view=New');
					}elseif($num_pin < 1){
message("Incorrect Pin and Serial Number Please Try Again.", "error");
		        redirect('apply_b.php?view=New'); 
				}else{
				$_SESSION['temppin']=$Pin;
	$_SESSION['tempserial']=$serial;
				redirect("apply_b.php?view=N_1");
				//echo "<script>window.location.assign('location:apply_b.php?view=N_1');</script>";
			}

}//}$_SESSION['insid'] = rand();
?>


   <section id="content" role="document">
        <main style="min-height: 168px;">
                    <div class="container">
                        

<div class="row">
    <div class="col-xs-12">
        <div id="breadcrumbs-share">
            <section id="breadcrumbs">
                <ul class="breadcrumb">
                                <li><a href="<?php echo  host(); ?>">Home</a> </li>

                </ul>
            </section>
        </div>
    </div>
</div>
                    </div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-9 link-icons">
            <div class="row">
                <div class="col-xs-12">
            <h3>Welcome to the Online Application For Admission </h3>
        </div>
        <div class="col-xs-12 primary-content link-icons">
<p class="first-paragraph">This page will Enable You To Continue with Rest Of The application Process After Pin/Serial Number Verification.</p>
                </div>
                
        <div class="margin-md-top row cards section-cards">
           <div class="col-xs-12">
           
            <div class="row nopadding nomargin" id="cards">
            
					<!-- form window  --!>	
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<!-- <h3 class="panel-title">Please sign up for Bootsnipp <small>It's free!</small></h3> --!>
			    		<h4 class="panel-title">Enter Generated  Pin/Serial</h4>
			 			</div>
			 			
			 			<div class="panel-body">
			    	<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Pin<span class="w3l-star"> * </span></label>
			<div class="form-group"> <input type="text" name="pin"  id="pin" class="form-control input-sm" autocomplete="off"  required="required" >
			    					</div></div>
			    					
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Serial Number<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    			<input type="text" name="serial" id="serial" required="required" class="form-control input-sm" autocomplete="off">
			    				</div>
			    				</div>
			    			</div>
			    <label class="head"> Help Me Get My Pin/Serial:</label> <input type="checkbox" id="myCheck"  onclick="myFunction()">
	<input type="text" name="country" id="country" style="display:none;width: 100%; border: 1px solid #ccc;padding: 12px 20px;"  class="form-control input-sm" autocomplete="off" placeholder="Enter Your Payment Reference" onkeyup="suggest(this.value);"  onblur="fill();" >
	<div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div></div>
	<br>
		<button name="Continue" class="btn btn-primary" data-placement="right" type="submit" title="Click for pin verification">Verify</button> 		
			    		</form>
			    	</div>
	    		</div>
    	
    	
    
    	
    	
						
                </div>
                
                
            </div>
        </div>



            </div>
            
        </div>
        <div class="col-xs-12 col-md-3 sidebar-right margin-lg-bottom">
            <!-- right feature space -->
            
   <!-- <div class="apply-box">
        <a class="btn btn-default expand padding-md" href="https://applyalberta.ca/APAS.Web.Public/ApplicationServices/default.aspx?StartingAction=ApplyNow">APPLY NOW</a>
    </div> --!>

            
<?php include("sidenews.php"); ?>
            
        </div>
    </div>
</div>


        </main>
    </section>
    
    