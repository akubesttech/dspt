<?php 

$file= $_FILES['fileName']['name'];
$tempName = $_FILES['fileName']['tmp_name'];
$course_e=$_POST['cos'];
$session2=$_POST['session'];
$semester=$_POST['semester'];
$level=$_POST['level'];
$deptd = $_POST['dept1'];
$query_recover = mysqli_query($condb,"SELECT * FROM results WHERE course_code='".safee($condb,$course_e)."' AND  session='".safee($condb,$session2)."' AND semester='".safee($condb,$semester)."' AND level ='".safee($condb,$level)."'")or die(mysqli_error($condb)); 
$num_recover = mysqli_num_rows($query_recover);//$row_recover = mysqli_fetch_array($query_recover); $annSubject = $row_recover['subject']; $adminid = $row_recover['admin_id']; $adminuser = $row_recover['username'];

if($num_recover > 0){ 
//$res="<font color='Red'><strong>ERROR:  This Result has been Uploaded Before,Please Comfirm and Try Again .</strong></font><br>";$resi=1;
//$showerror2="ERROR:  This Result with this Course code $course_e has been Uploaded Before in this Semester ,Please Comfirm and Try Again.";

 
				//setcookie("showerror3","<div class=\"alert alert-warning\"><i class=\"icon-info-sign\"><font color='Red'>".$showerror2."</font><br></i> </div>",time()+5);
echo "<script>alert('ERROR:  This Result with this Course code $course_e has been Uploaded Before in this Semester ,Please Comfirm and Try Again.');</script>";
			
			redirect("Result_am.php?view=aimp_re");
}

if ($_FILES["fileName"]["error"] > 0)
{
	echo "Error: " . $_FILES["file"]["error"] . "<br>";
	exit;
} 
else
{
      //while($r < 2){
								   $dig .="book".rand(3,9);
                                   // $r+=1;
                                        //  }
                                         $file=$dig . ".xls";                           //$uploadfile = $newname;
    	move_uploaded_file($tempName,"temp/".$file);
}
//unset($dig);
//$r=0;
$allow_url_override = 1; // Set to 0 to not allow changed VIA POST or GET
if(!$allow_url_override || !isset($file_to_include))
{
	$file_to_include = $file;
}
if(!$allow_url_override || !isset($max_rows))
{
	$max_rows = 0; //USE 0 for no max
}
if(!$allow_url_override || !isset($max_cols))
{
	$max_cols = 0; //USE 0 for no max
}
if(!$allow_url_override || !isset($debug))
{
	$debug = 0;  //1 for on 0 for off
}
if(!$allow_url_override || !isset($force_nobr))
{
	$force_nobr = 1;  //Force the info in cells not to wrap unless stated explicitly (newline)
}
	//$handle = fopen($_FILES['file']['tmp_name'], "r");

require_once 'Excel/reader.php';
$data = new Spreadsheet_Excel_Reader();
//$data = fgetcsv ($handle, 1000, ",");
$data->setOutputEncoding('CPa25a');
$data->read($file_to_include);
error_reporting(E_ALL ^ E_NOTICE);
echo "
<STYLE>
.table_data
{
	border-style:ridge;
	border-width:1;
	text-shadow:0 1px 1px gray;
	width:100px;
}
.tab_base
{
	background:#C5D0DD;
	font-weight:bold;
	border-style:solid;
	border-width:1;
	cursor:pointer;
}
.table_sub_heading
{
	background:#CCCCCC;
	font-weight:bold;
	border-style:solid;
	border-width:1;
	text-shadow:0 1px 2px green;
}
.table_body
{
	background:#F0F0F0;
	font-wieght:normal;
	font-size:12;
	font-family:sans-serif;
	border-style:ridge;
	border-width:1;
	border-spacing: 0px;
	border-collapse: collapse;
	box-shadow:0 1px 2px gray;
}
.tab_loaded
{
	background:#222222;
	color:white;
	font-weight:bold;
	border-style:groove;
	border-width:1;
	cursor:pointer;
}
.table_data:hover
{
background:white;
}

