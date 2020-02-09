<?php

if(!empty($_POST['title']) && !empty($_POST['content']))
{
  $dataBase->updatePosts($_GET['id'], $_POST['title'], $_POST['content']);
  header('Location: index.php?page=articles');
}


if(isset($_GET['action']) && $_GET['action'] === 'delete')
{
  $dataBase->deletePost($_GET['id']);
  header('Location: index.php?page=articles');
}


$post = $dataBase->getPost($_GET['id']);

?>

<a href="index.php?page=articles">Retour</a>

<h1>Mon article à modifier: </h1>

<form action="#" method="post">
  <div>
    <label for="title">Titre</label>
    <br>
    <input id="title" type="text" name="title" value="<?= $post->title ?>">
    <br>
    <label for="content">Contenu</label>
    <br>
    <textarea id="contentPost" name="content" rows="8" cols="80"><?= $post->content ?></textarea>
    <br>
    <button type="submit">Valider</button>
    <br>
    <a href="index.php?page=update&id=<?= $post->id ?>&action=delete">Supprimer l'article</a>
  </div>
</form>
