
<div class="x_panel">
                
             
                <div class="x_content">
	             <a href="printeresult.php" class="btn btn-info"  id="delete02" data-placement="right" title="Click to Print Election Result" ><i class="fa fa-print icon-large"></i> Print Result</a> <a href="printwinner.php" class="btn btn-info"  id="delete02" data-placement="right" title="Click to Print Winner (s) " ><i class="fa fa-print icon-large"></i> Print Winner (s)</a>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
       Election Result / Report for <?php  $catee = getecated($elect_ID2); if($catee == "2"){ echo $nelect = getecate($elect_ID2)." (".getfacultyc($elefacu).")"; }elseif($catee== "1"){ echo $nelect = getecate($elect_ID2)." (".getdeptc($eleDept).")";}else{ echo getecate($elect_ID2);} ?> , To  Print Election Result Click Print Report . 
                  </div>
               <?php
        
        $sql = "SELECT * FROM post_tb WHERE ecate1 = '".safee($condb,$ecat)."' ORDER BY position ASC";
        $query = mysqli_query($condb,$sql);
        $inc = 2;
        while($row = mysqli_fetch_assoc($query)){
          $inc = ($inc == 2) ? 1 : $inc+1; 
          if($inc == 1) echo "<div class='row'>";
          echo "
            <div class='col-md-6 col-sm-6 col-xs-12'>
              <div class='x_panel'>
              <div class='x_title'>
                    <h2>".$row['position']."</h2>
                    <div class='clearfix'></div>
                  </div>
                <div class='x_content'>
                  <canvas id='".slugify($row['position'])."' style='width:100%; height:280px;'></canvas>
               </div>
              </div>
            </div>
          ";
          if($inc == 2) echo "</div>";  
        }
        if($inc == 1) echo "<div class='col-md-6 col-sm-6 col-xs-12'></div></div>";
      ?>
                
                        </div>
                        
                      
                        
                      </div>
                   
                  </div>
                  