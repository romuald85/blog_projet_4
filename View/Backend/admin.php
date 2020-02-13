<?php

ob_start(); ?>
<a href="index.php?route=admin&deconnect=true">Déconnexion</a>

<div>
  <a href="index.php?route=articles">Articles</a><br>
  <a href="index.php?route=commentsAndPosts">Commentaires</a>
</div>

<?php $content = ob_get_clean(); ?>

<?php require 'template.php';
