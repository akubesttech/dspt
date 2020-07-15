$(document).ready(function(){
// code to get all records from table via select box
$("#dept1").change(function() {
var id = $(this).find(":selected").val();
var dataString = 'loadcos='+ id;
$.ajax({
url: 'meedit.php',
dataType: "json",
data: dataString,
cache: false,
success: function(response) {
$('tbody').html(response.html);
//if(employeeData) {
//$("#heading").show();
//$("#no_records").hide();
//$("#emp_name").text(employeeData.employee_name);
//$("#emp_age").text(employeeData.employee_age);
//$("#emp_salary").text(employeeData.employee_salary);
//$("#records").show();
//} else {
//$("#heading").hide();
//$("#records").hide();
//$("#no_records").show();
//}
}
});
})
});