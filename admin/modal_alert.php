<!---------------------------------- modal alert session expire admin ------------------------------------------>
<div class="modal fade" id="myModalat" tabindex="-1" role="dialog" aria-hidden="true" >
<!--  <div class="modal-dialog modal-lg"> --!>
                   <div class="modal-dialog modal-sm">
                      <div class="modal-content" >

                        <div class="modal-header" style="cursor: move;background-color:#2196F3;color: #fff;">
                        <!--  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
                          </button> --!>
                          <h4 class="modal-title" id="myModalLabel"><img src="uploads/Warning_icon.png" height="18" width="18"> Warning</h4>
                        </div>
                       <div class="modal-body">
					<div class="alert alert-danger">
					<p><strong> <center>The <font color='green'><?php //echo $warning_semester; ?></font> <!-- Semester Duration For --!> <font color='green'><?php //echo $warning_txt; ?></font> Session Set Has <br>Expired Please Update To Continue !</center></strong></p>
					</div>
					</div>
                        <div class="modal-footer">
                         <!-- <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>Close</button> --!>
                      <!--    <button  name="delete_courses" class="btn btn-primary"><i class="fa fa-check icon-large"></i>Yes</button> --!>
                          <a  onclick="window.open('add_Yearofstudy.php','_self')" href="javascript:{}" rel="tooltip" id="addsession1" class="btn btn-info" title="Click To update to New Academic Session and Continue"><i class="icon-time"></i>&nbsp;Click To Update</a>
                          <a  onclick="window.open('logout.php','_self')" href="javascript:{}" rel="tooltip" id="addsession1" class="btn btn-info" title="Click To Logout"><i class="fa fa-sign-out"></i>&nbsp;Logout</a>
                        </div>

                      </div>
                    </div>
                  </div>
               <!---------------------------------- modal alert session expire student ------------------------------------------>
                  <div class="modal fade" id="myModalat2" tabindex="-1" role="dialog" aria-hidden="true" >
    
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content" >

                        <div class="modal-header" style="cursor: move;background-color:#2196F3;color: #fff;">
                        <!--  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
                          </button> --!>
                          <h4 class="modal-title" id="myModalLabel"><img src="../admin/uploads/Warning_icon.png" height="18" width="18"> Warning</h4>
                        </div>
                       <div class="modal-body">
					<div class="alert alert-danger">
					<p><strong> <center>Unable <font color='green'><?php //echo $warning_semester; ?></font> <!-- Semester Duration For --!> <font color='green'><?php //echo $warning_txt; ?></font> to  Use the <br>CMS at this time Please Check Back Later!<br> (Academic session not Added)</center></strong></p>
					</div>
					</div>
                        <div class="modal-footer">
                         <!-- <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>Close</button> --!>
                      <!--    <button  name="delete_courses" class="btn btn-primary"><i class="fa fa-check icon-large"></i>Yes</button> --!>
                          <a  onclick="window.open('logout.php','_self')" href="javascript:{}" rel="tooltip" id="addsession1" class="btn btn-info" title="Click To Logout"><i class="fa fa-sign-out"></i>&nbsp;Click To Logout</a>
                        </div>

                      </div>
                    </div>
                  </div>
                  
                  <!---------------------------------- modal alert login time out admin ------------------------------------------>
                  <div class="modal fade" id="myModalat4" tabindex="-1" role="dialog" aria-hidden="true" >
    
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content" >

                        <div class="modal-header" style="cursor: move;background-color:#2196F3;color: #fff;">
                        <!--  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
                          </button> --!>
                          <h4 class="modal-title" id="myModalLabel"><img src="../admin/uploads/Warning_icon.png" height="18" width="18"> Warning</h4>
                        </div>
                       <div class="modal-body">
					<div class="alert alert-danger">
					<p><strong> <center><font color='green'><?php //echo $warning_semester; ?></font> <!-- Semester Duration For --!> <font color='green'><?php //echo $warning_txt; ?></font> Your are Logged out,Because Of Long Time of No Activity!</center></strong></p>
					</div>
					</div>
                        <div class="modal-footer">
                         <!-- <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>Close</button> --!>
                      <!--    <button  name="delete_courses" class="btn btn-primary"><i class="fa fa-check icon-large"></i>Yes</button> --!>
                          <a  onclick="window.open('logout.php','_self')" href="javascript:{}" rel="tooltip" id="addsession1" class="btn btn-info" title="Click To Login"><i class="fa fa-sign-out"></i>&nbsp;Click To Login</a>
                        </div>

                      </div>
                    </div>
                  </div>
                  
                  <!---------------------------------- modal alert school fee Notification student ------------------------------------------>
                  <div class="modal fade" id="myModalat3" tabindex="-1" role="dialog" aria-hidden="true" >
    
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content" >

                        <div class="modal-header" style="cursor: move;background-color:#2196F3;color: #fff;">
                       <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
                          </button> 
                          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bell"></i> Notification</h4>
                        </div>
                       <div class="modal-body">
					<div class="alert alert-danger">
					<p><strong> <center> School Fees Payment Notification For <font color='green'><?php echo $default_session; ?></font> Academic Session <br>You are Required To Pay your School fees so that you can have full access to The CMS !</center></strong></p>
					</div>
					</div>
                        <div class="modal-footer">
                         <!-- <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>Close</button> --!>
                      <!--    <button  name="delete_courses" class="btn btn-primary"><i class="fa fa-check icon-large"></i>Yes</button> --!>
                          <a  onclick="window.open('Spay_manage.php?view=a_p','_self')" href="javascript:{}" rel="tooltip" id="addsession1" class="btn btn-info" title="Click Make Payment To Continue"><i class="fa fa-money"></i>&nbsp;Make Payment</a>
                        </div>

                      </div>
                    </div>
                  </div>
                  
                  <!---------------------------------- modal alert login time out notification admin ------------------------------------------>
                  <div class="modal fade" id="myModalat5" tabindex="-1" role="dialog" aria-hidden="true" >
    
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content" >

                        <div class="modal-header" style="cursor: move;background-color:#2196F3;color: #fff;">
                        <!--  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
                          </button> --!>
                          <h4 class="modal-title" id="myModalLabel"><img src="../admin/uploads/Warning_icon.png" height="18" width="18"> Warning</h4>
                        </div>
                       <div class="modal-body">
					<div class="alert alert-danger">
					<p style="text-align:center;"><strong>You will be automatically <br> logged out in 1 minute.<br>
    To remain logged in click on any part of this window.</strong></p>
					</div>
					</div>
                       

                      </div>
                    </div>
                  </div>
                   <!---------------------------------- modal alert empty programm admin ------------------------------------------>
                  <div class="modal fade" id="myModalat7" tabindex="-1" role="dialog" aria-hidden="true" >
    
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content" >

                        <div class="modal-header" style="cursor: move;background-color:#2196F3;color: #fff;">
                        <!--  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
                          </button> --!>
                          <h4 class="modal-title" id="myModalLabel"><img src="../admin/uploads/Warning_icon.png" height="18" width="18"> Warning</h4>
                        </div>
                       <div class="modal-body">
					<div class="alert alert-danger">
					<p style="text-align:center;"><strong>! You'r Required To Add School Programme in other to continue.</strong></p>
					</div>
					</div>
                       <div class="modal-footer">
                     <a  onclick="window.open('add_Program.php','_self')" href="javascript:{}" rel="tooltip" id="closeme1" class="btn btn-info" title="Click To Add Programm(s)"><i class="fa fa-plus"></i>&nbsp;Add</a>
                       </div>
                      </div>
                    </div>
                  </div>
                  
                  <!---------------------------------- modal alert select program admin ------------------------------------------>
