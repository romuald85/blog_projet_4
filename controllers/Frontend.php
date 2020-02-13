<?php
namespace Controllers;

use Model\PostManager;
use Model\CommentManager;

class Frontend
{

  public function listPosts()
  {
    $postManager = new PostManager();
    // TODO Récupérer les postes avec le postManager
    // TODO Appeler la vue qui permettra d'afficher la liste des posts

    // récupération des posts
    $posts = $postManager->getAll('posts');
    require 'View/Frontend/home.php';
  }

  public function onePost()
  {
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getPostComments($_GET['id']);

    require 'View/Frontend/post.php';
  }

  public function addComment()
  {
    $commentManager = new CommentManager();
    $commentManager->postComment($post_id, $author, $comment);



    require 'View/Frontend/post.php';
  }

  public function ellipsis($content)
  {
    return substr($content, 0, 60) . '...';
  }

}
