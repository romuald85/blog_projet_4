<?php

if(!empty($_POST['title']) && !empty($_POST['content']))
{
  $dataBase->createPost($_POST['title'], $_POST['content']);
  header('Location: index.php?page=articles');
}

?>

<a href="index.php?page=articles">Retour</a>

<form action="#" method="post">
  <div>
    <label for="title">Titre</label>
    <br>
    <input id="title" type="text" name="title">
    <br>
    <label for="content">Contenu</label>
    <br>
    <textarea id="contentPost" name="content" rows="8" cols="80"></textarea>
    <br>
    <button type="submit">Valider</button>
  </div>
</form>
