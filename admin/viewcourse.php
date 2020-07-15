 <div class="x_panel"><div class="x_content">
                <div class="row">
  <div class="alert alert-success alert-dismissable">
                            <i class="fa fa-exclamation-circle"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                           Please Select Appropriate <?php echo $SCategory; ?> and Department to load Course!
                            </div>
				 <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard"><?php echo $SCategory; ?> </label>
			<select name='fac1' id="fac1" onchange='loadd(this.name);return false;' class="form-control" required="required"  >
                            <option value="">Select <?php echo $SCategory; ?></option>
                            <?php  

$resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//$counter=1;
while($rsblocks = mysqli_fetch_array($resultblocks))
{if($_GET['loadfac'] ==$rsblocks['fac_id'] ){echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";
//	$counter=$counter+1;
	}else{ echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>"; } }
?>
                            
                          
                          </select>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard"><?php echo $SGdept1; ?></label>
        <select name='dept1' id="dept1" onchange='loadctable(this.name);return false;' selected="selected" class="form-control" required="required" > 
       <!-- <select name='dept1' id="dept1"  selected="selected" class="form-control" required="required" >--!>
                           <option value=''>Select <?php echo $SGdept1; ?></option>
                          </select>
                      </div>
				<div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
				</div> </div></div>
<div class="x_panel">
                  <div class="x_title">
                 
                    <h2> list of Courses </h2>
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
 
       <form action="Delete_course.php" method="post">
       <div id="cccv" ><?php   if (authorize($_SESSION["access3"]["sConfig"]["avc"]["delete"])){ ?> 
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#Course_delete" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a> <?php } ?>
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
                      <thead id="ccc3">
                        <tr>
                         <th> <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> </th>
                          <th><?php echo $SGdept1; ?></th>
						  <th>Course Title</th>
                          <th>Course Code</th>
                          <th>Credit Unit</th>
                          <th>Semester</th>
                          <th>Level</th>
                         
                          <th >Action</th>
                        </tr>
                      </thead>
					    <tbody id="loadn1" >               
					    <?php include("loadcoursetable.php"); ?>
					     </tbody></div></form>
					    
				 
                    </table>
					</div>
				
				</div> </div>
				
				
				
                  </div>
                </div>
