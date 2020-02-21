<?php ob_start(); ?>

<a href="index.php?route=admin">Retour</a>

<h1 class="text-center">Commentaires signalés</h1>
  <div class="container">
    <?php if(!empty($comments)): ?>
    <?php foreach($comments as $comment): ?>
    <b>Email: </b><p><?= $comment->email ?></p>
    <b>Titre de l'article: </b><p><?= $comment->title ?></p>
    <b>Numero du commentaire: </b><p><?= $comment->numero ?></p>
    <b>Message: </b><p><?= $comment->message ?></p>
    <p><?= $comment->id ?></p>
    <a href="index.php?route=commentDelete&id=<?= $comment->id ?>">Sélectionner le commentaire</a>
    <hr>
    <?php endforeach; ?>
    <?php endif; ?>
  </div>


<?php $content = ob_get_clean(); ?>

<?php require 'template.php';
