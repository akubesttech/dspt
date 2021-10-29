<!-- footer content -->
<?php include('../admin/modal_alert.php'); ?>
<?php include 'ballot_modal.php'; ?>
        <footer>
          <div class="pull-right">
          
               <?php 
               
    $query= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $row = mysqli_fetch_array($query);          
 $time = time () ; 

 $year= date("Y",$time) . ""; 
 //This line formats it to display just the year

 echo "All Right Reserved &copy; " . $year . " " ; if ($row['WebAddress']==NULL ){
	echo "My School Web Address.com";
	}else{
	echo $row['WebAddress']."<strong> Powered By Delta Smart City.</strong>";
	
} 
 //All Right Reserved &copy; 2016 by My School.com

 ?>
 
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
 <script>

 $(document).on('click', '.platform', function(e){
		e.preventDefault();
		$('#platform').modal('show');
		var platform = $(this).data('platform');
		var fullname = $(this).data('fullname');
		$('.candidate').html(fullname);
		$('#plat_view').html(platform);
	});
$('#preview').click(function(e){
		e.preventDefault();
		var form = $('#ballotForm').serialize();
		if(form == ''){
			$('.message').html('You must vote atleast one candidate');
			$('#alert').show();
		}
		else{
			$.ajax({
				type: 'POST',
				url: 'preview.php',
				data: form,
				dataType: 'json',
				success: function(response){
					if(response.error){
						var errmsg = '';
						var messages = response.message;
						for (i in messages) {
							errmsg += messages[i]; 
						}
						$('.message').html(errmsg);
						$('#alert').show();
					}
					else{
						$('#preview_modal').modal('show');
						$('#preview_body').html(response.list);
					}
				}
			});
		}
		
	});
	

function updatePrice() {
        var myBox1 = document.getElementById('duration').value; 
        var myBox2 = document.getElementById('amt').value;
        var result = document.getElementById('total'); 
        var myResult = myBox1 * myBox2;
          document.getElementById('total').value = myResult;

    }


    function checkall(selector)
  {
    if(document.getElementById('chkall').checked==true)
    {
      var chkelement=document.getElementsByName(selector);
      for(var i=0;i<chkelement.length;i++)
      {
        chkelement.item(i).checked=true;
      }
    }
    else
    {
      var chkelement=document.getElementsByName(selector);
      for(var i=0;i<chkelement.length;i++)
      {
        chkelement.item(i).checked=false;
      }
    }
  }</script>
  	<script>
    function checkall2(selector)
  {
    if(document.getElementById('chkall2').checked==true)
    {
      var chkelement=document.getElementsByName(selector);
      for(var i=0;i<chkelement.length;i++)
      {
        chkelement.item(i).checked=true;
      }
    }
    else
    {
      var chkelement=document.getElementsByName(selector);
      for(var i=0;i<chkelement.length;i++)
      {
        chkelement.item(i).checked=false;
      }
    }
  }</script>
   <script>
