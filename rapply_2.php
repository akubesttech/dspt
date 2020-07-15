<?php
//session_start();

//ini_set('display_errors', 1);
//if($_SESSION['insid']==$_POST['insid'])
//{
if(isset($_POST['Login_Reprint'])){
 $Pin = $_POST["pin"];
$serial = $_POST["serial"];
$nappNo21 = $_POST["nappNo21"];
	$_SESSION['temppin']=$Pin;

	$sql_pinr="SELECT * FROM new_apply1 WHERE Pin ='".safee($condb,$Pin)."' AND appNo ='".safee($condb,$nappNo21)."'";
$result_pinr = mysqli_query($condb,$sql_pinr);
$num_pinr = mysqli_num_rows($result_pinr);
$num_serialr = mysqli_fetch_array($result_pinr);
$num_serialNo = $num_serialr['SerialNo'];
	$sql_pinn2="SELECT reg_status FROM new_apply1 WHERE Pin ='".safee($condb,$Pin)."' AND appNo ='".safee($condb,$nappNo21)."' AND reg_status = '0'";
$result_pinn2 = mysqli_query($condb,$sql_pinn2);
$num_pinn2 = mysqli_num_rows($result_pinn2);
//$sub_user = $num_pinn2['reg_status'];
	$_SESSION['tempserial']=$num_serialNo;
					if($num_pinr < 1){
	message("Incorrect Application Number and Pin  Please Try Again", "error");
		        redirect('apply_b.php?view=N_2'); 
		//$res="<font color='Red'><strong>Incorrect Application Number and Pin  Please Try Again.</strong></font><br>";
				//$resi=1;
				}elseif(strpos($Pin," ")){
					message("Please! Pin can not Contain a Space", "error");
		        redirect('apply_b.php?view=N_2'); 
		//$res="<font color='Red'><strong>Please! Pin can not Contain a Space..</strong></font><br>";
				//$resi=1;
			   }elseif($num_pinn2 > 0){
		//$res="<font color='Red'><strong>Application with the Following Details '$Pin','$nappNo21' Has Not Been Submited</strong></font><br>";
				//$resi=1;
				message("Application with the Following Details '$Pin','$nappNo21' Has Not Been Submited", "error");
		        redirect('apply_b.php?view=N_2'); 
				}else{
			//	header("location:apply_b.php?view=N_1");
				//echo "<script>alert('Your Application was Sucessfully Submited!');</script>";
		echo "<script>window.location.assign('studentappprint.php?applicationid=".md5($nappNo21)."');</script>";
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
                                <li><a href="index.php">Home</a> </li>

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
<p class="first-paragraph">This page will Enable You To Reprint Your Application Slip.</p>
                </div>
                
        <div class="margin-md-top row cards section-cards">
           <div class="col-xs-12">
           
            <div class="row nopadding nomargin" id="cards">
            
					<!-- form window  --!>	
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<!-- <h3 class="panel-title">Please sign up for Bootsnipp <small>It's free!</small></h3> --!>
			    		<h4 class="panel-title">Enter Your Application Number and Pin to Login</h4>
			 			</div>
			 			
			 			<div class="panel-body">
			    	<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Application Number<span class="w3l-star"> * </span></label>
			    					<div class="form-group"><input type="text" name="nappNo21" id="nappNo21" class="form-control input-sm" required="required">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Pin<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    			<input type="text" name="pin" id="pin" required="required" class="form-control input-sm" ></div>
			    				</div>
			    			</div>
			    			<button name="Login_Reprint" class="btn btn-primary" data-placement="right" type="submit" title="Click to Load Button To Reprint Application Slip">Login</button></form>
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
    
    