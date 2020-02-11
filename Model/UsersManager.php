<?php
require 'Model/Manager.php';

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
    if($req->fetchAll())
    {
      $result = true;
    }
    return $result;
  }
}