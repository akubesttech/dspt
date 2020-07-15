 <?php
 	$status = FALSE;
if ( authorize($_SESSION["access3"]["sConfig"]["aem"]["create"]) || 
authorize($_SESSION["access3"]["sConfig"]["aem"]["edit"]) || 
authorize($_SESSION["access3"]["sConfig"]["aem"]["view"]) || 
authorize($_SESSION["access3"]["sConfig"]["aem"]["delete"]) ) {
 $status = TRUE;
}
if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}
if(isset($_POST['modename'])){
$modename = ucfirst($_POST['modename']);
$mdesc = ucfirst($_POST['mdesc']);
$entrylevel = $_POST['elevel'];
$query_f = mysqli_query($condb,"select * from mode_tb where entrymode = '".safee($condb,$modename)."'")or die(mysqli_error($condb));
$row_fee = mysqli_num_rows($query_f); 
if ($row_fee>0){
message("The Mode Entered  Already Exist please Try Again".$modename, "error");
			redirect('add_Courses.php?view=addMode');
				}else{

mysqli_query($condb,"insert into mode_tb (entrymode,mdesc,entrylevel) values('".safee($condb,$modename)."','".safee($condb,$mdesc)."','".safee($condb,$entrylevel)."')")or die(mysqli_error($condb));
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'".safee($condb,$admin_username)."','entry mode Titled $modename was Added')")or die(mysqli_error($condb)); 
// ob_start();
 message("New Mode [$modename] was Successfully Added", "success");
			redirect('add_Courses.php?view=addMode');
}
}
?>
 <div class="x_panel"><div class="x_content">
 <form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
                <div class="row">
  <span class="section">Add Entry Mode </span>

<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Mode Name </label>
                  <input type="text" class="form-control " name='modename' id="modename"  value=""  required="required"> </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Mode Description </label>
                  <input type="text" class="form-control " name='mdesc' id="mdesc"  value=""  required="required"> </div>
                   <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
<label for="heard">Entry Level</label> <input type="text" class="form-control " name='elevel' id="elevel"  value="" maxlength="3" placeholder="example : 100,200 ..." onkeypress="return isNumber(event);"  required="required">  </div>
                  
			<?php   if (authorize($_SESSION["access3"]["sConfig"]["aem"]["create"])){ ?>	 <button  name="savemode"  id="savemode"  class="btn btn-primary col-md-4" title="Click Here to Save " ><i class="fa fa-plus"></i> Save</button><?php } ?>
				</div></form> </div></div>
<div class="x_panel">
                  <div class="x_title">
                 
                    <h2> list of entry Mode </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  
 <!--    <p class="text-muted font-13 m-b-30"> </p> --!>
                    
                    
                    <div class="row" >
 <div class="col-md-12" > 
 
       <form action="Delete_mode.php" method="post">
       <div id="cccv" ><?php   if (authorize($_SESSION["access3"]["sConfig"]["aem"]["delete"])){ ?>
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#delete_mode" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a> <?php } ?>
                    	<a rel="tooltip"  href="javascript:void(0);" title="Print Courses"  onClick="return Clickheretoprint();" class="btn btn-default"><i class="fa fa-print icon-large"> Print</i></a>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show');
									 $('#delete').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?> </div><div	id="ccc2"></div>
										<div id="print_content">
										<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" border="1">
										<?php 	if ($i%2) {$class = 'row1';} 
	else {$class = 'row2';}
	$i += 1; 

                $query = "select * from mode_tb order by entrymode";
                $result = mysqli_query($condb,$query);
                $count = 1;
                
            ?>
	
                      <thead id="ccc3">
                        <tr>
                         <th> <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> </th>
                           <th>S/N</th>
                          <th>Mode</th>
						  <th>mode description</th>
						  <th>Entry Level</th>
                          
                        </tr>
                      </thead>
					    <tbody> 
						<?php while($row = mysqli_fetch_array($result) ){
                    $id = $row['id']; $emode = $row['entrymode']; $mdesc1 = $row['mdesc']; $elevel = $row['entrylevel']; ?>              
					    <tr class="<?php echo $class; ?>">
<td width="30"><input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>"></td>
<td width="30"> <?php echo $count; ?></td>
<td><div class='edit' > <?php echo $emode; ?></div> 
                            <input type='text' class='txtedit' value='<?php echo $emode; ?>' id='entrymode_<?php echo $id; ?>' ></td>
 <td><div class='edit' ><?php echo $mdesc1; ?> </div> 
                            <input type='text' class='txtedit' value='<?php echo $mdesc1; ?>' id='mdesc_<?php echo $id; ?>' ></td>
                            <td><div class='edit' ><?php echo $elevel; ?> </div> 
                            <input type='text' class='txtedit' value='<?php echo $elevel; ?>' id='entrylevel_<?php echo $id; ?>' maxlength='3' ></td>
                        </tr><?php  $count ++; } ?></tbody></div></form>
					</table>
					</div>
				
				</div> </div>
				
				
				
                  </div>
                </div>
