



<?php
if(isset($_POST['viewpayment'])){
$slevel = $_POST['level']; 
$fac1 = $_POST['fac1'];
$dept1 = $_POST['dept1'];
$pdate = $_POST['pdate'];
$pdate2 = $_POST['pdate2'];
$salot_session = $_POST['session'];
$categg = $_POST['categ2'];
$sql_alldept="SELECT * FROM payment_tb";
$result_alldept = mysqli_query($condb,$sql_alldept);
$num_alldept = mysqli_num_rows($result_alldept);
//	$_SESSION['vsession']=$salot_session;

if($num_alldept < 1){
	message("No Payment information found , Please Try Again", "error");
		        redirect('formSales.php?view=Reportmain'); 
      
}else{
if($categg == '1'){ 
echo "<script>window.location.assign('formSales.php?view=Greport&xd1=".$pdate."&xd2=".$pdate2."&cat=".$categg."');</script>";
 }elseif($categg == '2'){
 echo "<script>window.location.assign('formSales.php?view=Greport&xsec=".($salot_session)."&xdp=".$dept1."&cat=".$categg."');</script>";
 }elseif($categg == '4'){
 echo "<script>window.location.assign('formSales.php?view=Greport&xsec=".($salot_session)."&xdp=".$dept1."&xlev=".$slevel."&cat=".$categg."');</script>";
}else{
 echo "<script>window.location.assign('formSales.php?view=Greport&xsec=".($salot_session)."&cat=".$categg."');</script>";
 }}
 }
?>

<div class="x_panel">
                
             
                <div class="x_content">
<form name="user" method="post" enctype="multipart/form-data" id="user">
<input type="hidden" name="insidtime" value="<?php echo $_SESSION['insidtime'];?> " />
                  <span class="section">Search Record </span>
                  <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>Select Approprate Option/Component to Generate General report <strong></strong>. </div>
                  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Search Category </label>
                      <select name='categ2' id="categ2" class="form-control" required>
                            <option value="">Select Category</option><option value="1">Date</option>
    <option value="2"><?php echo $SGdept1; ?></option><option value="3">Academic Session</option><option value="4">Level</option></select></div>
                    
   	    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"  style="display: none;"  id="enable1">
		<label for="heard"><?php echo $SCategory; ?> </label>
		<select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control"   >
                            <option value="">Select <?php echo $SCategory; ?></option>
                            <?php  $resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
while($rsblocks = mysqli_fetch_array($resultblocks))
{if($_GET['loadfac'] ==$rsblocks['fac_id'] ){echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";}
	else{echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";}}
?></select></div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display: none;"  id="enable2">
<label for="heard"><?php echo $SGdept1; ?></label><select name='dept1' id="dept1" class="form-control" >
                           <option value=''>Select <?php echo $SGdept1; ?></option></select></div>
  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display: none;"  id="enable5">
						  	  <label for="heard">Academic Session </label>
<select class="form-control"   name="session" id="session"  ><option value="">Select Session</option>
<?php  $resultsec = mysqli_query($condb,"SELECT * FROM session_tb  ORDER BY session_name ASC");
while($rssec = mysqli_fetch_array($resultsec)){ echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	}
?></select></div>
       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display: none;"  id="enable6">
						  	  <label for="heard">Level </label>
                            	  <select name='level' id="status" class="form-control" >
                            <option value="">Select Level</option>
                      <?php $resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2)){ echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	}
?></select></div>
 <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display: none;"  id="enable3">
						  	  <label for="heard">From </label>
<input  type="text" name="pdate" size="29"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed1"   readonly="readonly" style="height:32px;"></div><div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display: none;"  id="enable4">
						  	  <label for="heard">To</label>
<input  type="text" name="pdate2" size="29"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed"   readonly="readonly" style="height:32px;"></div>
          
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  
                           </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  
                           </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <div class="col-md-6 col-md-offset-3">
                           <?php   if (authorize($_SESSION["access3"]["fIn"]["forms"]["view"])){ ?> 
    <button  name="viewpayment"  id="viewpedger"  class="btn btn-primary col-md-4" title="Click Here to Load Payment (s) " ><i class="fa fa-search"></i> GO  </button> <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#viewPay').tooltip('show');
	                                            $('#viewPay').tooltip('hide');
	                                            });
	                                            </script> <?php } ?>
	                                              <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div></div> 
                        </form>
				  <div class="x_content">
                    
                    <a class="btn btn-app"  onclick="window.open('formSales.php?view=Report&q=wp1','_self')" >
                      <i class="fa fa-calendar"></i> Weekly Report
                    </a>
                    <a class="btn btn-app" onclick="window.open('formSales.php?view=Report&q=mp2','_self')" >
                      <i class="fa fa-calendar"></i> Monthly Report
                    </a>
                    <a class="btn btn-app" onclick="window.open('formSales.php?view=Report&q=qp3','_self')">
                      <i class="fa fa-calendar"></i> Quaterly Report
                    </a>
                    <a class="btn btn-app" onclick="window.open('formSales.php?view=Report&q=ap4','_self')" >
                      <i class="fa fa-calendar"></i> Annually Report
                    </a>
                   
                  </div>
                  
                  
                  
                  
				  
				  </div>
                 
                  