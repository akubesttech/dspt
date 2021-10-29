<?php
/**
 * Created by PhpStorm.
 * User: haslek_UCNET
 * Date: 11/28/2019
 * Time: 9:59 AM
 */
//echo "What's up how you doing???";
//define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
//spl_autoload_register(function ($clsnm){
   // require_once "Classes/".$clsnm.".php";
//});

include('lib/dbcon.php'); 
dbcon();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
$query3 = mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));$rowdd = mysqli_fetch_array($query3);
$title20 = $rowdd['SchoolName'];$motto = $rowdd['Motto'];$logoback = $rowdd['Logo'];$exists = imgExists($logoback);
$saddress = $rowdd['Address']; $state = $rowdd['State'];$city = $rowdd['City'];
					if ($exists > 0 ){ $logob =  $rowdd['Logo'];}else{ $logob = "uploads/NO-IMAGE-AVAILABLE.jpg";}
include('session.php');

$dept = $_GET['Schd'];
$sess = $_GET['sec'];
$bs_lev =$_GET['lev'];
//$semester = $_GET['sem'];
$semester = $default_semester;
include 'Classes/PHPExcel/IOFactory.php';
include 'Classes/PHPExcel/Cell.php';

//include 'Classes/PHPExcel/PHPExcel_Reader_xls.php';

//$rowFilter = new myReadFilter();
//$objReader = PHPExcel_IOFactory::createReader('Excel5');
//$objReader->setReadDataOnly(true);
//$objReader->setLoadSheetsOnly($worksheet);
//
//$objReader->setReadFilter($rowFilter);
//$objExcel = $objReader->load('./sample/ResultFormat.xls');
//$worksheet = $objExcel->setActiveSheetIndex(2);
//echo  $worksheet->getTitle();

//$highest_column = PHPExcel_Cell::columnIndexFromString($worksheet->getHighestDataColumn());
//echo $worksheet->getCellByColumnAndRow(8,14)->getValue();

$avaluen = ""; 
$valuem = "";
$avaluen2 = "";
$resultsec2 = mysqli_query(Database::$conn,"SELECT level_order,level_name FROM level_db where prog = '$class_ID'  ORDER BY level_order ASC");
$sql_gradeset = mysqli_query(Database::$conn,"select * from grade_tb where prog ='".safee($condb,$class_ID)."' and grade_group ='01' Order by b_max ASC limit 1 ")or die(mysqli_error($condb)); 
$getmg = mysqli_fetch_array($sql_gradeset); $getpass = $getmg['b_max'];
$resultsec3 = mysqli_query(Database::$conn,"SELECT level_order,level_name FROM level_db where prog = '$class_ID'  ORDER BY level_order ASC limit 1");
$getml = mysqli_fetch_array($resultsec3); $getminlevel = $getml['level_order'];
$resultsec4 = mysqli_query(Database::$conn,"SELECT level_order,level_name FROM level_db where prog = '$class_ID'  ORDER BY level_order DESC limit 1");
$getmaxl = mysqli_fetch_array($resultsec4); $getmaxlevel = $getmaxl['level_order']; 

function col_nums(){
    $alphas = range('A','Z');
    $count = count($alphas);
    $start = 'A';
    $cu_ind = 0;
    $cu = 0;
    $cols = array();
    while(true){
        $alpha = $alphas[$cu];
        $col = $start.$alpha;
        $cols[] = $col;
        if($alphas[$count - 1] == $alpha){
            $cu = 0;
            ++$cu_ind;
            if($cu_ind >= $count){

            }else{
                $start = $alphas[$cu_ind];
            }

        }
        if($col == 'ZZ'){
            break;
        }
        ++$cu;
    }
//    foreach ($alphas as $alpha){
//
//    }
    return array_merge($alphas,$cols);
}

