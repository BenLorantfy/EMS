<?php
namespace Helper;
use \stdClass;

class Route{
	static private $paramStyle = "regular";
	static private $echoReturn = true;
	static public function config($options){
		if(isset($options["paramStyle"])) Route::$paramStyle = $options["paramStyle"];
		if(isset($options["echoReturn"])) Route::$echoReturn = $options["echoReturn"];
	}
	
	static private function route($type="",$matchURI = "*",$middleware = null,$callback = null){
		if($type == "ANY" || $type == $_SERVER['REQUEST_METHOD']){
			if($matchURI != "*"){
				$actualURI = $_SERVER["REQUEST_URI"];
				trim($matchURI, "/");
				trim($actualURI,"/");
				$actualURIParts = explode("/",$actualURI);
				$matchURIParts = explode("/",$matchURI);
				$numActualURIParts = count($actualURIParts);
				$numMatchURIParts = count($matchURIParts);
				$request = (Route::$paramStyle == "object") ? new stdClass() : array();
				
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
							if(Route::$paramStyle == "object"){
								$request->$placeholderName = $actualURIParts[$i];
							}else{
								array_push($request, $actualURIParts[$i]);
							}
							
						}
					}
				}else{
					$match = false;
				}		
			}

			
			if($match){
				// Add payload to parameters
				$payload = array();
				parse_str(file_get_contents('php://input'), $payload);
				foreach($payload as $key => $value){
					if(Route::$paramStyle == "object"){
						$request->$key = $value;
					}else{
						$request[$key] = $value;
					}
				}
			
				$content = null;
				if($middleware != null && $callback != null){
					if(is_callable($middleware)){
						if($middleware()){
							if(Route::$paramStyle == "object"){
								$content = call_user_func($callback,$request);
							}else{
								$content = call_user_func_array($callback, $request);
							}
						}
					}else{
						if($middleware){
							if(Route::$paramStyle == "object"){
								$content = call_user_func($callback,$request);
							}else{
								$content = call_user_func_array($callback, $request);
							}
						}
					}
				}else if($middleware != null){
					$callback = $middleware;
					if(Route::$paramStyle == "object"){
						$content = call_user_func($callback,$request);
					}else{
						$content = call_user_func_array($callback, $request);
					}
				}
				if(Route::$echoReturn && $content != null){
					echo json_encode($content);
				}
			}			
		}
	}
	
	static public function get($matchURI = "*",$middleware = null,$callback = null){
		Route::route("GET",$matchURI,$middleware,$callback);
	}
	
	static public function post($matchURI = "*",$middleware = null,$callback = null){
		Route::route("POST",$matchURI,$middleware,$callback);
	}
	
	static public function put($matchURI = "*",$middleware = null,$callback = null){
		Route::route("PUT",$matchURI,$middleware,$callback);
	}
	
	static public function delete($matchURI = "*",$middleware = null,$callback = null){
		Route::route("DELETE",$matchURI,$middleware,$callback);
	}
	
	static public function any($matchURI = "*",$middleware = null,$callback = null){
		Route::route("ANY",$matchURI,$middleware,$callback);
	}
}