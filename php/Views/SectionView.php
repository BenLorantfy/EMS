<?php
namespace Views;
class SectionView{
	private $template = "";
	private $members = array();
	
	public function __construct($template){
		$this->template = $template;
	}
	
	public function __get($key){
		if(isset($this->members[$key])){
			return $this->members[$key];
		}
		
		return "";
	}
	
	public function __call($key,$args){
		if(isset($this->members[$key]) && is_callable($this->members[$key])){
			return call_user_func_array($this->members[$key], $args);
		}
		
		return "";
	}
	
	public function __set($key,$value){
		$this->members[$key] = $value;
	}
	
	public function render(){
		require "Views/pages/" . $this->template . ".phtml";
	}
	
	static public function StartPageRender(){
		echo "<!DOCTYPE html>\n<html>\n";
	}
	
	static public function StartHeadRender(){
		echo "<head>\n";
	}
	
	static public function EndHeadRender(){
		echo "</head>\n";
	}
	
	static public function StartBodyRender(){
		echo "<body>\n";
	}
	
	static public function EndBodyRender(){
		echo "</body>\n";
	}
	
	static public function EndPageRender(){
		echo "</html>";
	}
}