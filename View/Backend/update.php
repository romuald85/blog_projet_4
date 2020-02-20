<?php

ob_start(); ?>
  <a href="index.php?route=articles" class="btn btn-danger">Retour</a>

  <h1 class="text-center">Mon article à modifier: </h1>

  <div class="container">
    <form action="#" method="post">
      <div class="form-group">
        <label for="title">Titre</label>
        <br>
        <input id="title" type="text" name="title" value="<?= $post->title ?>" class="form-control">
        <br>
      </div>
      <div class="form-group">
        <label for="content">Contenu</label>
        <br>
        <textarea id="contentPost" name="content" rows="8" cols="80" class="form-control">
          <?= $post->content ?>
        </textarea>
        <br>
      </div>
      <div>
        <button type="submit" class="btn btn-primary">Valider</button>
        <br>
      </div>
      <a href="index.php?route=update&id=<?= $post->id ?>&action=delete" class="btn btn-danger">Supprimer l'article</a>
  </form>
  </div>
  <?php $content = ob_get_clean(); ?>

    <?php require 'template.php';
