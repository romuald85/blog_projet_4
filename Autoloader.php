<?php

class Autoloader
{
  static function register()
  {
    // Appel la fonction 'autoload' qui se trouve dans cette class 
    spl_autoload_register(array(__CLASS__, 'autoload'));
  }

  static function autoload($class)
  {
    $paths = explode('\\', $class);
    $directory = strtolower($paths[0]);
    $className = ucfirst($paths[1]);
    require $directory . '/' . $className . '.php';
  }
}
