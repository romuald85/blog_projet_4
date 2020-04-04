<?php
namespace Model;

class UsersManager extends Manager
{
  protected $table = 'users';

  public function exists($login, $password)
  {
    $req = $this->db->prepare("SELECT login, password FROM users WHERE login = ?");
    $req->execute(array($login));
    // Passe le résultat de la  requête à true si les login sont bons
    $ok = false;
    if($data = $req->fetch())
    {
      $ok = password_verify($password, $data->password);
    }
    return $ok;
  }
}
