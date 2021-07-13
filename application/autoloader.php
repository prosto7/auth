<?php
define('DS', $_SERVER['DOCUMENT_ROOT'].'/');

function autoload($class) {

	if( file_exists(DS."application/models/".$class.".php" ) ){
        require_once DS."application/models/".$class.".php";

    }
    elseif( file_exists(DS."application/controllers/".$class.".php" ) ){
		require_once  DS."application/controllers/".$class.".php";
 
    }elseif( file_exists(DS."application/view/".$class.".php") ){
		require_once  DS."application/view/".$class.".php";
    
    } else {
		require_once  DS."application/core/".$class.".php";
  
    }

	// контроллер и действие по умолчанию
		
	
	}

	$controller_name = 'Main';
		$action_name = 'index';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// получаем имя контроллера
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
		
		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}

		// добавляем префиксы
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;


		// подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = strtolower($model_name).'.php';
		$model_path = DS."application/models/".$model_file;
		if(file_exists($model_path))
		{
			include_once DS."application/models/".$model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = DS."application/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include_once (DS."application/controllers/".$controller_file);
		}
		else
		{
			/*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу 404
			*/
			ErrorPage404();
		}
		
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;
	
		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();
		}
		else
		{
			// здесь также разумнее было бы кинуть исключение
			ErrorPage404();
		}

	function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
    
