<!-- footer content -->
   <?php include('modal_alert.php'); ?>
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
    <script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : '../assets/media/loading.gif',
      closeImage   : '../assets/media/closelabel.png'
    })
  });
  function checkDec(el){
 var ex = /^[0-9]+\.?[0-9]*$/;
 if(ex.test(el.value)==false){
   el.value = el.value.substring(0,el.value.length - 1);
  }
}

</script>
 <script>
 
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
  }
      function checkall3(selector3)
  {if(document.getElementById('chkall3').checked==true)
    {var chkelement=document.getElementsByName(selector3);
for(var i=0;i<chkelement.length;i++){
        chkelement.item(i).checked=true;}}else{
      var chkelement=document.getElementsByName(selector3);
      for(var i=0;i<chkelement.length;i++){chkelement.item(i).checked=false;
      }}}
  </script>
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
  document.all.divTitle.style.visibility = 'show'; 
    var display_setting="toolbar=no,location=no,directories=no,menubar=no,";  
    display_setting+="scrollbars=yes,width=850, height=500, left=100, top=25";  
  //var tableData = '<table border="1" width = "1080">'+document.getElementsByTagName('table')[0].innerHTML+'</table>';
    var content_innerhtml = document.getElementById("printout").innerHTML;  
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
document.all.ccc3.style.visibility = 'visible';
  var disp_setting="toolbar=yes,location=no,directories=no,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=870, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("print_content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
  
   docprint.document.open(); 
   docprint.document.write('<html><head><title>Print Preview</title>');
   docprint.document.write('<link rel="stylesheet" href="../assets/css/ApplyAlberta.css" type="text/css" />'); 
   docprint.document.write('</head><centre><body onLoad="self.print();self.close();" style="width: 870px; font-size:8px;border: 0px solid #98C1D1; font-family:Verdana, Geneva, sans-serif;" >');  
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
</script>

    
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min2.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart2.min.js"></script>
    
    <script src="../plugins/chart.js/Chart.js"></script>
<!-- ChartJS Horizontal Bar -->
<script src="../plugins/chart.js/Chart.HorizontalBar.js"></script>

     <!-- morris.js -->
    <script src="../vendors/raphael/raphael.min.js"></script>
    <script src="../vendors/morris.js/morris.min.js"></script>
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
<script type="text/javascript">
 $(document).ready(function(){

            $(document).on('keydown', '.regno', function() {
                
                var id = this.id;
                var splitid = id.split('_');
                var index = splitid[1];
                $( '#'+id ).autocomplete({
                    source: function( request, response ) {
                        $.ajax({
                            url: "getcand.php",
                            type: 'post',
                            dataType: "json",
                            data: {
                                search: request.term,request:1
                            },
                            success: function( data ) {
                                response( data );
                            }});
                    },
                    select: function (event, ui) {
                        $(this).val(ui.item.label); // display the selected text
                        var userid = ui.item.value; // selected id to input

                        // AJAX
                        $.ajax({
                            url: 'getcand.php',
                            type: 'post',
                            data: {userid:userid,request:2},
                            dataType: 'json',
                            success:function(response){
                                
                                var len = response.length;
                                 var notif = "Candidate Not Found";
                                if(len > 0){
                                    var id = response[0]['id'];
                                    var fname = response[0]['fname'];
                                    var lname = response[0]['lname'];
                                    var fac = response[0]['fac'];
                                    var deptn = response[0]['dept1'];
                                    var fac2 = response[0]['fac2'];
                                    var deptn2 = response[0]['dept2'];
                                    var gender = response[0]['sex'];

                                    document.getElementById('fname_'+index).value = fname;
                                    document.getElementById('lname_'+index).value = lname;
                                    document.getElementById('fac_'+index).value = fac;
                                    document.getElementById('dept1_'+index).value = deptn;
                                        document.getElementById('fac2_'+index).value = fac2;
                                    document.getElementById('dept2_'+index).value = deptn2;
                                     document.getElementById('sex_'+index).value = gender;
                                    }else{ document.getElementById('alertn_').value = notif; }        } }); return false;
                    }
                });
            });
            
            // Add more
          
        }); 
		
		
