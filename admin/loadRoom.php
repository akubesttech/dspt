
                <div class="x_panel"> 
 <div class="x_content">

                    <div class="row">
                    
                       

                       
                       
                        <?php 
						include('lib/dbcon.php'); 
dbcon();
$q=$_GET['blockid'];
                          echo "  <form name='find_hostel' method='post' action=''>";
						//$resultrooms = mysqli_query($condb,"SELECT * FROM roomdb where room_status = '1' AND h_coder='$_GET[blockid]'");
						$resultrooms = mysqli_query($condb,"SELECT * FROM roomdb where  h_coder = '".safee($condb,$q)."'");
						$count=mysqli_num_rows($resultrooms);
						echo " <h2>No Of Rooms Found <big> $count</big></h2>";
while($rsrooms = mysqli_fetch_array($resultrooms))
{
$resultblocks1 = mysqli_query($condb,"SELECT * FROM hostedb where h_code='".safee($condb,$rsrooms['h_coder'])."' AND h_status = '1'");
$rsblocks1 = mysqli_fetch_array($resultblocks1); ?>
     
				
				   <div class='col-md-55'>
                        <div class='thumbnail'>
                        <div class='cleaner'></div>
				 <div class='image view view-first'>
                           <img style='width: 100%; display: block;' src='uploads/media.jpg' alt='image' />
                            <div class='mask'>
                             <div class='tools tools-bottom'>
                                <a href='#'><i class='fa fa-link'></i></a>
                                <a href='?editrooms&idroom=<?php echo $rsrooms['room_id']; ?>' data-toggle='modal'><i class='fa fa-pencil'></i></a>
                                <a href='view_Rooms.php?delid= <?php echo $rsrooms['room_id']; ?>'><i class='fa fa-times'></i></a>
                              </div>
                              <p><strong>Hostel Name: <?php echo $rsblocks1['h_name']; ?></strong></p>
                            </div>
                          </div>
                          <div class='caption'>
                          <?php if($rsrooms['room_status'] > 0){ ?>
                            <p><strong>Room No: <?php echo $rsrooms['room_no']; ?></p>
                           <p><strong>Amount : <?php echo number_format($rsrooms['fee'],2); ?></strong></p>
                            <?php }else{ ?>
                            <p><strong>Room No: <?php echo $rsrooms['room_no']; ?></p>
                            <p style="color:red;"><strong>Room Not Available</strong></p>
                            <?php } ?>
                          </div> </div>
                      </div>
						  <?php } ?>
                      </form>
                        <!--  ." (".$rsrooms['no_of_bed'] ." Bed (s)) --!>

                    
                    	</div> 	</div>
                    	
                    	 </div>
                    
                    	

	