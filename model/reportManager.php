<?php 
namespace Model;

class ReportManager extends Manager
{
  protected $table = 'reportcomments';

  public function getAllReport()
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
      WHERE rc.approved IS NULL
      GROUP BY c.id
      ORDER BY
       nb_report DESC,
       c.id DESC"
    );
    $req->execute();
    return $req->fetchAll();
  }

  /**
   * supprime le signalement en fonction de l'id
   * @param int $id
   */
  public function deleteReport($id)
  {
    $req = $this->db->prepare("DELETE FROM reportcomments WHERE id = ?");
    $req->execute(array($id));
  }

  /**
   * approuve le signalement en fonction de l'id de commentaire
   * @param int $id l'id de commentaire
   */
  public function approveReport($id)
  {
    $req = $this->db->prepare("UPDATE reportcomments SET approved = 1 WHERE comment_id = ?");
    $req->execute(array($id));
  }

  /**
   * rejette le signalement en fonction de l'id de commentaire
   * @param int $id l'id de commentaire
   */
  public function rejectReport($id)
  {
    $req = $this->db->prepare("UPDATE reportcomments SET approved = 0 WHERE comment_id = ?");
    $req->execute(array($id));
  }

  /**
   * récupère l'id du commentaire de la table reportcomments
   */
  public function getCommentIdFromReportId($id)
  {
    $req = $this->db->prepare("SELECT comment_id FROM reportcomments WHERE id = ?");
    $req->execute(array($id));
    $tmpclass = $req->fetch();
    return $tmpclass->comment_id;
  }

  /**
   * post les commentaires signalés
   */
  public function reportComment($comment_id, $report)
  {
    if(isset($comment_id, $report))
    {
      $req = $this->db->prepare("INSERT INTO reportcomments(comment_id, report) VALUES (?, ?)");
      $req->execute(array($comment_id, $report));
    }
  }
}