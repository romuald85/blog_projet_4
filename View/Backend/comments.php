<?php

ob_start(); ?>
<a href="index.php?route=admin" class="btn btn-danger">Retour</a>

<h2 class="text-center">Modérer les commentaires</h2>

  <div class="container">
    <?php if(!empty($comments)): ?>
    <?php foreach($comments as $comment): ?>
      <h3><?= $comment->author ?></h3>
       <p class="font-italic"><?= $comment->comment_date ?></p>
       <p>#<?= $comment->id ?></p>
      <p>
        <?= nl2br($comment->comment) ?>
      </p>
      <div>
        <a href="index.php?route=approveComment&idComment=<?= $comment->id ?>">Approuver</a>
      </div>
      <div>
        <a href="index.php?route=rejectComment&idComment=<?= $comment->id ?>">Rejeter</a>
      </div>
      <hr>
    <?php endforeach; ?>
    <?php else: ?>
      <p>Il n'y a pas de commentaires !</p>
    <?php endif ?>
  </div>

  <?php $content = ob_get_clean(); ?>

  <?php require 'template.php';
