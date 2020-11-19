

<?php
$fID = isset($_GET['id']) ? $_GET['id'] : '';
if(isset($_POST['addfeed'])){
 $f_typea = $_POST['f_typea'];
 $f_desca = $_POST['f_desca'];
 $fcate = $_POST['fcate'];
  $status = $_POST['status'];
//$curdateset=date("Y-m-d");
$currentdate_ts = strtotime($Sstart);
$Send2 = strtotime($Send);
$query = mysqli_query($condb,"select * from ftype_db where f_type = '".safee($condb,$f_typea)."'")or die(mysqli_error($condb));
$row_course = mysqli_num_rows($query);
if ($fID > 0) {
if ($row_course >1){
message("The Fee type <strong> $f_typea </strong>    Already Exist please Try Again.", "error");
		        redirect('user_Private.php?view=apt');
			}else{
			mysqli_query($condb,"update  ftype_db set f_type='".safee($condb,$f_typea)."',d_desc='".safee($condb,$f_desca)."',f_category='".safee($condb,$fcate)."',status='".safee($condb,$status)."' where id ='".safee($condb,$fID)."'") or die(mysqli_error($condb));
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Fee type Titled $f_typea was Updated')")or die(mysqli_error($condb));
 message("Fee Type was Successfully Updated", "success");
		        redirect('user_Private.php?view=Aftype');}}else{
				 if ($row_course>0){
message("The Fee type <strong> $f_typea </strong>    Already Exist please Try Again.", "error");
		        redirect('user_Private.php?view=apt');
			}else{
mysqli_query($condb,"insert into ftype_db(f_type, d_desc, f_category, status) VALUES('".safee($condb,$f_typea)."','".safee($condb,$f_desca)."','".safee($condb,$fcate)."','".safee($condb,$status)."')")or die(mysqli_error($condb));
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Fee type Titled $f_typea was Add')")or die(mysqli_error($condb));
 message("New Fee Type was Successfully Added", "success");
		        redirect('user_Private.php?view=Aftype');}
	 } }
?>
<div class="x_panel">
                <div class="x_title">
                 
                    <h2> <?php echo ($fID > 0) ? "Edit Fee Type " : "Add Fee Type "; ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>  
             
                <div class="x_content">
<?php $query_ft = mysqli_query($condb,"select * from ftype_db where id = '".safee($condb,$fID)."' ")or die(mysqli_error($condb));
$row_ft = mysqli_fetch_array($query_ft); //$cpenalty= $row_ft['penalty'];
								?>
                    		<form name="register" method="post" enctype="multipart/form-data" id="register">
<input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard"> Fee Type</label>
    <input type="text" class="form-control "  id="f_typea" name="f_typea" maxlength="40"  value="<?php echo $row_ft['f_type']; ?>" placeholder="Fee type"   required="required">
                      </div>
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">Fee Description </label>
    <input type="text" class="form-control "  name="f_desca" id="f_desca" maxlength="150"  value="<?php echo $row_ft['d_desc']; ?>" placeholder="Fee Description"   required="required"></div>
  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" >
					    <label for="heard">Fee Category</label>
						  	  <select  name="fcate" id="fcate" class="form-control" ><?php if ($fID > 0) { ?>
<option value="<?php echo $row_ft['f_category']; ?>"><?php echo getfeecat($row_ft['f_category']); ?></option><?php }else{ ?> <option value="">Select Category</option><?php } ?>
		<?php echo getfeecat("",1); ?>
            </select>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                       <label for="heard">Fee Status</label><select  name="status" id="status" class="form-control" >
<?php if ($fID > 0) { ?><option value="<?php echo $row_ft['status']; ?>"><?php if($row_ft['status'] =="1"){echo "compulsory";}else{ echo "Optional";} ?></option><?php }else{ ?> <option value="">Select Status</option>
                       <?php } ?>
					   <option value="1">compulsory</option><option value="0">Optional</option></select>
                      </div>
 <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                    
                                     
                                       
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3"> <button  name="addfeed"  id="addfeed"  class="btn btn-primary col-md-4" title="Click Here to Save Fee Type Details" ><i class="fa fa-save"></i> Save </button>
                        <button  name="goback"  id="goback" type='button' onClick="window.location.href='user_Private.php?view=Aftype';" class="btn btn-primary col-md-4" title="Click Here View Fee Type" ><i class="fa fa-eye"></i> View Fee Type </button> 
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addfeed').tooltip('show');
	                                            $('#addfeed').tooltip('hide');$('#goback').tooltip('show');
	                                            $('#goback').tooltip('hide');
	                                            });
	                                            </script>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 