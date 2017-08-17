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
		$this->variables['name'] = $newname;
	}
	
	public function speak(){
		$this->checkSpoken();
		print($this->variables['call']);
	}

	public function checkSpoken(){
		$this->incrementSpoken();
		if(5 === $this->variables['spoken']){
			$this->ageUp();
			$this->variables['spoken'] = 0;
		}
	}
	
	public function incrementSpoken(){
		$this->variables['spoken']++;
	}
}

class Tests{
	
	public function testSpokenIncrementation($obj){
		$original = $obj->getClassVar('spoken')['result'];
		$before = microtime(true);
		$obj->incrementSpoken();
		$after = microtime(true);
		$newresult = $obj->getClassVar('spoken')['result'];
		$totaltime = $after - $before;
		$result = ($newresult > $original ? 'Function executed in %d seconds, resulting in success, results are as follows %s' : 'Function executed in %d seconds, resulting in failure, results are as follows %s');
		return sprintf($result, $totaltime, "Before: {$original}, After: {$newresult}");
	}
	
	public function testNameSet($obj){
		$original = $obj->getClassVar('name')['result'];
		$before = microtime(true);
		$obj->setName($original.'OOGABOOGA!');
		$after = microtime(true);
		$newresult = $obj->getClassVar('name')['result'];
		$totaltime = $after - $before;
		$result = ($newresult != $original ? 'Function executed in %d seconds, resulting in success, results are as follows %s' : 'Function executed in %d seconds, resulting in failure, results are as follows %s');
		return sprintf($result, $totaltime, "Before: {$original}, After: {$newresult}");
	}
	
	public function testSpeak($obj){
		$original = $obj->getClassVar('call')['result'];
		$before = microtime(true);
		ob_start();
		$obj->speak();
		$newresult = ob_end_clean();
		$after = microtime(true);
		$totaltime = $after - $before;
		$result = ($newresult == $original ? 'Function executed in %d seconds, resulting in success, results are as follows %s' : 'Function executed in %d seconds, resulting in failure, results are as follows %s');
		return sprintf($result, $totaltime, "Before: {$original}, After: {$newresult}");
	}
	
	public function checkSpoken($obj){
		$original = $obj->getClassVar('age')['result'];
		$timesspoken = $obj->getClassVar('spoken')['result'];
		$loops = 5 - $timesspoken;
		$before = microtime(true);
		for($i=0;$i<$loops;$i++){
			$obj->checkSpoken();
		}
		$after = microtime(true);
		$newresult = $obj->getClassVar('age')['result'];
		$totaltime = $after - $before;
		$result = ($newresult > $original ? 'Function executed in %d seconds, resulting in success, results are as follows %s' : 'Function executed in %d seconds, resulting in failure, results are as follows %s');
		return sprintf($result, $totaltime, "Before: {$original}, After: {$newresult}");
	}
	
	public function testGetClassVar($obj,$mode){
		if('exists' == $mode){
			$existingvar = 'call';
			$before = microtime(true);
			$test = $obj->getClassVar($existingvar);
			$after = microtime(true);
			$testresult = $test['result'];
			$totaltime = $after - $before;
			$result = ($test['success'] ? 'Function executed in %d seconds, resulting in success, results are as follows %s' : 'Function executed in %d seconds, resulting in failure, results are as follows %s');
			return sprintf($result, $totaltime, "getClassVar returned {$testresult} for class var {$existingvar}");
		}elseif('nonexistant' == $mode){
			$nonexistingvar = 'callboop';
			$before = microtime(true);
			$test = $obj->getClassVar($existingvar);
			$after = microtime(true);
			$testresult = $test['result'];
			$totaltime = $after - $before;
			$result = ((!$test['success']) ? 'Function executed in %d seconds, resulting in success, results are as follows %s' : 'Function executed in %d seconds, resulting in failure, results are as follows %s');
			return sprintf($result, $totaltime, "getClassVar returned {$testresult} for class var {$existingvar}");
		}
	}
}