<?php
namespace Controllers;

use Model\PostManager;
use Model\CommentManager;

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
  public function onePost()
  {
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getCommentsApproved($_GET['id']);
    $idComments = $commentManager->getPostComments($_GET['id']);
    // Pour afficher le message 'votre commentaire à bien été ajouté etc ...' après le post d'un commentaire
    $addComment = false;
    if(isset($_GET['addComment']) && $_GET['addComment'] === 'true')
    {
      $addComment = true;
      header("Refresh:3;url=index.php?route=post&id={$_GET['id']}");
    }

    require 'View/Frontend/post.php';
  }

  /**
   * Ajoute un commentaire
   */
  public function addComment()
  {
    $commentManager = new CommentManager();

    if(!isset($_GET['id']) || empty($_GET['id']))
    {
      header('Location: index.php');
    }

    if(!empty($_POST['author']) && !empty($_POST['comment']))
    {
      $commentManager->postComment($_GET['id'], $_POST['author'], $_POST['comment']);
      header("Location: index.php?route=post&id={$_GET['id']}&addComment=true");
    } 
  }

  /**
   * Signaler un commentaire
   */
  public function alertComment()
  {
    $commentManager = new CommentManager();
    // Pour afficher le message 'Votre alerte pour le signalement d'un commentaire a bien été prise en compte'
    $addSignalComment = false;

    if(!isset($_GET['id']))
    {
      header("Location: index.php");
    }

    if(!empty($_POST['email']) && !empty($_POST['titre']) && !empty($_POST['numero']) && !empty($_POST['message']))
    {
      $commentManager->descriptionComment($_POST['email'], $_POST['titre'], $_POST['numero'], $_POST['message']);
      header("Location: index.php?route=post&id={$_GET['id']}");
    }

    require 'View/Frontend/alert.php';
  }

  public function alertCommentId()
  {
    $commentManager = new CommentManager();

    if(isset($_GET['alert']))
    {
      $commentManager->postCommentAlert($_GET['id']);
      header("Location: index.php?route=alert&id{$_GET['id']}");
    }

    require 'View/Frontend/post.php';
  }

    public function ellipsis($content)
  {
    return substr($content, 0, 250) . '...';
  }

}
