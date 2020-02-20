<?php

ob_start(); ?>
<a href="index.php?route=commentsAndPosts" class="btn btn-danger">Retour</a>

<h2 class="text-center">Modérer les commentaires</h2>

<?php if(!empty($comments)): ?>
  <div class="container">
    <?php foreach($comments as $comment): ?>
      <h3><?= $comment->author ?></h3>
       <p class="font-italic"><?= $comment->comment_date ?></p>
       <p>#<?= $comment->id ?></p>
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
