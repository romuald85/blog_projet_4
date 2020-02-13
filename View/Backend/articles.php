<?php

ob_start(); ?>
<a href="index.php?route=admin">Retour</a><br>
<a href="index.php?route=create">Écrire un nouvel article</a>

<h1>Mes articles</h1>

<?php if(!empty($posts)): ?>
<div>
  <?php foreach ($posts as $post): ?>
  <h2><?= $post->title ?></h2><em><?= $post->creation_date ?></em>
  <p><?= $post->content ?></p>
  <a href="index.php?route=update&id=<?= $post->id ?>">Modifier l'article</a>
</div>
<?php endforeach; ?>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>

<?php require 'template.php';
