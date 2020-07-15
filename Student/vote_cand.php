<?php 
//$_SESSION['sess']= $_POST['session'];
//$_SESSION['lev']= $_POST['level'];
//$_SESSION['seme']= $_POST['semester'];
?>
<style>
.clist{
        margin-left: 20px;
      }

      .cname{
        font-size: 25px;
      }
      .votelist{
        font-size: 17px;
      }
input[type="checkbox"] { position: absolute; opacity: 0; z-index: -1; }
input[type="checkbox"]+span { font: 16pt sans-serif; color: #000; }
input[type="checkbox"]+span:before { font: 16pt FontAwesome; content: '\00f096'; display: inline-block; width: 16pt; padding: 2px 0 0 3px; margin-right: 0.5em; }
input[type="checkbox"]:checked+span:before { content: '\00f046'; }
input[type="checkbox"]:focus+span:before { outline: 1px dotted #aaa; }
input[type="checkbox"]:disabled+span { color: #999; }
input[type="checkbox"]:not(:disabled)+span:hover:before { text-shadow: 0 1px 2px #77F; }
</style>
<div class="x_panel">
                
             
                <div class="x_content">
	               <!-- <form method="get" class="form-horizontal"  action="Time_manage.php?view=l_t" enctype="multipart/form-data"> --!>
                   <section class="content">
                      
<span class="section"><a href='#' class='btn btn-info' onclick="window.open('select.php?view=s_e','_self')"><i class='fa fa-check-circle-o'></i> Select Election </a> | Vote Your Candidate (s)</span> <div class="alert alert-danger alert-dismissible" id="alert" style="display:none;">
		        		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			        	<span class="message"></span>
			        	
			        </div>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Please Select your Choice Candidate (s) for <?php  $catee = getecated($elect_ID); if($catee == "2"){ echo $nelect = getecate($elect_ID)." (".getfacultyc($efaculty).")"; }elseif($catee== "1"){ echo $nelect = getecate($elect_ID)." (".getdeptc($electdept).")";}else{ echo getecate($elect_ID);} ?> and Click Submit . <?php //echo getecate($elect_ID)." ".$efaculty." ".$electdept." ".$ecateg." ".getregid("6") ; ?>
                  </div>
  <?php  //if($ecateg == "2"){  
 // $sql = "SELECT * FROM votes WHERE voters_id = '".$session_id."' and elect = '".$elect_ID."' and posit = '".$ecateg."' ";
  //}elseif($ecateg == "1"){ 
   //$sql = "SELECT * FROM votes WHERE voters_id = '".$session_id."' and elect = '".$elect_ID."' and posit = '".$ecateg."' ";
//}else{
 $sql = "SELECT * FROM votes WHERE voters_id = '".$session_id."' and elect = '".$ecateg."'   ";
//}

				    	
				    	$vquery = mysqli_query($condb,$sql);
				    	if(mysqli_num_rows($vquery) > 0){
				    		?>
				    		<div class="text-center">
					    		<h3>You have already voted for this election.</h3>
					    	<!--	<a href="#view" data-toggle="modal" class="btn btn-flat btn-primary btn-lg"> View Ballot</a> --!>
<a href="#view" data-toggle="modal" class="btn btn-info"  id="delete02" data-placement="right" title="Click to view Ballot " ><i class="fa fa-archive icon-large"></i> View Ballot</a>
<a href="printwinner.php" class="btn btn-info"  id="delete02" data-placement="right" title="Click to Print Winner (s) " ><i class="fa fa-print icon-large"></i> View Winner (s)</a>
					    	</div>
				    		<?php
				    		//echo "yes";
				    	}
				    	else{//echo "vote now"; }
				    		?>

    <form method="POST" id="ballotForm" action="submit_ballot.php">
    	<?php

				        			$candidate = '';
				        			$sql = "SELECT * FROM post_tb WHERE ecate1 = '".safee($condb,$ecateg)."' ORDER BY position ASC";
									$query = mysqli_query($condb,$sql);
									while($row = mysqli_fetch_assoc($query)){ $ecateg2 = ($ecateg);
									//$post1 = $row['postid'];	$ecat = $row['ecate1'];
								if($ecateg2 == "2"){
$sql = "SELECT * FROM candidate_tb WHERE post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID)."' and approve ='1' and fac = '".safee($condb,$student_facut)."' ";
				}elseif($ecateg2 == "1"){
			$sql = "SELECT * FROM candidate_tb WHERE post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID)."' and fac = '".safee($condb,$student_facut)."' and dept = '".safee($condb,$student_dept)."' and approve ='1' ";
								}else{
				$sql = "SELECT * FROM candidate_tb WHERE post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID)."' and approve = '1' ";
									 }
						
										$cquery = mysqli_query($condb,$sql);
										while($crow = mysqli_fetch_assoc($cquery)){
										$existv = imgExists("../admin/".$crow['image']);
											$slug = slugify($row['position']);
											$checked = '';
											if(isset($_SESSION['post'][$slug])){
												$value = $_SESSION['post'][$slug];

												if(is_array($value)){
													foreach($value as $val){
														if($val == $crow['candid']){
															$checked = 'checked';
														}
													}
												}
												else{
													if($value == $crow['candid']){
														$checked = 'checked';
													}
												}
											}
$input = ($row['mvote'] > 1) ? '<input type="checkbox"  class="flat-red '.$slug.'" name="'.$slug."[]".'" value="'.$crow['candid'].'" '.$checked.'>' : '<input type="checkbox"  class="flat-red '.$slug.'" name="'.slugify($row['position']).'" value="'.$crow['candid'].'" '.$checked.'>';
											//$image = (!empty($crow['image'])) ? '../admin/'.$crow['image'] : 'uploads/NO-IMAGE-AVAILABLE.jpg';
											if ($existv > 0 ){$image ="../admin/".$crow['image'];}else{ $image = "uploads/NO-IMAGE-AVAILABLE.jpg";}
											$candidate .= '
											<tr class="row1"><td><label>'.$input.'<span> <button type="button" class="btn btn-primary btn-sm btn-flat clist platform" data-platform="'.$crow['platform'].'" data-fullname="'.$crow['fname'].' '.$crow['lname'].'"><i class="fa fa-search"></i> Platform</button> <img  src="'.$image.'" height="100px" width="100px" class="clist"></span></label> <span class="cname clist">'.$crow['fname'].' '.$crow['lname'].' </span> </td></tr>
											';
											
											
										}

			$instruct = ($row['mvote'] > 1) ? 'You may select up to '.$row['mvote'].' candidates' : 'Select only one Candidate';?>
						<div class="panel-body" > 
								<table id="zctb" class="table table-bordered " border="1" cellspacing="0" width="100%">
								<tbody><tr class="row1" id="<?php echo $row['postid']; ?>"  >
<td colspan="6" class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                       <font color="black"><?php echo $row['position']; ?> </font>
                          </td></tr>
                          <tr class="row2" style="font-size:12px;">
<td colspan="3"><b><?php echo $instruct ; ?>	<span class="pull-right">
																	<button type="button" class="btn btn-success btn-sm btn-flat reset" data-desc="<?php echo slugify($row['position']); ?>"><i class="fa fa-refresh"></i> Reset</button>
																</span></b></td></tr>


                          



<div><?php echo $candidate; ?></div>	
<?php	echo $candidate = '';
//echo $session_id;
 ?>

</tbody>

</table>
</div>






<?php } ?>
	<div class="text-center">
<button type="button" class="btn btn-success btn-flat" id="preview"><i class="fa fa-file-text"></i> Preview</button> 
					        		<button type="submit" class="btn btn-primary btn-flat" name="vote"><i class="fa fa-check-square-o"></i> Submit</button>
					        	</div>
</form>
<?php } ?>  </section>
                        </div>
                        
                      </div>
                   
                  </div>
                 