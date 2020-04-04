<?php
namespace Controllers;

use Model\PostManager;
use Model\CommentManager;
use Model\UsersManager;
use Model\ReportManager;

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
    require 'view/backend/login.php';
  }

  /**
   * Met fin à la session 'user' et redirige vers la page login
   */
  public function logoutAdmin()
  {
    unset($_SESSION['user']);
    setMessageFlash("Vous êtes deconnecté !", SUCCESS_MESSAGE);
    header("Location: index.php?route=login");
  }

  /**
   * affiche la page admin
   */
  public function indexAdmin()
  {
    require 'view/backend/admin.php';
  }

  /**
   * affiche tous les articles sur la vue article
   */
  public function listPosts()
  {
    $postManager = new PostManager();
    $posts = $postManager->getAll('posts');

    require 'view/backend/posts.php';
  }

  /**
   * pour créer article
   */
  public function createPost()
  {
    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $content = isset($_POST['content']) ? $_POST['content'] : null;

    if( 'POST' == $_SERVER['REQUEST_METHOD']){
      if(!empty($title) && !empty($content))
      {
        $createPost = new PostManager();
        $createPost->createPost($title, $content);
        header('Location: index.php?route=posts');
      } else {
        setMessageFlash("Veuillez remplir les champs !", DANGER_MESSAGE);
      }
    }
    require 'view/backend/create.php';
  }

  /**
   * pour modifier un article
   */
  public function updatePost()
  { 
    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $content = isset($_POST['content']) ? $_POST['content'] : null;

    if(!$id || 0 >= $id)
    {
      header("Location: index.php?route=admin");
      return false;
    }

    $postManager = new PostManager();

    if('POST' == $_SERVER['REQUEST_METHOD']) {
      if(!empty($title) && !empty($content)) {
        $postManager->updatePosts($id, $title, $content);
        setMessageFlash("Votre article a bien été modifié ! ", SUCCESS_MESSAGE);
      } else {
        setMessageFlash("Veuillez remplir les champs obligatoires !", DANGER_MESSAGE);
      }
    }

    $post = $postManager->getPost($id);
    require 'view/backend/updatePost.php';
  }

  /**
   * Fonction qui permet de supprimer un article
   */
  public function deletePost()
  {
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if(!$id || 0 >= $id)
    {
      header("Location: index.php?route=admin");
    } else {
      $postManager = new PostManager();
      $postManager->deletePost($id);
      header('Location: index.php?route=posts');
    }
  }

  /**
   * liste les commentaires
   */
  public function listComments()
  {
    $type = isset($_GET['type']) ? $_GET['type'] : null;

    $commentManager = new CommentManager();

    $comments = $commentManager->getComments($type);

    require 'view/backend/comments.php';
  }

  /**
   * approuve les commentaires pour qu'ils s'affichent côté client
   */
  public function approveComment()
  {
    $idComment = isset($_GET['idComment']) ? $_GET['idComment'] : null;

    if(!$idComment || 0 >= $idComment)
    {
      header("Location: index.php?route=admin");
    } else {
      $commentManager = new CommentManager();

      $idPost = $commentManager->getPostIdFromCommentId($idComment);
      $commentManager->approveComment($idComment);
      //header("Location: index.php?route=comments&id={$idPost}");
      setMessageFlash("Le commentaire #{$idComment} a été approuvé", SUCCESS_MESSAGE);
      header("Location: index.php?route=comments&type=" . \Model\CommentManager::TYPE_WAITING);
    }
  }

  public function rejectComment()
  {
    $idComment = isset($_GET['idComment']) ? $_GET['idComment'] : null;

    if(!$idComment || 0 >= $idComment){
      header("Location: index.php?route=admin");
    } else {
      $commentManager = new CommentManager();
      $commentManager->rejectComment($idComment);
      setMessageFlash("Le commentaire #{$idComment} a été rejeté", SUCCESS_MESSAGE);
      header("Location: index.php?route=comments&type=" . \Model\CommentManager::TYPE_WAITING);
    }
  }

  /**
   * supprime le commentaire avant qu'il apparaisse côté client
   */
  public function deleteComment()
  {
    $idComment = isset($_GET['idComment']) ? $_GET['idComment'] : null;// affecte l'id comment avec null ou l'id comment en superglobal GET
    $commentManager = new CommentManager();

    // si l'id comment n'existe pas ou qu'il est inférieur à zero renvoi sur la page admin
    if(!$idComment || 0 >= $idComment){
      header("Location: index.php?route=admin");
    } else {
      $idPost = $commentManager->getPostIdFromCommentId($idComment);// récupère l'id du post en rapport avec l'id du commentaire
      $commentManager->deleteComment($idComment);// supprime le commentaire en base de données
      header("Location: index.php?route=comments&id={$idPost}");// redirige vers le post déterminé plus haut
    }
  }

  /**
   * affiche les commentaires signalés
   */
  public function listReports()
  {
    $reportManager = new ReportManager();

    $comments = $reportManager->getAllReport();
    require 'view/backend/reports.php';
  }

  /**
   * valide un signalement
   */
  public function approveReport()
  {
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if(!$id || 0 >= $id)
    {
      header("Location: index.php?route=admin");
    } else {
      $reportManager = new ReportManager();
      $idComment = $reportManager->getCommentIdFromReportId($id);
      $reportManager->approveReport($idComment);
      setMessageFlash("Le signalement du commentaire #{$idComment} a été validé");
      header("Location: index.php?route=reports");
    }
  }

  /**
   * invalide un signalement
   */
  public function rejectReport()
  {
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if(!$id || 0 >= $id){
      header("Location: index.php?route=reports");
    } else {
      $reportManager = new ReportManager();
      $idComment = $reportManager->getCommentIdFromReportId($id);
      $reportManager->rejectReport($idComment);
      setMessageFlash("Le signalement du commentaire #{$idComment} a été invalidé");
      header("Location: index.php?route=reports");
    }
  }
}
