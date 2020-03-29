<?php 
namespace Model;

class reportManager extends Manager 
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
      GROUP BY c.id
      ORDER BY
       nb_report DESC,
       c.id DESC"
    );
    $req->execute();
    return $req->fetchAll();
  }

  public function deleteReport($id)
  {
    $req = $this->db->prepare("DELETE FROM reportcomments WHERE id = ?");
    $req->execute(array($id));
  }
}