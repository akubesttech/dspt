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

//Browser Support Code
            function ajaxFunction2(){
               var ajaxRequest;  // The variable that makes Ajax possible!
               try {
                  // Opera 8.0+, Firefox, Safari
                  ajaxRequest = new XMLHttpRequest();
               }catch (e) {
                  // Internet Explorer Browsers
                  try {
                     ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                  }catch (e) {
                     try{
                        ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                     }catch (e){
                        // Something went wrong
                        alert("Your browser broke!");
                        return false;
                     }
                  }
               }
               
               // Create a function that will receive data 
               // sent from the server and will update
               // div section in the same page.
					
               ajaxRequest.onreadystatechange = function(){
                  if(ajaxRequest.readyState == 4){
                     var ajaxDisplay = document.getElementById('ajaxDiv');
                     ajaxDisplay.innerHTML = ajaxRequest.responseText;
                  }
               }
               
               // Now get the value from user and pass it to
               // server script.
					
               var startd = document.getElementById('ed2').value;
               var endd = document.getElementById('ed3').value;
              // var mday = document.getElementById('mday').value;
               var queryString = "?ed2=" + startd + "&ed3=" + endd;
            
              // queryString +=  "&mmonth=" + mmonth + "&mday=" + mday;
               ajaxRequest.open("GET", "remPayreport.php" + queryString, true);
               ajaxRequest.send(null); 
            }
            
            function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();



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
    
    <script src="../vendors/Chart.js/Chart.js"></script>
<!-- ChartJS Horizontal Bar -->
<script src="../vendors/Chart.js/Chart.HorizontalBar.js"></script>

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
     
<script type="text/javascript" src="../js/footerfuction.js"></script>

  

        
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

// load penalty check
    function showpcheck(str)
{if (str==""){
  //document.getElementById("txtroomno").innerHTML="Amount was Not Loaded Because Form Type was Not Selected";
 // return;
  } if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();}else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
xmlhttp.onreadystatechange=function(){
if (xmlhttp.readyState==4 && xmlhttp.status==200){
    document.getElementById("loadcheck").innerHTML=xmlhttp.responseText;
    
    }}
xmlhttp.open("GET","loadp_check.php?q="+str,true);
xmlhttp.send();}
		             </script>
