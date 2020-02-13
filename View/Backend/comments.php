<?php

ob_start(); ?>
<a href="index.php?route=commentsAndPosts">Retour</a>

<h1>Modérer les commentaires</h1>

<?php if(!empty($comments)): ?>
  <div>
    <?php foreach($comments as $comment): ?>
      <h2><?= $comment->author ?> <em><?= $comment->comment_date ?></em></h2>
      <p>
        <?= $comment->comment ?>
      </p>
      <?php if($comment->approved == 0): ?>
      <a href="index.php?route=comments&idComment=<?= $comment->id ?>&approved=true&id=<?= $_GET['id'] ?>">Approuver</a>
    <?php endif ?>
      <?php endforeach ?>
  </div>
  <?php endif ?>

  <?php $content = ob_get_clean(); ?>

  <?php require 'template.php';
