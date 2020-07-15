
<div class="x_panel">
                
             
                <div class="x_content">
	                
                 
                      
                      <span class="section">List of Our School Programme</span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Note:Records are Generated Base on the Selected Programme . 
                  </div>
          <?php        //current URL of the Page. cart_update.php redirects back to this URL
	$current_url2 = base64_encode($url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>
   <?php  $queryprog = mysqli_query($condb,"SELECT * FROM prog_tb  ORDER BY Pro_name ASC");
    $countersac = mysqli_num_rows($queryprog); ?>
					    
					    <?php
            while($rec = mysqli_fetch_assoc($queryprog)){ 
                //$postID = $rec['pro_id'];
        ?>
        <div class="col-md-2" >
                     <a href="javascript:void(0);"><form method="post"  action="prog_select.php"  >
         <?php  //$class_ID  = $cart_itm["p_id"];$cnames =  $cart_itm["pro_name"]; $p_duration =  $cart_itm["p_dura"];
		 if($class_ID == $rec['pro_id'] ){ ?>
					    <button  data-placement="right" class="btn btn-primary" title="Click To Select Programme" ><i class="fa fa-briefcase"></i>  <?php echo $rec['Pro_name']." Programme";?></button><?php }else{ ?>
					    <button  data-placement="right" class="btn btn-info" title="Click To Select Programme" ><i class="fa fa-briefcase"></i>  <?php echo $rec['Pro_name']." Programme";?></button> <?php } ?>
					    <input type="hidden" name="sel_id" value="<?php echo $rec['pro_id'];?>" />
		
            <input type="hidden" name="type" value="addselect" />
          <input type="hidden" name="return_url" value="<?php echo $current_url2; ?>" />
             </form> </a>  </div>
					    <?php }	?>
                     
                    
             
         
            
                        
                      </div>
                   
                  </div>
                  