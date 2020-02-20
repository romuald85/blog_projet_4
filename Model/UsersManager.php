<?php
namespace Model;

class UsersManager extends Manager
{
  private $db;

  public function __construct()
  {
    $this->db = $this->dbConnect();
  }

  public function userExists($login, $password)
  {
    $result = false;
    $req = $this->db->prepare("SELECT login, password FROM users WHERE login = ? AND password = ?");
    $req->execute(array($login, $password));
    // Passe le résultat de la  requête à true si les login sont bons
    if($req->fetchAll())
    {
      $result = true;
    }
    return $result;
  }
}
