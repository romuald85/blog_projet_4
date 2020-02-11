<?php
require_once 'Model/PostManager.php';

class Frontend
{

  public function listPosts()
  {
    $postManager = new PostManager();
    // TODO Récupérer les postes avec le postManager
    // TODO Appeler la vue qui permettra d'afficher la liste des posts

    // récupération des posts
    $posts = $postManager->getAll('posts');

    // récupération des commentaires
    $comments = $postManager->getAll('comments');

     ob_start(); ?>
        <h1>Mon blog</h1>
        <div id="posts">
          <?php if(!empty($posts)): ?>
              <div class="posts-list">
            <?php foreach($posts as $post): ?>
              <h2><?= $post->title ?>
                <br>
                <em><?= $post->creation_date ?></em> </h2>
              <p><?= $this->ellipsis($post->content) ?><a href="index.php?page=post&id=<?= $post->id ?>">Voir la suite</a></p>
            <?php endforeach ?>
            </div>
          <?php endif ?>
        </div>
        <?php $content = ob_get_clean(); ?>

        <?php require 'template.php';

  }

  public function onePost($id)
  {
    echo 'Voici le poste numéro ' . $id;
  }

  public function apropos()
  {
    echo 'A propos de nous';
  }

  function ellipsis($content)
  {
    return substr($content, 0, 60) . '...';
  }

}
