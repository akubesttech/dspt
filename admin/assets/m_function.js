//var name ;
 function myFcate(name)
{ if (name=1){ return 'Fee';} else if(name=2){
return 'Dues';}else if(name=3){ return 'Form';
}else if(name=0){ return 'Others'; } }

function edit_row(id)
{
var ftypea=document.getElementById("ftypea_val"+id).innerHTML;
 var fdesca=document.getElementById("fdesca_val"+id).innerHTML;
 var fcate=document.getElementById("fcate_val"+id).innerHTML;
  var status=document.getElementById("status_val"+id).innerHTML;
  var st = status == '1' ? 'compulsory' : 'Optional';
  
 

  //var fcate2 = myFcate(fcate); 
document.getElementById("ftypea_val"+id).innerHTML="<input type='text' class='form-control' id='ftypea_text"+id+"' value='"+ftypea+"'>";
 document.getElementById("fdesca_val"+id).innerHTML="<input type='text' class='form-control' id='fdesca_text"+id+"' value='"+fdesca+"'>";
 //document.getElementById("fcate_val"+id).innerHTML="<input type='text' class='form-control' id='fcate_text"+id+"' value='"+fcate+"'>";
 document.getElementById("fcate_val"+id).innerHTML="<select  id='fcate_text"+id+"' class='form-control' ><option value=''>Select Category</option><option value='1'>Fee</option><option value='2'>Dues</option><option value='3'>Form</option><option value='0'>Others</option></select>";
 //document.getElementById("status_val"+id).innerHTML="<input type='text' id='status_text"+id+"' value='"+status+"'>";
document.getElementById("status_val"+id).innerHTML="<select  id='status_text"+id+"' class='form-control' ><option value=''>Select Status</option><option value='1''>compulsory</option><option value='0''>Optional</option></select>";
            
 document.getElementById("edit_button"+id).style.display="none"; 
 document.getElementById("save_button"+id).style.display="block";
 document.getElementById("delete_button"+id).style.display="none";
}

function save_row(id)
{
var ftypea=document.getElementById("ftypea_text"+id).value;
 var fdesca=document.getElementById("fdesca_text"+id).value;
  var fcate=document.getElementById("fcate_text"+id).value;
 var status=document.getElementById("status_text"+id).value;
  var st = status == '1' ? 'compulsory' : 'Optional';
 var st2 = myFcate(fcate) ;
///var name=document.getElementById("name_text"+id).value;
 //var age=document.getElementById("age_text"+id).value;
	 if (ftypea == '' || fdesca == '' || status == ''|| fcate == '') {
    alert("Please Fill All Fields");
    }else{
 $.ajax
 ({
  type:'post',
  url:'m_record.php',
  data:{
   edit_row:'edit_row',
   row_id:id,
  ftypea_val:ftypea,
   fdesca_val:fdesca,
   fcate_val:fcate,
    status_val:status
  },
  success:function(response) {
   if(response=="success")
   {
  
    document.getElementById("ftypea_val"+id).innerHTML=ftypea;
    document.getElementById("fdesca_val"+id).innerHTML=fdesca;
     document.getElementById("fcate_val"+id).innerHTML=st2;
    document.getElementById("status_val"+id).innerHTML=st;
    document.getElementById("edit_button"+id).style.display="block";
    document.getElementById("save_button"+id).style.display="none";
     document.getElementById("delete_button"+id).style.display="block";
   }
  }
 });
}
window.location.href = "user_Private.php?view=Aftype";
}

function delete_row(id)
{
 $.ajax
 ({
  type:'post',
  url:'m_record.php',
  data:{
   delete_row:'delete_row',
   row_id:id,
  },
  success:function(response) {
   if(response=="success")
   {
    var row=document.getElementById("row"+id);
    row.parentNode.removeChild(row);
   }
  }
 });
}

function insert_row()
{
var ftypea=document.getElementById("f_typea").value;
 var fdesca=document.getElementById("f_desca").value;
 var fcate=document.getElementById("fcate").value;
 var status=document.getElementById("status").value;
    var st = status == '1' ? 'compulsory' : 'Optional';
    if (ftypea == '' || fdesca == '' || status == '') {
    alert("Please Fill All Fields");
    }else{
 $.ajax
 ({
  type:'post',
  url:'m_record.php',
  data:{
   insert_row:'insert_row',
   ftypea_val:ftypea,
   fdesca_val:fdesca,
   fcate_val:fcate,
    status_val:status
  },
  success:function(response) {
   if(response!="")
   {
    var id=response;
    var table=document.getElementById("datatable-buttons");
    var table_len=(table.rows.length)-1;
    var row = table.insertRow(table_len).outerHTML="<tr id='row"+id+"'><td><input id='optionsCheckbox' class='uniform_on1' name='selector[]' type='checkbox' value='"+id+"'></td><td id='ftypea_val"+id+"'>"+ftypea+"</td><td id='fdesca_val"+id+"'>"+fdesca+"</td><td id='fcate_val"+id+"'>"+myFcate(fcate)+"</td><td id='status_val"+id+"'>"+st+"</td><td><input type='button' class='btn btn-success' id='edit_button"+id+"' value='edit' onclick='edit_row("+id+");'/><input type='button' class='btn btn-success' id='save_button"+id+"' value='save' style='display: none;' onclick='save_row("+id+");'/><input type='button' class='btn btn-danger' id='delete_button"+id+"' value='delete' onclick='delete_row("+id+");'/></td></tr>";

    document.getElementById("f_typea").value="";
    document.getElementById("f_desca").value="";
    document.getElementById("fcate").value="";
    document.getElementById("status").value="";
    //$('datatable-buttons').load('user_Private.php?view=Aftype');
    //$("datatable-buttons").load(location.href+" datatable-buttons>*","");

 }
  // $("insert_row").html(data);
  }
 });
 window.location.href = "user_Private.php?view=Aftype";
}
return false;
}


//function UpdPanelUpdate(value)
//{
   //var obj = document.getElementById("<%= text.ClientID %>");
  // obj.value=value;
 //  __doPostBack("<%= button.ClientID %>","");
//}
