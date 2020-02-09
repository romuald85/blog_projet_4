<?php
session_start();

if(!empty($_POST['login']) && !empty($_POST['password']))
{
  if($dataBase->userExists($_POST['login'], $_POST['password']) === false)
  {
    echo 'Les identifiants sont invalides !';
  }
  else
  {
    $_SESSION['user'] = $_POST['login'];
    header('Location: index.php?page=admin');
  }
}
?>

<?php ob_start(); ?>
    <h1>Administration</h1>

    <form action="" method="post">
      <input type="text" name="login" placeholder="Entrer le login">
      <input type="password" name="password" placeholder="Entrer le password">
      <button type="submit">Valider</button>
    </form>

    <?php $content = ob_get_clean(); ?>

    <?php require 'template.php'; ?>
