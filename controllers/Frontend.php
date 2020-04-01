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
    require 'View/Frontend/home.php';
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

    require 'View/Frontend/post.php';
  }

  /**
   * Ajoute un commentaire
   */
  public function addComment()
  {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $author = isset($_POST['author']) ? $_POST['author'] : null;
    $comment = isset($_POST['comment']) ? $_POST['comment'] : null;

    if(!$id || empty($id))
    {
      header('Location: index.php');
    }

    if(!empty($author) && !empty($comment))
    {
      $commentManager = new CommentManager();
      $commentManager->postComment($id, $author, $comment);
      setMessageFlash("Votre commentaire a bien été pris en compte, il est en attente d'approbation.", PRIMARY_MESSAGE);
      header("Location: index.php?route=post&id={$id}&refresh=true");
    }
  }

  /**
   * Signaler un commentaire
   */
  public function reportComment()
  {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $reportComment = isset($_GET['reportComment']) ? $_GET['reportComment'] : null;

    if($id && $reportComment)
    {
      $commentManager = new CommentManager();
      $reportManager = new ReportManager();
      $reportManager->reportComment($id, $reportComment);
      $postId = $commentManager->getPostIdFromCommentId($id);
      setMessageFlash("Votre commentaire a bien été signalé l'administrateur confirmera le signalement si nécéssaire.", PRIMARY_MESSAGE);
      header("Location: index.php?route=post&id={$postId}&refresh=true");
    }
  }

  public function ellipsis($content)
  {
    return substr($content, 0, 250) . '...';
  }

}
