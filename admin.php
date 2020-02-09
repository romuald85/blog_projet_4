<?php
session_start();

if(!isset($_SESSION['user']))
{
  header('Location: index.php?page=login');
}

if(isset($_GET['deconnect']))
{
  unset($_SESSION['user']);
  header('Location: index.php?page=login');
}

?>

<a href="index.php?page=admin&deconnect=true">Déconnexion</a>

<div>
  <a href="index.php?page=articles">Articles</a><br>
  <a href="index.php?page=commentsAndPosts">Commentaires</a>
</div>
