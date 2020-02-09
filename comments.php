<?php

if(isset($_GET['approved']) && $_GET['approved'] === 'true' && isset($_GET['idComment']) && !empty($_GET['idComment']))
{
  $dataBase->approveComment($_GET['idComment']);
}

$comments = $dataBase->getPostComments($_GET['id']);

?>

<a href="index.php?page=commentsAndPosts">Retour</a>

<h1>Modérer les commentaires</h1>

<?php if(!empty($comments)): ?>
  <div>
    <?php foreach($comments as $comment): ?>
      <h2><?= $comment->author ?> <em><?= $comment->comment_date ?></em></h2>
      <p>
        <?= $comment->comment ?>
      </p>
      <?php if($comment->approved == 0): ?>
      <a href="index.php?page=comments&idComment=<?= $comment->id ?>&approved=true&id=<?= $_GET['id'] ?>">Approuver</a>
    <?php endif ?>
      <?php endforeach ?>
  </div>
  <?php endif ?>
