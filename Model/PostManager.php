<?php
namespace Model;

class PostManager extends Manager
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

  public function getPost($id)
  {
    $req = $this->db->prepare("SELECT * FROM posts WHERE id = {$id}");
    $req->execute();

    return $req->fetch();
  }

  public function updatePosts($id, $title, $content)
  {
    if(isset($id, $title, $content))
    {
      $req = $this->db->prepare("UPDATE posts SET id = ?, title = ?, content = ?, creation_date = NOW() WHERE id = ?");
      $req->execute(array($id, $title, $content, $id));
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
