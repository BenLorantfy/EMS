<?php
namespace Views;
class View{
	private $template = "";
	private $members = array();
	
	public function __construct($template){
		$this->template = $template;
	}
	
	public function __get($key){
		return $this->members[$key];
	}
	
	public function __set($key,$value){
		$this->members[$key] = $value;
	}
	
	public function render(){
		require "php/Views/" . $this->template . ".phtml";
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