<?php
include('lib/dbcon.php'); 
dbcon();
$query3 = mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $rowdd = mysqli_fetch_array($query3);
							  $title = $rowdd['SchoolName'];
include('session.php');
function generateRow($conn,$ecat,$elect_ID2,$eleDept,$elefacu){
		$contents = '';
	 	
		$sql = "SELECT * FROM post_tb WHERE ecate1 = '".safee($condb,$ecat)."' ORDER BY position ASC";
        $query = mysqli_query(Database::$conn,$sql);
        while($row = mysqli_fetch_assoc($query)){
        	$id = $row['postid'];
        	$contents .= '
        		<tr>
        			<td colspan="2" align="center" style="font-size:15px;color:#FFF;background-color: #428bca;"><b>'.$row['position'].'</b></td>
        		</tr>
        		<tr>
        			<td width="80%"><b>Candidates</b></td>
        			<td width="20%"><b>Votes</b></td>
        		</tr>
        	';
 if($ecat == "2"){
$sql = "SELECT * FROM candidate_tb WHERE post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID2)."' and approve ='1' and fac = '".safee($condb,$elefacu)."' ORDER BY lname ASC";}elseif($ecat == "1"){
			$sql = "SELECT * FROM candidate_tb WHERE post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID2)."' and fac = '".safee($condb,$elefacu)."' and dept = '".safee($condb,$eleDept)."' and approve ='1' ORDER BY lname ASC";}else{
$sql = "SELECT * FROM candidate_tb WHERE post = '".$row['postid']."' and ecate = '".safee($condb,$elect_ID2)."' and approve = '1' ORDER BY lname ASC ";}
//$sql = "SELECT * FROM candidates WHERE position_id = '$id' ORDER BY lastname ASC";
    		$cquery = mysqli_query(Database::$conn,$sql);
    		while($crow = mysqli_fetch_assoc($cquery)){
    			$sql = "SELECT * FROM votes WHERE candid = '".$crow['candid']."'";
      			$vquery = mysqli_query(Database::$conn,$sql);
      			$votes = mysqli_num_rows($vquery);

      			$contents .= '
      				<tr>
      					<td>'.$crow['fname'].", ".$crow['lname'].'</td>
      					<td>'.$votes.'</td>
      				</tr>
      			';

    		}

        }

		return $contents;
	}
		
	//$parse = parse_ini_file('config.ini', FALSE, INI_SCANNER_RAW);
    //$title = $parse['election_title'];
//$fpdf = new FPDF();
//$fpdf->AddPage();
//$fpdf->Image('background-image.png', 0, 0, $fpdf->w, $fpdf->h);
//$fpdf->Output();
	require_once('tcpdf/tcpdf.php');  
	 $ecat = getecated($elect_ID2); if($ecat == "2"){ $nelect = getecate($elect_ID2)." (".getfacultyc($elefacu).")"; }elseif($ecat == "1"){  $nelect = getecate($elect_ID2)." (".getdeptc($eleDept).")";}else{ $nelect = getecate($elect_ID2);} 
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Election Result: '.$title);  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 
	 
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();
	
	// create background text
//$background_text = str_repeat('Delta State Smart City ', 100);
//$pdf->MultiCell(0, 5, $background_text, 0, 'J', 0, 2, '', '', true, 0, false);
//$pdf->Image('new_image/4686MC WTYE1.png', 50, 50, 100, '', '', 'http://www.tcpdf.org', '', false, 300);

// first embed mask image (w, h, x and y will be ignored, the image will be scaled to the target image's size)
//$mask = $pdf->Image('images/alpha.png', 50, 140, 100, '', '', '', '', false, 300, '', true);

// embed image, masked with previously embedded mask
//$pdf->Image('images/img.png', 50, 140, 100, '', '', 'http://www.tcpdf.org', '', false, 300, '', false, $mask);

	// get the current page break margin
//$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
//$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
//$pdf->SetAutoPageBreak(false, 0);
// set bacground image
//$img_file = 'new_image/4686MC WTYE1.png';
	//$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
//$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
//$pdf->setPageMark();

	 
    $content = '';  
    $content .= '
      	<h2 align="center" style="text-shadow:-1px 1px 1px #000;">'.$title.'</h2>
      	<h4 align="center" style="color:#000;"> Election Result  for '.$nelect.'</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
      ';  
   	$content .= generateRow($condb,$ecat,$elect_ID2,$eleDept,$elefacu);  
    $content .= '</table>';  
    $pdf->writeHTML($content);
	ob_end_clean();  
    $pdf->Output('election_result.pdf', 'I');

?>