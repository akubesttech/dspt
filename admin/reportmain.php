<?php
if(isset($_POST['viewpayment'])){
$slevel = $_POST['level']; 
$fac1 = $_POST['fac1'];
$dept1 = $_POST['dept1'];
$pdate = $_POST['pdate'];
$pdate2 = $_POST['pdate2'];
$salot_session = $_POST['session'];
$categg = $_POST['categ2'];
$fcate = $_POST['fcate'];
$fcate2 = $_POST['fee'];
$repup =  isset($_POST['chkPenalty']) ? $_POST['chkPenalty'] : ''; //gnum($_POST['chkPenalty']); 
$sql_alldept="SELECT * FROM payment_tb";
$result_alldept = mysqli_query($condb,$sql_alldept);
$num_alldept = mysqli_num_rows($result_alldept);
//	$_SESSION['vsession']=$salot_session;
if($repup > 0 ){ $pagen = "Greport2"; $show = ""; $show2 = "required"; $catn = $fcate2; }else{ $pagen = "Greport"; $show = "required";  $show2 = "";$catn = $fcate; }
if($num_alldept < 1){
	message("No Payment information found , Please Try Again", "error");
		        redirect('formSales.php?view=Reportmain'); 
      
}else{
if($categg == '1'){ 
echo "<script>window.location.assign('formSales.php?view=".$pagen."&xd1=".$pdate."&xd2=".$pdate2."&cat=".$categg."&fcat=".$catn."');</script>";
 }elseif($categg == '2'){
 echo "<script>window.location.assign('formSales.php?view=".$pagen."&xsec=".($salot_session)."&xdp=".$dept1."&cat=".$categg."&fcat=".$catn."');</script>";
 }elseif($categg == '4'){
 echo "<script>window.location.assign('formSales.php?view=".$pagen."&xsec=".($salot_session)."&xdp=".$dept1."&xlev=".$slevel."&cat=".$categg."&fcat=".$catn."');</script>";
}else{
 echo "<script>window.location.assign('formSales.php?view=".$pagen."&xsec=".($salot_session)."&cat=".$categg."&fcat=".$catn."');</script>";
 }}
 }
 if(isset($_POST['vfpay'])){
 $salot_session = $_POST['session'];
 $slevel = $_POST['level'];
$fcate = $_POST['fcate'];
//$fcate2 = $_POST['fee'];
 
$sql_alldept="SELECT * FROM payment_tb";
$result_alldept = mysqli_query($condb,$sql_alldept);
$num_alldept = mysqli_num_rows($result_alldept);
if($num_alldept < 1){
	message("No Payment information found , Please Try Again", "error");
		        redirect('formSales.php?view=Reportmain'); 
 }else{
echo "<script>window.location.assign('formSales.php?view=Greport3&xsec=".($salot_session)."&xlev=".$slevel."&fcat=".$fcate."');</script>";
}}
?>

<div class="x_panel">
<div class="x_content">
                
<input type="hidden" name="insidtime" value="<?php echo $_SESSION['insidtime'];?> " />
                  <span class="section">Search Record </span>
                  <div >
                  <style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
  height: 20%;
}

#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: gray;
    color: white;
}
</style>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')" >General Report</button>
   <button class="tablinks" onclick="openCity(event, 'Summary')" >Summary</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')" id="defaultOpen">Remittance Summary</button>
  <!--<button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button>-->
</div>
<form name="user" method="post" enctype="multipart/form-data" id="user">
<div id="London" class="tabcontent" style="min-height: 300px;">
 <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>Select Approprate Option/Component to Generate General report <strong></strong>. </div>
                             
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
<label for="chkPenalty"> </label><br><br><label class="chkPenalty">
<input type="checkbox" id="chkPenalty"  onclick="ShowHideDiv3(this)" name="chkPenalty" value="1" /> Report By Payment Components </label></div>
    
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"  id="cat" >
<label for="heard">Payment Category</label>
<select  name="fcate" id="fcate" class="form-control" onchange="showreport(this.value)" <?php echo $show2; ?> ><?php if ($fID > 0) { ?>
<option value="<?php echo $row_ft['f_category']; ?>"><?php echo getfeecat($row_ft['f_category']); ?></option><?php }else{ ?> <option value="">Select Category</option><?php } ?>
		<?php echo getfeecat("",1); ?>
            </select>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display:none; " id="comp">
						  	  <label for="heard">Payment Component</label>
                            	  <select name='fee' id="fee" class="form-control" <?php echo $show; ?> >
                            <option value="">Select Component</option>
						<?php $resultfee = mysqli_query($condb,"SELECT * FROM ftype_db   ORDER BY f_type  ASC");
while($rsfee = mysqli_fetch_array($resultfee)){ echo "<option value='$rsfee[id]'>$rsfee[f_type]</option>";}?></select>
                      </div>
                  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Search Category </label>
                      <select name='categ2' id="categ2" class="form-control"  >
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
<?php echo fill_sec(); ?></select></div>
       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display: none;"  id="enable6">
						  	  <label for="heard">Level </label>
                            	  <select name='level' id="status" class="form-control" >
                            <option value="">Select Level</option>
                      <?php $resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2)){ echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	}
?></select></div>
 <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display: none;"  id="enable3">
						  	  <label for="heard">From </label>
<input  type="text" name="pdate" size="25"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed1"   readonly="readonly" style="height:32px;"></div>
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display: none;"  id="enable4">
						  	  <label for="heard">To</label>
