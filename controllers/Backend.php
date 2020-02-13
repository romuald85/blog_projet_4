<?php
namespace Controllers;
session_start();

use Model\PostManager;
use Model\CommentManager;
use Model\UsersManager;

class Backend
{
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
      header('Location: index.php?route=login');
    }

    if(isset($_GET['deconnect']))
    {
      unset($_SESSION['user']);
      header('Location: index.php?route=login');
    }
    require 'View/Backend/admin.php';
  }

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


    if(isset($_GET['action']) && $_GET['action'] === 'delete')
    {
      $updatePost->deletePost($_GET['id']);
      header('Location: index.php?route=articles');
    }
    $post = $updatePost->getPost($_GET['id']);
    require 'View/Backend/update.php';
  }

  public function commentsAndPosts()
  {
    $postManager = new PostManager();
    $posts = $postManager->getAll('posts');

    require 'View/Backend/commentsAndPosts.php';
  }

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
}
