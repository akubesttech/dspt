
<script type="text/javascript">   
$(document).ready(function() {   
$('#level').change(function(){   
if($('#level').val() === 'Others')   
   {   
   $('#otherl').show(); 
      $('#other2').show();    
   }   
else 
   {   
   $('#otherl').hide(); 
      $('#other2').hide();      
   }   
});   
});   
</script>

<?php

if(isset($_POST['addbank'])){
$b_name= ucwords($_POST['b_name']);
$acc_name = $_POST['acc_name'];
$acc_num = $_POST['acc_num'];
$b_sort = $_POST['b_sort'];
$b_code = $_POST['b_code'];
$f_cat = $_POST['fcate'];
$query_bank = mysqli_query($condb,"select * from bank where b_name = '$b_name' AND f_cate = '$f_cat' ")or die(mysqli_error($condb));
//$row = mysql_fetch_array($query);
$row_bank = mysqli_num_rows($query_bank);
if ($row_bank>0){
message("ERROR:The Bank Entered  Already Exist Try Again!", "error");
		       redirect('add_Bank.php');
//echo "<script>alert('Applicationform record inserted sucessfully..');</script>";
				}elseif(!ctype_digit($acc_num)){
				message("ERROR:Incorrect Format For Account Number it should be a Digit!", "error");
		       redirect('add_Bank.php');
}elseif(!ctype_digit($b_sort)){
	message("ERROR:Incorrect Format For Bank Sort Code it should be a Digit!", "error");
		       redirect('add_Bank.php');
	
}else{
//if($level=="Others"){
mysqli_query($condb,"insert into bank (b_name,acc_name,acc_num,b_sort,b_code,f_cate) values('$b_name','$acc_name','$acc_num','$b_sort','$b_code',$f_cat)")or die(mysqli_error($condb));

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Bank Titled $b_name was Add')")or die(mysql_error()); 
 ob_start();
 message("ERROR:New Bank Details was Successfully Added", "success");
		       redirect('add_Bank.php');

}
}
?>

<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="bank" method="post" enctype="multipart/form-data" id="dept">
<input type="hidden" name="insidd" value="<?php echo $_SESSION['insidd'];?> " />
                      
                      <span class="section">Add New Bank <?php
//if($resi == 1){echo " <center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res</font></label></center>";}
?> </span>


 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Bank Name</label>
                            	  <input type="text" class="form-control " name='b_name' id="b_name"  required="required">
                      </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Account Name </label>
                            	  <input type="text" class="form-control " name='acc_name' id="acc_name"  required="required">
                      </div>
                      
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Account Number </label>
                            	  <input type="text" class="form-control " name='acc_num' id="acc_num" onkeypress="return isNumber(event);"  >
                      </div>
 
 <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Bank Sort Code </label>
                            	  <input type="text" class="form-control " name='b_sort' id="b_sort" onkeypress="return isNumber(event);"  >
                      </div>
                      
                      
 <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Bank Code </label>
                            	  <input type="text" class="form-control " name='b_code' id="b_code"   >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
					    <label for="heard">Fee Category</label>
						  	  <select  name="fcate" id="fcate" class="form-control" ><?php if ($fID > 0) { ?>
<option value="<?php echo $row_ft['f_category']; ?>"><?php echo getfeecat($row_ft['f_category']); ?></option><?php }else{ ?> <option value="">Select Category</option><?php } ?>
		<?php echo getfeecat("",1); ?>
            </select>
                      </div>
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
                         <?php   if (authorize($_SESSION["access3"]["sConfig"]["abk"]["create"])){ ?>
                        <button  name="addbank"  id="addbank"  class="btn btn-primary col-md-4" title="Click Here to Save Bank Details" ><i class="fa fa-sign-in"></i> Add Bank</button> <?php } ?>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addbank').tooltip('show');
	                                            $('#addbank').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 