#cpbtn:link, #cpbtn:visited, #cpbtn:active
{
	text-decoration:none;
}
</STYLE>
";
function make_alpha_from_numbers($number)
{
	$numeric = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	if($number<strlen($numeric))
	{
		return $numeric[$number];
	}
	else
	{
		$dev_by = floor($number/strlen($numeric));
		return "" . make_alpha_from_numbers($dev_by-1) . make_alpha_from_numbers($number-($dev_by*strlen($numeric)));
	}
}
?>



<div class="x_panel">
                
             
                <div class="x_content">
                 <?php
								$queryx = mysqli_query($condb,"select * from new_apply1 where stud_id ='$get_RegNo'");
								$row_admit = mysqli_fetch_array($queryx);
								?>
	                <form method="post" class="form-horizontal"  action="" enctype="multipart/form-data">
                    <input type="hidden" name="insidresult" value="<?php echo $_SESSION['insidresult'];?> " />
              
                    
                      
                      <span class="section">Preview of imported Excel Data Sheet for <?php echo ucwords($course_e." Course in ". $session2." Session ."); ?> <?php
                                          if($resi20 == 1)
{


					echo " 
		
			    <center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res20</font></label></center>
			 
			  ";
}
?></span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
                   
Note: Preview The Excel File Before Saving into the Database because it cannot be edited when Process Result Button is clicked.

                  </div>
                  
      <div id="content">
  <?php 
  echo "<SCRIPT LANGUAGE='JAVASCRIPT'>
var sheet_HTML = Array();\n";
for($sheet=0;$sheet<count($data->sheets);$sheet++)
{
	$table_output[$sheet] .= "<TABLE id='datatable' class='table table-striped table-bordered'>
	 <tbody>
	<TR>
		<th>S/N</th>";
	for($i=0;$i<$data->sheets[$sheet]['numCols']&&($i<=$max_cols||$max_cols==0);$i++)
	{
		$table_output[$sheet] .= "<th CLASS='table_sub_heading' ALIGN=CENTER>" . make_alpha_from_numbers($i) . "</th>";
	}
	for($row=1;$row<=$data->sheets[$sheet]['numRows']&&($row<=$max_rows||$max_rows==0);$row++)
	{
		$table_output[$sheet] .= "<TR><th CLASS='table_sub_heading' width='30'>" . $row . "</th>";
		for($col=1;$col<=$data->sheets[$sheet]['numCols']&&($col<=$max_cols||$max_cols==0);$col++)
		{
			if($data->sheets[$sheet]['cellsInfo'][$row][$col]['colspan'] >=1 && $data->sheets[$sheet]['cellsInfo'][$row][$col]['rowspan'] >=1)
			{
				$this_cell_colspan = " COLSPAN=" . $data->sheets[$sheet]['cellsInfo'][$row][$col]['colspan'];
				$this_cell_rowspan = " ROWSPAN=" . $data->sheets[$sheet]['cellsInfo'][$row][$col]['rowspan'];
				for($i=1;$i<$data->sheets[$sheet]['cellsInfo'][$row][$col]['colspan'];$i++)
				{
					$data->sheets[$sheet]['cellsInfo'][$row][$col+$i]['dontprint']=1;
				}
				for($i=1;$i<$data->sheets[$sheet]['cellsInfo'][$row][$col]['rowspan'];$i++)
				{
					for($j=0;$j<$data->sheets[$sheet]['cellsInfo'][$row][$col]['colspan'];$j++)
					{
						$data->sheets[$sheet]['cellsInfo'][$row+$i][$col+$j]['dontprint']=1;
					}
				}
			}
			else if($data->sheets[$sheet]['cellsInfo'][$row][$col]['colspan'] >=1)
			{
				$this_cell_colspan = " COLSPAN=" . $data->sheets[$sheet]['cellsInfo'][$row][$col]['colspan'];
				$this_cell_rowspan = "";
				for($i=1;$i<$data->sheets[$sheet]['cellsInfo'][$row][$col]['colspan'];$i++)
				{
					$data->sheets[$sheet]['cellsInfo'][$row][$col+$i]['dontprint']=1;
				}
			}
			else if($data->sheets[$sheet]['cellsInfo'][$row][$col]['rowspan'] >=1)
			{
				$this_cell_colspan = "";
				$this_cell_rowspan = " ROWSPAN=" . $data->sheets[$sheet]['cellsInfo'][$row][$col]['rowspan'];
				for($i=1;$i<$data->sheets[$sheet]['cellsInfo'][$row][$col]['rowspan'];$i++)
				{
					$data->sheets[$sheet]['cellsInfo'][$row+$i][$col]['dontprint']=1;
				}
			}
			else
			{
				$this_cell_colspan = "";
				$this_cell_rowspan = "";
			}
			if(!($data->sheets[$sheet]['cellsInfo'][$row][$col]['dontprint']))
			{
				$table_output[$sheet] .= "<TD CLASS='table_data'  $this_cell_colspan $this_cell_rowspan>&nbsp;";
				if($force_nobr)
				{
					$table_output[$sheet] .= "<NOBR>";
				}
				$table_output[$sheet] .= nl2br(htmlentities($data->sheets[$sheet]['cells'][$row][$col]));
				if($force_nobr)
				{
					$table_output[$sheet] .= "</NOBR>";
				}
				$table_output[$sheet] .= "</TD>";
			}
		}
		$table_output[$sheet] .= "</TR> <tbody>";
	}
	$table_output[$sheet] .= "</TABLE>";
	$table_output[$sheet] = str_replace("\n","",$table_output[$sheet]);
	$table_output[$sheet] = str_replace("\r","",$table_output[$sheet]);
	$table_output[$sheet] = str_replace("\t"," ",$table_output[$sheet]);
	if($debug)
	{
		$debug_output = print_r($data->sheets[$sheet],true);
		$debug_output = str_replace("\n","\\n",$debug_output);
		$debug_output = str_replace("\r","\\r",$debug_output);
		$table_output[$sheet] .= "<PRE>$debug_output</PRE>";
	}
	echo "sheet_HTML[$sheet] = \"$table_output[$sheet]\";\n";
}
echo "
function change_tabs(sheet)
{
	//alert('sheet_tab_' + sheet);
	for(i=0;i<" , count($data->sheets) , ";i++)
	{
		document.getElementById('sheet_tab_' + i).className = 'tab_base';
	}
	document.getElementById('table_loader_div').innerHTML=sheet_HTML[sheet];
	document.getElementById('sheet_tab_' + sheet).className = 'tab_loaded';

}
</SCRIPT>";
echo "
<TABLE CLASS='table_body' NAME='tab_table'>
<TR>";
for($sheet=0;$sheet<count($data->sheets);$sheet++)
{
	echo "<TD CLASS='tab_base' ID='sheet_tab_$sheet' ALIGN=CENTER
		ONMOUSEDOWN=\"change_tabs($sheet);\">", $data->boundsheets[$sheet]['name'] , "</TD>";
}

