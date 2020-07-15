<?php
session_start();
include('../admin/lib/dbcon.php'); 
dbcon();

//add item in shopping cart

if(isset($_POST["type"]) && $_POST["type"]=='addelect1')
{
//$selectclass_ID  = "";

unset($_SESSION["s_elect2"]);
//session_regenerate_id();
	$select_AID 	= filter_var($_POST["sel_id2"], FILTER_SANITIZE_STRING); //product code
	$return_url 	= base64_decode($_POST["return_url"]); //return url
	//MySqli query - get details of item from db using product code
	$results = mysqli_query($condb,"SELECT id,ecate,fac,dept FROM electiontb WHERE id ='".safee($condb,$select_AID)."' LIMIT 1");
	$obj = mysqli_fetch_object($results); 
	if ($results) { //we have the product info 
		//prepare array for the session variable
$new_selectlist = array(array('e_id'=>$select_AID , 'e_ecate'=>$obj->ecate, 'e_fac'=>$obj->fac, 'e_dept'=>$obj->dept ));
		
		if(isset($_SESSION["s_elect2"])) //if we have the session
		{
			$found = false; //set found item to false
			
			foreach ($_SESSION["s_elect2"] as $cart_itm) //loop through session array
			{
				if($cart_itm["e_id"] == $select_AID){ //the item exist in array

			$product[] = array('e_id'=>$cart_itm["e_id"], 'e_ecate'=>$cart_itm["ecate"] , 'e_fac'=>$cart_itm["fac"], 'e_dept'=>$cart_itm["dept"]);
					$found = true;
				}else{
					//item doesn't exist in the list, just retrive old info and prepare array for session var
		$product[] = array('e_id'=>$cart_itm["e_id"], 'e_ecate'=>$cart_itm["ecate"] , 'e_fac'=>$cart_itm["fac"], 'e_dept'=>$cart_itm["dept"]);
				}
			}
			
			if($found == false) //we didn't find item in array
			{
				//add new user item in array
				$_SESSION["s_elect2"] = array_merge($product, $new_selectlist);
			}else{
				//found user item in array list, and increased the quantity
				$_SESSION["s_elect2"] = $product;
			}
			
		}else{
			//create a new session var if does not exist
			$_SESSION["s_elect2"] = $new_selectlist;
		}
		
	}
	
	//redirect back to original page
	redirect('election.php?view=eresult');
//redirect('./');
//redirect($return_url);
	 	
}


?>