<?php


function autoload($class)
{
	
		/* 	$path = [
			DS."/application/$class.php",
			DS."/application/services/$class.php",
			DS."/application/controllers/$class.php",
			DS."/application/models/$class.php"

		];
		foreach ($path AS $file) {
			if (file_exists($file)) {
			require_once $file;
		
			}
		} */

	  echo DS . "application/services/" . $class . ".php";
	  echo '</br>';
	  echo DS . "application/models/" . $class . ".php";
	  echo '</br>';
	  echo DS . "application/controllers/" . $class . ".php"; 
	  echo '</br>';
	 
	  	 if (file_exists(DS . "application/services/" . $class . ".php")) {
			include_once  DS . "/application/services/" . $class . ".php";
	} elseif (file_exists(DS . "application/models/" . $class . ".php")) {
			include_once DS . "application/models/" . $class . ".php";
		
	} elseif (file_exists(DS . "application/controllers/" . $class . ".php")) {
		include_once  DS . "application/controllers/" . $class . ".php";
	} else{
		// throw new Exception('Failed to include class' . $class);
	}
	}

	spl_autoload_register('autoload');






