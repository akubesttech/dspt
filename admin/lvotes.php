
    <?php 
include('lib/dbcon.php'); 
dbcon();
if($_GET['nov'] > 10){ $ndown = "height:500px;";}else{$ndown = "";}
 ?>               
 <div class="modal-header">
      
                          <h4 class="modal-title" id="myModalLabel">Votes Breakdown for  <?php echo $_GET['cid']; ?> </h4>
                        </div>
                        <style>#resultTable {
	color: #666666;
    text-shadow: 0 1px 0 #FFFFFF;
	width: 100%;
	border: 1px solid #CCCCCC;
	box-shadow: 0 5px 5px -5px rgba(0, 0, 0, 0.3);
}
#resultTable thead tr th {
    background: none repeat scroll 0 0 #EEEEEE;
    color: #222222;
    padding: 10px 14px;
    text-align: left;
	border-top: 0 none;
	font-size: 12px;
}

#resultTable tbody tr td{
    background-color: #FFFFFF;
	font-size: 11px;
    text-align: left;
	padding: 10px 14px;
	border-top: 1px solid #DDDDDD;
}</style>
    
		<div class="modal-body" style="overflow:auto;<?php echo $ndown; ?>">
					<form method="post"  action="admin_pic.php" enctype="multipart/form-data">
					<?php
echo 'Name : '.getname($_GET['cid']).'<br>';
echo 'Election  : '.getecate($_GET['ecate']).'<br>';
echo 'Position : '.getelectpost($_GET['posit']).'<br>';
echo 'Number of Votes : '.$_GET['nov'].'<br>';
$dsds = getidreg($_GET['cid']);
?>							  
<table  id="resultTable" class="table table-striped table-bordered" style="font-size:12px;text-align:left; width: 500px;">
							    <thead>
                  <tr>
                         <th>S/N</th>
                          <th>Reg / Matric No</th>
                          <th>Name</th>
                          <th>Department</th>
                         
                        </tr>
				   </thead>
				   
				      <tbody>
				         <?php
				        $serial = 1 ;
				         $results = $DB2->prepare("SELECT * FROM votes WHERE candid = :a");
	$results->bindParam(':a', $dsds);
	$results->execute();
	for($i=0; $rows = $results->fetch(); $i++){
		$dddddd=$rows['voters_id'];
		$resultas = $DB2->prepare("SELECT * FROM student_tb WHERE stud_id = :j");
		$resultas->bindParam(':j', $dddddd);
		$resultas->execute();
		for($i=0; $rowas = $resultas->fetch(); $i++){
													///$user_query = mysqli_query($condb,"select * from staff_details")or die(mysqli_error($condb));
													//while($row_b = mysqli_fetch_array($user_query)){
													//$id = $row_b['staff_id'];
													?>
			   <tr>
                        	<td width="30"><?php echo $serial++; ?>
												</td>
												
                          <td><?php echo $rowas['RegNo']; ?></td>
                          <td><?php echo getname($rowas['RegNo']); ?></td>
                          <td><?php echo getdeptc($rowas['Department']); ?></td>
                          
												<script type="text/javascript">
									 $(document).ready(function(){
									 $('#choose_patient').tooltip('show');
									 $('#choose_patient').tooltip('hide');
									 });
									</script> 
                        </tr>
                        
                     	   <?php }} ?>
							    					
				   </tbody>
				</table>
		</div>
			
					<div class="modal-footer">
					<a href="election.php?view=candidates" class="btn btn-default" ><i class="fa fa-remove"></i>&nbsp;Close</a>
       <a href="election.php?view=candidates" class="btn btn-default" ><i class="fa fa-print"></i>&nbsp;Print</a>
                         <!-- <button  name="change" class="btn btn-primary"><i class="fa fa-check icon-large"></i>Yes</button> --!>
                        </div>
					
					</form>
				
                 

<!-- end  Modal -->