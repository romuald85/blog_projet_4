<a href="index.php?route=commentSignal">Retour</a>

<?php if(!empty($comment)): ?>
<p><?= $comment->email ?></p>
<p><?= $comment->title ?></p>
<p><?= $comment->numero ?></p>
<p><?= $comment->message ?></p>
<a href="index.php?route=commentDelete&id=<?= $comment->id ?>&action=delete">Supprimer</a>
<?php endif; ?>
