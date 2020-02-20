<?php
namespace Controllers;

use Model\PostManager;
use Model\CommentManager;

class Frontend
{

  public function listPosts()
  {
    $postManager = new PostManager();


    // récupération des posts
    $posts = $postManager->getAll('posts');
    require 'View/Frontend/home.php';
  }

  // Récupèration du post selon l'id et gère l'affichage du commentaire approuvé
  public function onePost()
  {
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getCommentsApproved($_GET['id']);
    $idComments = $commentManager->getPostComments($_GET['id']);
    $addComment = false;
    if(isset($_GET['addComment']) && $_GET['addComment'] === 'true')
    {
      $addComment = true;
    }

    require 'View/Frontend/post.php';
  }

  // Poste un commentaire
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

  // Poster un commentaire à signaler
  public function alertComment()
  {
    $commentManager = new CommentManager();

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

    public function ellipsis($content)
  {
    return substr($content, 0, 250) . '...';
  }

}
