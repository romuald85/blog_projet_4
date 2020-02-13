<?php

ob_start(); ?>
<a href="index.php?route=admin">Retour</a>

<?php if(!empty($posts)): ?>
  <div>
    <?php foreach($posts as $post): ?>
    <h2><?= $post->title ?></h2>
    <br>
    <em><?= $post->creation_date ?></em>
    <br>
    <p><?= $post->content ?></p>
    <a href="index.php?route=comments&id=<?= $post->id ?>">Modérer les commentaires</a>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>

<?php require 'template.php';
