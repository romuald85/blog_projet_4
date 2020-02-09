<?php

if(!isset($_GET['id']) || empty($_GET['id']))
{
  header('Location: index.php');
}

$post = $dataBase->getPost($_GET['id']);

$comments = $dataBase->getCommentsApproved($_GET['id']);

if(!empty($_POST['author']) && !empty($_POST['comment']))
{
  $dataBase->postComment($_GET['id'], $_POST['author'], $_POST['comment']);
  header("Location: index.php?page=post&id=$post->id");
}

?>
<?php ob_start(); ?>
    <title>Blog</title>

    <h1><?= $post->title ?></h1>
    <a href="index.php?page=home">Revenir à la page d'accueil</a>
    <em><?= $post->creation_date ?></em>
    <p>
      <?= $post->content ?>
    </p>
    <h2>Ajouter un commentaire</h2>
    <form action="index.php?page=post&id=<?= $post->id ?>" method="post">
      <div>
          <label for="author">Auteur</label>
          <br>
          <input id="author" type="text" name="author">
      </div>
        <div>
            <label for="comment">Commentaire</label>
            <br>
            <textarea id="comment" name="comment" rows="6" cols="60">
            </textarea>
        </div>
          <div>
            <button type="submit">Valider</button>
          </div>
    </form>
    <?php if(!empty($comments)): ?>
      <div class="comments-list">
        <?php foreach($comments as $comment): ?>
          <h2><?= $comment->author ?> <em><?= $comment->comment_date ?></em></h2>
          <p>
            <?= $comment->comment ?>
          </p>
          <?php endforeach ?>
      </div>
      <?php endif ?>
<?php $content = ob_get_clean(); ?>

<?php require 'template.php'; ?>
