<?php

class Controller_Table_php extends Controller
{
    function __construct()
    {
        $this->model = new Model_Table_php();
        $this->view = new View();
    }
	function action_index()
	{	
        $data = $this->model->get_data();
		$this->view->generate('table_php_view.php','template_view.php',$data);
	}
}