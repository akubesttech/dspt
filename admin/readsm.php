	<?php
$readmid=$_GET['ID'];
$getsendmessage=mysqli_query($condb,"SELECT *,UNIX_TIMESTAMP() - therealtime AS TimeSpent from b_pms  where pmID='$readmid'")or die("Could not get Send Message");$getuserinfo3=mysqli_fetch_array($getsendmessage); $messageid1=$getuserinfo3['pmID'];
  $updatenote=mysqli_query($condb,"Update b_pms set hasread='1' where pmID='$messageid1' and receiver='$session_id'")or die(mysqli_error($condb));
      
?>
	<div class="inbox-body">
                        
                          <div class="mail_heading row">
                            <div class="col-md-8">
                              <div class="btn-group">
    <a href="message_m.php" class="btn btn-sm btn-primary" ><i class="fa fa-reply"></i>&nbsp;Go Back</a>
    <?php if($getuserinfo3['receiver'] == $session_id){?>
    <a href="message_m.php?view=r_msg&ID=<?php echo $getuserinfo3['pmID'] ; ?>" class="btn btn-sm btn-default" ><i class="fa fa-share"></i>&nbsp;Reply</a>
     <?php }else{?>
     <a href="message_m.php" class="btn btn-sm btn-default"data-placement="top" data-toggle="tooltip" data-original-title="Forward" ><i class="fa fa-share"></i></a>
      <?php }?>
   
                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                                
                                <a href="message_m.php?delid=<?php echo $getuserinfo3['pmID']; ?>" class="btn btn-sm btn-default" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></a>
                              </div>
                            </div>
                            <div class="col-md-4 text-right">
                              <p class="date"><?php echo strtoupper($getuserinfo3['vartime']); ?></p>
                            </div>
                            <div class="col-md-12">
                              <h4 style="color:darkblue;text-shadow:0 1px 2px gray;"> <?php echo strtoupper($getuserinfo3['subject']); ?>.</h4>
                            </div>
                          </div>
                          
                          <div class="sender-info">
                            <div class="row">
                            <?php if($getuserinfo3['receiver'] == $session_id){?>
                              <div class="col-md-12">
                                <strong>Received From :<?php 
								if($getuserinfo3['r_status']=='1'){
									echo strtoupper(getstudent2($getuserinfo3['sender']));
								}elseif($getuserinfo3['r_status']=='2'){
								echo strtoupper(getstaff2($getuserinfo3['sender']));
							}else{
							echo strtoupper(getadmin2($getuserinfo3['sender']));}
							
							//	echo strtoupper($getuserinfo3['sender']); ?></strong>
                                <span>(<?php //echo strtoupper($getuserinfo3['sender']); 
								if($getuserinfo3['r_status']=='1'){
									echo strtoupper($getuserinfo3['sender']);
								}elseif($getuserinfo3['r_status']=='2'){
								echo strtoupper($getuserinfo3['sender']);
							}else{
							echo strtoupper(getemail($getuserinfo3['sender']));
						}
								
								?>)</span> by
                                <strong>me</strong>
                                <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                              </div>
                              <?php }else{?>
                               <div class="col-md-12">
                                <strong>Send To :<?php 
								if($getuserinfo3['s_status']=='1'){
									echo strtoupper(getstudent2($getuserinfo3['receiver']));
								}elseif($getuserinfo3['s_status']=='2'){
								echo strtoupper(getstaff2($getuserinfo3['receiver']));
							}else{
							echo strtoupper(getadmin2($getuserinfo3['receiver']));
						}?></strong>
                                <span>(<?php 		if($getuserinfo3['s_status']=='1'){
									echo strtoupper($getuserinfo3['receiver']);
								}elseif($getuserinfo3['s_status']=='2'){
								echo strtoupper($getuserinfo3['receiver']);
							}else{
							echo strtoupper(getemail($getuserinfo3['receiver']));
						} ?>)</span> From
                                <strong>me</strong>
                                <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                              </div>
                               <?php }?>
                            </div>
                          </div>
                          
                          <div class="view-mail" >
                            <p style="text-align:justify;height:160px;"><?php echo ucfirst($getuserinfo3['message']); ?>. </p>
                           <hr>
                          </div>
                          
                         
                          
                          <div class="btn-group">
                             <a href="message_m.php" class="btn btn-sm btn-primary" ><i class="fa fa-reply"></i>&nbsp;Go Back</a>
                              <?php if($getuserinfo3['receiver'] == $session_id){?>
    <a href="message_m.php?view=r_msg&ID=<?php echo $getuserinfo3['pmID'] ; ?>" class="btn btn-sm btn-default" ><i class="fa fa-share"></i>&nbsp;Reply</a>
     <?php }else{?>
     <a href="message_m.php" class="btn btn-sm btn-default"data-placement="top" data-toggle="tooltip" data-original-title="Forward" ><i class="fa fa-share"></i></a>
      <?php }?>
                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                            <a href="message_m.php?delid=<?php echo $getuserinfo3['pmID']; ?>" class="btn btn-sm btn-default" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></a>
                          </div>
                          
                        </div>
                        