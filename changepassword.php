<?php include('header.php'); ?>
<?php
$sql_svery=mysqli_query($condb,"SELECT * FROM p_reset WHERE (userid) = '".safee($condb,$_GET['ID'])."' AND rest_id = '".safee($condb,$_GET['keyed'])."'");
$dform_checkexist2 = mysqli_num_rows($sql_svery);
if($dform_checkexist2 < 1){ message("ERROR:  Password Request cannot be verify or Expired Please try Again.", "error");
		        redirect('Up_recover.php');}

 ?>
<?php 
//$ourPath =  host()	;
$curDate = date("Y-m-d H:i:s");
$ID=$_GET['ID'];
$keyed=$_GET['keyed'];
$usercategory = $_GET['cat'];
//$key = md5($username . rand(0,10000) .$expDate . PW_SALT);
      //$password = md5(trim($password) . PW_SALT);
      
//$epath2 = $ourPath.'changepassword.php?ID='.$ID.'&keyed='.$key.'&cat='.$usercategory;
if($_SESSION['insidf']==$_POST['insidf'])
{
if(isset($_POST['passRec'])){
$checksendd =  mysqli_query($condb,"SELECT * FROM  p_reset WHERE rest_id = '".$keyed."' ")or die(mysqli_error($condb));
//$checksendd =  mysqli_query($condb,"SELECT * FROM  p_reset WHERE rest_id = '".$keyed."' AND userid = '".$ID."' AND expiredate >= '".$curDate."' ")or die(mysqli_error($condb));
  $counterrec = mysqli_num_rows($checksendd);$flowme =  mysqli_fetch_array($checksendd); $expiredate_1 =$flowme['expiredate'];
  
$passwordn = $_POST['password'];
$password2 = $_POST['password2'];
 $password = substr(md5($passwordn.SUDO_M),14);

$ourPath =  host()	;
$webaddress=$_SERVER['HTTP_HOST'];

if(strpos($password," ")){
	//message("Please! Password  can not Contain a Space.", "error");
		        //redirect($epath2);
		        $res = "<font color='red'><strong>Please! Password  can not Contain a Space</strong></font><br>";
				$resi=1;
         //}elseif(!ctype_alnum($_POST['password']) || strlen($_POST['password']) < 6 || strlen($_POST['password']) > 12) {
           }elseif(strlen($_POST['password']) < 6 || strlen($_POST['password']) > 20) {
	$res = "<font color='red'><strong>Please! Password must be between 6-20 characters (letters and numbers)</strong></font><br>";
				$resi=1;
		
		        //redirect($epath2);
		}elseif($passwordn != $password2){
$res = "<font color='red'><strong>Please! Password  Did not Match</strong></font><br>";
				$resi=1;
	//redirect($epath2);
}
		        elseif(!preg_match("#.*^(?=.{6,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $passwordn)){
		        $res = "<font color='red'><strong>Your Password is not Strong try combination of Upper,Lower case letters,special character and numbers</strong></font><br>";
		        $resi=1;
		         }elseif(time()-$expiredate_1 >= 24 * 60 * 60){
		        //}elseif($curDate > $expiredate_1){
		        $del_rec2 = mysqli_query($condb,"DELETE FROM p_reset WHERE rest_id = '".$keyed."'");
                $res = "<font color='red'><strong>Invalid password request key please try again! </strong></font><br>";
   		
		       $resi=1;
		}else{
	if($usercategory == "sy"){ 
	mysqli_query($condb,"update admin set password = '".$password."' where  md5(username) = '".safee($condb,$ID)."' ")or die(mysqli_error($condb));}
	
if($usercategory == "xp"){ mysqli_query($condb,"update student_tb set password = '".$password."' where   md5(RegNo) = '".safee($condb,$ID)."'")or die(mysqli_error($condb)); }

if($usercategory == "ws"){ mysqli_query($condb,"update staff_details set password = '".$password."' where  md5(usern_id) = '".safee($condb,$ID)."'")or die(mysqli_error($condb));
}  $del_rec = mysqli_query($condb,"DELETE FROM p_reset WHERE rest_id = '".$keyed."'");
//$res="<font color='green'><strong>Your Password Reset was Successfully Click <a href='Userlogin.php'>Here</a> To login.</strong></font><br>";
//$resi=1; 
	echo "<script>alert('Your Password Reset was Successfully!');</script>";
		//echo "<script>window.location.assign('Userlogin.php');</script>";
	 //message("Your Password Reset was Successfully!", "success");
		redirect('Userlogin.php');
	}}$_SESSION['insidf'] = rand();
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
                                <li><a href="./">Home</a> </li>
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
            <h3>Password Reset Panel  </h3>
        </div>
        
       
                
        <div class="margin-md-top row cards section-cards">
           <div class="col-xs-12">
           
            <div class="row nopadding nomargin" id="cards">
            
					<!-- form window  --!>	
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<!-- <h3 class="panel-title">Please sign up for Bootsnipp <small>It's free!</small></h3> --!>
			    		<h4 class="panel-title"><i class="fa fa-key"></i> Set New Password </h4>
			 			</div>
			 			
			 			<div class="panel-body">
			    	 <form id="login_form1" class="form-signin" method="POST">
                     <input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      
<p class="first-paragraph"><?php if($resi == 1){  echo " <center>$res</center>";}?></p>
               
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">New Password<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
	<input type="text"      class="form-control input-sm" id="password" name="password" placeholder="New Passwordeg No" required> </div>
			    				</div>
			    				</div>
<!--
			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div> --!>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<label class="head">Confirm Password<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
		<input type="password"   class="form-control input-sm"   id="password2" name="password2" placeholder="Re-type Password" required>
			    					</div>
			    				</div>
			    				
			    			</div>
			    		<button  title="Click Here to Save New Password" id="passRec" data-placement="right" name="passRec" class="btn btn-primary" type="submit"><i class="icon-save icon-large"></i> Save</button>
			    			
			    		
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
    