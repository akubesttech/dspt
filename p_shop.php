<script>
function showroomno(str)
{
if (str=="")
  {
  //document.getElementById("txtroomno").innerHTML="Amount was Not Loaded Because Form Type was Not Selected";
 // return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtroomno").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","loadamt.php?q="+str,true);
xmlhttp.send();
}
/* var qsParm = new Array();
function qs() {
    var query = window.location.search.substring(1);
    var parms = query.split('&');
    for (var i=0; i < parms.length; i++) {
        var pos = parms[i].indexOf('=');
        if (pos > 0) {
            var key = parms[i].substring(0, pos);
            var val = parms[i].substring(pos + 1);
            qsParm[key] = val;
        }
    }
} */
function getQueryVariable(variable) {
var query = window.location.search.substring(1)
var vars = query.split("&");
for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=")
    if(pair[0] == variable){
        if(pair[1].indexOf('%20') != -1){
            console.log(pair[1].indexOf('%20'))
            var fullName = pair[1].split('%20')
            console.log(fullName)
            return fullName[0] + ' ' + fullName[1]
        }
        else {
            return pair[1];
        }
    }
}
return(false)}
getQueryVariable("main");
</script>
<?php
//session_start();

//ini_set('display_errors', 1);
$getmain = $_GET['main'];
$sql_pinn2=mysqli_query($condb,"SELECT * FROM form_db WHERE sha1(id) ='".safee($condb,$_GET['main'])."'");
$dform_checkexist = mysqli_num_rows($sql_pinn2);
$dform_get = mysqli_fetch_assoc($sql_pinn2); $amount_n = $dform_get['amount']; $app_type = $dform_get['app_type']; $fid = sha1($dform_get['id']);
$gmode = $dform_get['mode'];
//!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == ''))
//if($getmain !== $fid){
if($dform_checkexist < 1){
	message("Payment no completed please try Again!", "error"); 
		        redirect('apply_b.php?view=f_select');
		        exit();
}

$querylastserial = mysqli_query($condb,"select * from lastserial where id = '1'")or die(mysqli_error($condb));
$rowlast = mysqli_fetch_array($querylastserial); $serialno=$rowlast['last']; 
$finalcode='PO-'.createRandomPassword(); 
 $transdate = date("Y-m-d");
$amount_n2 = $dform_get['amount2']; $prog_no = $dform_get['prog'];
$prog_sec = $dform_get['session'];$p_start = $dform_get['f_start'];$p_send = $dform_get['f_end'];
$schooltag = "A".substr($prog_sec,0,4);
$timestamp = strtotime($p_send);
$datetime	= date('l, jS F Y', $timestamp);
//print $datetime;//date("F d, Y", mktime(0, 0, 0, $dateformat[0], $dateformat[1], $dateformat[2]));
if(isset($_POST['buyformps'])){
$snamep = $_POST["sname1"];$onamep = $_POST["oname1"]; $phone1 = $_POST["phone1"];
$semail = $_POST["semail"];$famt = $_POST["amt"]; $foamt = $_POST["amt2"];
$sql_pinn2=mysqli_query($condb,"SELECT fpay_status FROM fshop_tb WHERE femail ='$semail' AND  fpay_status = '1' and '$prog_sec' and '$prog_no'");
$num_pinn2 = mysqli_num_rows($sql_pinn2);
	$result_ph=mysqli_query($condb,"SELECT * FROM fshop_tb WHERE femail='$semail' and '$prog_sec' and '$prog_no'");
$num_ph = mysqli_num_rows($result_ph);
	$result_ph2=mysqli_query($condb,"SELECT * FROM fshop_tb WHERE fphone='$phone1' and '$prog_sec' and '$prog_no' ");
$num_ph2 = mysqli_num_rows($result_ph2);

	if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $_POST['semail'])){
	message("Please! Provide a valid Email Address.", "error");
		        redirect('apply_b.php?view=p_sh&main='.$getmain);
		        //}elseif($num_pinn2 > 0){
				//message("Payment made with this Email '$semail' Has Been Processed ,please fill in your Payment Details or use <strong>(Help Me Get My Pin/Serial)</strong>", "success");
		        //redirect('apply_b.php?view=New');
				//}elseif($num_ph > 0){
//message("Another Candidate Has initiated payment with This Email '$semail' Before.", "error");
		        //redirect('apply_b.php?view=p_sh&main='.$getmain);
				}elseif($num_ph2 > 0){ message("Another Candidate Has initiated payment with This Phone Number '$phone1' Before.", "error");
		        redirect('apply_b.php?view=p_sh&main='.$getmain);
		       // Candidate with Name: Nweke Ebuka; ,Phone Number: 07083853189 Email Address: ifennalue2018@gmail.com already exist
			  }else{
	$s=14;
	$pin = "";
	while($s>0){
		$pin .= rand(1,9);
		$s-=1;}
	$serialno+=1;
	$newserial = $schooltag ."". $serialno;
$sqlip=mysqli_query($condb,"INSERT INTO pin(trans_id,serial, pinnumber) VALUES('".safee($condb,$finalcode)."','".safee($condb,$newserial)."', '".safee($condb,$pin)."')")or die(mysqli_error($condb));
$sqlporder =	mysqli_query($condb,"INSERT INTO fshop_tb (ftrans_id, fsname, foname, femail, fphone, moe, feen, pin, serial, ftype, session, charge, dategen, famount, fpamount, fcard_type, fpay_status) VALUES('".safee($condb,$finalcode)."','".safee($condb,$snamep)."','".safee($condb,$onamep)."','".safee($condb,$semail)."','".safee($condb,$phone1)."','".safee($condb,$gmode)."','".safee($condb,$app_type)."','".safee($condb,$pin)."','".safee($condb,$newserial)."','".safee($condb,$prog_no)."','".safee($condb,$prog_sec)."','".safee($condb,$foamt)."','".safee($condb,$transdate)."','".safee($condb,$famt)."','','','0')")or die(mysqli_error($condb));
				//session_regenerate_id();
//echo "<script>window.location.assign('apply_b.php?view=ep_view&o_id=".md5($semail)."');</script>";
		  redirect("apply_b.php?view=ep_view&o_id=".sha1($finalcode));
				unset($pin);
	}

}
	$querypup = mysqli_query($condb,"UPDATE lastserial SET last='$serialno' WHERE id=1")or die(mysqli_error($condb));
