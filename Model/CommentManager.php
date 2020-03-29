<?php
namespace Model;

class CommentManager extends Manager
{
  protected $table = 'comments';
  
  const TYPE_WAITING = 'waiting';

  const COMMENTS_TYPE = array(self::TYPE_WAITING);// verifie que la const TYPE_WAITING fait partie du tableau

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

  /**
   * approuve le commentaire en passant la colonne approved à 1
   * @param int $id
   */
  public function approveComment($id)
  {
    $req = $this->db->prepare("UPDATE comments SET approved = 1 WHERE id = ?");
    $req->execute(array($id));
  }

  /**
   * rejette le commentaire en passant la colonne approved à 0
   * @param int $id
   */
  public function rejectComment($id)
  {
    $req = $this->db->prepare("UPDATE comments SET approved = 0 WHERE id = ?");
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

  /**
   * récupère les commentaires en attente pour les approuver ou non
   * @return array[StdClass]
   * @param string $type le type de commentaire. Doit faire parti de liste COMMENTS_TYPE
   */
  public function getComments($type)
  {
    if(!in_array($type, self::COMMENTS_TYPE)){
      return false;
    }
    if($type = self::TYPE_WAITING){
      $req = $this->db->prepare("SELECT * FROM `comments` WHERE approved IS NULL");
      $req->execute();
      return $req->fetchAll();
    }
  }
}
