<?php

class Template {
	public $filename = "main.php"; // default to views/main.php
	public $assignedVars=array();
	// ** UPDATE TO: protected $templatePath = TEMPLATE_PATH;
	protected $templatePath = VIEWS_PATH . DS . 'templates';

	public function set($key, $value) {
		$this->assignedVars[$key] = $value;
	}

	protected function filePath($filename = "main.php") {
		if ($filename != "main.php"){
			$this->filename = $filename;
		}
		return $this->templatePath . DS . $this->filename;
	}

  function display($assignedVars = [], $filename = "") {
		if (($filename == "") && ($this->filename == "")) {
			$this->filename = "main.php"; // set default
		} elseif (!empty($filename)) {
			$this->filename = $filename;
		}
		// args?: $assignedVars
		$fullpath = $this->filePath($this->filename);
  	if(file_exists($fullpath)) {
  		$output = file_get_contents($fullpath);
			if (!empty($assignedVars)) {
				$this->assignedVars = $assignedVars;
			}
  		foreach($this->assignedVars as $key => $value) {
				$output = preg_replace('/{'.$key.'}/', $value, $output);
  			// above is: regular expression replace
  		}
  		echo $output;
  	} else {
  		echo "*** Missing template error filename shows: {$this->filePath($filename)}****";
  	}
		$this->assignedVars = []; // zero out assigned vars
  }

  function returnText($assignedVars = [], $filename = "") { // must set $this->filename = file before use
		if (($filename == "") && ($this->filename == "")) {
			$this->filename = "main.php"; // set default filename
		} elseif (!empty($filename)) {
			$this->filename = $filename;
		}
		// args?: $assignedVars
		$fullpath = $this->filePath($this->filename);
  	if(file_exists($fullpath)) {
  		$output = file_get_contents($fullpath);
// DEBUG 10/29**	 **********msgHeader***********************************NOT showing div		//
			if (isset($assignedVars['msgHeader'])) {
				echo "In tewmplate:returnText assignedVars: <br>";
				var_dump($this->assignedVars);
				die();
			}

			if (!empty($assignedVars)) {
				$this->assignedVars = $assignedVars;
			}
  		foreach($this->assignedVars as $key => $value) {
  			$output = preg_replace('/{'.$key.'}/', $value, $output);
  			// above is: regular expression replace
  		}

			$this->assignedVars = []; // zero out assigned vars
  		return $output;
  	} else {
			// DEBUG**: return $fullpath;
  		return "*** Missing template error showing file: {$this->filename} ****";
  	}
  }

	function renderWithVariables($filePath, $variables = array(), $print = true) {
		// render(orig. include)WithVariables('header.php', array('title' => 'Header Title'));
		// <h1>< ?php echo $title; ? ></h1>
    $output = "";
    if(file_exists($filePath)){
				if (empty($variables)){
					$variables = $this->assignedVars;
				}
				// DEBUG 10/30 TEST msgHeader
				// if(!empty($this->assignedVars['msgHeader'])) {
				// 	echo "<br>In renderWithVariable for {$filePath}; assignedVars: <br>";
				// 	var_dump($this->assignedVars);
				// 	echo "<br>In renderWithVariable for {$filePath}; vars: <br>";
				// 	var_dump($variables);
				// 	die();
				// }

        // Extract the variables to a local namespace
        extract($variables);
        // Start output buffering
        ob_start();
        // Include the template file
        include $filePath;

        // End buffering and return its contents
        $output = ob_get_clean();
    }
    if ($print) {
        print $output;
    }
    return $output;
	}
}

/* usage:
$template = new Template();
$template->filename = "template2.php";
$template->set('pageTitle', "Template Test");
$template->set('content', "This tests  search/replace templating.");
OR:
$assignedVars = [
			'pageTitle' => "Template Test",
			'content' =>"Test of search/repl template."
		];
$template->display();
*/
?>
