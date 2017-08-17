<?php

class Cat{
	private $variables = array('name','call'=>'meow','age'=>1,'spoken'=>0);
	
	public function getClassVar($var){
		if(isset($this->variables[$var]) || array_key_exists($this->variables[$var], $this->variables)){
			return array('success'=>1,'result'=>$this->variables[$var]);
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
	
	public function ageUp(){
		$this->variables['age']++;
	}
}

class Tests{
	
	private $patient = '';
	
	function __construct($obj){
		$this->patient = $obj;
	}
	
	public function testageUp(){
		$original = $this->patient->getClassVar('age')['result'];
		$before = microtime(true);
		$this->patient->ageUp();
		$after = microtime(true);
		$newresult = $this->patient->getClassVar('age')['result'];
		$totaltime = $after - $before;
		$result = ($newresult > $original ? 'Function executed in %f seconds, resulting in success, results are as follows %s' : 'Function executed in %d seconds, resulting in failure, results are as follows %s');
		return sprintf($result, $totaltime, "Before: {$original}, After: {$newresult}");
	}
	
	public function testSpokenIncrementation(){
		$original = $this->patient->getClassVar('spoken')['result'];
		$before = microtime(true);
		$this->patient->incrementSpoken();
		$after = microtime(true);
		$newresult = $this->patient->getClassVar('spoken')['result'];
		$totaltime = $after - $before;
		$result = ($newresult > $original ? 'Function executed in %f seconds, resulting in success, results are as follows %s' : 'Function executed in %d seconds, resulting in failure, results are as follows %s');
		return sprintf($result, $totaltime, "Before: {$original}, After: {$newresult}");
	}
	
	public function testNameSet(){
		$original = $this->patient->getClassVar('name')['result'];
		$before = microtime(true);
		$this->patient->setName($original.'OOGABOOGA!');
		$after = microtime(true);
		$newresult = $this->patient->getClassVar('name')['result'];
		$totaltime = $after - $before;
		$result = ($newresult != $original ? 'Function executed in %f seconds, resulting in success, results are as follows %s' : 'Function executed in %d seconds, resulting in failure, results are as follows %s');
		return sprintf($result, $totaltime, "Before: {$original}, After: {$newresult}");
	}
	
	public function testSpeak(){
		$original = $this->patient->getClassVar('call')['result'];
		$before = microtime(true);
		ob_start();
		$this->patient->speak();
		$newresult = ob_get_contents();
		ob_end_clean();
		$after = microtime(true);
		$totaltime = $after - $before;
		$result = ($newresult === $original ? 'Function executed in %f seconds, resulting in success, results are as follows %s' : 'Function executed in %d seconds, resulting in failure, results are as follows %s');
		return sprintf($result, $totaltime, "Before: {$original}, After: {$newresult}");
	}
	
	public function checkSpoken(){
		$original = $this->patient->getClassVar('age')['result'];
		$timesspoken = $this->patient->getClassVar('spoken')['result'];
		$loops = 5 - $timesspoken;
		$before = microtime(true);
		for($i=0;$i<$loops;$i++){
			$this->patient->checkSpoken();
		}
		$after = microtime(true);
		$newresult = $this->patient->getClassVar('age')['result'];
		$totaltime = $after - $before;
		$result = ($newresult > $original ? 'Function executed in %f seconds, resulting in success, results are as follows %s' : 'Function executed in %d seconds, resulting in failure, results are as follows %s');
		return sprintf($result, $totaltime, "Before: {$original}, After: {$newresult}");
	}
	
	public function testGetClassVar($mode){
		if('exists' == $mode){
			$existingvar = 'call';
			$before = microtime(true);
			$test = $this->patient->getClassVar($existingvar);
			$after = microtime(true);
			$testresult = $test['result'];
			$totaltime = $after - $before;
			$result = ($test['success'] ? 'Function executed in %f seconds, resulting in success, results are as follows %s' : 'Function executed in %d seconds, resulting in failure, results are as follows %s');
			return sprintf($result, $totaltime, "getClassVar returned {$testresult} for class var {$existingvar}");
		}elseif('nonexistant' == $mode){
			$nonexistingvar = 'callboop';
			$before = microtime(true);
			$test = $this->patient->getClassVar($nonexistingvar);
			$after = microtime(true);
			$testresult = $test['result'];
			$totaltime = $after - $before;
			$result = ((!$test['success']) ? 'Function executed in %f seconds, resulting in success, results are as follows %s' : 'Function executed in %d seconds, resulting in failure, results are as follows %s');
			return sprintf($result, $totaltime, "getClassVar returned {$testresult} for class var {$nonexistingvar}");
		}
	}
}


$kitty = new Cat;
$kitty->setName('Fido');
$testkitty = new Tests($kitty);
print_r($testkitty->testSpokenIncrementation());
print('<br/>');
print_r($testkitty->testNameSet());
print('<br/>');
print_r($testkitty->testSpeak());
print('<br/>');
print_r($testkitty->checkSpoken());
print('<br/>');
print_r($testkitty->testGetClassVar('exists'));
print('<br/>');
print_r($testkitty->testGetClassVar('nonexistant'));
print('<br/>');
print_r($testkitty->testageUp());