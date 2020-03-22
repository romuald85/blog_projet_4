<?php
namespace Model;

use \PDO;

// Connexion à la base de données
class Manager
{
  protected function dbConnect()
  {
    $db = new PDO(
      'mysql:host=localhost;dbname=projet-4_blog;charset=utf8',
      'root',
      '',
      [\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ],
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
  }
}
