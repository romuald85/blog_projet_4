<?php
namespace Model;

use \PDO;

// Connexion à la base de données
class Manager
{
  protected $db;
  protected $table = '';

  public function __construct()
  {
    $this->db = new PDO(
      'mysql:host=localhost;dbname=projet-4_blog;charset=utf8',
      'root',
      '',
      [\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ],
    );
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  // Récupère les articles
  public function getAll()
  {
    $req = $this->db->prepare("SELECT * FROM " . $this->table . " ORDER BY id DESC");
    $req->execute();
    return $req->fetchAll();
  }
}
