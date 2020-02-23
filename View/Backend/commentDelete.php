<?php ob_start(); ?>

<a href="index.php?route=commentSignal" class="btn btn-danger">Retour</a>

<h1 class="text-center">Supprimer le commentaire</h1>

<?php if(!empty($comment)): ?>
  <div class="container">
    <p><?= $comment->email ?></p>
    <p><?= $comment->title ?></p>
    <p><?= $comment->numero ?></p>
    <p><?= $comment->message ?></p>
    <a href="index.php?route=commentDelete&id=<?= $comment->id ?>&action=delete">Supprimer</a>
  </div>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>

<?php require 'template.php'; ?>
