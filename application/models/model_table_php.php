<?php

class Model_Table_PHP extends Model {
    public $sort_list;
	public function get_data()
	{	

    $sort_list = array(
    'login_asc'   => '`login`',
    'login_desc'  => '`login` DESC',
    'email_asc'  => '`email`',
    'email_desc' => '`email` DESC',
    'namefirst_asc'   => '`namefirst`',
    'namefirst_desc'   => '`namefirst`DESC',
    'namelast_asc'  => '`namelast`',
    'namelast_desc'  => '`namelast` DESC',
    'age_asc'   => '`age`',
    'age_desc'  => '`age` DESC',
    'gender_asc'   => '`gender`',
    'gender_desc'  => '`gender` DESC',
    'imagepath_asc' => 'imagepath'
);

$sort = @$_GET['sort'];
if (array_key_exists($sort, $sort_list)) {
    $sort_sql = $sort_list[$sort];
} else {
    $sort_sql = reset($sort_list);
}

$pdo = Tools::connect();
$ps = $pdo->prepare("SELECT * FROM `users` ORDER BY {$sort_sql}");
$ps->execute();
$list = $ps->fetchAll(PDO::FETCH_ASSOC);

    }
}