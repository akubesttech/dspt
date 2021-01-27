<script>
function getformamount(str)
{
if (str=="")
  {
  //document.getElementById("txtroomno").innerHTML="Amount was Not Loaded Because Form Type was Not Selected";
 // return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtroomno").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","loadfamt.php?q="+str,true);
xmlhttp.send();
}
</script>


<?php

if(isset($_POST['addrole'])){
$rolename = $_POST['rolename'];$roledesc = $_POST['roledesc'];$roleorder = $_POST['order'];
	
$query = mysqli_query($condb,"select * from role where role_rolename = '".safee($condb,$rolename)."'")or die(mysqli_error($condb));
$count = mysqli_num_rows($query);

if($count > 0){ 	message("Role Name Already Exist! ).", "error");
		        redirect('add_role.php');
		      		
}else{
mysqli_query($condb,"INSERT INTO role(role_rolename, role_desc, roleorder) VALUES('".safee($condb,$rolename)."', '".safee($condb,$roledesc)."', '".safee($condb,$roleorder)."')")or die(mysqli_error($condb));
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Role Name $rolename was Add')")or die(mysqli_error($condb)); 
// ob_start();
message("Role Was Successfully Added", "success");
		         redirect('add_role.php');
}

}
?>

<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      

                      
        <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback"  >
                    <label for="email">Role Name *</label>
                	<div class="form-group">
                	 <input type="text" class="form-control "   name='rolename' id="rolename" placeholder="Example : Admin"  >
			    					</div>
 
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback"  >
            <!-- <div class="form-group"> --!>
                    <label for="email">Role Description *</label>
                	<div class="form-group">
                	 <input type="text" class="form-control "    name='roledesc' id="roledesc"  placeholder="Example : Administartor" >
			    					</div></div>
                    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Role Category *</label>
                            	  	 <select class="form-control" name="order" id="order" required="required">
<option value="">Select Role Category</option><?php //for($x=1;$x<11;$x++){echo '<option value="'.$x.'">'.$x.'</option>';}
echo getRolecategory(0,1);
 ?>
 </select>
                      </div>
                   
               
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                          <?php   if (authorize($_SESSION["access3"]["sConfig"]["aer"]["create"])){ ?>
                        <button  name="addrole"  id="addrole"  class="btn btn-primary col-md-4" title="Click Here to Save Role" ><i class="fa fa-sign-in"></i> Save</button><?php } ?>

                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addform').tooltip('show');
	                                            $('#addform').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 