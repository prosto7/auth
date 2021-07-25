<?php

class Controller_Register extends Controller
{
    function __construct()
    {
        $this->model = new Model_Register();
        $this->view = new View();
    }

    function action_index()
    {
        $data = array(
            'id' => null,
            'login' => $_POST['login'],
            'pass' => $_POST['pass'],
            'email' => $_POST['email'],
            'namefirst' => $_POST['namefirst'],
            'namelast' => $_POST['namelast'],
            'age' => $_POST['age'],
            'gender' => $_POST['gender']
        );
        $this->model->get_data_table();

        $this->view->generate('registration_view.php', 'template_view.php', $data);
    }


    function signup()
    {
        $user_name = $_POST['user_name'];
        $email_id = $_POST['email_id'];
        $password = $_POST['password'];
        $count = $this->model->check_user($user_name, $email_id);
        if ($count > 0) {
            echo 'This User Already Exists';
        } else {
            $data = array(
                'id' => null,
                'user_name' => $_POST['user_name'],
                'email_id' => $_POST['email_id'],
                'password' => $_POST['password']
            );
            $this->model->insert_user($data);
        }
        header('location:index');
    }
}