function isNumber(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

</script>
 <script>
function tablePrint(){ 
 document.all.divButtons.style.visibility = 'hidden';  
  document.all.delete_course.style.visibility = 'hidden'; 
  document.all.divTitle.style.visibility = 'visible'; 
    var display_setting="toolbar=no,location=no,directories=no,menubar=no,";  
    display_setting+="scrollbars=yes,width=850, height=500, left=100, top=25";  
  //var tableData = '<table border="1" width = "1080">'+document.getElementsByTagName('table')[0].innerHTML+'</table>';
    var content_innerhtml = document.getElementById("printout").innerHTML;  
    var document_print=window.open("","",display_setting);  
    document_print.document.open();  
    document_print.document.write('<center><body style="font-family:verdana; font-size:12px;" onLoad="self.print();self.close();" >');  
    document_print.document.write(content_innerhtml);  
    document_print.document.write('</body></center></html>');  
    //document_print.print();  
    //document_print.document.close(); 
   
   setTimeout(function(){document_print.print();},1000);
    document_print.document.close(); 
    document_print.focus();
    document_print.all.divButtons.style.visibility = 'visible';
    document_print.all.delete_course.style.visibility = 'visible';
    return true;  
    } 
  $(document).ready(function() {
    oTable = jQuery('#example').dataTable({
    "bJQueryUI": true,
    "sPaginationType": "full_numbers"
    } );
  });  
  
  function tablePrint2(){ 
 document.all.divButtons.style.visibility = 'hidden';  
  document.all.delete_course.style.visibility = 'hidden'; 
  document.all.divTitle.style.visibility = 'show'; 
    var display_setting="toolbar=no,location=no,directories=no,menubar=no,";  
    display_setting+="scrollbars=yes,width=850, height=500, left=100, top=25";  
  //var tableData = '<table border="1" width = "1080">'+document.getElementsByTagName('table')[0].innerHTML+'</table>';
    var content_innerhtml = document.getElementById("printout1").innerHTML;  
    var document_print=window.open("","",display_setting);  
    document_print.document.open();  
    document_print.document.write('<center><body style="font-family:verdana; font-size:12px;" onLoad="self.print();self.close();" >');  
    document_print.document.write(content_innerhtml);  
    document_print.document.write('</body></center></html>');  
    document_print.print();  
    document_print.document.close(); 
   
    return false;  
    } 
  $(document).ready(function() {
    oTable = jQuery('#example').dataTable({
    "bJQueryUI": true,
    "sPaginationType": "full_numbers"
    } );
  }); 
  
  function Clickheretoprint()
{ 
document.all.cccv.style.visibility = 'hidden';
document.all.ccc2.style.visibility = 'hidden';
  var disp_setting="toolbar=yes,location=no,directories=no,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=870, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("print_content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
  
   docprint.document.open(); 
   docprint.document.write('<html><head><title>Print Preview</title>');
   docprint.document.write('<link rel="stylesheet" href="../assets/css/ApplyAlberta.css" type="text/css" />'); 
   docprint.document.write('</head><centre><body onLoad="self.print();self.close();" style="width: 870px; font-size:8px;border: 1px solid #98C1D1; font-family:Verdana, Geneva, sans-serif;">');  
   //docprint.document.write('</head><centre><body onLoad="window.print();window.close()" style="width: 870px; font-size:8px;border: 1px solid #98C1D1; font-family:Verdana, Geneva, sans-serif;">');         
   docprint.document.write(content_vlue);          
   docprint.document.write('</body></centre></html>'); 
   //docprint.document.close(); 
   //docprint.focus();
   //docprint.print();  
   setTimeout(function(){docprint.print();},1000);
    docprint.document.close(); 
    docprint.focus();
    document.all.cccv.style.visibility = 'visible';
    document.all.ccc2.style.visibility = 'visible';
          //  printButton.style.visibility = 'visible';
    
    
    //docprint.document.close();
      //docprint.focus();
      //setTimeout(function(){docprint.print();},1000);
      //docprint.close();

      return true;

}

var xmlhttp

function loadDept(str)
{var a=document.getElementById(str)[document.getElementById(str).selectedIndex].value;
//var a=document.getElementById(str)[document.getElementById(str).selectedIndex].innerHTML;
//document.getElementById("select_id").options[document.getElementById("select_id").selectedIndex].value;
if(a=='Select Faculty'){ return;}
else{
var e=document.getElementById('imgHolder2');
e.style.visibility='visible';
xmlhttp=GetXmlHttpObject();

setTimeout(function(){if (xmlhttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  }

var d=document.getElementById(str)[document.getElementById(str).selectedIndex].value;
var url="../admin/loadDept.php";
url=url+"?loadfac="+d;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}

function stateChanged()
{
if (xmlhttp.readyState==4)
  {
  document.getElementById("dept1").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';
  }
}

function loadCourse(str1)
{var a=document.getElementById(str1)[document.getElementById(str1).selectedIndex].value;
if(a=='Select <?php echo $SGdept1; ?>'){ return;}
else{
var e=document.getElementById('imgHolder2');
e.style.visibility='visible';
xmlhttp=GetXmlHttpObject();

setTimeout(function(){if (xmlhttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  }

var p=document.getElementById(str1)[document.getElementById(str1).selectedIndex].value;
var url="../admin/loadCourse.php";
url=url+"?loadcos="+p;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged2;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}

function stateChanged2()
{
if (xmlhttp.readyState==4)
  {
  document.getElementById("cosload").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';
  }
}


 
  function loadlga(str1)
{var a=document.getElementById(str1)[document.getElementById(str1).selectedIndex].innerHTML;
if(a=='- Select State -'){ return;}
else{
var e=document.getElementById('imgHolder2');
e.style.visibility='visible';
xmlhttp=GetXmlHttpObject();

setTimeout(function(){if (xmlhttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  }

var d=document.getElementById(str1)[document.getElementById(str1).selectedIndex].innerHTML;
var url="../load_lga.php";
url=url+"?loadfac="+d;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged3;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}
function stateChanged3()
{
if (xmlhttp.readyState==4)
  {
  document.getElementById("lga").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';
  }
}


function loadroom2(str)
{var a=document.getElementById(str)[document.getElementById(str).selectedIndex].value;
if(a=='Select Hostel'){ return;}
else{
var e=document.getElementById('imgHolder2');
e.style.visibility='visible';
xmlhttp=GetXmlHttpObject();

setTimeout(function(){if (xmlhttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  }

var d=document.getElementById(str)[document.getElementById(str).selectedIndex].value;
var url="loadRoom.php";
url=url+"?loadroom="+d;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged4;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}

function stateChanged4()
{
if (xmlhttp.readyState==4)
  {
  
  document.getElementById("roomno").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';
  }
}

function loadhamt(str1)
{var a=document.getElementById(str1)[document.getElementById(str1).selectedIndex].value;
if(a=='Select Room No'){ return;}
else{
var e=document.getElementById('imgHolder2');
e.style.visibility='visible';
xmlhttp=GetXmlHttpObject();

setTimeout(function(){if (xmlhttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  }

var p=document.getElementById(str1)[document.getElementById(str1).selectedIndex].value;
var url="loadhamt.php";
url=url+"?q="+p;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged2;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}

function stateChanged2()
{
if (xmlhttp.readyState==4)
  {
  document.getElementById("txtamtid").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';
  }
}


function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}
$(function() {
	$(window).scroll(function () { 
      var $windowTop = $(window).scrollTop();
      if ($windowTop>200){
      	$timeTop=Math.round(($windowTop-200)/80)*80;
      } else {
      	$timeTop=0;
      }
      $("#time-hour").css("top",$timeTop);
    });
});
$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alertm").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 5000);
 
});
  function calc() {
  var tots = 0;
  $(".uniform_on1:checked").each(function() {
    var price = $(this).attr("payamt");
    tots += parseFloat(price);
  });
  $('#tots').text(tots.toFixed(2));
}
$(function() {
  $(document).on("change", ".uniform_on1", calc);
  calc();
});
 /*   $(document).ready(function(){
                $( "#ed , #endDate" ).datepicker({
                    dateFormat: 'yy-mm-dd',
                    showOn: "button",
                    buttonImage: "images/calendar.gif",
                    buttonImageOnly: true
                });
            }); */


</script>
<style>#time-hour{
	list-style-type : none;
	position: relative;
	overflow: hidden;
	top: 0px;
	left: 0px;
	padding-left: 32px;
	padding-right: 32px;
	width: 834px;
	height: 30px;
	background-color: #269;
	color: rgb(255,255,255);
	border: 1px solid #999;
	z-index: 99;
}
#time-hour ul{
	padding: 0px;
	margin: 0px;
}

#time-hour li{
	display: inline-block;
	float: left;
	width: 64px;
	text-align: center;
	line-height: 30px;
}
</style>
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="../vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
     <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
     <!-- validator -->

    
    
    	<script src="../vendors/jGrowl/jquery.jgrowl.js"></script>
    		<script src="../vendors/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
			<script src="../vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
			<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
			 <script src="../plugins/bootstrap-fileinput.js" type="text/javascript"></script>
			 <!-- iCheck 1.0.1 -->
<script src="../plugins/iCheck/icheck.min.js"></script>
  </body>
</html>