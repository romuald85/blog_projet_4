<?php

$posts = $dataBase->getAll('posts');

?>

<a href="index.php?page=admin">Retour</a><br>
<a href="index.php?page=create">Écrire un nouvel article</a>

<h1>Mes articles</h1>

<?php if(!empty($posts)): ?>
<div>
  <?php foreach ($posts as $post): ?>
  <h2><?= $post->title ?></h2><em><?= $post->creation_date ?></em>
  <p><?= $post->content ?></p>
  <a href="index.php?page=update&id=<?= $post->id ?>">Modifier l'article</a>
</div>
<?php endforeach; ?>
<?php endif; ?>
