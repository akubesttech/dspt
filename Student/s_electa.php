<?php 
//$_SESSION['sess']= $_POST['session'];
//$_SESSION['lev']= $_POST['level'];
//$_SESSION['seme']= $_POST['semester'];
?>
<div class="x_panel">
                
             
                <div class="x_content">
	               <!-- <form method="get" class="form-horizontal"  action="Time_manage.php?view=l_t" enctype="multipart/form-data"> --!>
                   
                      
                      <span class="section">Select Election</span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Please Select the appropriate Election and continue your Voting . 
                  </div>
    
       
       
                    
                      <?php        //current URL of the Page. cart_update.php redirects back to this URL
$date_now =  date("Y-m-d");	$current_url2 = base64_encode($url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>
   <?php  $queryprog = mysqli_query($condb,"SELECT * FROM electiontb where eend >'".$date_now."' and estatus = '0'  ORDER BY ecate DESC");
    $countersac = mysqli_num_rows($queryprog); 
while($rec = mysqli_fetch_assoc($queryprog)){  $election1 = $rec['title'];$estart = $rec['estart']; $eend = $rec['eend']; $ecate1= $rec['ecate'];
$efac= $rec['fac']; $edept= $rec['dept'];
        ?>
        <div class='col-md-55'>
                        <div class='thumbnail'>
                        <div class='cleaner'></div>
				 <div class='image view view-first'>
                           <img style='width: 100%; display: block;' src='uploads/elect.jpg' alt='image' />
                            
							<div class='mask' style="font-size:10;color:white"><br>
                           <strong><?php echo $election1; ?></strong><br>
        <?php if($ecate1 == "2"){  $voteclass = getfacultyc($efac);}elseif($ecate1 == "1"){$voteclass = getdeptc($edept) ;}else{ } ?>
                           <strong><?php echo $voteclass; ?></strong><br>
                           
                              <strong><?php echo "Start :".$estart; ?></strong><br>
                              <strong><?php echo "End :".$eend; ?></strong><p></p><p></p>
                            </div>
                            
                          </div>
                          <div class='caption'> <center>
                         <form method="post"  action="elect_select.php"  >
                             <button  data-placement="right" class="btn btn-primary" title="Click To Select Election and Continue" ><i class="fa fa-check-circle-o"></i>  <?php echo $rec['title']." ";?></button>
					    <input type="hidden" name="sel_id1" value="<?php echo $rec['id'];?>" />
		<input type="hidden" name="type" value="addelect" />
          <input type="hidden" name="return_url" value="<?php echo $current_url2; ?>" />
                             </form></center>
                          </div>
						  
						   </div>
                      </div>
                <?php } ?>
                
                        </div>
                        
                      </div>
                   
                  </div>
                  