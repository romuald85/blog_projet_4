<?php

ob_start(); ?>
<a href="index.php?route=articles">Retour</a>

<h1>Mon article à modifier: </h1>

<form action="#" method="post">
  <div>
    <label for="title">Titre</label>
    <br>
    <input id="title" type="text" name="title" value="<?= $post->title ?>">
    <br>
    <label for="content">Contenu</label>
    <br>
    <textarea id="contentPost" name="content" rows="8" cols="80"><?= $post->content ?></textarea>
    <br>
    <button type="submit">Valider</button>
    <br>
    <a href="index.php?route=update&id=<?= $post->id ?>&action=delete">Supprimer l'article</a>
  </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require 'template.php';
