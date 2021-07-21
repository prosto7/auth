<?php

function autoload($class)
{
			$path = [
			DS."application/core/$class.php",
			DS."application/services/$class.php",
			DS."application/controllers/$class.php",
			DS."application/models/$class.php"

		];
		foreach ($path AS $file) {
			if (file_exists($file)) {
			require_once $file;
			$result = true;
			break;
			} 	
		}

	}
	spl_autoload_register('autoload');






