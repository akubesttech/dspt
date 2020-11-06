



<?php
if(isset($_POST['viewOrder'])){
$sprog1 = $_POST['f_pro'];
$paydate = $_POST['pdate'];
//$salot_los = $_POST['los'];
$salot_session = $_POST['session'];
$result_alldept = mysqli_query($condb,"SELECT * FROM fshop_tb WHERE session ='".safee($condb,$salot_session)."' and ftype ='".safee($condb,$sprog1)."'");
//$result_alldept = mysqli_query($condb,$sql_alldept);
$num_alldept = mysqli_num_rows($result_alldept);
//	$_SESSION['vsession']=$salot_session;

if($num_alldept < 1){
	message("No Order Record Found for ".getprog($sprog1)." Programm in $salot_session , Please Try Again", "error");
		        redirect('formSales.php?view=formOrder'); 
      
}else{
	$_SESSION['vsession']=$salot_session;

echo "<script>window.location.assign('formSales.php?view=fDetails&xpo=".($sprog1)."&xsec=".($salot_session)."&xdop=".$paydate."');</script>";}

}
?>

<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="user" method="post" enctype="multipart/form-data" id="user">
<input type="hidden" name="insidtime" value="<?php echo $_SESSION['insidtime'];?> " />
                      
                      <span class="section">Search Record </span>
<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback"  >
						  	  <label for="heard"   id="enable3" >Fee Type *</label>
          <select name='fee' id="fee" class="form-control" onchange="getformamount(this.value)" required>
                            <option value="">Select Fee</option>
                           <?php 
$resultfee = mysqli_query($condb,"SELECT * FROM ftype_db WHERE f_category = '3'  ORDER BY f_type  ASC");
while($rsfee = mysqli_fetch_array($resultfee)){ echo "<option value='$rsfee[id]'>$rsfee[f_type]</option>";}?>
                        </select>
                      </div>
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Program *</label>
                            	  <select name='f_pro' id="f_pro" class="form-control" required>
                            <option value="">Select Program</option>
                            <?php  $resultproe = mysqli_query($condb,"SELECT * FROM prog_tb  ORDER BY Pro_name  ASC");
while($rsproe = mysqli_fetch_array($resultproe)){echo "<option value='$rsproe[pro_id]'>$rsproe[Pro_name]</option>";}?>
                            </select>
                      </div>
   
  <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Academic Session *</label>
							   <select class="form-control"   name="session" id="session" required >
  <option value="">Select Session</option>
<?php echo fill_sec(); ?></select></div>
       
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
                        <button  name="viewOrder"  id="viewOrder"  class="btn btn-primary col-md-4" title="Click Here to Load form sales record" ><i class="fa fa-search"></i> GO  </button>
<a rel="tooltip"  title="View form Order Details" id="<?php echo $new_a_id; ?>"  onclick="window.open('formSales.php?view=fDetails','_self')" data-toggle="modal" class="btn btn-info"><i class="fa fa-search-plus"> View Most recent Order</i></a>                       

                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#viewPay').tooltip('show');
	                                            $('#viewPay').tooltip('hide');
	                                            });
	                                            </script> <?php } ?>
	                                              <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 
                  