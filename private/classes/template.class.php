<?php

class Template {
	public $filename;
	public $assignedVars=array();

	public function set($key, $value) {
		$this->assignedVars[$key] = $value;
	}

  function display($filename, $assignedVars) {
  	if(file_exists($this->$filename)) {
  		$output = file_get_contents($this->$filename);
  		foreach($this->$assignedVars as $key => $value) {
  			$output = pregReplace('/{'.$key.'}/', $value, $output);
  			// above is: regular expression replace
  		}
  		echo $output;
  	} else {
  		echo "*** Missing template error ****";
  	}
  }
}
