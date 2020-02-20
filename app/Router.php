<?php
namespace App;

class Router
{
  public $routes = [];

  // Ajouter le nom de la route et la valeur ex: add('home, frontend:onePost')
  public function add($name, $value)
  {
    $this->routes[$name] = $value;
  }

  public function get($name)
  {
    // etape 1: récupérer le controller et l'action en fonction du nom de la route
    $route = explode(':', $this->routes[$name]);
    $controllerName = ucfirst($route[0]);
    $actionName = strtolower($route[1]);
    if(isset($route[2]))
    {
      $id = (int) $route[2];
    }

    // etape 2: on instancie le controller récupéré précédemment
    $class = 'Controllers\\' . $controllerName;
    $controller = new $class;

    // etape 3: on éxécute l'action du controller
    if(isset($id))
    {
      $controller->$actionName($id);
    }
    else
    {
      $controller->$actionName();
    }
  }
}