<input  type="text" name="pdate2" size="25"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed"   readonly="readonly" style="height:32px;"></div>
          
              
<div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
 <?php   if (authorize($_SESSION["access3"]["fIn"]["forms"]["view"])){ ?> 
    <button  name="viewpayment"  id="viewpedger"  class="btn btn-primary" title="Click Here to Load Payment (s) " ><i class="fa fa-search"></i> Search  </button> <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#viewPay').tooltip('show');
	                                            $('#viewPay').tooltip('hide');
	                                            });     </script> <?php } ?>
 <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>  </div> 
 <div class="x_content" id="txtrbutton" >
                    
                    
                   <a class="btn btn-app" onclick="window.open('formSales.php?view=Report&q=ap5','_self')" style="display: none;" >
                      <i class="fa fa-calendar"></i> Management Summary
                    </a>
                  </div>
 
</div>
</form>

<div id="Summary" class="tabcontent" style="min-height: 300px;">
<form name='myForm' method="post">
<div id="print_content2"> <table><style type="text/css" media="print"> @media print { a[href]:after {content: none !important;}} @page {size: auto;margin: 0;}
                .row1 {
	background-color: #EFEFEF; border: 1px solid #98C1D1;height: 30px;	font-family:Verdana, Geneva, sans-serif; font-size:12px; }
.row2 {background-color: #DEDEDE;border: 1px solid #98C1D1;height: 30px;font-family:Verdana, Geneva, sans-serif; font-size:12px; }
					  </style> 
  <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>Final Payment Summary <strong></strong>. </div>
                <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"  id="cat" >
<label for="heard">Payment Category</label>
<select  name="fcate" id="fcate" class="form-control" onchange="showreport(this.value)" required ><?php if ($fID > 0) { ?>
<option value="<?php echo $row_ft['f_category']; ?>"><?php echo getfeecat($row_ft['f_category']); ?></option><?php }else{ ?> <option value="">Select Category</option><?php } ?>
		<?php echo getfeecat("",1); ?>
            </select>
                      </div>
  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
						  	  <label for="heard">Academic Session </label>
<select class="form-control"   name="session" id="session"  ><option value="">Select Session</option>
<?php echo fill_sec(); ?></select></div>
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
						  	  <label for="heard">Level </label>
                            	  <select name='level' id="status" class="form-control" >
                            <option value="">Select Level</option>
                      <?php $resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2)){ echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	}
?></select></div>       
    <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" ><div id="cccv2" >
 <?php   if (authorize($_SESSION["access3"]["fIn"]["forms"]["view"])){ ?> 
    <button   name="vfpay" id="vfpay" type = 'submit'  class="btn btn-primary" title="Click to Generate Payment Summary" ><i class="fa fa-search"></i> Search  </button> 
   
    <a href="#" onClick="return Clickheretoprint();" class="btn btn-info"  id="delete2" data-placement="right" title="Click to preview select record" style="display: none;"><i class="fa fa-print icon-large"></i> Preview</a>
    <script type="text/javascript">$(document).ready(function(){
	                                            $('#searchrem').tooltip('show');
	                                            $('#searchrem').tooltip('hide');
	                                            });     </script> <?php } ?>
                                                
  </div></div>
  <div	id="ccc22"></div>
 <div style="width: 100%;" style="overflow: auto;" id = 'ajaxDiv2'>
</div> </table> </div>                 
 </form>
</div>


<div id="Paris" class="tabcontent" style="min-height: 300px;" >

 <form name='myForm2'>
<table><style type="text/css" media="print"> @media print { a[href]:after {content: none !important;}} @page {size: auto;margin: 0;}
                .row1 {
	background-color: #EFEFEF; border: 1px solid #98C1D1;height: 30px;	font-family:Verdana, Geneva, sans-serif; font-size:12px; }
.row2 {background-color: #DEDEDE;border: 1px solid #98C1D1;height: 30px;font-family:Verdana, Geneva, sans-serif; font-size:12px; }
					  </style> 
  <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>Generate Remittance Summary <strong></strong>. </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
<label for="chkPenalty"> </label><br><br><label class="chkPenalty">
<input type="checkbox" id="chkPenalty"  name="chkPenalty" value="1" disabled /> Payment Date : </label></div>
  
                    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"   id="enable3">
						  	  <label for="heard">From: </label>
<input  type="text" name="pdate3" size="25"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed2"   readonly="readonly" style="height:32px;" required></div>
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"  id="enable4">
						  	  <label for="heard">To:</label>
<input  type="text" name="pdate4" size="25"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed3"   readonly="readonly" style="height:32px;" required></div>
          
    <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" ><div id="cccv" >
 <?php   if (authorize($_SESSION["access3"]["fIn"]["forms"]["view"])){ ?> 
    <button   id="searchrem" type="button" onclick = 'ajaxFunction2()' class="btn btn-primary" title="Click to Generate Remittance Summary" ><i class="fa fa-search"></i> Search  </button> 
    	   <button  name="print" type="button"  onclick ="return Clickheretoprint();"  class="btn btn-primary" title="Click to print Remittance Summary" ><i class="fa fa-print"></i> Printable version  </button>
  <?php } ?>
                                                
  </div></div>
  <div	id="ccc2"></div><div id="ccc3"></div><div id="print_content">
 <div style="width: 100%;" style="overflow: auto;" id = 'ajaxDiv'>
</div></div>  </table> </form>                
 </div>
 <script type="text/javascript">$(document).ready(function(){
	                                            $('#searchrem').tooltip('show');
	                                            $('#searchrem').tooltip('hide');
	                                            });     </script>
 
   <!-- </form> -->
</div>
 </div>
                  
                 <script  language = "javascript" type = "text/javascript">



  
    </script>
    
    
                 
                  