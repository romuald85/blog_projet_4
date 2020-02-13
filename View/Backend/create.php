<?php

ob_start(); ?>
<a href="index.php?route=articles">Retour</a>

<form action="#" method="post">
  <div>
    <label for="title">Titre</label>
    <br>
    <input id="title" type="text" name="title">
    <br>
    <label for="content">Contenu</label>
    <br>
    <textarea id="contentPost" name="content" rows="8" cols="80"></textarea>
    <br>
    <button type="submit">Valider</button>
  </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require 'template.php';
