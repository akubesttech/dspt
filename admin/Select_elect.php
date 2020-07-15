
<div class="x_panel">
                
             
                <div class="x_content">
	            
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Please Select the Appropriate Election Option to view Results /  Analysis  . 
                  </div>
    
       
       
                    
                      <?php        //current URL of the Page. cart_update.php redirects back to this URL
$date_now =  date("Y-m-d");	$current_url3 = base64_encode($url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>
   <?php  $queryprog = mysqli_query($condb,"SELECT * FROM electiontb Where estatus = '0' ORDER BY ecate DESC");
    $countersac = mysqli_num_rows($queryprog); 
while($rec = mysqli_fetch_assoc($queryprog)){  $election1 = $rec['title'];$estart = $rec['estart']; $eend = $rec['eend']; $ecate1= $rec['ecate'];
$efac= $rec['fac']; $edept= $rec['dept']; $electid = $rec['id'];
        ?>
        
					    
					    
                     <div class='col-md-55'>
                        <div class='thumbnail'>
                        <div class='cleaner'></div>
				 <div class='image view view-first'>
                           <img style='width: 100%; display: block;' src='../Student/uploads/elect.jpg' alt='image' />
                            
							<div class='mask' style="font-size:12;color:white"><br>
                           <strong><?php echo $election1; ?></strong><br>
        <?php if($ecate1 == "2"){  $voteclass = getfacultyc($efac);}elseif($ecate1 == "1"){$voteclass = getdeptc($edept) ;}else{ } ?>
                           <strong><?php echo $voteclass; ?></strong><br>
                           
                              <strong><?php echo "Start :".$estart; ?></strong><br>
                              <strong><?php echo "End :".$eend; ?></strong><p></p><p></p>
                            </div>
                            
                          </div>
                          <div class='caption'> <center>
                         <form method="post"  action="elect_selectadmin.php"  >
                             <button  data-placement="bottom" class="btn btn-primary " id="<?php echo $electid ; ?>goselect" title="Click To Select <?php echo $voteclass." " ; ?>Election and Continue" ><i class="fa fa-check-circle-o"></i>  <?php echo $rec['title']." ";?></button>
					    <input type="hidden" name="sel_id2" value="<?php echo $rec['id'];?>" />
		<input type="hidden" name="type" value="addelect1" />
          <input type="hidden" name="return_url" value="<?php echo $current_url3; ?>" />
   <script type="text/javascript">$(document).ready(function(){$('#<?php echo $electid ; ?>goselect').tooltip('show');$('#<?php echo $electid ; ?>goselect').tooltip('hide');});</script>
                             </form></center>
                          </div>
						  
						   </div>
                      </div>
                <?php }	?>
                
                
                
                        </div>
                        
                      
                        
                      </div>
                   
                  </div>
                  