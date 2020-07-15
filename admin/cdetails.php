
<?php 
include('lib/dbcon.php'); 
dbcon(); 
$user_candi = mysqli_query($condb,"select * from candidate_tb c LEFT JOIN student_tb s ON c.regno = s.RegNo WHERE c.candid  = '".safee($condb,$_GET['id'])."'")or die(mysqli_error($condb));
$row_cand = mysqli_fetch_array($user_candi); $is_active = $row_cand['approve']; $is_activeresult = $row_cand['approve_result'];
$picget = $row_cand['image'];$existsc = imgExists($picget); $date_now =  date("Y-m-d");
$queryprog2 = mysqli_query($condb,"SELECT * FROM electiontb where eend >'".$date_now."' and id = '".$row_cand['ecate']."' ");
    $countersac2 = mysqli_num_rows($queryprog2); 
 ?>

 <div class="modal-header">

                        
                          <h4 class="modal-title" id="myModalLabel"><center><?php echo getecate($row_cand['ecate']) ;?> Candidate Information </center></h4>
                        </div>
                        
    
		<div>
		   
	



<div class="col-sm-12" style="overflow:auto;height:400px;">
<div class="left col-xs-10">
	<form method="post"  action="" enctype="multipart/form-data" >
	<input type="hidden" name="insidmove" value="<?php echo $_SESSION['insidmove'];?> " />
	<input type='hidden' name='fee_str_id[]' value='$rs[id]' >

<img src="<?php  if ($existsc > 0 ){
	echo "".$row_cand['image'];
	}else{ print "./uploads/NO-IMAGE-AVAILABLE.jpg";}

				 
?>" alt=""  width="250px;" height="200px">
<h2 style="text-shadow:-1px 1px 1px #000; color:blue;"><?php echo ucwords($row_cand['fname']).'  '.ucwords($row_cand['lname']); ?></b> </h2>
<p><strong>Reg / Matric No: </strong> <?php echo $row_cand['regno'] ;?>  </p>
<p><strong>No of Votes: </strong> <?php echo $row_cand['votes'] ;?>  </p>
<p><strong>Gender: </strong> <?php echo $row_cand['Gender'] ;?></p>
<p><strong>CGPA: </strong> <?php echo ($row_cand['cgpa']) ;?></p>
<p><strong>Position :</strong> <?php echo getelectpost($row_cand['post']) ;?></p>
<p><strong><?php echo $SCategory; ?> :</strong> <?php echo getfacultyc($row_cand['fac']) ;?></p>
<p><strong>Department: </strong> <?php echo getdeptc($row_cand['dept']) ;?></p>

</div>

</div>
	<div class="modal-footer">
					<a href="election.php?view=candidates" class="btn btn-info" ><i class="fa fa-remove"></i>&nbsp;Close</a>
					<?php if($countersac2 == "0"){ ?>
					<a href="javascript:changeUserStatus8(<?php echo $_GET['id']; ?>, '<?php echo $is_activeresult; ?>');" class="btn btn-info" ><i class=" <?php echo $is_activeresult == '0'? 'fa fa-check' : 'fa fa-remove'; ?>"></i>&nbsp;<?php echo $is_activeresult == '0'? 'Approve' : 'Decline'; }?></a>
<script type="text/javascript">
		              $(document).ready(function(){
		              $('#com').tooltip('show');
		              $('#com').tooltip('hide');
		              });
		             </script>
					</div>
					
					</form>
				
					
		</div>
					 
