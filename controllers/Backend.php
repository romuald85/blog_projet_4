<?php
namespace Controllers;

use Model\PostManager;
use Model\CommentManager;
use Model\UsersManager;

class Backend
{
  /**
   * Connecte l'utilisateur en ajoutant son login, qu'il a entré, à la session après l'avoir comparé ainsi que le mdp en base
   */
  public function loginAdmin()
  {
    if(isUserConnected()){
      setMessageFlash('Vous êtes déjà connecté', PRIMARY_MESSAGE);
      header("Location: index.php?route=admin");
      return false;// pour ne pas executer la suite de la fonction
    }
    $login = isset($_POST['login']) ? trim($_POST['login']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;

    // vérifie que le formulaire a été envoyé pour ne pas affiché des messages d'erreurs lorsque l'on arrive sur la page
    if ('POST' == $_SERVER['REQUEST_METHOD']){
      if(!empty($login) && !empty($password))
      {
        $usersManager = new UsersManager();
        if($usersManager->exists($login, $password) === false)
        {
          setMessageFlash('Les identifiants sont invalides !', DANGER_MESSAGE);
        }
        else
        {
          $_SESSION['user'] = $login;
          setMessageFlash("Vous êtes connecté !", SUCCESS_MESSAGE);
          header('Location: index.php?route=admin');
        }
      } else
      {
        setMessageFlash('Les champs sont vides veuillez les remplir !', DANGER_MESSAGE);
      }
    }
    require 'View/Backend/login.php';
  }

  public function logoutAdmin()
  {
    unset($_SESSION['user']);
    setMessageFlash("Vous êtes deconnecté !", SUCCESS_MESSAGE);
    header("Location: index.php?route=login");
  }

  public function indexAdmin()
  {
    if(isset($_GET['deconnect']))
    {
      // Fin de session de connexion
      unset($_SESSION['user']);
      header('Location: index.php?route=login');
    }
    require 'View/Backend/admin.php';
  }

  /**
   * affiche tous les articles sur la vue article
   */
  public function listPosts()
  {
    $postManager = new PostManager();
    $posts = $postManager->getAll('posts');

    require 'View/Backend/posts.php';
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

  /**
   * liste les commentaires
   */
  public function listComments()
  {
    $type = isset($_GET['type']) ? $_GET['type'] : null;

    $commentManager = new CommentManager();

    $comments = $commentManager->getComments($type);

    require 'View/Backend/comments.php';
  }

  public function approveComment()
  {
    $idComment = isset($_GET['idComment']) ? $_GET['idComment'] : null;

    $commentManager = new CommentManager();

    if(!$idComment || 0 >= $idComment)
    {
      header("Location: index.php?route=commentsAndPosts");
    } else {
      $idPost = $commentManager->getPostIdFromCommentId($idComment);
      $commentManager->approveComment($idComment);
      header("Location: index.php?route=comments&id={$idPost}");
    }
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
