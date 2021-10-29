<?php
//session_start();

//ini_set('display_errors', 1);
//if($_SESSION['insid']==$_POST['insid'])
//{
unset($_SESSION['temppin']);
unset($_SESSION['tempserial']);
?>
<?php
//session_start();

//ini_set('display_errors', 1);
//if($_SESSION['insid']==$_POST['insid'])
//{


if(isset($_POST['Login_Continue'])){
 //$Pin = $_POST["pin"];
//$serial = $_POST["serial"];
$nappNo20 = $_POST["nappNo20"];
	//$_SESSION['temppin']=$Pin;
$passwordn = $_POST['pword'];
$password = substr(md5($passwordn.SUDO_M),14);
	//$result_pinn=mysqli_query($condb,"SELECT * FROM new_apply1 WHERE Pin ='$Pin' AND appNo ='".safee($condb,$nappNo20)."'");
	$result_pinn=mysqli_query($condb,"SELECT * FROM new_apply1 WHERE password ='".safee($condb,$password)."' AND appNo ='".safee($condb,$nappNo20)."'");
$num_pinn = mysqli_num_rows($result_pinn);
$num_serial = mysqli_fetch_array($result_pinn);
$num_serialNo = $num_serial['SerialNo'];
$num_pin = $num_serial['Pin'];
	$sql_pinn2="SELECT reg_status FROM new_apply1 WHERE password ='".safee($condb,$password)."' AND appNo ='".safee($condb,$nappNo20)."' AND reg_status = '1'";
$result_pinn2 = mysqli_query($condb,$sql_pinn2);
$num_pinn2 = mysqli_num_rows($result_pinn2);
//$sub_user = $num_pinn2['reg_status'];
	$_SESSION['tempserial']=$num_serialNo;
					if($num_pinn < 1){
message("Incorrect Application Number and Password Please Try Again.", "error");
		        redirect('apply_b.php?view=Return');
	}elseif(strpos($nappNo20," ")){
	message("Please! Application Number can not Contain a Space.", "error");
		        redirect('apply_b.php?view=Return');
			   }elseif($num_pinn2 > 0){
message("Application with the Following Details '$nappNo20' Has Been Submited,you can Now Print", "success");
//echo "<script>window.location.assign('studentappprint.php?applicationid=".md5($nappNo21)."');</script>";
		        redirect('studentappprint.php?applicationid='.md5($nappNo20));
				}else{
				redirect("apply_b.php?view=N_1");
                	$_SESSION['temppin']=$num_pin;
	               $_SESSION['tempserial']=$num_serialNo;
				//header("location:apply_b.php?view=N_1");
				//echo "<script>window.location.assign('apply_b.php?view=N_1 & applicationid=".$nappNo20."');</script>";
			}}

if(isset($_POST['Login_Reprint'])){
 $Pin = $_POST["pin"];
$serial = $_POST["serial"];
$nappNo21 = $_POST["nappNo20"];
	$_SESSION['temppin']=$Pin;
$passwordn = $_POST['pword'];
$password = substr(md5($passwordn.SUDO_M),14);
	$sql_pinr="SELECT * FROM new_apply1 WHERE password ='".safee($condb,$password)."' AND appNo ='".safee($condb,$nappNo21)."'";
$result_pinr = mysqli_query($condb,$sql_pinr);
$num_pinr = mysqli_num_rows($result_pinr);
$num_serialr = mysqli_fetch_array($result_pinr);
$num_serialNo = $num_serialr['SerialNo'];
	$sql_pinn2="SELECT reg_status FROM new_apply1 WHERE password ='".safee($condb,$password)."' AND appNo ='".safee($condb,$nappNo21)."' AND reg_status = '0'";
$result_pinn2 = mysqli_query($condb,$sql_pinn2);
$num_pinn2 = mysqli_num_rows($result_pinn2);
//$sub_user = $num_pinn2['reg_status'];
	$_SESSION['tempserial']=$num_serialNo;
					if($num_pinr < 1){
	message("Incorrect Application Number and Password  Please Try Again", "error");
		        redirect('apply_b.php?view=Return'); 
		//$res="<font color='Red'><strong>Incorrect Application Number and Pin  Please Try Again.</strong></font><br>";
				//$resi=1;
				}elseif(strpos($nappNo21," ")){
					message("Please! Application Number can not Contain a Space", "error");
		        redirect('apply_b.php?view=Return'); 
	
			   }elseif($num_pinn2 > 0){
			message("Application with the Following Details '$nappNo21' Has Not Been Submited", "error");
		        redirect('apply_b.php?view=Return'); 
				}else{
			echo "<script>window.location.assign('studentappprint.php?applicationid=".md5($nappNo21)."');</script>";
			}}
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
<p class="first-paragraph">This page will Enable You To Continue with Rest Of The application Process and reprint your Application slip.</p>
                </div>
                
        <div class="margin-md-top row cards section-cards">
           <div class="col-xs-12">
           
            <div class="row nopadding nomargin" id="cards">
            
					<!-- form window  --!>	
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<!-- <h3 class="panel-title">Please sign up for Bootsnipp <small>It's free!</small></h3> --!>
			    		<h4 class="panel-title">Enter Your Application Number and Password to Continue </h4>
			 			</div>
			 			
			 			<div class="panel-body">
			    	<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Application Number<span class="w3l-star"> * </span></label>
			    					<div class="form-group"><input type="text" name="nappNo20" id="nappNo20" class="form-control input-sm" required="required">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Password<span class="w3l-star"> * </span></label>
<div class="form-group"><input type="password" class="form-control input-sm" name="pword" id="pword" placeholder="Enter your Application Password"  required="required">
			    					</div>
			    				</div>
			    			<!--	<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Pin<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    				<input type="text" name="pin" id="pin" required="required" class="form-control input-sm" ></div>
			    				</div> --!>
			    			</div>
<button name="Login_Continue" class="btn btn-primary" data-placement="right" type="submit" title="Click to Continue  Button To Continue Application and aswell Reprint Your Application Slip"><i class="icon-plus-sign icon-large"> Continue </i></button>
			    <!--		  <button name="Reprint" class="btn btn-primary" data-placement="right" type="button"  title="Click  Reprint Button To Reprint Your Application Slip" onClick="window.location.href='apply_b.php?view=N_2';"><i class="icon-plus-sign icon-large"> Reprint</i></button>
<button name="Login_Reprint" class="btn btn-primary" data-placement="right" type="submit" title="Click  Reprint Button To Reprint Your Application Slip">Reprint</button>  	--!>
			    		
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
    
    