<?php
namespace Model;

class CommentManager extends Manager
{
  private $db;

  public function __construct()
  {
    $this->db = $this->dbConnect();
  }

  // Récupère les commentaires
  public function getPostComments($id)
  {
    $req = $this->db->prepare("SELECT c.* FROM comments AS c JOIN posts AS p ON p.id = c.post_id WHERE p.id = ? ORDER BY c.id DESC");
    $req->execute(array($id));
    return $req->fetchAll();
  }

  // Récupère les commentaires approuvés
  public function getCommentsApproved($id)
  {
    $req = $this->db->prepare("SELECT c.id, post_id, author, comment, comment_date, approved FROM comments AS c JOIN posts AS p ON p.id = c.post_id WHERE p.id = ? AND approved = 1 ORDER BY c.id DESC");
    $req->execute(array($id));
    return $req->fetchAll();
  }

  // Passe les commentaire de 0 à 1
  public function approveComment($id)
  {
    $req = $this->db->prepare("UPDATE comments SET approved = 1 WHERE id = ?");
    $req->execute(array($id));
  }

  // Poste des commentaires
  public function postComment($post_id, $author, $comment)
  {
    if(isset($post_id, $author, $comment))
    {
      $req = $this->db->prepare("INSERT INTO comments(post_id, author, comment, comment_date) VALUES (?, ?, ?, NOW())");
      $req->execute(array($post_id, trim($author), htmlspecialchars(trim($comment))));
    }
  }

  public function postCommentAlert($comment_id, $report)
  {
    if(isset($comment_id, $report))
    {
      $req = $this->db->prepare("INSERT INTO reportcomments(comment_id, report) VALUES (?, ?)");
      $req->execute(array($comment_id, $report));
    }
  }

  public function getAllCommentsSignal()
  {
    $req = $this->db->prepare(
      "SELECT
        c.id AS id_comment,
        rc.report,
        p.title,
        p.id AS id_post,
        rc.id AS id_report,
        c.comment,
        COUNT(rc.id) AS nb_report 
      FROM reportcomments AS rc
      INNER JOIN comments AS c 
        ON c.id = rc.comment_id
      INNER JOIN posts AS p 
        ON c.post_id = p.id
      GROUP BY c.id
      ORDER BY
       nb_report DESC,
       c.id DESC"
    );
    $req->execute();
    return $req->fetchAll();
  }

  /**
   * Renvoi l'identifiant du post qui correspont à l'identifiant d'un commentaire envoyer en parametre
   * @var int id correspond à l'identifiant de commentaire
   * @return int
   */
  public function getPostIdFromCommentId($id)
  {
    $req = $this->db->prepare(
      "SELECT post_id AS identifiant
      FROM `comments`
      WHERE id = ?"
    );
    $req->execute(array($id));
    $tmpClass = $req->fetch();
    return $tmpClass->identifiant;
  }

  public function deleteComment($id)
  {
    $req = $this->db->prepare("DELETE FROM comments WHERE id = ?");
    $req->execute(array($id));
  }

  public function deleteCommentSignal($id)
  {
    $req = $this->db->prepare("DELETE FROM reportcomments WHERE id = ?");
    $req->execute(array($id));
  }
}
