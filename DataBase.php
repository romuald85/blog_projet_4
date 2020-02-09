<?php
require 'DbConnexion.php';

class DataBase extends DbConnexion
{
  private $db;

  public function __construct()
  {
    $this->db = $this->dbConnect();
  }

  public function getAll($table)
  {
    $req = $this->db->prepare("SELECT * FROM {$table} ORDER BY id DESC");
    $req->execute();
    return $req->fetchAll();
  }

  public function getPostComments($id)
  {
    $req = $this->db->prepare("SELECT c.* FROM comments AS c JOIN posts AS p ON p.id = c.post_id WHERE p.id = ? ORDER BY c.id DESC");
    $req->execute(array($id));
    return $req->fetchAll();
  }

  public function getCommentsApproved($id)
  {
    $req = $this->db->prepare("SELECT * FROM comments AS c JOIN posts AS p ON p.id = c.post_id WHERE p.id = ? AND approved = 1 ORDER BY c.id DESC");
    $req->execute(array($id));
    return $req->fetchAll();
  }

  public function approveComment($id)
  {
    $req = $this->db->prepare("UPDATE comments SET approved = 1 WHERE id = ?");
    $req->execute(array($id));
  }

  public function getPost($id)
  {
    $req = $this->db->prepare("SELECT * FROM posts WHERE id = {$id}");
    $req->execute();

    return $req->fetch();
  }


  public function postComment($post_id, $author, $comment)
  {
    if(isset($post_id, $author, $comment))
    {
      $req = $this->db->prepare("INSERT INTO comments(post_id, author, comment, comment_date) VALUES (?, ?, ?, NOW())");
      $req->execute(array($post_id, $author, $comment));
    }
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

  public function updatePosts($id, $title, $content)
  {
    if(isset($id, $title, $content))
    {
      $req = $this->db->prepare("UPDATE posts SET id = ?, title = ?, content = ?, creation_date = NOW() WHERE id = ?");
      $req->execute(array($id, $title, $content));
    }
  }

  public function createPost($title, $content)
  {
    if(isset($title, $content))
    {
      $req = $this->db->prepare("INSERT INTO posts(title, content, creation_date) VALUES (?, ?, NOW())");
      $req->execute(array($title, $content));
    }
  }

  public function deletePost($id)
  {
    if(empty($id))
    {
      throw Exception("le paramètre ID est requis");
    }
    $req = $this->db->prepare("DELETE FROM posts WHERE id = ?");
    $req->execute(array($id));
  }
}
