<?php

ob_start(); ?>
<a href="index.php?route=admin" class="btn btn-danger">Retour</a>

<?php if(!empty($posts)): ?>
  <div class="container">
    <div class="row">
      <?php foreach($posts as $post): ?>
        <div class="col-sm-6 col-md-4" style="border: 1px solid">
          <h2><?= $post->title ?></h2>
          <br>
          <p class="font-italic"><?= $post->creation_date ?></p>
          <p><?= $post->content ?></p>
          <a href="index.php?route=comments&type=<?php Model\CommentManager::TYPE_WAITING ?> &idPost=<?= $post->id ?>">Modérer les commentaires</a>
        </div>
      <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

<?php $content = ob_get_clean(); ?>

<?php require 'template.php';
