<?php

ob_start(); ?>
  <a href="index.php?route=posts" class="btn btn-danger">Retour</a>

  <h1 class="text-center">Mon article à modifier: </h1>

  <div class="container">
    <form action="index.php" method="post">
      <input type="hidden" name="route" value="updatePost">
      <input type="hidden" name="id" value="<?= $post->id ?>">
      <div class="form-group">
        <label for="title">Titre<span class="asterix">*</span></label>
        <br>
        <input id="title" type="text" name="title" value="<?= $post->title ?>" class="form-control" required>
        <br>
      </div>
      <div class="form-group">
        <label for="content">Contenu<span class="asterix">*</span></label>
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
    </form>
    <a href="index.php?route=deletePost&id=<?= $post->id ?>" class="btn btn-danger">Supprimer l'article</a>
    <p class="asterix">* Champs obligatoires à remplir</p>
  </div>
  <?php $content = ob_get_clean(); ?>

    <?php require 'template.php';
