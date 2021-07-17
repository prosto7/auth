<?php

class Controller_Login extends Controller
{
	function __construct()
    {
	$this->model = new Model_Login();
	$this->view = new View();
	
	}

	function action_index()
	{	
		if (Utils::is_ajax()==true) {
			$this->model->get_data();
		
		}
		else
		{
			$this->view->generate('login_view.php','template_view.php');
		}
		
		}




}

