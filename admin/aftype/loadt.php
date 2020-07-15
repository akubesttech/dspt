<?php
	// include Database connection file 
	include('../lib/dbcon.php'); 
dbcon();
function getprog($get_RegNo)
{
$query2 = @mysql_query("select Pro_name from prog_tb where pro_id = '$get_RegNo' ")or die(mysql_error());
$count = mysql_fetch_array($query2);
 $nameclass2=$count['Pro_name'];
return $nameclass2;
}
	// Design initial table header 
	$data = '<form method="POST" action="" >
                    <table id="datatable-buttons" class="table table-striped table-bordered"> 
				 	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#fee_delete" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
                  	<button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Record</button>
									
										
                      <thead>
                        <tr>
                      <th>No</th> 
                          <th>Year</th>
                          <th>Application Type</th>
                      
                          <th>Amount</th> 
                           <th>Session</th>
                           <th>Application Period</th>
                           <th>Update</th>
                           <th>Delete</th>
                        </tr>
                      </thead>
                       <tbody>';
	//$user_query = mysql_query("select * from form_db Order by session ASC")or die(mysql_error());
													//while($row_f = mysql_fetch_array($user_query)){
													//$id = $row_f['id'];
													
	$query = "select * from form_db Order by session ASC";

	if (!$result = mysql_query($query)) {
        exit(mysql_error());
    }

    // if query results contains rows then featch those rows 
    if(mysql_num_rows($result) > 0)
    {
    	$number = 1;
    	while($row = mysql_fetch_assoc($result))
    	{
    		$data .= '<tr>
				<td>'.$number.'</td>
				<td>'.$row['year'].'</td>
				<td>'.getprog($row['prog']).'</td>
				<td>'.$row['amount'].'</td>
					<td>'.$row['session'].'</td>
						<td>'.$row['f_start'].' - '.$row['f_end'].'</td>
				<td>
					<button onclick="GetUserDetails('.$row['id'].')" class="btn btn-warning">Update</button>
				</td>
				<td>
					<button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger">Delete</button>
				</td>
    		</tr>';
    		$number++;
    	}
    }
    else
    {
    	// records now found 
    	$data .= '<tr><td colspan="6">Records not found!</td></tr>';
    }

    $data .= '</form>
                    </table>';

    echo $data;
    ?>
     