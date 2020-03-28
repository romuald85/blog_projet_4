<?php ob_start(); ?>

<link rel="stylesheet" href="public/css/login.css">

  <div class="container">
    <form action="#" method="post">
      <h2 class="text-center">Se connecter</h2>
      <div class="form-group">
        <label for="login">Identifiant</label>
        <input id="login" type="text" name="login" placeholder="Entrer le login" class="form-control">
        <br>
      </div>
      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" placeholder="Entrer le password" class="form-control">
        <br>
      </div>
      <div>
        <button type="submit" class="btn btn-primary btn-block">Valider</button>
      </div>
    </form>
  </div>
  <?php $content = ob_get_clean(); ?>

  <?php require 'template.php'; ?>