function findindex($item){
    $cols = col_nums();
    $index =  array_search($item,$cols);
    return $index;
}
function fill_columns($data,$objExcel,$sty){
    foreach ($data as $k=>$v){
        $objExcel->getActiveSheet()
            ->getCell($k)
            ->setValue($v);

        formBorder($k,$sty,$objExcel);
    }
}
function autoFitColumnWidthToContent($sheet, $fromCol, $toCol= null) {
    if ($toCol == null ) {//not defined the last column, set it the max one
        $toCol = $sheet->getColumnDimension($sheet->getHighestColumn())->getColumnIndex();
    }
    $toCol++;
    for($i = $fromCol; $i !== $toCol; $i++) {
        //echo $i."<br/>";
        $sheet->getColumnDimension($i)->setAutoSize(true);
        $calculatedWidth = $sheet->getColumnDimension($i)->getWidth();
        //echo $calculatedWidth;
        $sheet->getColumnDimension($i)->setWidth((int) $calculatedWidth * 1.05);
    }
    $sheet->calculateColumnWidths();
    for($i = $fromCol;$i !== $toCol;$i++){
        $sheet->getColumnDimension($i)->setAutoSize(false);
    }
}
function autoFitColumnToContent($sheet,$col){
    $sheet->getColumnDimension($col)->setAutoSize(true);
    $calculatedWidth = $sheet->getColumnDimension($i)->getWidth();
    //echo $calculatedWidth;
    $sheet->getColumnDimension($col)->setWidth((int) $calculatedWidth * 1.05);
    $sheet->calculateColumnWidths();
    $sheet->getColumnDimension($col)->setAutoSize(false);
}

function mergenfill_columns($objExcel,$data,$sty = null){
    foreach ($data as $key=>$value){
        $objExcel->getActiveSheet()
            ->mergeCells($key);
        $sss = explode(':',$key);
        $objExcel->getActiveSheet()
            ->getCell($sss[0])
            ->setValue($value);
//        $objExcel->getActiveSheet()
//            ->getColumnDimension($sss[0])
//            ->setAutoSize(false)
//            ->setWidth(mb_strwidth($value));
        $objExcel->getActiveSheet()
            ->getStyle($sss[0])
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        if($sty != null){
            formBorder($key,$sty,$objExcel);
        }
        //$col = preg_replace('/[0-9]+/','',$sss[0]);
    }

}
function setValues($coord,$val,$objExcel){
    $objExcel->getActiveSheet()
        ->getCell($coord)
        ->setValue($val);
}
function vAlign($col_in,$objExcel){
    $objExcel->getActiveSheet()
        ->getStyle($col_in)
        ->getAlignment()
        ->setTextRotation(-90);
}
function makeBold($col_range,$objExcel){
    $objExcel->getActiveSheet()
        ->getStyle($col_range)
        ->setBold(true);
}
function formBorder($cord,$style,$objExcel){
    $objExcel->getActiveSheet()
        ->getStyle($cord)
        ->applyFromArray($style);
}
function setCellFontSize($cord,$size,$objExcel){
    $objExcel->getActiveSheet()
        ->getStyle($cord)
        ->getFont()
        ->setSize($size);
}
function merge($cord,$objExcel){
    $objExcel->getActiveSheet()
        ->mergeCells($cord);
}
function setRowHeight($row,$height,$objExcel){
    $objExcel->getActiveSheet()
        ->getRowDimension($row)
        ->setRowHeight($height);
}
function setInvisible($col,$objExcel){
    $objExcel->getActiveSheet()
        ->getColumnDimension($col)
        ->setVisible(false);
}
function fetchGrade($cgpa,$class_ID){ $con = new Database();
    $q = "Select grade from grade_tb WHERE b_min <= '$cgpa' and b_max >= '$cgpa' AND grade_group  ='01' AND prog = '".safee($con,$class_ID)."'";
    $gclass = $con->getData($q); if(count($gclass) > 0){ return $gclass[0]['grade'];}
    return '';}
function fetchGradeClass($cgpa,$class_ID){ $con = new Database();
    $q = "Select gradename from grade_tb WHERE gpmin <= '$cgpa' and gpmax >= '$cgpa' AND grade_group  ='01' AND prog = '".safee($con,$class_ID)."'";
    $gclass = $con->getData($q); if(count($gclass) > 0){ return $gclass[0]['gradename'];}
    return '';}
function getsnamex($get_RegNo){ $con = new Database();  $query2_fac = "select Concat(FirstName, ' ', SecondName,' ',Othername) AS fullname from student_tb where RegNo = '".safee($con,$get_RegNo)."' ";
$count_fac = $con->getData($query2_fac);
 if(count($count_fac) > 0){ return $count_fac[0]['fullname'];}
return '';
}
$con = new Database();
$nb = "Summary";$kn=0; $adp = $nb.'=>'.$kn;
//$arr = array();
foreach ($resultsec2 as $getgdetails){
    $avaluen2 .= "'".$getgdetails['level_name']."'"."=>".(int)$getgdetails['level_order']."," ; 
}
$valuem = $avaluen;//.$adp;
$numlc = mysqli_num_rows($resultsec2);



//query params

//$dept = 7;
//$sess = '2017/2018';
//$semester = 'Second';




