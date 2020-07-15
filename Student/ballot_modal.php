<!-- Preview -->
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
/* background-color: gray; */
  color: black; 
}
</style>
<div class="modal fade" id="preview_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Vote Preview</h4>
            </div>
            <div class="modal-body">
              <div id="preview_body"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Platform -->
<div class="modal fade" id="platform">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="candidate"></b></h4>
            </div>
            <div class="modal-body">
              <p id="plat_view"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<!-- View Ballot -->
<div class="modal fade" id="view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Your Votes</h4>
            </div>
            <div class="modal-body">
             <table border="1">
           <!-- <tr><th>Position</th><th>Firstname</th><th>Lastname</th></tr>#4CAF50 --!>
              <?php
                $id = $session_id;
                $sql1 = "SELECT * FROM post_tb WHERE ecate1 = '".safee($condb,$ecateg)."' ";
									$query1 = mysqli_query($condb,$sql1);
				while($row2 = mysqli_fetch_array($query1)){
                echo "<tr><th colspan='3'>".$row2['position']."</th></tr>";
                $sql = "SELECT *, candidate_tb.fname AS canfirst, candidate_tb.lname AS canlast FROM votes LEFT JOIN candidate_tb ON candidate_tb.candid=votes.candid LEFT JOIN post_tb ON post_tb.postid=votes.posit WHERE voters_id = '$id' and elect = '".$ecateg."' and  posit = '".$row2['postid']."' ORDER BY post_tb.ecate1 ASC";
$query = mysqli_query($condb,$sql); while($row = mysqli_fetch_array($query)){$existv1 = imgExists("../admin/".$row['image']);
if ($existv1 > 0 ){$image ="../admin/".$row['image'];}else{ $image = "uploads/NO-IMAGE-AVAILABLE.jpg";}
 echo "<tr><td colspan='1'><img  src=".$image." height='30px' width='30px' ></td>
    <td colspan='1'>".$row['canfirst']." ".$row['canlast']."</td>
    <td colspan='1'><i class='fa fa-check-circle-o'style='color:green;font-size: 25px;'></i>  </td></tr>"; }} ?>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>
