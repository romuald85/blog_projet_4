<?php
session_start();// Entame la session

require __DIR__ . DIRECTORY_SEPARATOR . 'Autoloader.php';
require_once 'fonctions_utiles.php';

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
$router->add('post', 'Frontend:showPost');
$router->add('showComment', 'Frontend:addComment');
$router->add('alert', 'Frontend:reportComment');


$router->add('login', 'Backend:loginAdmin');
$router->add('logout', 'Backend:logoutAdmin');
$router->add('create', 'Backend:createArticle');
$router->add('update', 'Backend:updateArticle');
$router->add('admin', 'Backend:indexAdmin');

$router->add('posts', 'Backend:listPosts');

$router->add('approveComment', 'Backend:approveComment');
$router->add('rejectComment', 'Backend:rejectComment');

$router->add('comments', 'Backend:listComments');
$router->add('deleteComment', 'Backend:deleteComment');

$router->add('reports', 'Backend:listReports');

$router->add('approveReport', 'Backend:approveReport');
$router->add('rejectReport', 'Backend:rejectReport');

$router->get($route);