//different levels and their summaries
//$levels = array( 'NDI'=>100,'NDII'=>200,'Summary'=>0);
if($numlc < 3){
if($bs_lev == 100){$levels = array( 'NDI'=>100,'Summary'=>0);}elseif($bs_lev == 200){
 $levels = array('NDI' => 100,'NDII' => 200,'Summary'=>0);   
}elseif($bs_lev == 300){$levels = array('HNDI' => 300,'Summary'=>0);}elseif($bs_lev == 400){
  $levels = array('HNDI' => 300,'HNDII' => 400,'Summary'=>0);  
}else{$levels = array('Summary'=>$bs_lev);} }
if($numlc > 2){
if($bs_lev == 100){$levels = array('NDI' => 100,'Summary'=>0);}elseif($bs_lev == 200){
 $levels = array('NDI' => 100,'NDII' => 200,'Summary'=>0);   
}elseif($bs_lev == 300){$levels = array('NDI' => 100,'NDII' => 200,'NDIII' => 300,'Summary'=>0);}elseif($bs_lev == 400){
  $levels = array('HNDI' => 400,'Summary'=>0); }elseif($bs_lev == 500){ $levels = array('HNDI' => 400,'HNDII' => 500,'Summary'=>0);
  }elseif($bs_lev == 600){$levels = array('HNDI' => 400,'HNDII' => 500,'HNDIII' => 600,'Summary'=>0);
}else{$levels = array('Summary'=>0);} } 
//creating an excel object
$objExcel = new PHPExcel();
// To track the active excel sheet
$c_sheet = 0;
$m_level = $getminlevel;
//To hold the various grade classifications based on the level and semester
$classification = array();
//creating sheets for each levels
foreach ($levels as $level=>$level_number){
    //query to select each course offered
    //$courseq = "Select DISTINCT course_code, c_unit from results WHERE session='$sess' AND dept ='$dept' AND semester='$semester'";
     if($bs_lev == $getmaxlevel ){ $mak = $getmaxlevel;  }else{ $mak = $bs_lev;  }
     
    $courseq = "Select DISTINCT C_code, C_unit from courses WHERE dept_c ='$dept' AND semester='$semester'";
    $st_que = "Select DISTINCT student_id from results WHERE session='$sess' AND dept ='$dept' ";
    if($level_number != 0){
        $courseq .= " AND C_level = '$level_number'";
        $st_que .= "AND level = '$level_number'";
    }else{
    	//$q_level = $getmaxlevel; //max($levels);
        $courseq .= " AND C_level = '$mak'";
       // $st_que .= "AND level = '$mak'";
    }
    $st_que .= " ORDER BY student_id";
    $courses = $con->getData($courseq);
    $num_course = count($courses);
    $que= "Select results.*,coursereg_tb.lect_approve,coursereg_tb.creg_status from results,coursereg_tb 
        WHERE results.dept = coursereg_tb.dept AND results.session = coursereg_tb.session AND results.semester = coursereg_tb.semester
         AND results.dept = '$dept' AND results.session = '$sess'";

    $objExcel->createSheet($c_sheet + 1);
    $objExcel->setActiveSheetIndex($c_sheet);
    $objExcel->getActiveSheet()->setTitle($level);
    $sty = array(
        'alignment'=>array(
            'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ),
    );
    $objExcel->getDefaultStyle()->getFont()->setName('Arial');
    $objExcel->getDefaultStyle()
        ->getFont()
        ->setSize(9);
    $objExcel->getDefaultStyle()
        ->applyFromArray($sty);
    $cols = col_nums();
    //$end_col = findindex('BN');
//    foreach ($cols as $column){
//        if($column == $cols[$end_col]){
//            break;
//        }
//        $objExcel->getActiveSheet()
//            ->getColumnDimension($column)
//            ->setWidth(5);
//    }
//    $objExcel->getActiveSheet()
//        ->getColumnDimension('D')
//        ->setWidth(2);
//    $objExcel->getActiveSheet()
//        ->getColumnDimension('C')
//        ->setWidth(1);
//    $objExcel->getActiveSheet()
//        ->getColumnDimension('A')
//        ->setWidth(1);
    $sty = array(
        'borders'=>array(
            'outline'=>array(
                'style'=>PHPExcel_Style_Border::BORDER_THIN
            ),
        ),
    );
    $cell_sty = array(
        'borders'=>array(
            'allborders'=>array(
                'style'=>PHPExcel_Style_Border::BORDER_NONE
            ),
        ),
    );


//    foreach (range(1,9) as $row){
//        foreach (range($cols[0],$cols[$end_col]) as $col ){
//            formBorder($col.$row,$cell_sty,$objExcel);
//        }
//    }
    $s_data = array(
        'Q14'=>'CGP',
        'R14'=>'CGPA',
        'S14'=>'No. failed'
    );
    fill_columns($s_data,$objExcel,$sty);
    vAlign('S14',$objExcel);
    $start_ind = findindex('T');
    if($level_number == $m_level){
        $start_ind = findindex('M');
    }
    $stp_ind = $start_ind + (2 * ($num_course - 1));
    $c = 0;
// create course columns
    foreach (range($start_ind,$stp_ind,2) as $ind){
        $course_name = '';
        if($c >= $num_course){
            break;
        }else{
            //$course_name =  $courses[$c]['course_code']."(".$courses[$c]['c_unit'].")";
             $course_name =  $courses[$c]['C_code']."(".$courses[$c]['C_unit'].")";
           
        }

        $objExcel->getActiveSheet()->mergeCells($cols[$ind].'14:'.$cols[$ind+1].'14');
        setValues($cols[$ind].'14',$course_name,$objExcel);
        formBorder($cols[$ind].'14:'.$cols[$ind+1].'14',$sty,$objExcel);
        vAlign($cols[$ind].'14',$objExcel);

        ++$c;
    }
//creates the columns after courses
    $next_columns = array();
    $next_columns_values = array(
        'TU','TP','GPA','No. passed','No. failed','Total courses'
    );
    $next_columns_values_n = array('Total failed','CU','CGP','CGPA');
    if($level_number != $m_level){
        $next_columns_values = array_merge($next_columns_values,$next_columns_values_n);
    }
    array_push($next_columns_values,'Outstanding Courses');
    if($level_number == 0){
        array_push($next_columns_values,'Class of Diploma');
        array_push($next_columns_values,'Status');
    }else{
        array_push($next_columns_values,'Remarks');
    }
    $highestcolumn = $stp_ind;
    foreach (range(1,count($next_columns_values)) as $nu){
        $next_columns[$cols[$stp_ind + $nu + 1].'14'] = $next_columns_values[$nu - 1];
        vAlign($cols[$stp_ind + $nu + 1].'14',$objExcel);
        $highestcolumn = $stp_ind + $nu + 1;
        //array_push($next_columns,);
    }

    fill_columns($next_columns,$objExcel,$sty);
//get student names
    $students = $con->getData($st_que);
//fill students names
    $sts = array();
    $st_num_rows = count($students);
    $start_row = 15;
    $c = 0;

    $igs = 0;
    $nigs = 0;
    $distinct = 0;
    $upper = 0;
    $lower = 0;
    $pass = 0;
    $srns = 0;

//get each course results
    foreach ($courses as $course){
        //$c_code = $course['course_code'];
        $c_code = $course['C_code'];
        $q = "Select  total,grade,student_id,c_unit,qpoint,gpoint from results WHERE course_code = '$c_code' AND session = '$sess' AND dept = '$dept'";
        $sts[$c_code] = $con->getData($q);
    }

// fill in results and student names
    foreach ($students as $student){
        $s_id = $student['student_id'];
        $all_courses = "Select Distinct course_code,c_unit,qpoint,grade,session,semester,total,gpoint from results WHERE student_id = '$s_id' ORDER BY session";
        $st_all = $con->getData($all_courses);
        $row = $start_row + $c;
        ++$c;
        $outstanding_c = '';
        $d_class = 'N/A';
        $stat = '';
        $c1 = 0;
        $tu = 0;
         $tgp= 0;
        $tp = 0;
        $gpa = 0;
        $n_p = 0;
        $n_f = 0;
        $tc = 0;
        $tf = 0;
        $cu = 0;
        $cgp = 0;
        $cgpa = 0;

// create course columns
        foreach (range($start_ind,$stp_ind,2) as $ind){
            $results = array();
            $score = '';
            $grade = '';

            if($c1 >= $num_course){

            }else{
                //$results =  $sts[$courses[$c1]['course_code']];
                $results =  $sts[$courses[$c1]['C_code']];
                $ncourse =  $courses[$c1]['C_code'];
                if(count($results) > 0){
                    foreach ($results as $result){
                        if($result['student_id'] == $student['student_id']){
                            $score = $result['total'];
                            $grade = $result['grade'];
                            $tgp = $result['gpoint']*$result['c_unit'];
                            //if($grade != 'F'){
                                if($score > $getpass){
                                $n_p += 1;
                            }else{
                                $n_f += 1;
                            }
                            $tp += $tgp; //$result['qpoint'];
                            $tu += $result['c_unit'];
                        }
                    }
                }


            }
            $nscore = $score." ".fetchGrade($score,$class_ID);
           $fscore =  getscorest($s_id,$dept,$ncourse,$nscore);
                            
            setValues($cols[$ind].$row,$fscore,$objExcel);
            //setValues($cols[$ind + 1].$row,$ncourse,$objExcel);
            $objExcel->getActiveSheet()
                ->getStyle($cols[$ind].$row.":".$cols[$ind + 1].$row)
                ->applyFromArray($sty);
            ++$c1;
        }

        $data = array(
            'C'.$row.':D'.$row =>$c + 1-1,
            'E'.$row.':J'.$row=>$student['student_id'],
            'K'.$row.':L'.$row=>getsnamex($student['student_id'])
        );

        //student id and summary of the previous course unit
        $p_cu = 0;
        $tgp1 = 0;
        $tgp2 = 0;
        $p_gp = 0;
        $p_gpa = 0;
        $p_failed = '';
        foreach ($st_all as $re){
            $cu += $re['c_unit'];
            $tc += 1;
           $tgp1 = $re['gpoint']*$re['c_unit'];
            $cgp += $tgp1;//$re['qpoint'];
            //if($re['grade'] == 'F'){
                if($re['total'] <= $getpass){
                $tf += 1;
                $outstanding_c .= $re['course_code'].',';
            }
            if($re['session'] < $sess && $re['semester'] != $semester){
                $p_cu += $re['c_unit'];
               $tgp2 = $re['gpoint']*$re['c_unit'];
                $p_gp += $tgp2;//$re['qpoint'];
                //if($re['grade'] == 'F'){
                    if($re['total'] <= $getpass){
                    $p_failed .= $re['course_code'].',';
                }
            }
        }
        if($p_cu != 0){
            $p_gpa = round($p_gp/$p_cu,2);
        }

        if($level_number != $m_level){
            $data['M'.$row.':P'.$row] =$p_cu;
            //student previous cgp, cgpa and previous failed courses
            $data_n = array(
                'Q'.$row => $p_gp,
                'R'.$row => $p_gpa,
                'S'.$row => $p_failed
            );
            fill_columns($data_n,$objExcel,$sty);
        }

        mergenfill_columns($objExcel,$data,$sty);

        if($cu != 0){
            $cgpa = round($cgp/$cu,2);
        }
        if($tu != 0){
            $gpa = round($tp/$tu ,2);
        }
        if($level_number == 0){
            if(strlen($outstanding_c) > 0){
                $d_class = 'SRNS';
                $stat = 'Not Graduating';
                $srns += 1;
            }else{
                //$d_class = fetchGradeClass($cgpa);
                $d_class = fetchGradeClass($cgpa,$class_ID);
                $stat = 'Graduating';
                if($cgpa < 2.50){
                    $pass += 1;
                }elseif ($cgpa < 3.00){
                    $lower += 1;
                }elseif ($cgpa < 3.5){
                    $upper += 1;
                }else{
                    $distinct += 1;
                }
            }
        }else{
            if($cgpa < 2.00){
                $stat = 'NIGS';
                $nigs += 1;
            }else{
                $stat = 'IGS';
                $igs += 1;
            }
        }
        $next_columns_values = array($tu,$tp,$gpa,$n_p,$n_f,$tc);
        $next_columns_values_n = array($tf,$cu,$cgp,$cgpa);
        if($level_number != $m_level){
            $next_columns_values = array_merge($next_columns_values,$next_columns_values_n);
        }
        array_push($next_columns_values,$outstanding_c);
        if($level_number == 0){
            array_push($next_columns_values,$d_class);
        }
        array_push($next_columns_values,$stat);
        $next_columns = array();
        foreach (range(1,count($next_columns_values)) as $nu){
            $next_columns[$cols[$stp_ind + $nu + 1].$row] = $next_columns_values[$nu - 1];
            $objExcel->getActiveSheet()
                ->getStyle($cols[$stp_ind + $nu + 1].$row)
                ->applyFromArray($sty);
            //array_push($next_columns,);
        }
        fill_columns($next_columns,$objExcel,$sty);
    }
    $objExcel->getActiveSheet()->getStyle('C'.$start_row.':'.$cols[$stp_ind+13].($start_row+$st_num_rows))
        ->getAlignment()->setWrapText(true);
    if($level_number != 0){$mesn= " ".$semester." Semester Detailed Result for ";}else{$mesn= getlevel($bs_lev,$class_ID)." ".$semester." Semester Detailed Result for ";}

//Note this data can be configured or fetched from database. It is to set the header of the excel sheets
   $data = array(
        'H1:AX1'=> $title20,
        'D2:I2'=> getprog($class_ID),
        'H4:AX5'=> getfacultyc($_SESSION['bfac'])." ".$valuem,
        'C5:E9'=>'',
        'H7:AX7'=> getdeptc($dept),
        'H9:AX9'=> ''.getlevel($level_number,$class_ID).$mesn.$sess.' Session ('.getprog($class_ID).')'
    );
    $c_ind = findindex('T');
    if($level_number == $m_level){
        $c_ind = findindex('M');
    }
    setCellFontSize('H1',18,$objExcel);
    setRowHeight(14,50,$objExcel);
    mergenfill_columns($objExcel,$data);
    $drawing = new PHPExcel_Worksheet_Drawing();
    $drawing->setName('Logo');
    $drawing->setDescription('Logo');
    $drawing->setPath($logob);
    $drawing->setHeight(56);
    $drawing->setCoordinates('C5');
    $drawing->setWorksheet($objExcel->getActiveSheet());


    $data = array(
        'C14:D14'=>'S/N',
        'E14:J14'=>'Matriculation Number',
        'K14:L14'=>'Name (Surname first)'
    );
    if($level_number != $m_level){
        $data['M13:S13']= 'SUMMARY OF PREVIOUS';
        $data['M14:P14'] = 'CU';
        $data[$cols[$c_ind+(($num_course-1) * 2)+7].'13:'.$cols[$c_ind+(($num_course-1) * 2)+11].'13']='CUMMULATIVE SEMESTER';
    }
    $data[$cols[$c_ind]."13:".$cols[$c_ind+(($num_course-1) * 2)+6].'13']='CURRENT SEMESTER INFORMATION';

    mergenfill_columns($objExcel,$data,$sty);
//    $objExcel->getActiveSheet()
//        ->getColumnDimension('M')
//        ->setWidth(1);
//    $objExcel->getActiveSheet()
//        ->getColumnDimension('P')
//        ->setWidth(3);
//    $objExcel->getActiveSheet()
//        ->getColumnDimension('O')
//        ->setWidth(1);
//    $objExcel->getActiveSheet()
//        ->getColumnDimension('L')
//        ->setWidth(10);
    setInvisible('N',$objExcel);
    setInvisible('B',$objExcel);
    foreach (range(1,3)as $add){
//        $objExcel->getActiveSheet()
//            ->getColumnDimension($cols[$c_ind+(($num_course-1) * 2)+11 + $add])
//            ->setWidth(25);
        $objExcel->getActiveSheet()
            ->getStyle($cols[$c_ind+(($num_course-1) * 2)+11 + $add].'14')
            ->getAlignment()
            ->setTextRotation(0);
    }
    formBorder('M13:S13',$sty,$objExcel);
    formBorder($cols[$c_ind]."13:".$cols[$c_ind+(($num_course-1) * 2)+6].'13',$sty,$objExcel);
    formBorder('M13:'.$cols[$highestcolumn - 1].(13 + $st_num_rows +1),$sty,$objExcel);
    formBorder('C'.(13 + $st_num_rows +4).':M'.(13 + $st_num_rows +12),$sty,$objExcel);

    $analy_array = array(
        'C'.(13 + $st_num_rows +4).':M'.(13 + $st_num_rows +4)=>'Analysis of Result',
        'C'.(13 + $st_num_rows +5).':H'.(13 + $st_num_rows +5)=>'Academic Standing',
        'I'.(13 + $st_num_rows +5).':K'.(13 + $st_num_rows +5)=>'Number',
        'L'.(13 + $st_num_rows +5).':M'.(13 + $st_num_rows +5)=>'Percentage',

    );
    if($st_num_rows < 1){
        $st_num_rows = 1;
    }

    if($level_number == 0){
        $analy_array['C'.(13 + $st_num_rows +6).':H'.(13 + $st_num_rows +6)] = 'Distinction';
        $analy_array['I'.(13 + $st_num_rows +6).':K'.(13 + $st_num_rows +6)] = $distinct;
        $analy_array['L'.(13 + $st_num_rows +6).':M'.(13 + $st_num_rows +6)] = round($distinct/$st_num_rows ,3)*100;
        $analy_array['C'.(13 + $st_num_rows +7).':H'.(13 + $st_num_rows +7)] = 'Upper Credit';
        $analy_array['I'.(13 + $st_num_rows +7).':K'.(13 + $st_num_rows +7)] = $upper;
        $analy_array['L'.(13 + $st_num_rows +7).':M'.(13 + $st_num_rows +7)] = round($upper/$st_num_rows ,3)*100;
        $analy_array['C'.(13 + $st_num_rows +8).':H'.(13 + $st_num_rows +8)] = 'Lower Credit';
        $analy_array['I'.(13 + $st_num_rows +8).':K'.(13 + $st_num_rows +8)] = $lower;
        $analy_array['L'.(13 + $st_num_rows +8).':M'.(13 + $st_num_rows +8)] = round($lower/$st_num_rows ,3)*100;
        $analy_array['C'.(13 + $st_num_rows +9).':H'.(13 + $st_num_rows +9)] = 'Pass';
        $analy_array['I'.(13 + $st_num_rows +9).':K'.(13 + $st_num_rows +9)] = $pass;
        $analy_array['L'.(13 + $st_num_rows +9).':M'.(13 + $st_num_rows +9)] = round($pass/$st_num_rows ,3)*100;
        $analy_array['C'.(13 + $st_num_rows +10).':H'.(13 + $st_num_rows +10)] = 'SRNS';
        $analy_array['I'.(13 + $st_num_rows +10).':K'.(13 + $st_num_rows +10)] = $srns;
        $analy_array['L'.(13 + $st_num_rows +10).':M'.(13 + $st_num_rows +10)] = round($srns/$st_num_rows ,3)*100;
        $analy_array['C'.(13 + $st_num_rows +11).':H'.(13 + $st_num_rows +11)] = 'Total';
        $analy_array['I'.(13 + $st_num_rows +11).':K'.(13 + $st_num_rows +11)] = $srns+ $pass+ $lower+ $upper +$distinct;
        $analy_array['L'.(13 + $st_num_rows +11).':M'.(13 + $st_num_rows +11)] = round($st_num_rows/$st_num_rows ,3)*100;
    }else{
        $analy_array['C'.(13 + $st_num_rows +6).':H'.(13 + $st_num_rows +6)] = 'In Good Standing(IGS)';
        $analy_array['I'.(13 + $st_num_rows +6).':K'.(13 + $st_num_rows +6)] = $igs;
        $analy_array['L'.(13 + $st_num_rows +6).':M'.(13 + $st_num_rows +6)] = round($igs/$st_num_rows ,3)*100;
        $analy_array['C'.(13 + $st_num_rows +7).':H'.(13 + $st_num_rows +7)] = 'Not in Good Standing(NIGS)';
        $analy_array['I'.(13 + $st_num_rows +7).':K'.(13 + $st_num_rows +7)] = $nigs;
        $analy_array['L'.(13 + $st_num_rows +7).':M'.(13 + $st_num_rows +7)] = round($nigs/$st_num_rows ,3)*100;
        $analy_array['C'.(13 + $st_num_rows +8).':H'.(13 + $st_num_rows +8)] = 'Total';
        $analy_array['I'.(13 + $st_num_rows +8).':K'.(13 + $st_num_rows +8)] = $nigs + $igs;
        $analy_array['L'.(13 + $st_num_rows +8).':M'.(13 + $st_num_rows +8)] = round($st_num_rows/$st_num_rows ,3)*100;
    }
    mergenfill_columns($objExcel,$analy_array,$sty);
    $objExcel->getActiveSheet()->getStyle('C'.(13 + $st_num_rows +4).':M'.(13 + $st_num_rows +5))->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FF3377FF');

    $sheet_title = $objExcel->getActiveSheet()->getTitle();
    $dataSeriesLabels = array(
        new PHPExcel_Chart_DataSeriesValues('String', $sheet_title.'!$I$'.(13 + $st_num_rows +5), NULL, 1),	//	2011
    );

    if($level_number == 0){
        $xAxisTickValues = array(
            new PHPExcel_Chart_DataSeriesValues('String', $sheet_title.'!$C$'.(13 + $st_num_rows +6).':$C$'.(13 + $st_num_rows +10), NULL, 5),	//	Q1 to Q4
        );
        $dataSeriesValues = array(
            new PHPExcel_Chart_DataSeriesValues('Number', $sheet_title.'!$I$'.(13 + $st_num_rows +6).':$I$'.(13 + $st_num_rows +10), NULL, 5),
        );
    }else{
        $xAxisTickValues = array(
            new PHPExcel_Chart_DataSeriesValues('String', $sheet_title.'!$C$'.(13 + $st_num_rows +6).':$C$'.(13 + $st_num_rows +7), NULL, 2),	//	Q1 to Q4
        );
        $dataSeriesValues = array(
            new PHPExcel_Chart_DataSeriesValues('Number', $sheet_title.'!$I$'.(13 + $st_num_rows +6).':$I$'.(13 + $st_num_rows +7), NULL, 2),
        );
    }

    $series1 = new PHPExcel_Chart_DataSeries(
        PHPExcel_Chart_DataSeries::TYPE_PIECHART,				// plotType
        NULL,			                                        // plotGrouping (Pie charts don't have any grouping)
        range(0, count($dataSeriesValues)-1),					// plotOrder
        $dataSeriesLabels,										// plotLabel
        $xAxisTickValues,										// plotCategory
        $dataSeriesValues										// plotValues
    );

//	Set up a layout object for the Pie chart
    $layout = new PHPExcel_Chart_Layout();
    $layout->setShowVal(TRUE);
    $layout->setShowPercent(TRUE);

//	Set the series in the plot area
    $plotArea = new PHPExcel_Chart_PlotArea($layout, array($series1));
//	Set the chart legend
    $legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

    $title = new PHPExcel_Chart_Title('Result Analysis');


//	Create the chart
    $chart = new PHPExcel_Chart(
        'chart',		// name
        $title,		// title
        $legend,		// legend
        $plotArea,		// plotArea
        true,			// plotVisibleOnly
        0,				// displayBlanksAs
        NULL,			// xAxisLabel
        NULL			// yAxisLabel		- Pie charts don't have a Y-Axis
    );

//	Set the position where the chart should appear in the worksheet
    $chart->setTopLeftPosition('Q'.(13 + $st_num_rows +4));
    $chart->setBottomRightPosition('Y'.(13 + $st_num_rows +15));
    formBorder('Q'.(13 + $st_num_rows +4).':X'.(13 + $st_num_rows +15),$sty,$objExcel);


//	Add the chart to the worksheet
    $objExcel->getActiveSheet()->addChart($chart);

    $objExcel->getActiveSheet()
        ->getPageSetup()
        ->setOrientation(
            PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE
        )
        ->setFitToHeight(1)
        ->setFitToWidth(1);
    $objExcel->getActiveSheet()
        ->setShowGridlines(false);
    //autoFitColumnWidthToContent($objExcel->getActiveSheet(),'C','BX');
    $highestrow = 13 + $st_num_rows;//$objExcel->getActiveSheet()->getHighestDataRow();
    $highestcolumn = $objExcel->getActiveSheet()->getHighestDataColumn();
    $highestcolumn++;
    $objExcel->getActiveSheet()->getStyle('A1:'.$highestcolumn.'14')->getFont()->setBold(true);
    $objExcel->getActiveSheet()->freezePane('A10');
    $hc = $highestrow;
    //echo $hc. ":".$highestcolumn;
    //die();
    for($i = 'A';$i !== $highestcolumn;$i++){
        $highest =1;
        for($b = 1;$b <= $hc;$b++){
            $val = $objExcel->getActiveSheet()->getCell($i.$b)->getValue();
            if(is_string($val)){
                $len = strlen($val);
            }else{
                $len = strlen(strval($val));
            }

            if($len > $highest){
                $highest = $len;
                $objExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
                $objExcel->getActiveSheet()->calculateColumnWidths();
            }
        }
    }

//    for($i = 'B';$i !== $highestcolumn;$i++){
//        $calculatedWidth = $objExcel->getActiveSheet()->getColumnDimension($i)->getWidth();
//        //echo $calculatedWidth.":".$i;
//        if($calculatedWidth == -1){
//            continue;
//        }
//        $objExcel->getActiveSheet()->getColumnDimension($i)->setWidth((int) $calculatedWidth * 1.5);
//        $objExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(false);
//
//    }
    $objExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
    $objExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(false);
    ++$c_sheet;
}
$objWriter = PHPExcel_IOFactory::createWriter($objExcel,'Excel2007');
$objWriter->setIncludeCharts(TRUE);
$objWriter->save('temp/rFormat.xlsx');
$objWriter2 = PHPExcel_IOFactory::createWriter($objExcel,'HTML');
$objWriter2->setIncludeCharts(TRUE);
$objWriter2->writeAllSheets();
echo $objWriter2->generateHTMLHeader();
?>
<style>
    <!--
    html{
        font-family: "Corbel Light";
        font-size: medium;
        background-color: white;
    }
    <?php
    echo $objWriter2->generateStyles(false)
    ?>
</style>
<?php

echo $objWriter2->generateSheetData();
?>
<form action="temp/rFormat.xlsx" method="get">
    <button type="submit">Download Excel</button>
    
</form>
<?php
echo $objWriter2->generateHTMLFooter();
?>
