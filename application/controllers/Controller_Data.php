<?php

class Controller_Data extends Controller
{
    
   
	function __construct()
    {
	$this->model = new Model_Data();
	$this->view = new View();
	
	}
		function action_data() {
            $data = $this->model->get_data_table_nativephp();          
            $this->view->generate('table_php_view.php','template_view.php',$data);
            if (Utils::is_ajax()==true){
                Export::exportToCSV();
            } 
		}
    }

	