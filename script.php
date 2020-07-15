       <link href="admin/assets/styles1.css" rel="stylesheet" media="screen">      
	
	
	   <!--------------------------------------/.fluid-container-------------------------------------->
        <link href="admin/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen"> 
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min1.js"></script>
        <script src="admin/bootstrap1/js/bootstrap.min.js"></script>
        <script src="admin/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="admin/assets/scripts.js"></script>
				<script>
				$(function() {
				<!-----------------------Easy pie charts---------------------------------->
					$('.chart').easyPieChart({animate: 1000});
				});
				</script>
				
				
		<!------------------------------------- jgrowl-------------------------------------------- -->
		<script src="admin/vendors/jGrowl/jquery.jgrowl.js"></script>   
				<script>
				$(function() {
					$('.tooltip').tooltip();	
					$('.tooltip-left').tooltip({ placement: 'left' });	
					$('.tooltip-right').tooltip({ placement: 'right' });	
					$('.tooltip-top').tooltip({ placement: 'top' });	
					$('.tooltip-bottom').tooltip({ placement: 'bottom' });
					$('.popover-left').popover({placement: 'left', trigger: 'hover'});
					$('.popover-right').popover({placement: 'right', trigger: 'hover'});
					$('.popover-top').popover({placement: 'top', trigger: 'hover'});
					$('.popover-bottom').popover({placement: 'bottom', trigger: 'hover'});
					$('.notification').click(function() {
						var $id = $(this).attr('id');
						switch($id) {
							case 'notification-sticky':
								$.jGrowl("Stick this!", { sticky: true });
							break;
							case 'notification-header':
								$.jGrowl("A message with a header", { header: 'Important' });
							break;
							default:
								$.jGrowl("Hello world!");
							break;
						}
					});
				});
				</script>
			<link href="admin/vendors/datepicker.css" rel="stylesheet" media="screen">
			<link href="admin/vendors/uniform.default.css" rel="stylesheet" media="screen">
			<link href="admin/vendors/chosen.min.css" rel="stylesheet" media="screen">
		<!--  -->
		<script src="admin/vendors/jquery.uniform.min.js"></script>
        <script src="admin/vendors/chosen.jquery.min.js"></script>
        <script src="admin/vendors/bootstrap-datepicker.js"></script>
		<!--  -->
			<script src="admin/vendors/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
			<script src="admin/vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
			<script src="admin/vendors/ckeditor/ckeditor.js"></script>
			<script src="admin/vendors/ckeditor/adapters/jquery.js"></script>
			<script type="text/javascript" src="admin/vendors/tinymce/js/tinymce/tinymce.min.js"></script>
        <script>
        $(function() {
           <!-------------------------------Ckeditor standard-------------------------------------->
            $( 'textarea#ckeditor_standard' ).ckeditor({width:'98%', height: '150px', toolbar: [
				{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
				[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
				{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
			]});
            $( 'textarea#ckeditor_full' ).ckeditor({width:'98%', height: '150px'});
        });
        </script>
		<!-- ----------<script type="text/javascript" src="admin/assets/modernizr.custom.86080.js"></script> ------------------------->
		<script src="admin/assets/jquery.hoverdir.js"></script>
		<link rel="stylesheet" type="text/css" href="admin/assets//style.css" />
			<script type="text/javascript">
			$(function() {
				$('#da-thumbs > li').hoverdir();
			});
			</script>
			<script src="admin/vendors/fullcalendar/fullcalendar.js"></script>
			<script src="admin/vendors/fullcalendar/gcal.js"></script>
			<link href="admin/vendors/datepicker.css" rel="stylesheet" media="screen">
			<script src="admin/vendors/bootstrap-datepicker.js"></script>
						<script>
						$(function() {
							$(".datepicker").datepicker();
							$(".uniform_on").uniform();
							$(".chzn-select").chosen();
							$('#rootwizard .finish').click(function() {
								alert('Finished!, Starting over!');
								$('#rootwizard').find("a[href*='tab1']").trigger('click');
							});
						});
						
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
var url="./admin/loadDept.php";
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

//load level
function loadlevel(str1)
{var a=document.getElementById(str1)[document.getElementById(str1).selectedIndex].value;
if(a=='Select Program'){ return;}else{var e=document.getElementById('imgHolder2');
e.style.visibility='visible';xmlhttp=GetXmlHttpObject(); setTimeout(function(){if (xmlhttp==null)
  {alert ("Your browser does not support AJAX!"); return;}

var p=document.getElementById(str1)[document.getElementById(str1).selectedIndex].value;
var url="loadlevel.php";
url=url+"?proid="+p;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged20;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);}}
function stateChanged20()
{if (xmlhttp.readyState==4){document.getElementById("level").innerHTML=xmlhttp.responseText; var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';}}


function loaddept1(str1)
{var a=document.getElementById(str1)[document.getElementById(str1).selectedIndex].value;
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

var d=document.getElementById(str1)[document.getElementById(str1).selectedIndex].value;
var url="./admin/loadDept.php";
url=url+"?loadfac="+d;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged1;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}
function stateChanged1()
{
if (xmlhttp.readyState==4)
  {
  document.getElementById("dept_2").innerHTML=xmlhttp.responseText;
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
var url="load_lga.php";
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


function showgroup(str)
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
xmlhttp.open("GET","loadd_group.php?q="+str,true);
xmlhttp.send();
}
   /* $(document).ready(function(){  
     var i=1;
	  var count = 0;  
var max_fields = 10; //Maximum allowed input fields
$('#add').click(function(){  
  //if(i < max_fields){ 
            //input field increment
           i++;  

           $('#dynamic_field').append('<tr id="row'+i+'" ><div class="form-group"  ><td>'+ count +'</td><td><select class="form-control input-sm"   name="Sub_7" id="Sub_7"   required="required"> <option value="">Select Subject</option><option value="bbd97b00c539801e32317ab550867ec4">Very Good (B2)</option><?php  //include('sub_load.php');   ?> </select></td><td><select class="form-control input-sm"   name="grade_7" id="grade_7"   required="required"><option value="">Select Grade</option><?php // include('grade_load.php');   ?> </select></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></div></tr>'
		   
		  // }
		   );  

      });
      
        $(document).on('click', '.btn_remove', function(){  

           var button_id = $(this).attr("id");   

           $('#row'+button_id+'').remove();  

      });
       });  */
       $(document).ready(function() {
       var count = 0;
    var max_fields = 10; //Maximum allowed input fields 
    var wrapper    = $(".wrapper"); //Input fields wrapper
    var add_button = $(".add_fields"); //Add button class or ID
    var x = 0; //Initial input field is set to 1
	
	//When user click on add input button
	$(add_button).click(function(e){
        e.preventDefault();
        	count += 1;
		//Check maximum allowed input fields
        if(x < max_fields){ 
            x++; //input field increment
			 //add input field
            $(wrapper).append('<div class="row"><input type="hidden" name="selector[]" value="'+ x +'"><div class="col-xs-1 col-sm-1 col-md-1"></div><div class="col-xs-6 col-sm-6 col-md-3" ><div class="form-group"  ><select class="form-control input-sm"   name="suba[]'+ x +'"  required="required"  ><option value="">Select Subject</option><?php  echo fill_sub();?> </select></div></div> <div class="col-xs-6 col-sm-6 col-md-3" ><div class="form-group"  ><select class="form-control input-sm"   name="gradea[]'+ x +'" required="required"   ><option value="">Select Grade</option><?php  echo fill_grade();?> </select></div></div><a href="javascript:void(0);" class="remove_field btn btn-danger btn_remove">X</a></div>');
        }
    });
	
    //when user click on remove button
    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault();
		$(this).parent('div').remove(); //remove inout field
		x--; //inout field decrement
    })
    
    //add second result
       var count2 = 0;
    var max_fields2 = 10; //Maximum allowed input fields 
    var wrapper2    = $(".wrapper2"); //Input fields wrapper
    var add_button2 = $(".add_fields2"); //Add button class or ID
    var y = 0; //Initial input field is set to 1
    //When user click on add input button
	$(add_button2).click(function(e){
        e.preventDefault();
        	count2 += 1;
		//Check maximum allowed input fields
        if(y < max_fields2){ 
            y++; //input field increment
			 //add input field
            $(wrapper2).append('<div class="row"><input type="hidden" name="selector2[]" value="'+ y +'"><div class="col-xs-1 col-sm-1 col-md-1"> </div><div class="col-xs-6 col-sm-6 col-md-3" ><div class="form-group"  ><select class="form-control input-sm"   name="subb[]'+ y +'"  required="required"  ><option value="">Select Subject</option><?php  echo fill_sub();?> </select></div></div> <div class="col-xs-6 col-sm-6 col-md-3" ><div class="form-group"  ><select class="form-control input-sm"   name="gradeb[]'+ y +'" required="required"   ><option value="">Select Grade</option><?php  echo fill_grade();?> </select></div></div><a href="javascript:void(0);" class="remove_field2 btn btn-danger btn_remove">X</a></div>');
        }
    });
	
    //when user click on remove button
    $(wrapper2).on("click",".remove_field2", function(e){ 
        e.preventDefault();
		$(this).parent('div').remove(); //remove inout field
		y--; //inout field decrement
    })
});

    $(document).ready(function() {
        $('.btn-danger').click(function() {
            var id = $(this).attr("id");
            if (confirm("Are you sure you want to delete this Result?")) {
                $.ajax({
                    type: "POST",
                    url: "deleteolevel1.php",
                    data: ({
                        id:id
                    }),
                   // cache: false,
                    success: function(html) {
                        $(".row" + id).fadeOut('slow');
                        //window.location.href = 'apply_b.php?view=N_1';
                        	
                    }
                });
            } else {
                return false;
            }
        });
    });
		
		function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: 'getData.php',
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (html) {
            $('#posts_content').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});	
setInterval("my_function();",10000); 
    function my_function(){
      $('#refresh').load(location.href + ' #time');
    }			
	
	function getData(empid, divid){
                $.ajax({
                    url: 'loademployeedata.php?empid='+empid, //call storeemdata.php to store form data
                    success: function(html) {
                        var ajaxDisplay = document.getElementById(divid);
                        ajaxDisplay.innerHTML = html;
                    }
                });
            }
function recordClick(ad_id){
    var id = ad_id;

alert( ad_id); // is not getting here...
obj = getHTTPObject();

var link = "./record_click.php?ad_id" + id;
if( obj != null ){
    obj.open( "GET", link, true );
    obj.send( null );
    obj.onreadystatechange = outputData;
}
}

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
   docprint.document.write('<link rel="stylesheet" href="assets/css/ApplyAlberta.css" type="text/css" />'); 
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

function tablePrint3(){ 
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



						</script>