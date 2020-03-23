<?php ob_start(); ?>

<a href="index.php?route=admin" class="btn btn-danger">Retour</a>

<h1 class="text-center">Commentaires signalés</h1>
  <div class="container">
    <?php if(!empty($comments)): ?>
    <?php foreach($comments as $comment): ?>
    <b>Numéro du commentaire: </b><p><?= $comment->comment_id ?></p>
    <b>Motif de signalement: </b><p><?= $comment->report ?></p>
    <a href="index.php?route=commentSignal&id=<?= $comment->id ?>&action=delete">Supprimer</a>
    <hr>
    <?php endforeach; ?>
    <?php endif; ?>
  </div>


<?php $content = ob_get_clean(); ?>

<?php require 'template.php';
