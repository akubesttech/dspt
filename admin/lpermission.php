<?php
include('lib/dbcon.php'); 
dbcon();
if(isset($_REQUEST['q'])){
	$search = safee($condb,$_REQUEST['q']);
}
$serial=1;
$viewutme_query = mysqli_query($condb,"select * from role_rights LEFT JOIN module ON role_rights.rr_modulecode = module.mod_modulecode WHERE role_rights.rr_rolecode = '$search' OR module.mod_modulename LIKE '%$search%' GROUP BY rr_rolecode, rr_modulecode ORDER BY rr_rolecode ASC,rr_modulecode ASC  ")or die(mysqli_error($condb));

//$data = array();
while($row_utme = mysqli_fetch_array($viewutme_query)){
$id = $row_utme['rr_rolecode'];
$new_a_id = $row_utme['rr_modulecode'];
$sno = $row_utme['sno'];

?>     
                        <tr>
 <td width="30"> <input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $sno; ?>" checked>
											
												</td>
												<input type="hidden" name="role1[]" value="<?php echo $id; ?>">
												 <input type="hidden" name="module1[]" value="<?php echo $new_a_id; ?>"  >
											
												<td width="30"> <?php echo $serial++;?> </td>
						  <td><a rel="tooltip"  title="" id="<?php echo $new_a_id; ?>"  data-toggle="modal" class="btn btn-info"><i class=""> <?php 
echo getstatus($row_utme['rr_rolecode']); ?></i></a></td>
                          <td><?php echo $row_utme['mod_modulename']; ?></td>
                          <td><input type="checkbox" value="1" name="perma[]" <?php echo ($row_utme['rr_create'] == '1')? "checked":"" ;		?>></td>
                          <td><input type="checkbox" value="1" name="permb[]" <?php echo ($row_utme['rr_edit'] == '1')? "checked":"" ;		?>></td>
                          <td><input type="checkbox" value="1" name="permc[]" <?php echo ($row_utme['rr_delete'] == '1')? "checked":"" ;		?>></td>
                          <td><input type="checkbox" value="1" name="permd[]" <?php echo ($row_utme['rr_view'] == '1')? "checked":"" ;		?>></td>
          <td width="120">
		  <a rel="tooltip"  title="Click to Remove Permission" id="delete" href="userPermission.php?delid=<?php echo $row_utme['rr_modulecode']; ?>&p2=<?php echo $id; ?> "  data-toggle="modal" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash icon-large"> Remove</i></a>
												</td>                
												
                        </tr>
                     
                     
                        <?php }  ?>
                        
                        