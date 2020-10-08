
<?php  include('header.php'); ?>
<?php include('session.php');
	$status = FALSE;
if ( authorize($_SESSION["access3"]["sConfig"]["agd"]["create"]) || 
authorize($_SESSION["access3"]["sConfig"]["agd"]["edit"]) || 
authorize($_SESSION["access3"]["sConfig"]["agd"]["view"]) || 
authorize($_SESSION["access3"]["sConfig"]["agd"]["delete"]) ) {
 $status = TRUE;
}
 ?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} ?>
  <?php $get_RegNo= $_GET['id']; ?>
   <script type="text/javascript">
 window.onload = function (){
 if($('#ggroup').val() === '01')   
   {   
    $('#grade').show(); 
      $('#gpoint').show();
	   $('#ggroup').select(); 
	   $('#gmark').show(); 
      $('#gstatus').hide(); 
	  $('#gpmin').show(); 
      $('#gpmax').show();
      $('#smin').show();
      $('#smax').show();
       $('#gastatus').hide();   
   }else if($('#ggroup').val() === '03'){
    $('#grade').hide(); 
      $('#gpoint').hide();
	   $('#ggroup').select(); 
	   $('#gmark').hide(); 
      $('#gstatus').hide();
      $('#gastatus').show();
      $('#smin').hide();
      $('#smax').hide();
	   $('#gpmin').show(); 
      $('#gpmax').show();
}else{   
    $('#grade').hide(); 
      $('#gpoint').hide();
	   $('#ggroup').select(); 
	   $('#gmark').hide(); 
      $('#gstatus').show();
	   $('#gpmin').hide(); 
      $('#gpmax').hide();
      $('#smin').show();
      $('#smax').show();
       $('#gastatus').hide();      
   }   
 }
    
/* $(document).ready(function() {   
$('#ggroup').change(function(){   
if($('#ggroup').val() === '01')   
   {   
    $('#grade').show(); 
      $('#gpoint').show();
	   $('#ggroup').select(); 
	   $('#gmark').show(); 
      $('#gstatus').hide(); 
	  $('#gpmin').show(); 
      $('#gpmax').show();   
   }   
else 
   {   
    $('#grade').hide(); 
      $('#gpoint').hide();
	   $('#ggroup').select(); 
	   $('#gmark').hide(); 
      $('#gstatus').show();
	   $('#gpmin').hide(); 
      $('#gpmax').hide();      
   }   
});   
}); */

 $(document).ready(function() {   
$('#ggroup').change(function(){   
if($('#ggroup').val() === '01')   
   {   
    $('#grade').show(); 
      $('#gpoint').show();
	   $('#ggroup').select(); 
	   $('#gmark').show(); 
      $('#gstatus').hide(); 
	  $('#gpmin').show(); 
      $('#gpmax').show();
      $('#smin').show();
      $('#smax').show();
       $('#gastatus').hide();   
   }else if($('#ggroup').val() === '03'){
    $('#grade').hide(); 
      $('#gpoint').hide();
	   $('#ggroup').select(); 
	   $('#gmark').hide(); 
      $('#gstatus').hide();
      $('#gastatus').show();
      $('#smin').hide();
      $('#smax').hide();
	   $('#gpmin').show(); 
      $('#gpmax').show();
}else{   
    $('#grade').hide(); 
      $('#gpoint').hide();
	   $('#ggroup').select(); 
	   $('#gmark').hide(); 
      $('#gstatus').show();
	   $('#gpmin').hide(); 
      $('#gpmax').hide();
      $('#smin').show();
      $('#smax').show();
       $('#gastatus').hide();      
   }   
});   
});   
</script>

    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>School grade Management
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
					$num=$get_RegNo;
				if ($num!==null){
			include('editgrade.php');
			}else{
			
				include('addgrade.php'); }?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2> List of Available Grade Data </h2>
                    
                            
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                            <i class="fa fa-exclamation-circle"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Note!: The Grade set determine the Student Grade structure i.e 65 to 70 :B .etc and Grade status determine the admission status of student base on average score (Admitted,Not Admitted or pending).
                            </div></div>
                    <form action="Delete_grade.php" method="post">
                   <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <?php   if (authorize($_SESSION["access3"]["sConfig"]["agd"]["delete"])){ ?>
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#delete_grade" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a> <?php } ?>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show');
									 $('#delete').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></th>
                          <th>Programme</th>
                          <th>Grade Group</th>
                          <th>grade</th>
						   <th>Grade Remark</th> 
                           <th>gp/gs</th>
                           <th>bound min</th>
                        <th>bound max</th>
                          <th>gpa min</th>
                        <th>gpa max</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                       <?php
													$user_query = mysqli_query($condb,"select * from grade_tb Order by prog ASC")or die(mysqli_error($condb)); while($row_s = mysqli_fetch_array($user_query)){$id = $row_s['id']; 
							//	$date_now = new DateTime(); $date2    = new DateTime($setend2);
								//$date_now = date("Y-m-d");
													?>
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
											
                          <td><?php echo getprog($row_s['prog']); ?></td>
                          <td><?php echo getggroup($row_s['grade_group']); ?></td>
                          <td><?php echo $row_s['grade']; ?></td>
                          <td><?php if($row_s['grade_group'] =="03"){ echo getAcastatus($row_s['gradename']);}else{ echo $row_s['gradename'];} ?></td>
                          <td><?php echo $row_s['gp']; ?></td>
                          <td><?php echo $row_s['b_min']; ?></td>
                        <td><?php echo $row_s['b_max'];  ?></td>
                        <td><?php echo $row_s['gpmin']; ?></td>
                        <td><?php echo $row_s['gpmax'];  ?></td>
                    <td width="120">
										<?php   if (authorize($_SESSION["access3"]["sConfig"]["agd"]["edit"])){ ?>		<a rel="tooltip"  title="Edit Selected Grade" id="<?php echo $id; ?>" onClick="window.location.href='add_grade.php<?php echo '?id='.$id; ?>';"  data-toggle="modal" class="btn btn-success"><i class="fa fa-pencil icon-large">edit</i></a> <?php } ?>
												</td>
                        </tr>
                     
                        <?php } ?>
                      </tbody>
                      	</form>
                    </table>
                  </div>
                </div>
              </div>



            
            
          </div>
        </div>
        <!-- /page content -->
        
  
         <?php include('footer.php'); ?>