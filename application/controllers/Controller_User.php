<?php

class Controller_User extends Controller
{
    
   
	function __construct()
    {
	$this->model = new Model_User();
	$this->view = new View();
	
	}

	function action_login()
	{	
		// check for definition ajax request
		if (Utils::is_ajax()==true) {
			$this->model->get_data_user();
		
		}
		else
		{
		
			$this->view->generate('registration_view.php','template_view.php');
		}
		
		}

		function action_table() {
		// check for definition ajax request
		if (Utils::is_ajax()==true){

			$this->model->get_data_table();
		}
		else {
			$this->view->generate('table_view.php','template_view.php');
		}
		
		}


		function action_data() {
            $data = $this->model->get_data_table_nativephp();          
            $this->view->generate('table_php_view.php','template_view.php',$data);
            if (Utils::is_ajax()==true){
                Export::exportToCSV($data);
            } 
		}



		
    }

	