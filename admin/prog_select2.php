<?php
session_start();
include('lib/dbcon.php'); 
dbcon();

//add item in shopping cart

if(isset($_POST["type"]) && $_POST["type"]=='addselect')
{
//$selectclass_ID  = "";

unset($_SESSION["select_pro"]);
//session_regenerate_id();
	$selectclass_ID 	= filter_var($_POST["sel_id"], FILTER_SANITIZE_STRING); //product code
	//$return_url 	= base64_decode($_POST["return_url"]); //return url
	//MySqli query - get details of item from db using product code
	$results = mysqli_query($condb,"SELECT pro_id,Pro_name,pro_dura,assmax,exammax FROM prog_tb WHERE pro_id ='$selectclass_ID' LIMIT 1");
	$obj = mysqli_fetch_object($results); 
	if ($results) { //we have the product info 
		//prepare array for the session variable
$new_selectlist = array(array('pg_id'=>$selectclass_ID , 'pro_name'=>$obj->Pro_name, 'p_dura'=>$obj->pro_dura, 'amax'=>$obj->assmax,'emax'=>$obj->exammax ));
		
		if(isset($_SESSION["select_pro"])) //if we have the session
		{
			$found = false; //set found item to false
			
			foreach ($_SESSION["select_pro"] as $cart_itm) //loop through session array
			{
				if($cart_itm["pg_id"] == $selectclass_ID){ //the item exist in array

			$product[] = array('pg_id'=>$cart_itm["pg_id"], 'pro_name'=>$cart_itm["pro_name"] , 'p_dura'=>$cart_itm["p_dura"],'amax'=>$cart_itm["amax"],'emax'=>$cart_itm["emax"]);
					$found = true;
				}else{
					//item doesn't exist in the list, just retrive old info and prepare array for session var
					$product[] = array('pg_id'=>$cart_itm["pg_id"], 'pro_name'=>$cart_itm["pro_name"] , 'p_dura'=>$cart_itm["p_dura"],'amax'=>$cart_itm["amax"],'emax'=>$cart_itm["emax"]);
				}
			}
			
			if($found == false) //we didn't find item in array
			{
				//add new user item in array
				$_SESSION["select_pro"] = array_merge($product, $new_selectlist);
			}else{
				//found user item in array list, and increased the quantity
				$_SESSION["select_pro"] = $product;
			}
			
		}else{
			//create a new session var if does not exist
			$_SESSION["select_pro"] = $new_selectlist;
		}
		
	}
	
	//redirect back to original page
redirect('./');
	 	
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