<?php
session_start();
include('../admin/lib/dbcon.php'); 
dbcon();

//add item in shopping cart

if(isset($_POST["type"]) && $_POST["type"]=='addelect')
{
//$selectclass_ID  = "";

unset($_SESSION["s_elect1"]);
//session_regenerate_id();
	$select_ID 	= filter_var($_POST["sel_id1"], FILTER_SANITIZE_STRING); //product code
	$return_url 	= base64_decode($_POST["return_url"]); //return url
	//MySqli query - get details of item from db using product code
	$results = mysqli_query($condb,"SELECT id,ecate,fac,dept FROM electiontb WHERE id ='".safee($condb,$select_ID)."' LIMIT 1");
	$obj = mysqli_fetch_object($results); 
	if ($results) { //we have the product info 
		//prepare array for the session variable
$new_selectlist = array(array('e_id'=>$select_ID , 'e_ecate'=>$obj->ecate, 'e_fac'=>$obj->fac, 'e_dept'=>$obj->dept ));
		
		if(isset($_SESSION["s_elect1"])) //if we have the session
		{
			$found = false; //set found item to false
			
			foreach ($_SESSION["s_elect1"] as $cart_itm) //loop through session array
			{
				if($cart_itm["e_id"] == $select_ID){ //the item exist in array

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
				$_SESSION["s_elect1"] = array_merge($product, $new_selectlist);
			}else{
				//found user item in array list, and increased the quantity
				$_SESSION["s_elect1"] = $product;
			}
			
		}else{
			//create a new session var if does not exist
			$_SESSION["s_elect1"] = $new_selectlist;
		}
		
	}
	
	//redirect back to original page
	redirect('select.php?view=vote');
//redirect('./');
//redirect($return_url);
	 	
}

//remove item from shopping cart
/*if(isset($_GET["removep"]) && isset($_GET["return_url"]) && isset($_SESSION["cart_session"]))
{
	$Product_ID 	= $_GET["removep"]; //get the product code to remove
	$return_url 	= base64_decode($_GET["return_url"]); //get return url

	
	foreach ($_SESSION["cart_session"] as $cart_itm) //loop through session array var
	{
		if($cart_itm["code"]!=$Product_ID){ //item does,t exist in the list
			$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'TiradaProductTiga'=>$cart_itm["TiradaProductTiga"], 'Qiimaha'=>$cart_itm["Qiimaha"]);
		}
		
		//create a new product list for cart
		$_SESSION["cart_session"] = $product;
	}
	
	//redirect back to original page
	header('Location:'.$return_url);
}*/
?>