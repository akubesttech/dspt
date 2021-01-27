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

if(isset($_POST['editrole'])){
$rolename = $_POST['rolename'];$roledesc = $_POST['roledesc']; $roleorder = $_POST['order'];
$query = mysqli_query($condb,"select * from role where role_rolename = '".safee($condb,$rolename)."' ")or die(mysqli_error($condb));
$count = mysqli_num_rows($query);

if($count > 1){ 	message("Role Name Already Exist! ).", "error");
		        redirect('add_role.php?id='.$get_RegNo);
		
}else{
mysqli_query($condb,"update role set role_rolename = '".safee($condb,$rolename)."',role_desc = '".safee($condb,$roledesc)."',roleorder = '".safee($condb,$roleorder)."' where role_rolecode ='".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'".safee($condb,$admin_username)."','Role Name $rolename  was Updated')")or die(mysqli_error($condb)); 
message("Role Information Was Successfully Updated", "success");
		        redirect('add_role.php');
}

}
?>

<div class="x_panel">
                
             
                <div class="x_content">
<?php
$query_d2form = mysqli_query($condb,"select * from role where role_rolecode ='".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
								$row_upform = mysqli_fetch_array($query_d2form); 
								?>
                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      
                 <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback"  >
                    <label for="email">Role Name *</label>
                	<div class="form-group">
                	 <input type="text" class="form-control "   name='rolename' id="rolename" placeholder="Example : Admin" value="<?php echo $row_upform['role_rolename']; ?> " >
			    					</div>
 
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback"  >
            <!-- <div class="form-group"> --!>
                    <label for="email">Role Description *</label>
                	<div class="form-group">
                	 <input type="text" class="form-control "    name='roledesc' id="roledesc"  placeholder="Example : Administartor" value="<?php echo $row_upform['role_desc']; ?> " ></div></div>
                   <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Role Category *</label>
                            	  	 <select class="form-control" name="order" id="order" required="required">
<option value="<?php echo $row_upform['roleorder'];?>"><?php echo getRolecategory($row_upform['roleorder']);?></option>
<?php //for($x=1;$x<11;$x++){echo '<option value="'.$x.'">'.$x.'</option>';}
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
                          <?php   if (authorize($_SESSION["access3"]["sConfig"]["aer"]["edit"])){ ?>
                        <button  name="editrole"  id="editrole"  class="btn btn-primary col-md-4" title="Click Here to Update Role" ><i class="fa fa-sign-in"></i> Update</button><?php } ?>
                      <a rel="tooltip"  title="" id="<?php echo $id; ?>" onClick="window.location.href='add_role.php';"   class="btn btn-success"><i class="fa fa-plus icon-large"> Add Role</i></a>
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#editform').tooltip('show');
	                                            $('#editform').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 