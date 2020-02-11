<?php
require 'Model/Manager.php';

class CommentManager extends Manager
{
  private $db;

  public function __construct()
  {
    $this->db = $this->dbConnect();
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

  public function postComment($post_id, $author, $comment)
  {
    if(isset($post_id, $author, $comment))
    {
      $req = $this->db->prepare("INSERT INTO comments(post_id, author, comment, comment_date) VALUES (?, ?, ?, NOW())");
      $req->execute(array($post_id, $author, $comment));
    }
  }
}
