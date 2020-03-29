<?php ob_start(); ?>

<link rel="stylesheet" href="public/css/commentSignal.css">

<a href="index.php?route=admin" class="btn btn-danger">Retour</a>

<h1 class="text-center">Commentaires signalés</h1>
  <div class="container">
    <?php if(!empty($comments)):
      foreach($comments as $comment): ?>
        <p><b>Numéro du commentaire: </b><a href="index.php?route=post&id=<?= $comment->id_post; ?>#myComment-<?= $comment->id_comment; ?>"><?= $comment->id_comment; ?></a><span id="nb_report"><strong>Nombre de signalement:</strong> <?= $comment->nb_report ?></span></p>
        <p><strong>Titre de l'article: </strong><?= $comment->title; ?></p>
        <p><strong>Commentaire :</strong></p>
        <p><?= $comment->comment; ?></p>
        <p><b>Motif de signalement: </b><?= $comment->report; ?></p>
        <a href="index.php?route=rejectReport&id=<?= $comment->id_report; ?>">Annuler la r&eacute;clamation</a>
        <a href="index.php?route=approveReport&id=<?= $comment->id_comment; ?>">Confirmer la r&eacute;clamation</a>
        <hr>
      <?php endforeach;
    endif; ?>
  </div>


<?php $content = ob_get_clean(); ?>

<?php require 'template.php';
