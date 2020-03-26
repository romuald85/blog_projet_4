<?php
namespace Controllers;
session_start();

use Model\PostManager;
use Model\CommentManager;
use Model\UsersManager;

class Backend
{
  /**
   * Récupère le login et le mdp
   */
  public function userExists()
  {
    $usersExists = new UsersManager();

    if(!empty($_POST['login']) && !empty($_POST['password']))
    {
      if($usersExists->userExists($_POST['login'], $_POST['password']) === false)
      {
        echo 'Les identifiants sont invalides !';
      }
      else
      {
        // Entame la session de connexion
        $_SESSION['user'] = $_POST['login'];
        header('Location: index.php?route=admin');
      }
    }
    require 'View/Backend/login.php';
  }

  public function admin()
  {
    if(!isset($_SESSION['user']))
    {
      // Renvoi vers la page login si l' utilisateur n'existe pas
      header('Location: index.php?route=login');
    }

    if(isset($_GET['deconnect']))
    {
      // Fin de session de connexion
      unset($_SESSION['user']);
      header('Location: index.php?route=login');
    }
    require 'View/Backend/admin.php';
  }

  // Récupère tous les articles
  public function articles()
  {
    $postManager = new PostManager();
    $posts = $postManager->getAll('posts');

    require 'View/Backend/articles.php';
  }

  public function createArticle()
  {
    $createPost = new PostManager();
    if(!empty($_POST['title']) && !empty($_POST['content']))
    {
      $createPost->createPost($_POST['title'], $_POST['content']);
      header('Location: index.php?route=articles');
    }
    require 'View/Backend/create.php';
  }

  public function updateArticle()
  {
    $updatePost = new PostManager();

    if(!empty($_POST['title']) && !empty($_POST['content']))
    {
      $updatePost->updatePosts($_GET['id'], $_POST['title'], $_POST['content']);
      header('Location: index.php?route=articles');
    }

    // Fonction qui permet de supprimer un article
    if(isset($_GET['action']) && $_GET['action'] === 'delete')
    {
      $updatePost->deletePost($_GET['id']);
      header('Location: index.php?route=articles');
    }
    $post = $updatePost->getPost($_GET['id']);
    require 'View/Backend/update.php';
  }

  // Fonction qui récupère les articles dans la page commentsAndPosts sera affiché un lien qui renverra vers les commentaires de l'article en question
  public function commentsAndPosts()
  {
    $postManager = new PostManager();
    $posts = $postManager->getAll('posts');

    require 'View/Backend/commentsAndPosts.php';
  }

  // Fonction qui récupère les commentaires dans l'administration et qui les approuve
  public function comments()
  {
    $commentManager = new CommentManager();

    if(isset($_GET['approved']) && $_GET['approved'] === 'true' && isset($_GET['idComment']) && !empty($_GET['idComment']))
    {
      $commentManager->approveComment($_GET['idComment']);
    }

    $comments = $commentManager->getPostComments($_GET['id']);
    require 'View/Backend/comments.php';
  }

  /**
   * supprime le commentaire avant qu'il apparaisse côté client
   */
  public function deleteComment()
  {
    $idComment = isset($_GET['idComment']) ? $_GET['idComment'] : null;// affecte l'id comment avec null ou l'id comment en superglobal GET
    $commentManager = new CommentManager();

    // si l'id comment n'existe pas ou qu'il est inférieur à zero renvoi sur la page commentsAndPosts
    if(!$idComment || 0 >= $idComment){
      header("Location: index.php?route=commentsAndPosts");
    } else {
      $idPost = $commentManager->getPostIdFromCommentId($idComment);// récupère l'id du post en rapport avec l'id du commentaire
      $commentManager->deleteComment($idComment);// supprime le commentaire en base de données
      header("Location: index.php?route=comments&id={$idPost}");// redirige vers le post déterminé plus haut
    }
  }

  // Appel la fonction qui récupère les données du formulaire pour les commentaires signalés
  public function commentSignal()
  {
    $commentManager = new CommentManager();

    $comments = $commentManager->getAllCommentsSignal();

    if(isset($_GET['action']) && $_GET['action'] === 'delete')
    {
      $commentManager->deleteCommentSignal($_GET['id']);
      header("Location: index.php?route=commentSignal");
    }

    require 'View/Backend/commentSignal.php';
  }
}
