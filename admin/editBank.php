
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
$fID = isset($_GET['id']) ? $_GET['id'] : '';
if(isset($_POST['editbank'])){
$b_name= ucwords($_POST['b_name']);
$acc_name = $_POST['acc_name'];
$acc_num = $_POST['acc_num'];
$b_sort = $_POST['b_sort'];
$b_code = $_POST['b_code'];
$f_cat = $_POST['fcate'];

$query_bank = mysqli_query($condb,"select * from bank where b_name = '$b_name' AND f_cate = '$f_cat' ")or die(mysqli_error($condb));
//$row = mysql_fetch_array($query);
$row_bank = mysqli_num_rows($query_bank);
if ($row_bank>1){
message("The Bank Entered  Already Exist Try Again", "error");
		       redirect('add_Bank.php?id='.$get_RegNo);
//echo "<script>alert('Applicationform record inserted sucessfully..');</script>";
				}elseif(!ctype_digit($acc_num)){
				message("Incorrect Format For Account Number it should be a Digit", "error");
		       redirect('add_Bank.php?id='.$get_RegNo);
}elseif(!ctype_digit($b_sort)){
	message("Incorrect Format For Bank Sort Code it should be a Digit", "error");
		       redirect('add_Bank.php?id='.$get_RegNo);
}else{
//if($level=="Others"){
mysqli_query($condb,"update bank set b_name='$b_name',acc_name='$acc_name',acc_num='$acc_num',b_sort='$b_sort',b_code = '$b_code',f_cate = '$f_cat' where b_id='$get_RegNo'")or die(mysqli_error($condb));
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Bank Titled $b_name was Updated')")or die(mysqli_error($condb)); 
 ob_start();
 message("$b_name has Updated successfully!", "success");
		       redirect('add_Bank.php?id='.$get_RegNo);

}
}
?>
<?php //$s=3;while($s>0){ $AppNo .= rand(0,9);$s-=1;} ?>
<div class="x_panel">
                
             
                <div class="x_content">
<?php
								$query_f21 = mysqli_query($condb,"select * from bank where b_id ='$get_RegNo' ")or die(mysqli_error($condb));
								$row_b = mysqli_fetch_array($query_f21);
								?>
                    		<form name="bank" method="post" enctype="multipart/form-data" id="dept">
<input type="hidden" name="insidd" value="<?php echo $_SESSION['insidd'];?> " />
                      
                      <span class="section">Edit Bank Details
 </span>


 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Bank Name</label>
                            	  <input type="text" class="form-control " name='b_name' id="b_name" value="<?php echo $row_b['b_name']; ?>"  required="required">
                      </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Account Name </label>
                            	  <input type="text" class="form-control " name='acc_name' id="acc_name" value="<?php echo $row_b['acc_name']; ?>"  required="required">
                      </div>
                      
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Account Number </label>
                            	  <input type="text" class="form-control " name='acc_num' id="acc_num" value="<?php echo $row_b['acc_num']; ?>" onkeypress="return isNumber(event);"  >
                      </div>
 
 <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Bank Sort Code </label>
                            	  <input type="text" class="form-control " name='b_sort' id="b_sort" value="<?php echo $row_b['b_sort']; ?>" onkeypress="return isNumber(event);"  >
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Bank Code </label>
                            	  <input type="text" class="form-control " name='b_code' id="b_code" value="<?php echo $row_b['b_code']; ?>"   >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
					    <label for="heard">Fee Category</label>
						  	  <select  name="fcate" id="fcate" class="form-control" ><?php if ($fID > 0) { ?>
<option value="<?php echo $row_b['f_cate']; ?>"><?php echo getfeecat($row_b['f_cate']); ?></option><?php }else{ ?> <option value="">Select Category</option><?php } ?>
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
                        <?php   if (authorize($_SESSION["access3"]["sConfig"]["abk"]["edit"])){ ?> 
                        <button  name="editbank"  id="editbank"  class="btn btn-primary col-md-4" title="Click Here to Edit Bank Details" ><i class="fa fa-sign-in"></i> Edit Bank</button> <?php } ?>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#editbank').tooltip('show');
	                                            $('#editbank').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 