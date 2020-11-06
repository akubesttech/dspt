

<script type="text/javascript">

</script>





<div class="x_panel">
                
             
                <div class="x_content">
	                <form method="get" class="form-horizontal"  action="" enctype="multipart/form-data">
                    
                      
                  <!--    <span class="section">Search  Record</span> --!>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Note: That this will enable Admin to search Payment Record By Department. 
                  </div>
   
					    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard"><?php echo $SCategory; ?> </label>
						  	  
                            	  <select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" >
                            <option value="">Select <?php echo $SCategory; ?></option>
                            <?php  

$resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//$counter=1;
while($rsblocks = mysqli_fetch_array($resultblocks))
{if($_GET['loadfac'] ==$rsblocks['fac_id'] ){
	echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";}
else{echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";}}?>
                            </select>
                      </div>
                     
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard"><?php echo $SGdept1; ?></label>
                            	  <select name='dept1_find' id="dept1" required="required" class="form-control"  >
                           <option value=''>Select <?php echo $SGdept1; ?></option>
                          </select>
                      </div>
                      
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Academic Session</label>
                            <select name="session2" id="session2"  required="required" class="form-control">
  <option value="">Select Session</option>
<?php echo fill_sec(); ?>
</select>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Date Of Payment</label>
                            	    <input  type="text" name="dop" size="18" style="height:32px;"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed1"   readonly="readonly">
                            	  
                      </div>
                      
                     
                    
             
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">  <?php   if (authorize($_SESSION["access3"]["fIn"]["conp"]["view"])){ ?> 
                         <button type="submit" name="Search"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click To Search By Department " ><i class="fa fa-cloud"></i> Search Record</button>
                 <a rel="tooltip"  title="View Most recent Payment(s)" id="<?php echo $new_a_id; ?>"  onclick="window.open('View_Payment.php','_self')" data-toggle="modal" class="btn btn-info"><i class="fa fa-search-plus"> View Most recent Payment(s)</i></a>        
                        <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script><?php } ?>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                      </div>
                    </form>
                  </div>
                  