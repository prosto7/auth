
<?php

require_once './config/database.php';
require_once 'core/Controller.php';
require_once 'core/Model.php';
require_once 'core/View.php';
require_once 'autoloader.php';
spl_autoload_register('autoload');

$router = new Router();
$router->run();




echo '</br>';
echo 'end';

?>