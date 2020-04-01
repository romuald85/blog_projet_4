<?php
session_start();// Entame la session

require __DIR__ . DIRECTORY_SEPARATOR . 'Autoloader.php';
require_once 'fonctions_utiles.php';

use App\Router;

// Appel la fonction register qui se trouve dans la class Autoloader
Autoloader::register();

$router = new Router();

/* ------------------ Front End ------------------ */
$router->add('home', 'Frontend:listPosts');
$router->add('post', 'Frontend:showPost');
$router->add('addComment', 'Frontend:addComment');
$router->add('alert', 'Frontend:reportComment');

/* ------------------ BackEnd ------------------ */
$router->add('login', 'Backend:loginAdmin');
$router->add('logout', 'Backend:logoutAdmin');
$router->add('admin', 'Backend:indexAdmin');

$router->add('posts', 'Backend:listPosts');
$router->add('createPost', 'Backend:createPost');
$router->add('updatePost', 'Backend:updatePost');
$router->add('deletePost', 'Backend:deletePost');

$router->add('approveComment', 'Backend:approveComment');
$router->add('rejectComment', 'Backend:rejectComment');

$router->add('comments', 'Backend:listComments');
$router->add('deleteComment', 'Backend:deleteComment');

$router->add('reports', 'Backend:listReports');

$router->add('approveReport', 'Backend:approveReport');
$router->add('rejectReport', 'Backend:rejectReport');

// gère les cas d'appel de la route
if(isset($_GET['route'])){// cas où la route est défini en GET
    $route = $_GET['route'];
} else if (isset($_POST['route'])){// cas où la route est défini en POST
    $route = $_POST['route'];
} else {// Par défaut la route est définie à home
    $route = 'home';
}

// éxecute l'action du controller correspondant à la route
$router->call($route);
