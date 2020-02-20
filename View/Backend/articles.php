<?php

ob_start(); ?>
  <a href="index.php?route=admin" class="btn btn-danger">Retour</a>
  <br>
  <a href="index.php?route=create" class="btn btn-primary">Écrire un nouvel article</a>

  <h1 class="text-center">Mes articles</h1>

  <div class="container">
    <div class="row">
      <?php if(!empty($posts)): ?>
          <?php foreach ($posts as $post): ?>
            <div class="col-sm-6 col-md-4" style="border: 1px solid">
              <h2><?= $post->title ?></h2><em><?= $post->creation_date ?></em>
              <p>
                <?= $post->content ?>
              </p>
              <a href="index.php?route=update&id=<?= $post->id ?>">Modifier l'article</a>
            </div>
        <?php endforeach; ?>
          <?php endif; ?>

    </div>
  </div>
  <?php $content = ob_get_clean(); ?>

    <?php require 'template.php';
