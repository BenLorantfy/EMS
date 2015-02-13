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
	if(isset($_POST["class"]) && isset($_POST["method"])){
		$class  	= $_POST["class"];	// class method belongs to
		$method 	= $_POST["method"];	// method to call
		$arguments 	= array();
		
		if(method_exists($class,$method)){
			//
			// Since request was made using AJAX, session has not been started, so start it
			//
			session_start();
	
			array_walk($_POST, function(&$value, &$key) use (&$arguments){
				if(is_numeric($key)){
					if(isset($_POST["json"])){
						array_push($arguments,json_decode($value));
					}else{
						array_push($arguments,$value);
					}
				}
			});	
			
			try{
				if(isset($_POST["json"])){
					$returnData = array("error" => false, "message" => call_user_func_array(array(new $class(),$method), $arguments));
				}else{
					$returnData = call_user_func_array(array(new $class(),$method), $arguments);
				}
				
			}catch(Exception $e){
				if(isset($_POST["json"])){
					$returnData = array("error" => true,"message" => $e->getMessage());	
				}else{
					$returnData = $e->getMessage();
				}
			}	
	
		}else{
			if(isset($_POST["json"])){
				$returnData = array("error" => true, "message" => "Specified method doesn't exist within specified class");
			}else{
				$returnData = "Specified method doesn't exist within specified class";
			}
		}	
		
		if(isset($_POST["json"])){
			echo json_encode($returnData, JSON_HEX_QUOT | JSON_HEX_TAG);
		}else{
			echo print_r($returnData,true);
		}		
	}
}

?>