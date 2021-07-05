<?php include_once('menu.php');
include_once('classes.php'); ?>


<div class='container mt-5 main-data__container'>
    <h2>Personal database of CIA agents</h2>
    <p>Top secret</p>

    <?php
    if (isset($_SESSION['register']) || isset($_SESSION['superadmin'])) {
        include_once('table.php');
    }
    ?>