echo 
"<TR>";
echo "</TABLE>
<DIV ID=table_loader_div></DIV>
<SCRIPT LANGUAGE='JavaScript'>
change_tabs(0);
</SCRIPT>";
//echo "<IFRAME NAME=table_loader_iframe SRC='about:blank' WIDTH=100 HEIGHT=100></IFRAME>";
/*
echo "<PRE>";
print_r($data);
echo "</PRE>";
*/
//echo "<br><a  rel='tooltip' href='uploadNow2.php?file=".safee($condb,$file)."&level=".safee($condb,$level)."&reco=".safee($condb,$course_e)."&c_seme=".safee($condb,$semester)."&session=".safee($condb,$session2)."&staffID=".safee($condb,$admin_id)."' id='submit'  class='btn btn-primary col-md-2' title='Click to Complete $course_e Result Processing'><i class='fa fa-gears'></i> Process Result</i></a>";
?>
<br><a  rel='tooltip' onClick="window.location.href='uploadNow2.php?file=<?php echo safee($condb,$file);?>&level=<?php echo safee($condb,$level);?>&reco=<?php echo safee($condb,$course_e);?>&c_seme=<?php echo safee($condb,$semester);?>&session=<?php echo safee($condb,$session2);?>&staffID=<?php echo safee($condb,$admin_id);?>&dep=<?php echo safee($condb,$deptd);?>';" id='submit'  class='btn btn-primary col-md-2' title='Click to Complete <?php echo $course_e; ?> Result Processing'><i class='fa fa-gears'></i> Process Result</i></a>


												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#submit').tooltip('show');
	                                            $('#submit').tooltip('hide');
	                                            });
	                                            </script>

</div>
             
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                        
                      </div>
                    </form>
                  </div>
                  