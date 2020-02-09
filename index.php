<?php
require 'DataBase.php';

$dataBase = new DataBase();

$page = 'home';

if(isset($_GET['page']))
{
  $page = $_GET['page'];
}

ob_start();

require $page . '.php';

$content = ob_get_clean();
require 'template.php';
