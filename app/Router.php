<?php

class Router
{
  public $routes = [];

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
    require 'controllers/' . $controllerName . '.php';
    $controller = new $controllerName;

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
