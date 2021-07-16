<?php

class Controller_Table extends Controller
{

	function __construct()
    {
	$this->model = new Model_Table();
	$this->view = new View();

	}
	function action_index()
	{	
		// check for definition ajax request
		if (Utils::is_ajax()==true){
		// if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
			$this->model->get_data();
		}

		else {
			$this->view->generate('table_view.php','template_view.php');
		}
		
		
	}

}