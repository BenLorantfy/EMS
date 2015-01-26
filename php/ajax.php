<?php

/*
 * 	FUNCTION 	: handleAJAX
 *
 * 	DESCRIPTION : This function is used to allow methods to be called with AJAX 
 *				  in the same way as regular synchronous server-side calls  
 *				  Calls method specified in the post variable named "method" and echos
 *				  return data, optionally as json
 *
 * 	RETURNS 	: nothing
 */		
function handleAJAX(){
	$class  = $_POST["class"];	// class method belongs to
	$method = $_POST["method"];	// method to call
	$post 	= $_POST;			// Don't modify the super global, instead, copy it
	
	if(method_exists($class,$method)){
		//
		// Since request was made using AJAX, session has not been started, so start it
		//
		session_start();
		
		unset($post["class"]);
		unset($post["method"]);

		//
		// Decodes parameters
		//
		if(isset($post["json"])){
			array_walk($post, function(&$value, &$key) {
			    $value = json_decode($value);
			});			
		}

		
		try{
			if(isset($post["json"])){
				$returnData = array("error" => false, "message" => call_user_func_array(array(new $class(),$method), $post);
			}else{
				$returnData = call_user_func_array(array(new $class(),$method), $post);
			}
		}catch(Exception $e){
			if(isset($post["json"])){
				$returnData = array("error" => true,"message" => $e->getMessage());	
			}else{
				$returnData = $e->getMessage();
			}
		}	
	}else{
		if(isset($post["json"])){
			$returnData = array("error" => true, "message" => "Specified method doesn't exist within specified class");
		}else{
			$returnData = "Specified method doesn't exist within specified class";
		}
	}	
	
	if(isset($post["json"])){
		echo json_encode($returnData, JSON_HEX_QUOT | JSON_HEX_TAG);
	}else{
		echo print_r($returnData,true);
	}
}

?>