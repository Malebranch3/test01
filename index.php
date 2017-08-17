<?php

class Cat{
	private $variables = array('name','call'=>'meow','age'=>1,'spoken'=>0);
	
	public function getClassVar($var){
		if(isset($this->variables[$var]) || array_key_exists($this->variables[$var])){
			return array('success'=>1,'result'=>$this->$var);
		}else{
			return array('success'=>0,'result'=>'Error: No such variable exists.');
		}
	}
	
	public function setName($newname){
		$this->name = $newname;
	}
	
	public function speak(){
		$this->checkSpoken();
		print($call);
	}

	public function checkSpoken(){
		$this->incrementSpoken();
		if(5 === $this->spoken){
			$this->ageUp();
			$this->spoken = 0;
		}
	}
	
	public function incrementSpoken(){
		$this->spoken++;
	}
}

class Tests{
	
	public function testSpokenIncrementation($obj){
		$original = $obj;
		return $result;
	}
}