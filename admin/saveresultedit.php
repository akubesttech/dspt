
<?php
include('lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['Saveupresult'])){
$id=$_POST['selector'];
$recid = $_POST['recid'];
  $credit_unit = $_POST['chour'];
        $assess = $_POST['assess'];
        $exams = $_POST['exams'];
        $prog = $_POST['prog'];
             $ccode = $_POST['ccode'];
                $csession = $_POST['csession'];
                $csemester = $_POST['csemester'];
                $clevel = $_POST['clevel'];
               
$N = count($id);
for($i=0; $i < $N; $i++)
{ 
mysqli_query($condb,"update results set assessment ='".safee($condb,$assess[$i])."',exam ='".safee($condb,$exams[$i])."',total ='".safee($condb,$assess[$i] + $exams[$i])."',grade='".grading($assess[$i] + $exams[$i],$prog[$i])."',gpoint='".gradpoint($assess[$i] + $exams[$i],$prog[$i])."',qpoint='".gradpoint($assess[$i] + $exams[$i],$prog[$i]) * $credit_unit[$i] ."' where student_id='".safee($condb,$id[$i])."'
		and course_code = '".safee($condb,$ccode[$i])."' and level = '".safee($condb,$clevel[$i])."' and session = '".safee($condb,$csession[$i])."' and semester = '".safee($condb,$csemester[$i])."'") 
or die(mysqli_error($condb));

header("location:Result_am.php?view=v_ares&userId=".$recid[$i]);}
}

?>