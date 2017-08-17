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
		$original = $obj->getClassVar('spoken');
		$before = microtime(true);
		$obj->incrementSpoken();
		$after = microtime(true);
		$newresult = $obj->getClassVar('spoken');
		$totaltime = $after - $before;
		$result = ($newresult > $original ? 'Function executed in %d seconds, resulting in success, results are as follows %s' : 'Function executed in %d seconds, resulting in failure, results are as follows %s');
		return sprintf($result, $totaltime, "Before: {$original}, After: {$newresult}");
	}
	
	public function testNameSet($obj){
		$original = $obj->getClassVar('name');
		$before = microtime(true);
		$obj->setName($original.'OOGABOOGA!');
		$after = microtime(true);
		$newresult = $obj->getClassVar('name');
		$totaltime = $after - $before;
		$result = ($newresult > $original ? 'Function executed in %d seconds, resulting in success, results are as follows %s' : 'Function executed in %d seconds, resulting in failure, results are as follows %s');
		return sprintf($result, $totaltime, "Before: {$original}, After: {$newresult}");
	}
}