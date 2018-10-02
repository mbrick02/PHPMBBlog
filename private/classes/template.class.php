<?php

class Template {
	public $filename = "main.php"; // default to views/main.php
	public $assignedVars=array();
	// ** UPDATE TO: protected $templatePath = TEMPLATE_PATH;
	protected $templatePath = VIEWS_PATH;

	public function set($key, $value) {
		$this->assignedVars[$key] = $value;
	}

	protected function filePath($filename = "main.php") {
		if ($filename != "main.php"){
			$this->filename = $filename;
		}
		return $this->templatePath . DS . $this->filename;
	}

  function display($filename = "main.php") {
		// args?: $assignedVars
		$fullpath = $this->filePath($filename);
  	if(file_exists($fullpath)) {
  		$output = file_get_contents($fullpath);
  		foreach($this->assignedVars as $key => $value) {
  			$output = preg_replace('/{'.$key.'}/', $value, $output);
  			// above is: regular expression replace
  		}
  		echo $output;
  	} else {
  		echo "*** Missing template error filename shows: {$this->filePath($filename)}****";
  	}
  }

  function returnText($filename = "main.php", $assignedVars) {
		$fullpath = $this->filePath($filename);
  	if(file_exists($fullpath)) {
  		$output = file_get_contents($this->$filename);
  		foreach($this->$assignedVars as $key => $value) {
  			$output = pregReplace('/{'.$key.'}/', $value, $output);
  			// above is: regular expression replace
  		}
  		return $output;
  	} else {
  		return "*** Missing template error showing file: {$filename} ****";
  	}
  }
}

/* usage:
$template = new Template();
$template->filename = "template2.php";
$template->set('pageTitle', "Template Test");
$template->set('content', "This is a test of templating using search replace.");
$template->display();
*/
?>