//}$_SESSION['insid'] = rand();


?>
   <section id="content" role="document">
        <main style="min-height: 168px;">
                    <div class="container">
                        

<div class="row">
    <div class="col-xs-12">
        <div id="breadcrumbs-share">
            <section id="breadcrumbs">
                <ul class="breadcrumb">
                                <li><a href="<?php  host(); ?>">Home</a> </li>


                    

                    

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
            <h3>Student Online Application Panel: <?php echo getprog($prog_no)." (".getamoe($gmode).") ".$prog_sec; ?> </h3>
         <h5 style="color:red;">Application Closes On <?php echo $datetime."."; ?> </h5>
        </div>
        <div class="col-xs-12 primary-content link-icons">
<p class="first-paragraph">This page will Enable You To Generate Pin For your Application and Continue your registration,to order for pin Click on <strong>Generate Pin</strong> and to Continue with the rest of  Application process click on <strong>Apply</strong>,to exit the page click on <strong>Close</strong> .</p>
                </div>
                
        <div class="margin-md-top row cards section-cards">
           <div class="col-xs-12">
           
            <div class="row nopadding nomargin" id="cards">
            
					<!-- form window  --!>	
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<!-- <h3 class="panel-title">Please sign up for Bootsnipp <small>It's free!</small></h3> $datetime --!>
			    		<h4 class="panel-title">Fill in your details </h4>
			 			</div>
			 			
			 			<div class="panel-body">
			    	<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			        <input type="hidden" name="amt" value="<?php echo $amount_n;?>" />
			        <input type="hidden" name="amt2" value="<?php echo $amount_n2;?>" />
			    	<input type="hidden" name="prog" value="<?php echo $prog_no;?>" />
			    	<input type="hidden" name="session" value="<?php echo $prog_sec;?>" />
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Surname<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			        
			                <input type="text" name="sname1" id="sname1" required="required" class="form-control input-sm">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Othername<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    					<input type="text" name="oname1" id="oname1" required="required" class="form-control input-sm">
			    					</div>
			    				</div>
			    			</div>
<!--
			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div> --!>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<label class="head">Email<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    						<input type="text" name="semail" id="semail" class="form-control input-sm" required="required">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<label class="head">Phone<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    				<input type="text" name="phone1" id="phone1" class="form-control input-sm" >
			    					</div>
			    				</div>
			    			</div>
			    			
			    		<!--	<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<label class="head">Form type<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
		<select name="ftype" id="ftype" onchange="showroomno(this.value)" required="required" class="form-control input-sm">
  <option value="">Select Form</option>
    <?php  //$resultsec = mysqli_query($condb,"SELECT * FROM prog_tb where status = '1' ORDER BY pro_id ASC");
//while($rssec = mysqli_fetch_array($resultsec)){ echo "<option value='$rssec[Pro_name]'>$rssec[Pro_name]</option>";	}
?>
  </select>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<label class="head">Amount<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    					<div  id="txtroomno" >
			  <input type="text" name="amt" id="amt" value="" placeholder="0.00"  required="required" readonly class="form-control input-sm" >
			 </div>
			    					</div>
			    				</div> 
			    			</div> --!>
	 <button name="buyformps" class="btn btn-primary" data-placement="right" type="submit" title="Click to Generate Pin"> Generate Pin</button>
	<button name="buyformp" class="btn btn-primary" data-placement="right" type="button" title="Click to Continue Application" onClick="window.location.href='apply_b.php?view=New';"> Apply</button>
            <button name="Reprint" class="btn btn-primary" data-placement="right" type="button"  title="Click  To Exit " onClick="window.location.href='apply_b.php';">Close</button>
			    			
			    		
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
</div>


        </main>
    </section>
    
  