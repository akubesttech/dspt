				   <select class="form-control"   name="level" id="level"  required="required">
  <option value="">Select Level</option>
<?php 
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2))
{
echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	
}
?>
<!-- <option value="Others">Other Level</option> --!>
</select>