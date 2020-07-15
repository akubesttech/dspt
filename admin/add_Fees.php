
<?php  include('header.php'); ?>
<?php include('session.php'); 
$status = FALSE;
if ( authorize($_SESSION["access3"]["fIn"]["afee"]["create"]) || 
authorize($_SESSION["access3"]["fIn"]["afee"]["edit"]) || 
authorize($_SESSION["access3"]["fIn"]["afee"]["view"]) || 
authorize($_SESSION["access3"]["fIn"]["afee"]["delete"]) ) {
 $status = TRUE;
}
?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php') ;
	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}
	?>
  <?php $get_RegNo= $_GET['id']; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>School Payments Panel
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
					$num=$get_RegNo;
				if ($num!==null){
			include('editFee.php');
			}else{
			
				include('addFee.php'); }?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2> List Of Fees </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                  
                    </p>
                    <form action="Delete_fee.php" method="post">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#fee_delete" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
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
                          <th>Fee Type</th>
                          <th>Programme</th>
                       <!--  <th>Faculty</th>--!>
                          <th>Ing/None</th> 
                          <th>Level</th>
                          <th>Amount</th>
                          <th>penalty start date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                       <tbody>
 <?php
$user_query = mysqli_query($condb,"select * from fee_db WHERE program = '".safee($condb,$class_ID)."' Order by fee_id DESC")or die(mysqli_error($condb)); while($row_f = mysqli_fetch_array($user_query)){ $id = $row_f['fee_id'];  $dperc = $row_f['pper']; 
$psdate = $row_f['psdate']; $famount =$row_f['f_amount'];
$date20 = str_replace('/', '-', $psdate );  $newDate20 = date("Y-m-d", strtotime($date20));  $date_now =  date("Y-m-d");
$penaltysum = FeesCalc($famount,$dperc,$newDate20); $difp = $penaltysum - $famount ;
if($dperc > 0){ $noteo = number_format($famount,2) ." + ". number_format($difp,2) ." = <span class='badge bg-green'>".number_format($penaltysum,2)."</span> (".$dperc."% penalty inclusive )"; }else{ $noteo = "<span class='badge bg-green'>". number_format($famount,2)."</span>";} 
$timestamp = strtotime($newDate20);
$datetime	= date('l, jS F Y', $timestamp);
?>

                    
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
												
                          <td><?php echo getftype($row_f['feetype']);//." ".$row_f['feetype']; ?></td>
                          <td><?php echo getprog($row_f['program']); ?></td>
                           <td><?php if($row_f['Cat_fee'] =="1"){echo "Indigene";}else{ echo "Non Indigene";} ?></td>
                          <td><?php echo getlevel($row_f['level'],$class_ID); ?></td>
                         <!-- <td><?php //echo $row_f['f_fac']; ?></td> --!>
                         
<td><?php if($date_now >= $newDate20){ echo  $noteo ; }else{ echo number_format($famount,2) ;} ?></td>
<td><?php if(empty($psdate)){ echo "-----";}else{ echo $datetime;} ?></td>
                          <td width="120"> <?php   if (authorize($_SESSION["access3"]["fIn"]["afee"]["edit"])){ ?> 
												<a rel="tooltip"  title="Add fee Details" id="<?php echo $id; ?>" href="add_Fees.php<?php echo '?id='.$id; ?>"  data-toggle="modal" class="btn btn-success"><i class="fa fa-pencil icon-large"> Edit Record</i></a> <?php } ?>
												</td>
                        </tr> <?php  } ?>
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