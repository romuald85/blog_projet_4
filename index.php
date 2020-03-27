<?php
session_start();

require __DIR__ . DIRECTORY_SEPARATOR . 'Autoloader.php';

use App\Router;

// Appel la fonction register qui se trouve dans la class Autoloader
Autoloader::register();

$router = new Router();

// Par défaut la route est définie à home
$route = 'home';

if(isset($_GET['route']))
{
  $route = $_GET['route'];
}

$router->add('home', 'Frontend:listPosts');
$router->add('post', 'Frontend:onePost');
$router->add('post', 'Frontend:onePost');
$router->add('showComment', 'Frontend:addComment');
$router->add('alert', 'Frontend:alertCommentId');


$router->add('login', 'Backend:userExists');
$router->add('admin', 'Backend:admin');
$router->add('articles', 'Backend:articles');
$router->add('create', 'Backend:createArticle');
$router->add('update', 'Backend:updateArticle');
$router->add('commentsAndPosts', 'Backend:commentsAndPosts');
$router->add('comments', 'Backend:comments');
$router->add('commentSignal', 'Backend:commentSignal');
$router->add('approveComment', 'Backend:approveComment');
$router->add('deleteComment', 'Backend:deleteComment');

$router->get($route);
