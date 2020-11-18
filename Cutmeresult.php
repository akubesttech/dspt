<?php
//session_start();

//ini_set('display_errors', 1);
//if($_SESSION['insid']==$_POST['insid'])
//{
if(isset($_POST['Login_Reprint'])){
 //$Session_checker = $_POST["session"];
//$serial = $_POST["serial"];
$nappNo21 = $_POST["nappNo21"];
	//$_SESSION['temppin']=$Pin;
$passwordn = $_POST['pword'];
$password = substr(md5($passwordn.SUDO_M),14);
$result_pinr = mysqli_query($condb,"SELECT * FROM new_apply1 WHERE appNo ='".safee($condb,$nappNo21)."' and password ='".safee($condb,$password)."'  and reg_status > 0 or JambNo ='".safee($condb,$nappNo21)."' and password ='".safee($condb,$password)."' and reg_status > 0 ")or die(mysqli_error($condb));
//$result_pinr = mysqli_query($condb,"SELECT * FROM new_apply1 WHERE appNo ='".safee($condb,$nappNo21)."' and password ='".safee($condb,$password)."' and adminstatus > 0 or JambNo ='".safee($condb,$nappNo21)."' and password ='".safee($condb,$password)."' and adminstatus > 0 ")or die(mysqli_error($condb));

//$result_pinr = mysqli_query($condb,$sql_pinr);and verify_apply='TRUE'
$num_pinr = mysqli_num_rows($result_pinr);
$num_serialr = mysqli_fetch_array($result_pinr);
$num_serialNo = $num_serialr['SerialNo'];
$sql_appNo_check = mysqli_query($condb,"SELECT * FROM new_apply1 WHERE appNo='".safee($condb,$nappNo21)."' or JambNo='".safee($condb,$nappNo21)."' LIMIT 1");
$appNo_check = mysqli_num_rows($sql_appNo_check);

//$sql_session_check = mysqli_query($condb,"SELECT Asession FROM new_apply1 WHERE  appNo='".safee($condb,$nappNo21)."' and Asession ='".safee($condb,$Session_checker)."' or JambNo ='".safee($condb,$nappNo21)."'");
//$session_check = mysqli_num_rows($sql_session_check);
//$sub_user = $num_pinn2['reg_status'];
	$_SESSION['tempserial']=$num_serialNo;
	if(strpos($nappNo21," ")){
message("Please! Application Id can not Contain a Space.", "error");
		        redirect('apply_b.php?view=C_R');
		}elseif($appNo_check < 1){ 
	message("ERROR:  Your $nappNo21 Number is Incorrect please Comfirm and try Again.", "error");
		        redirect('apply_b.php?view=C_R');

		
//}elseif($session_check < 1){
//message("ERROR:  Examination Session is Incorrect please Comfirm and try Again.", "error");
		        //redirect('apply_b.php?view=C_R'); 
}elseif($num_pinr < 1){
message("Entrance Exam Result / Admission Status is Not Available at This Time, Please Check back Later.", "error");
		        redirect('apply_b.php?view=C_R'); }else{
			redirect('studentresultprint.php?applyid='.md5($nappNo21));
		//echo "<script>window.location.assign('studentresultprint.php?applyid=".md5($nappNo21)."');</script>";
			}

}
?>


   <section id="content" role="document">
        <main style="min-height: 168px;">
                    <div class="container">
                        

<div class="row">
    <div class="col-xs-12">
        <div id="breadcrumbs-share">
            <section id="breadcrumbs">
                <ul class="breadcrumb">
                                <li><a href="<?php echo host(); ?>">Home</a> </li>


                    

                    

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
            <h3>Post UTME/Entrance Exam Result and Admission Status Checker </h3>
        </div>
        <div class="col-xs-12 primary-content link-icons">
<p class="first-paragraph">This page will Enable You To Check Your Post UTME Result and Admission Status.</p>
                </div>
                
        <div class="margin-md-top row cards section-cards">
           <div class="col-xs-12">
           
            <div class="row nopadding nomargin" id="cards">
            
					<!-- form window  --!>	
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<!-- <h3 class="panel-title">Please sign up for Bootsnipp <small>It's free!</small></h3> --!>
			    		<h4 class="panel-title">Applicant Examination Details</h4>
			 			</div>
			 			
			 			<div class="panel-body">
			    	<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Application No<span class="w3l-star"> * </span></label>
			    					<div class="form-group"><input type="text" class="form-control input-sm" name="nappNo21" id="nappNo21" placeholder="Enter your Application No or UTME Reg No" required="required">
			    					</div>
			    				</div>
			    				
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Password<span class="w3l-star"> * </span></label>
<div class="form-group"><input type="password" class="form-control input-sm" name="pword" id="pword" placeholder="Enter your Application Password"  required="required">
			    					</div>
			    				</div>
			    				
			    			<!-- <div class="col-xs-6 col-sm-6 col-md-6">
<label class="head">Session<span class="w3l-star"> * </span></label><div class="form-group">
			    					<select class="form-control input-sm"   name="session" id="session"  required="required">
  <option value="">Select Session</option><?php  
$resultsec = mysqli_query($condb,"SELECT * FROM session_tb  ORDER BY session_name ASC"); while($rssec = mysqli_fetch_array($resultsec))
{echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	}?></select></div></div> --!>
			    			</div>

			    		<!--	<button type="button" class="btn btn-primary btn-vote">Vote!</button>
			    			<input type="submit" value="Apply" class="btn btn-primary btn-block"> 
			    			<input type="submit" value="Apply" class="btn btn-primary"> --!>
<button name="Login_Reprint" class="btn btn-primary"  data-placement="right" type="submit" title="Click to Check  Your Result and Admission Status">Check</button>
			    		
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
    
    