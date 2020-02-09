<?php

function ellipsis($content)
{
  return substr($content, 0, 60) . '...';
}

// récupération des posts
$posts = $dataBase->getAll('posts');

// récupération des commentaires
$comments = $dataBase->getAll('comments');

?>
<?php ob_start(); ?>
    <h1>Mon blog</h1>
    <div id="posts">
      <?php if(!empty($posts)): ?>
          <div class="posts-list">
        <?php foreach($posts as $post): ?>
          <h2><?= $post->title ?>
            <br>
            <em><?= $post->creation_date ?></em> </h2>
          <p><?= ellipsis($post->content) ?><a href="index.php?page=post&id=<?= $post->id ?>">Voir la suite</a></p>
        <?php endforeach ?>
        </div>
      <?php endif ?>
    </div>
    <?php $content = ob_get_clean(); ?>

    <?php require 'template.php'; ?>
