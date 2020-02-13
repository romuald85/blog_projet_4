<?php
require __DIR__ . DIRECTORY_SEPARATOR . 'Autoloader.php';

use App\Router;

Autoloader::register();

$router = new Router();

$route = 'home';

if(isset($_GET['route']))
{
  $route = $_GET['route'];
}

$router->add('home', 'Frontend:listPosts');
$router->add('post', 'Frontend:onePost');
$router->add('show_post', 'Frontend:onePost:2');


$router->add('login', 'Backend:userExists');
$router->add('admin', 'Backend:admin');
$router->add('articles', 'Backend:articles');
$router->add('create', 'Backend:createArticle');
$router->add('update', 'Backend:updateArticle');
$router->add('commentsAndPosts', 'Backend:commentsAndPosts');
$router->add('comments', 'Backend:comments');

$router->get($route);
