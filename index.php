<?php
require 'app/Router.php';

$router = new Router();

$route = 'home';

if(isset($_GET['route']))
{
  $route = $_GET['route'];
}

$router->add('home', 'Frontend:listPosts');
$router->add('show_post', 'Frontend:onePost:2');
$router->add('apropos', 'Frontend:apropos');

$router->get($route);
