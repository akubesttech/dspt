<?php
//include('session.php'); 
class attandanse extends dbcon {

    function Add() {
        $present = $_POST['selector'];
        $date = $_POST['date'];
          $staffid = $_POST['teacher'];
          $term = $_POST['term'];
             $month1 = date('M');
              $session =$_POST['sessionNow']; ; 
        $length = count($present);

        $checkSunday = strtotime($date);
        
        $qry = "DELETE FROM attendance WHERE AttDate = '" . $date . "'";
        $this->insert($qry);
        if($this->number_of_days(0, $checkSunday, $checkSunday)){
                return ' ,Note: Today is Sunday  No Attendance was Recorded...';
        }
         if($this->number_of_days(6, $checkSunday, $checkSunday)){
                return ' ,Note: Today is Saturday No Attendance was Recorded ...';
        }
        
        for ($i = 0; $i < $length; $i++) {
            $values = $values . "('{$present[$i]}','{$date}','1','{$staffid}','{$term}','{$month1}','{$session}')";
            if ($i < ($length - 1)) {
                $values = $values . " , ";
            }
        }
        
        $absent = $_POST['absent'];
        if($absent != NULL){
            $ab = explode(',', $absent);
            for($j=0;$j<count($ab);$j++){
                $abQry = $abQry . "('{$ab[$j]}','{$date}','0','{$staffid}','{$term}','{$month1}','{$session}')";
                if ($j < (count($ab) - 1)) {
                    $abQry = $abQry . " , ";
                }
            }
            $this->insert($qry);
            $qry = "INSERT INTO attendance ( EmpID , AttDate ,Prensent,staff_id2,term,month,session) VALUES " . $abQry;
        }
        if($length != 0){
            $qry = "INSERT INTO attendance ( EmpID , AttDate ,Prensent,staff_id2,term,month,session) VALUES " . $values;
            $this->insert($qry);
        }
    }

    function Report($data) {
        $qry = "SELECT count(a.AttID) As Att ,e.EmpName,e.EmpTechnology
                FROM `attendance` a ,employee_detail e
                WHERE a.EmpID = e.EmpID AND a.AttDate >= '{$data['startDate']}' AND a.AttDate <= '{$data['endDate']}'
                GROUP BY a.EmpID
                ORDER BY e.`EmpTechnology` DESC,e.EmpName ASC";
        $result = $this->select($qry);
        return $result;
    }

    function EmpReport($EmpID) {
        $qry = "SELECT e.EmpName,e.EmpTechnology ,a.*
                FROM `attendance` a ,employee_detail e
                WHERE a.EmpID = e.EmpID AND a.AttDate >= '{$_POST['startDate']}' AND a.AttDate <= '{$_POST['endDate']}'
                	  AND e.EmpID = '{$EmpID}'
                ORDER BY a.AttDate ASC";

        $result = $this->select($qry);
        return $result;
    }
    
    function SalaryReport($EmpID){
        $qry = "SELECT e.EmpName,e.EmpTechnology ,i.*
                FROM increment_detail i ,employee_detail e
                WHERE i.EmpID = e.EmpID AND e.EmpID = '{$EmpID}'
                ORDER BY i.IncrementDate ASC";
        $result = $this->select($qry);
        return $result;
    }

    function getEmployeeList() {
        $qry = "SELECT * 
                FROM `employee_detail`
                ORDER BY  `employee_detail`.`EmpName` ASC 
                ";
        return $this->select($qry);
    }

    function getDate($date) {
        $qry = "SELECT a.EmpID,e.EmpName,e.EmpTechnology ,a.AttDate
                FROM `attendance` a ,employee_detail e
                WHERE a.EmpID = e.EmpID 
                      AND a.Prensent = '1'
                      AND a.AttDate = '{$date}'
                ORDER BY e.`EmpTechnology` DESC,e.EmpName ASC
                ";
        $result = $this->select($qry);
        return $result;
    }
    function number_of_days($day, $start, $end)
    {
        $one_week = 604800;
        $w = array(date('w', $start), date('w', $end));
        return floor( ( $end - $start ) / $one_week ) + ( $w[0] > $w[1] ? $w[0] <= $day || $day <= $w[1] : $w[0] <= $day && $day <= $w[1] );
        
        //echo number_of_days(0, $start, $end); // SUNDAY
        //echo number_of_days(1, $start, $end); // MONDAY
        //echo number_of_days(2, $start, $end); // TUESDAY
        //echo number_of_days(3, $start, $end); // WEDNESDAY
        //echo number_of_days(4, $start, $end); // THURSDAY
        //echo number_of_days(5, $start, $end); // FRIDAY
        //echo number_of_days(6, $start, $end); // SATURDAY
        
    }

}
?>