<div class="modal fade" id="myModalat6" tabindex="-1" role="dialog" aria-hidden="true" >
    
                <div class="modal-dialog modal-lg"> 
                  
                      <div class="modal-content" >

                        <div class="modal-header" style="cursor: move;background-color:#2196F3;color: #fff;">
                        <!--  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
                          </button> --!>
                          <h4 class="modal-title" id="myModalLabel"> Our School Programme(s)</h4>
                        </div>
                       <div class="modal-body">
					<div class="x_panel">
                
             
                <div class="x_content">
	      
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Note:Records are Generated Base on the Selected Programme . 
                  </div>
          <?php        //current URL of the Page. cart_update.php redirects back to this URL
	$current_url6 = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>
   <?php  $queryprog = mysqli_query($condb,"SELECT * FROM prog_tb  ORDER BY Pro_name ASC");
    $countersac = mysqli_num_rows($queryprog); ?>
					    
					    <?php
            while($rec = mysqli_fetch_assoc($queryprog)){ 
                //$postID = $rec['pro_id'];
        ?>
        <div class="col-md-3" >
                     <a href="javascript:void(0);"><form method="post"  action="prog_select2.php"  >
         <?php  //$class_ID  = $cart_itm["p_id"];$cnames =  $cart_itm["pro_name"]; $p_duration =  $cart_itm["p_dura"];
		 if($class_ID == $rec['pro_id'] ){ ?>
					    <button  data-placement="right" class="btn btn-primary" title="Click To Select Programme" ><i class="fa fa-briefcase"></i>  <?php echo $rec['Pro_name']." Programme";?></button><?php }else{ ?>
					    <button  data-placement="right" class="btn btn-info" title="Click To Select Programme" ><i class="fa fa-briefcase"></i>  <?php echo $rec['Pro_name']." Programme";?></button> <?php } ?>
					    <input type="hidden" name="sel_id" value="<?php echo $rec['pro_id'];?>" />
		
            <input type="hidden" name="type" value="addselect" />
          <input type="hidden" name="return_url" value="" />
             </form> </a>  </div>
					    <?php }	?>
                     
                    
             
         
            
                        
                      </div>
                   
                  </div>
                  
					</div>
                        <div class="modal-footer">
                         <!-- <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>Close</button> --!>
                      <!--    <button  name="delete_courses" class="btn btn-primary"><i class="fa fa-check icon-large"></i>Yes</button> --!>
                         <a  onclick="window.open('logout.php','_self')" href="javascript:{}" rel="tooltip" id="addsession1" class="btn btn-info" title="Click To Logout"><i class="fa fa-sign-out"></i>&nbsp;Logout</a>
                        </div>

                      </div>
                    </div>
                  </div>
                  
                  
                  <div id="timeout2" class="modal fade" >
    <h1>Session About To Timeout</h1>
    <p>You will be automatically logged out in 1 minute.<br />
    To remain logged in move your mouse over this window.
</div>
                  <script>
dragElement(document.getElementById("myModalat"));
dragElement(document.getElementById("myModalat2"));
dragElement(document.getElementById("myModalat3"));
dragElement(document.getElementById("myModalat4"));
dragElement(document.getElementById("myModalat5"));
dragElement(document.getElementById("myModalat6"));
dragElement(document.getElementById("myModalat7"));

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    /* if present, the header is where you move the DIV from:*/
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    /* otherwise, move the DIV from anywhere inside the DIV:*/
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
</script>