<?php
namespace Helper;
use \stdClass;

class Route{
	static private function route($type="",$matchURI = "*",$callback = null){
		if($type == "ANY" || $type == $_SERVER['REQUEST_METHOD']){
			if($matchURI != "*"){
				$actualURI = $_SERVER["REQUEST_URI"];
				trim($matchURI, "/");
				trim($actualURI,"/");
				$actualURIParts = explode("/",$actualURI);
				$matchURIParts = explode("/",$matchURI);
				$numActualURIParts = count($actualURIParts);
				$numMatchURIParts = count($matchURIParts);
				$request = new stdClass();
				
				$match = true;
				if($numActualURIParts == $numMatchURIParts){
					for($i = 0; $i < $numMatchURIParts; $i++){
						$isPlaceholder = preg_match('/^{.*?}$/', $matchURIParts[$i]) == 1;
						if(!$isPlaceholder){
							if($matchURIParts[$i] != $actualURIParts[$i]){
								$match = false;
								break;
							}
						}else{
							$placeholderName = str_replace(array("{","}"), "", $matchURIParts[$i]);
							$request->$placeholderName = $actualURIParts[$i];
						}
					}
				}else{
					$match = false;
				}		
			}

			if($match){
				
				//
				// Gets json request payload from php://input
				//
				$payload = json_decode(file_get_contents("php://input"));
				
				//
				// Merges URL request information and payload request information
				//
				$request = (object)array_merge((array)$request, (array)$payload);
				
				//
				// Calls provided callback with request object
				//
				$content = $callback($request);
				
				//
				// If callback returned something, echo it back in json form
				//
				if(isset($content)){
					echo json_encode($content);
				}
			}			
		}
	}
	
	static public function get($matchURI = "*",$callback = null){
		Route::route("GET",$matchURI,$callback);
	}
	
	static public function post($matchURI = "*",$callback = null){
		Route::route("POST",$matchURI,$callback);
	}
	
	static public function put($matchURI = "*",$callback = null){
		Route::route("PUT",$matchURI,$callback);
	}
	
	static public function delete($matchURI = "*",$callback = null){
		Route::route("DELETE",$matchURI,$callback);
	}
	
	static public function any($matchURI = "*",$callback = null){
		Route::route("ANY",$matchURI,$callback);
	}
}