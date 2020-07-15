<?php include('header.php'); ?>
<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
define(PW_SALT,'(+3%_');
$schoolname = $row['SchoolName'];
  //$expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y"));
       //$expDate = date("Y-m-d H:i:s",$expFormat);
       //echo $curDate = date("Y-m-d H:i:s");
	    //echo "</br>" .$expDate;
        //if($expDate > $curDate){echo "yes";}else{echo "No";}
        //error_reporting(E_ALL);
//ini_set('display_errors', 1);
if(isset($_POST['passRe'])){
$username = stripslashes($_POST['username']);
$usercategory = $_POST['ucategory'];
$ourPath =  host()	;
$webaddress=$_SERVER['HTTP_HOST'];
$from = "support@edu.smartdelta.ng";

	
//$hash1 = md5(microtime().$email.'xx'); //create a unique number for email
        //$ctime = time();
        //$hash2 = md5($hash1.$ctime); //create a unique hash based on hash1 and time	
$query_recover = "SELECT * FROM admin WHERE username='".safee($condb,$username)."' OR email='".safee($condb,$username)."'  AND validate='1' LIMIT 1";
$result = mysqli_query($condb,$query_recover)or die(mysqli_error($condb));$row_recover = mysqli_fetch_array($result); $num_recover = mysqli_num_rows($result); $email20 = $row_recover['email']; $adminid = md5($row_recover['admin_id']); $adminuser = md5($row_recover['username']);

$query_student = mysqli_query($condb,"SELECT * FROM student_tb WHERE RegNo ='".safee($condb,$username)."' OR e_address='".safee($condb,$username)."' AND verify_Data ='TRUE' LIMIT 1")or die(mysqli_error($condb)); $num_row_student = mysqli_num_rows($query_student);
		$row_student = mysqli_fetch_array($query_student); $email21 = $row_student['e_address'];
		$studentid = md5($row_student['stud_id']); $regnopass = md5($row_student['RegNo']);
		
		$query_staff = mysqli_query($condb,"SELECT * FROM staff_details WHERE usern_id='".safee($condb,$username)."' OR email='".safee($condb,$username)."' AND  r_status='2' LIMIT 1")or die(mysqli_error($condb));$num_row_staff = mysqli_num_rows($query_staff);
		$row_staff = mysqli_fetch_array($query_staff); $email22 = $row_staff['email'];
		$staffid = md5($row_staff['staff_id']); $usern_id = md5($row_staff['usern_id']);
	   
	    $expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y"));
        $expDate = time();//date("Y-m-d H:i:s",$expFormat);
        //$key = md5($uname . '_' . $email . rand(0,10000) .$expDate . PW_SALT);
        $key = md5($username . rand(0,10000) .$expDate . PW_SALT);
        //echo $key;
    if($usercategory == "sy"){
	$epath1 = $ourPath.'changepassword.php?ID='.$adminuser.'&keyed='.$key.'&cat='.$usercategory;

if($num_recover < 1){ 
	message("ERROR:  Your Id $username is Incorrect please Comfirm and try Again.", "error");
		        redirect('Up_recover.php');
}elseif(empty($email20)){
	message("ERROR:  Unable to send Recovered Password Because No Recovery Email Found.", "error");
		        redirect('Up_recover.php'); }else{
$msg = nl2br("Dear $row_recover[firstname] $row_recover[lastname],.\n
	The Message was Sent To You From ".ucwords($row['SchoolName']).", dated ".date('d-m-Y').".\n
	..................................................................\n
	Please click the link below to reset your password:.\n
	The link will expire after 24 Hours for security reasons.\n
    <a href=".$epath1.">Click Here For yor password reset </a>\n
	
	..................................................................\n
	If you did not request this forgotten password email, no action is needed.\n
	
	Thank You System Administrator!\n
    For Support send email to ".$row['SEmail']." \n
	to Contact The Developer Call Akubest @ 08062475090 \n");
$subject="Admin Password Reset ";
$mail_data = array('to' => $email20, 'sub' => $subject, 'msg' => 'Notify','body' => $msg, 'srname' => $comn);
/* $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers      .= "From:Message From School Admin\r\n <$from>\r\n".
                   'Reply-To: '.$from ."\r\n" .
                   'Return-Path: The Sender: '. $from ."\r\n" .
                   'X-Priority: 3\r\n'.
                   //'Reply-To: '.$from."\r\n" .
                   'X-Mailer: PHP/' . phpversion(); */
//mail($email,$subject,$msg ,$headers ); 

//if(@mail($email20,$subject,$msg ,$headers )){
if(send_email2($mail_data)=== 'success'){
$addreset1 = mysqli_query($condb,"insert into p_reset (userid,username,rest_id,expiredate) values('$adminuser','$email20','".$key."','$expDate')")or die(mysqli_error($condb));
//mysqli_close($condb);
message("Link For Your Password Reset have been mailed to This email $email20.", "success");
		        redirect('Up_recover.php');
}else{
message("ERROR:  Unable to  Recovered Password contact Admin For Assistance", "error");
		        redirect('Up_recover.php');				}
				}}
		
			if($usercategory == "xp"){
			$epath2 = $ourPath.'changepassword.php?ID='.$regnopass.'&keyed='.$key.'&cat='.$usercategory;
if($num_row_student < 1){ 
message("ERROR:  Your Id $username is Incorrect please Comfirm and try Again", "error");
		        redirect('Up_recover.php');}elseif(empty($email21)){
				message("ERROR:  Unable to send Recovered Password Because No Recovery Email Found ", "error");
		        redirect('Up_recover.php');	}else{
$msg = nl2br("Dear $row_student[FirstName] $row_student[SecondName],.\n
	The Message was Send To You From ".ucwords($row['SchoolName']).", dated ".date('d-m-Y').".\n
	..................................................................\n
	Please click the link below to reset your password:.\n
	The link will expire after 24 Hours for security reasons.\n
    <a href=".$epath2.">Click Here For yor password reset </a>\n
	
	..................................................................\n
	If you did not request this forgotten password email, no action is needed.\n
	
	Thank You System Administrator!\n
	For Support send email to ".$row['SEmail']." \n
	to Contact The Developer Call Akubest @ 08062475090 \n");
$subject="Student Password Reset ";
$mail_data2 = array('to' => $email21, 'sub' => $subject, 'msg' => 'Notify','body' => $msg, 'srname' => $comn);
/* $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers      .= "From:Message From School Admin\r\n <$from>\r\n".
                   'Reply-To: '.$from ."\r\n" .
                   'Return-Path: The Sender: '. $from ."\r\n" .
                   'X-Priority: 3\r\n'.
                   //'Reply-To: '.$from."\r\n" .
                   'X-Mailer: PHP/' . phpversion();*/
//mail($email,$subject,$msg ,$headers ); 
//if(@mail($email21,$subject,$msg ,$headers )){
if(send_email2($mail_data2)=== 'success'){
$addreset2 = mysqli_query($condb,"insert into p_reset (userid,username,rest_id,expiredate) values('$regnopass','$email21','".$key."','$expDate')")or die(mysqli_error($condb));
//mysqli_close($condb);
message("Link For Your Password Reset have been mailed to This email $email21 ", "success");
		        redirect('Up_recover.php');}else{
		        message("ERROR:  Unable to  Recovered Password contact Admin For Assistance", "error");
		        redirect('Up_recover.php');
					}
					}}
		
		if($usercategory == "ws"){
		 $epath3 = $ourPath.'changepassword.php?ID='.$usern_id.'&keyed='.$key.'&cat='.$usercategory;
if($num_row_staff < 1){ 
  message("ERROR:  Your Id $username is Incorrect please Comfirm and try Again", "error");
		        redirect('Up_recover.php'); }elseif(empty($email22)){
		         message("ERROR:  Unable to send Recovered Password Because No Recovery Email Found", "error");
		        redirect('Up_recover.php');
}else{
$msg = nl2br("Dear $row_staff[sname] $row_staff[mname],.\n
	The Message was Send To You From ".ucwords($row['SchoolName']).", dated ".date('d-m-Y').".\n
	..................................................................\n
	Please click the link below to reset your password:.\n
	The link will expire after 24 Hours for security reasons.\n
    <a href=".$epath3.">Click Here For yor password reset </a>\n
	
	..................................................................\n
	If you did not request this forgotten password email, no action is needed.\n
	
	Thank You System Administrator!\n
	For Support send email to ".$row['SEmail']." \n
	to Contact The Developer Call Akubest @ 08062475090 \n");
$subject="Staff Password Reset ";
$mail_data3 = array('to' => $email22, 'sub' => $subject, 'msg' => 'Notify','body' => $msg, 'srname' => $comn);
 /*$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers      .= "From:Message From School Admin\r\n <$from>\r\n".
                   'Reply-To: '.$from ."\r\n" .
                   'Return-Path: The Sender: '. $from ."\r\n" .
                   'X-Priority: 3\r\n'.
                   //'Reply-To: '.$from."\r\n" .
                   'X-Mailer: PHP/' . phpversion(); */
//mail($email,$subject,$msg ,$headers ); 
//if(@mail($email22,$subject,$msg ,$headers )){
if(send_email2($mail_data3)=== 'success'){
$addreset3 = mysqli_query($condb,"insert into p_reset (userid,username,rest_id,expiredate) values('$usern_id','$email22','".$key."','$expDate')")or die(mysqli_error($condb));
//mysqli_close($condb);
message("Link For Your Password Reset have been mailed to This email $email22", "success");
		        redirect('Up_recover.php');}else{
		        message("ERROR:  Unable to  Recovered Password contact Admin For Assistance", "error");
		        redirect('Up_recover.php');
						}
						}}

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
            <h3>Password Recovery Panel <?php 
function timeToSeconds($time) {
    list($hours, $minutes, $seconds) = explode(':', $time);
    return $hours * 3600 + $minutes * 60 + $seconds;
}

?> </h3>
        </div>
        <!--
        <div class="col-xs-12 primary-content link-icons">
<p class="first-paragraph">Please Note That Every Activity From Here is logged.</p>
                </div> --!>
                
        <div class="margin-md-top row cards section-cards">
           <div class="col-xs-12">
           
            <div class="row nopadding nomargin" id="cards">
            
					<!-- form window  --!>	
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<!-- <h3 class="panel-title">Please sign up for Bootsnipp <small>It's free!</small></h3> --!>
			    		<h4 class="panel-title"><i class="fa fa-user"></i> User Identification   </h4>
			 			</div>
			 			
			 			<div class="panel-body">
			    	<form id="login_form1" class="form-signin" method="POST">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Username<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
	<input type="text"      class="form-control input-sm" id="username" name="username" placeholder="Enter your Username or Reg No" required> </div>
			    				</div>
			    				</div>
<!--
			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div> --!>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<label class="head">User Category<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    	<select class="form-control input-sm"   name="ucategory" id="ucategory"  required="required">
  <option value="">Select Category</option>
<option value='xp'>Student</option>
<option value='ws'>Staff</option>	
<option value='sy'>Admin</option>

</select>
			    					</div>
			    				</div>
			    				
			    			</div>
			    		<button  title="Click Here to Recover Password" id="passRe" data-placement="right" name="passRe" class="btn btn-primary" type="submit"><i class="icon-signin icon-large"></i> Submit</button>
			    			
			    		
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
    
    <?php include('footer.php'); ?>
    