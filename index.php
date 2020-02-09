<?php
require 'app/Router.php';
require 'DataBase.php';

$dataBase = new DataBase();
$router = new Router();

$page = 'home';

if(isset($_GET['page']))
{
  $page = $_GET['page'];
}

$router->add('home', 'Frontend:listPosts');
$router->add('show_post', 'Frontend:onePost:2');

$router->get('show_post');