$(document).ready(function() {
    var x_timer;    
    $("#f_typea").keyup(function (e){
        clearTimeout(x_timer);
        var user_name = $(this).val();
        x_timer = setTimeout(function(){
            check_username_ajax(user_name);
        }, 1000);
    });

function check_username_ajax(f_typea){
    $("#user-result").html('<img src="../assets/media/loading.gif" />');
    $.post('m_record.php', {'f_typea':f_typea}, function(data) {
      $("#user-result").html(data);
        $("#user-mm2").html(data);
    });
}
});

$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alertm").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 5000);
 
});


$(document).ready(function(){
 
    // Show Input element
    $('.edit').click(function(){
        $('.txtedit').hide();
        $(this).next('.txtedit').show().focus();
        $(this).hide();
    });

    // Save data
    $(".txtedit").on('focusout',function(){
        
        // Get edit id, field name and value
        var id = this.id;
        var split_id = id.split("_");
        var field_name = split_id[0];
        var edit_id = split_id[1];
        var value = $(this).val();
        
        // Hide Input element
        $(this).hide();

        // Hide and Change Text of the container with input elmeent
        $(this).prev('.edit').show();
        $(this).prev('.edit').text(value);

        // Sending AJAX request
        $.ajax({
            url: 'editmode.php',
            type: 'post',
            data: { field:field_name, value:value, id:edit_id },
            success:function(response){
                console.log('Save successfully'); 
            }
        });
    
    });

});
var xmlhttp

