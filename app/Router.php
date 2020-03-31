<?php
namespace App;

class Router
{
  public $routes = [];

  // Ajouter le nom de la route et la valeur ex: add('home, frontend:onePost')
  public function add($name, $value)
  {
    $this->routes[$name] = $value;// $name: clé du tableau, $value: valeur associé à la clé
  }

  /**
   * Détermine et éxecute l'action du controller d'après le nom de route passé en paramètre
   * @param string $name nom de la route
   */
  public function call($name)
  {
    if( !array_key_exists($name, $this->routes) ){
      $name = 'home';
    }
    // etape 1: récupérer le nom du controller et de l'action en fonction du nom de la route
    $route = explode(':', $this->routes[$name]);
    $controllerName = ucfirst($route[0]);
    $actionName = strtolower($route[1]);

    // etape 2: on instancie le controller récupéré précédemment new Controllers\Backend()
    $class = 'Controllers\\' . $controllerName;
    $controller = new $class;

    // etape 3: on éxécute l'action du controller $controller->indexAdmin();
    $controller->$actionName();
  }
}
