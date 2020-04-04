<?php
namespace Controllers;

use Model\PostManager;
use Model\CommentManager;
use Model\ReportManager;

class Frontend
{

  /**
   * Récupération de tous les posts en base de données
   */
  public function listPosts()
  {
    $postManager = new PostManager();

    $posts = $postManager->getAll('posts');
    require 'view/frontend/home.php';
  }

  /**
   * Récupèration du post selon l'id et gère l'affichage du commentaire approuvé
   */
  public function showPost()
  {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $refresh = isset($_GET['refresh']) ? $_GET['refresh'] : null;

    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $post = $postManager->getPost($id);
    if(!$post){
      header("Location: index.php?route=home");
    }
    $comments = $commentManager->getCommentsApproved($id);

    // Pour effacer le message 'votre commentaire à bien été ajouté etc ...' après le post d'un commentaire on refresh la page apres 3 secondes
    if($refresh && 'true' === $refresh)
    {
      header("Refresh:3;url=index.php?route=post&id={$id}");
    }

    require 'view/frontend/post.php';
  }

  /**
   * Ajoute un commentaire
   */
  public function addComment()
  {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $author = isset($_POST['author']) ? $_POST['author'] : null;
    $comment = isset($_POST['comment']) ? $_POST['comment'] : null;

    if(!$id || empty($id))
    {
      header('Location: index.php');
    }

    if( 'POST' == $_SERVER['REQUEST_METHOD']){
      if(!empty($author) && !empty($comment))
      {
        $commentManager = new CommentManager();
        $commentManager->postComment($id, $author, $comment);
        setMessageFlash("Votre commentaire a bien été pris en compte, il est en attente d'approbation.", PRIMARY_MESSAGE);
      } else {
        setMessageFlash("Veuillez remplir les champs obligatoires !", DANGER_MESSAGE);
      }
      header("Location: index.php?route=post&id={$id}&refresh=true");
    }
  }

  /**
   * Signaler un commentaire
   */
  public function reportComment()
  {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $reportComment = isset($_POST['reportComment']) ? $_POST['reportComment'] : null;

    if( 'POST' == $_SERVER['REQUEST_METHOD']){
      $commentManager = new CommentManager();
      $postId = $commentManager->getPostIdFromCommentId($id);
      if(!empty($id) && !empty($reportComment))
      {
        $reportManager = new ReportManager();
        $reportManager->reportComment($id, $reportComment);
        setMessageFlash("Votre commentaire a bien été signalé l'administrateur confirmera le signalement si nécéssaire.", PRIMARY_MESSAGE);
      } else {
        setMessageFlash("Veuillez séléctionner une option !", DANGER_MESSAGE);
      }
      header("Location: index.php?route=post&id={$postId}&refresh=true");
    }
  }

  public function ellipsis($content)
  {
    return substr($content, 0, 250) . '...';
  }

}