function loadDept(str)
{var a=document.getElementById(str)[document.getElementById(str).selectedIndex].value;
//var a=document.getElementById(str)[document.getElementById(str).selectedIndex].innerHTML;
//document.getElementById("select_id").options[document.getElementById("select_id").selectedIndex].value;
if(a=='Select <?php echo $SCategory; ?>'){ return;}
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
var url="loadDept.php";
url=url+"?loadfac="+d;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
	populate('#time1');
	populate('#time2');
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
if(a=='Select Department'){ return;}
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
var url="loadCourse.php";
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

function accountDisplay(str)
{var a=document.getElementById(str)[document.getElementById(str).selectedIndex].value;
if(a=='Select Hostel'){ return;}
else{
var e=document.getElementById('imgHolder');
e.style.visibility='visible';
xmlhttp=GetXmlHttpObject();

setTimeout(function(){if (xmlhttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  }

var d=document.getElementById(str)[document.getElementById(str).selectedIndex].value;
var url="loadRoom.php";
url=url+"?blockid="+d;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged5;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}

function stateChanged5()
{
if (xmlhttp.readyState==4)
  {
  
  document.getElementById("account_info").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder');
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
var url="../Student/loadRoom.php";
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
var url="../Student/loadhamt.php";
url=url+"?q="+p;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged7;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}

function stateChanged7()
{
if (xmlhttp.readyState==4)
  {
  document.getElementById("txtamtid").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';
  }
}

//load courses table
function loadd(str)
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
var url="loadtDept.php";
url=url+"?loadfac="+d;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged6;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}

function stateChanged6()
{
if (xmlhttp.readyState==4)
  {
  document.getElementById("dept1").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';
  }
}

function loadctable(str1)
{var a=document.getElementById(str1)[document.getElementById(str1).selectedIndex].value;
if(a=='Select Department'){ return;}
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
var url="loadcoursetable.php";
url=url+"?loadcos="+p;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged8;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}

function stateChanged8()
{
if (xmlhttp.readyState==4)
  {
  document.getElementById("loadn1").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';
  }
}

function loadposition(str1)
{var a=document.getElementById(str1)[document.getElementById(str1).selectedIndex].value;
if(a=='Select Election'){ return;}
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
var url="loadposition.php";
url=url+"?loadp="+p;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged9;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}

function stateChanged9()
{if (xmlhttp.readyState==4)
  {document.getElementById("position").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';}
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

function changeUserStatus(userId, status)
{ 	
	var st = status == 'FALSE' ? 'Approve' : 'Cancel Approval'
	if (confirm('Your About to ' + st+' this Application Make Sure All Information are Correct?')) {
	//window.location.href = 'new_apply.php?details&userId=' + userId + '&nst=' + st;
	window.location.href = 'process.php?action=status&userId=' + userId + '&nst=' + st;
	}
}
function changeUserStatus2(userId, status)
{ var st = status == 'FALSE' ? 'Verify' : 'Cancel Verification'
	if (confirm('Your About to ' + st+' this Student Record Make Sure All Information are Correct?')) {
window.location.href = 'process.php?action=status2&userId=' + userId + '&nst=' + st;}}

function changeUserStatus20(userId, status, dep, sec, lev)
{ var st = status == 'FALSE' ? 'Verify' : 'Cancel'
	if (confirm('Your About to ' + st+' this Student Record Make Sure All Information are Correct?')) {
window.location.href = 'process.php?action=status20&userId=' + userId + '&dep=' + dep + '&sec='+ sec +'&los='+ lev +'&nst=' + st;}}

	function changeUserAccess(userId, status)
{var st = status == '0' ? 'Enable' : 'Block user'
	if (confirm('Your About to ' + st+' Access, Make Sure you wish to do so ?')) {
	window.location.href = 'process.php?action=status21&userId=' + userId + '&nst=' + st;
	}}
function changeUserStatus3(userId, status)
{var st = status == 'FALSE' ? 'Show' : 'Hide'
	if (confirm('Your About to ' + st+' this Post Make Sure You really what to do so')) {
	window.location.href = 'process.php?action=status3&userId=' + userId + '&nst=' + st;
	}}
	
	function changeUserStatus4(userId, status)
{var st = status == '0' ? 'Approve' : 'Decline'
	if (confirm('Note this process will not be reverted \n Your About to ' + st+' this Student Room Request Make Sure All Information are Correct?')) {
window.location.href = 'process.php?action=status4&userId=' + userId + '&nst=' + st;
	}}
	
	function changeUserStatus5(userId, status)
{var st = status == 'FALSE' ? 'Show' : 'Hide'
	if (confirm('Your About to ' + st+' this Staff on Our Term Scroller For Site visitors to See, Make Sure you wish to do so ?')) {
	window.location.href = 'process.php?action=status5&id2=' + userId + '&nst=' + st;
	}}
//for staff course approval
function changeUserStatus6(userId,couseid,status)
{var st = status == '0' ? 'Approve' : 'Decline'
if(confirm('Your About to ' + st+' this Student Course Registration Make Sure All Information are Correct?')) {
	window.location.href = 'process.php?action=status6&userId=' + userId + '&cos=' + couseid + '&nst=' + st;}}
	//for staff course approval
function changeUserStatus60(userId,los,deptn,sess,status)
{var st = status == '0' ? 'Approve' : 'Decline'
if (confirm('Your About to ' + st+' this Student Course Registration Make Sure All Information are Correct?')) {
window.location.href = 'process.php?action=status60&userId=' + userId + '&slos=' + los + '&Schd='+ deptn +'&sec='+ sess +'&nst=' + st; }}
//for candidate  approval
function changeUserStatus7(userId, status)
{var st = status == '0' ? 'Approve' : 'Decline'
	if (confirm('Your About to ' + st+' this Candidate for election Make Sure All Information are Correct?')) {
window.location.href = 'process.php?action=status7&userId=' + userId + '&nst=' + st;
	}
}
function changePayStatus2(userId, status,sess,dep,dop)
{var st = status == '0' ? 'Approve' : 'Decline'
	if (confirm('Your About to ' + st+' this Student Payment Make Sure All Information are Correct?')) {
window.location.href = 'process.php?action=status10&userId=' + userId + '&dep='+ dep +'&ses='+ sess +'&dop='+ dop +'&nst=' + st;
}}
//for candidate  result
function changeUserStatus8(userId, status)
{var st = status == '0' ? 'Approve' : 'Decline'
	if (confirm('Your About to ' + st+' this Candidate for election Result Publishing make Sure All Information are Correct?')) {
window.location.href = 'process.php?action=status8&userId=' + userId + '&nst=' + st;
	}
}
//for election activation
function changeUserStatus9(userId, status)
{var st = status == '1' ? 'Start' : 'Stop'
	if (confirm('Your About to ' + st+' Election Process, Please make Sure All Information are Correct?')) {
window.location.href = 'process.php?action=status9&userId=' + userId + '&nst=' + st;
	}
}
setTimeout(popup, 3000);// Setting time 3s to popup login form
            function popup() {
            $('#myModalat42').modal({
			backdrop: 'static'
		});
	 $('#myModalat42').draggable({
    handle: "#modal-header"
  });  
            } 
  //var timoutWarning = 840000; // Display warning in 14 Mins.
//var timoutNow = 900000; // Timeout in 15 mins.
  var timoutWarning = 840000; // Display warning in 14 Mins.
var timoutNow = 900000; // Timeout in 15 mins.
//var logoutUrl = 'http://domain.com/logout.aspx'; // URL to logout page.
var logoutUrl = 'logout.php'; // URL to logout page.
var warningTimer;
var timeoutTimer;

// Start timers.
function StartTimers() {
    warningTimer = setTimeout("IdleWarning()", timoutWarning);
    timeoutTimer = setTimeout("IdleTimeout()", timoutNow);
}

// Reset timers.
function ResetTimers() {
    clearTimeout(warningTimer);
    clearTimeout(timeoutTimer);
    StartTimers();
    //$("#myModalat4").dialog('close');
     $("#myModalat5").modal('close');
}

// Show idle timeout warning dialog.
function IdleWarning() {
    //$("#timeout").dialog({
        //modal: true
    //});
    $('#myModalat5').modal('show');
}

// Logout the user.
function IdleTimeout() {
    window.location = logoutUrl;
} 

    function ShowHideDiv() {
        var ddlPassport = document.getElementById("dura");
        var dvPassport = document.getElementById("other1");
        dvPassport.style.display = ddlPassport.value == "Others" ? "block" : "none";
    }

function validateFloatKeyPress(el) {
    var v = parseFloat(el.value);
    el.value = (isNaN(v)) ? '' : v.toFixed(2);
}


function populate(selector) {
    var select = $(selector);
    var hours, minutes, ampm;
    //for(var i = 480; i <= 1320; i += 30){
    for(var i = 480; i <= 1200; i += 30){
        hours = Math.floor(i / 60);
        minutes = i % 60;
        if (minutes < 10){
            minutes = '0' + minutes; // adding leading zero
        }
        ampm = hours % 24 < 12 ? 'AM' : 'PM';
        hours = hours % 12;
        if (hours === 0){
            hours = 12;
        } 
		
        select.append($('<option></option>')
            .attr('value', hours + ':' + minutes + ' ' + ampm)
            .text(hours + ':' + minutes + ' ' + ampm)
		); 
    }
}
 $('.countn').each(function () {
    $(this).prop('Counter',0.00).animate({
        Counter: $(this).text()
    }, { duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
 
 
function ShowHideDiv(chkPenalty){
            var penper = document.getElementById("penper");
            var pdate = document.getElementById("pdate");
            penper.style.display = chkPenalty.checked ? "block" : "none";
            pdate.style.display = chkPenalty.checked ? "block" : "none"; }
    $(document).ready(function(){
    $('#show').click(function() {
      $('.menu').toggle("slide");
    });
});

function check(e, value) {
      //Check Charater
      var unicode = e.charCode ? e.charCode : e.keyCode;
      if (value.indexOf(".") != -1)
        if (unicode == 46) return false;
      if (unicode != 8)
        if ((unicode < 48 || unicode > 57) && unicode != 46) return false;
    }
</script>
   
  

        
    	<script src="../vendors/jGrowl/jquery.jgrowl.js"></script>
    		<script src="../vendors/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
			<script src="../vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
			<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
			 <script src="../plugins/bootstrap-fileinput.js" type="text/javascript"></script>
			 <script type="text/javascript" src="aftype/actions.js"></script>
		
  </body>
</html>
 <script type="text/javascript">
		              $(document).ready(function(){
		              $('#addsession1').tooltip('show');
		              $('#addsession1').tooltip('hide');
		              });
		              
		             </script>
