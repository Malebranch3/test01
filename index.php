<?php

class Cat{
	private $name = '';
	private $call = 'Meow';
	private $age = 1;
	private $spoken = 0;
	
	private function setName($newname){
		$this->name = $newname;
	}
	
	private function speak(){
		$this->checkSpoken();
		print($call);
	}

	private function checkSpoken(){
		$this->spoken++;
		if(5 === $this->spoken){
			$this->ageUp();
			$this->spoken = 0;
		}
	}
}