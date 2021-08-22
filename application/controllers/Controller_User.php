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
		if (Utils::is_ajax() == true) {
			$this->model->get_data_user();
		} else {
			$this->view->generate('registration_view.php', 'template_view.php');
		}
	}
	function action_table()
	{
		// check for definition ajax request
		if (Utils::is_ajax() == true) {

			$this->model->get_data_table();
		} else {
			$this->view->generate('table_view.php', 'template_view.php');
		}
	}

	function action_data()
	{
		$data = $this->model->get_data_table_nativephp();
		$this->view->generate('table_php_view.php', 'template_view.php', $data);
		if (Utils::is_ajax() == true) {
			Export::exportToCSV($data);
		}
	}

	function action_index()
	{

		$login = '';
		$email = '';
		$pass =  '';
		$pass2 = '';
		$firstName = '';
		$lastName = '';
		$birthday = '';
		$gender = '';

		$data = array(
			$login,
			$email,
			$pass,
			$pass2,
			$firstName,
			$lastName,
			$birthday,
			$gender
		);
		$this->model->get_data_table();

		$this->view->generate('registration_view.php', 'template_view.php', $data);
	}

	function action_register()
	{

		if (isset($_POST['regbtn'])) {
			$login = $_POST['login'];
			$email = $_POST['email'];
			$pass =  $_POST['pass1'];
			$pass2 =  $_POST['pass2'];
			$firstName = $_POST['first_name'];
			$lastName = $_POST['last_name'];
			$birthday = $_POST['birthday'];
			$gender = $_POST['gender'];
			$data = array(
				'login' => $login,
				'email' => $email,
				'pass' => $pass,
				'pass2' => $pass2,
				'namefirst' => $firstName,
				'namelast' => $lastName,
				'birthday' => $birthday,
				'gender' => $gender,
			);

			$result = Rules::fillValidationErrors($data);

			var_dump($result);
			if ($result[0] == true) {

				$this->view->generate('registration_view.php', 'template_view.php', $result);
			} else {
				$this->model->insert_user($result[1]);
				header('Location: /table' );
			}
		}
	}
}
