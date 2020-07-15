<script>
function showroomno(str)
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
xmlhttp.open("GET","loadamt.php?q="+str,true);
xmlhttp.send();
}

$("table").on("click","#clickable-row",function(){
  var cid = $("#disp").text(); 
  $.ajax({
         type: "GET",
         url: "apply_b.php?view=p_sh",
         data: { complainid: cid},
         success: function(data) {
               alert(data) //To check if response is success
               }
        });
 });

/* function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
} */

</script>

   <section id="content" role="document">
        <main style="min-height: 168px;">
                    <div class="container">
                        

<div class="row">
    <div class="col-xs-12">
        <div id="breadcrumbs-share">
            <section id="breadcrumbs">
                <ul class="breadcrumb">
                                <li><a href="apply_b.php">Back</a> </li>


                    

                    

                </ul>
            </section>
        </div>
    </div>
</div>
                    </div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-9 link-icons">
            <div class="row">
                <div class="col-xs-12">
            <h3>Student Online Application Panel </h3>
        </div>
        <div class="col-xs-12 primary-content link-icons">
<p class="first-paragraph">Please Select Your Desired programme from the information listed below to Continue your application process.  <strong>Note:</strong> That you will be required to make an Online payment in the next Stage of this Application and to Continue with the rest of Application process after Generating PIN click on <strong><a onclick="window.open('apply_b.php?view=New','_self')"> Apply </strong></a>, for more information click on <strong><a onclick="window.open('apply_b.php?view=Application_Process','_self')">How to apply</strong></a> . </p>
                </div>
                
        <div class="margin-md-top row cards section-cards">
           <div class="col-xs-12">
           
            <div class="row nopadding nomargin" id="cards">
            
					<!-- form window  --!>	
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<!-- <h3 class="panel-title">Please sign up for Bootsnipp <small>It's free!</small></h3> --!>
			    		<h4 class="panel-title">Listed Below are Available Application Form(s) </h4>
			 			</div>
			 			
			 			<div class="panel-body">
			    	<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			    		<table id="customers">
  <tr>
  <th>S/N</th>
    <th>Application Type</th>
    <th>Application Fee ( &#8358; )</th>
    <th>Academic Session</th>
    <th>Duration</th>

  </tr>
   <?php $date_now =  date("Y-m-d");
$user_query = mysqli_query($condb,"select * from form_db where f_end >='".$date_now."' Order by session ASC")or die(mysqli_error($condb)); 
if(mysqli_num_rows($user_query) > 0)
    {
$number = 1;
while($row_s = mysqli_fetch_array($user_query)){
													$id = $row_s['id'];
												$setend2 = $row_s['f_end'];
								 $date2    = new DateTime($setend2);
								//$date_now = date("Y-m-d");
								//echo json_encode($row_s['id']);
													?>
<!-- <tr onclick="window.location='www.google.com';"> --!>
<?php //$url2 = "http://localhost/DSC/DSCHT/apply_b.php?view=p_sh&main=".md5($id);  ?>
<tr class='clickable-row' data-href='apply_b.php?view=p_sh&main=<?php echo sha1($id); ?>' >
<!--<tr class='clickable-row' data-href='<?php //echo prepareUrl($url2,"@?aku#70"); ?>' > --!>
<td><?php echo $number; ?></td>
     <td><?php echo getprog($row_s['prog'])." (".getamoe($row_s['mode']).")"; ?></td>
    <td><?php echo number_format($row_s['amount'],2); ?></td>
    <td><?php echo $row_s['session']; ?></td>
    <td><?php echo $row_s['f_start']." - ". $row_s['f_end'];  ?></td>
  </tr> 
   <?php $number++; }  }
    else
    { ?>
    
    <tr><td colspan="5">No Available Application Form(s) at this time Please Check back later!</td></tr>
   <?php  } 
   
   ?>
  
</table>	
						
			    		</form>
			    	</div>
	    		</div>
    	
    	
    
    	
    	
						
                </div>
                
                
            </div>
        </div>



            </div>
            
        </div>
        <div class="col-xs-12 col-md-3 sidebar-right margin-lg-bottom">
            <!-- right feature space -->
            
   <div class="apply-box">
<a class="btn btn-default expand padding-md" title="Click  To Apply if you have generated Your Pin " onClick="window.location.href='apply_b.php?view=New';">APPLY</a>
    </div>

 <?php include("sidenews.php"); ?>
</div>
            
        </div>
    </div>
</div>


        </main>
    </section>
    
  