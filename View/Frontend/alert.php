<?php ob_start(); ?>

<link rel="stylesheet" href="public/css/alert.css">

<a href="index.php?route=post&id=<?= $_GET['id'] ?>">Retour</a>

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <form action="#" method="post">
        <h2 class="text-center">Signaler un commentaire</h2>
        <div class="form-group">
          <label for="email">Email</label>
          <br>
          <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="titre">Titre de l'article</label>
          <br>
          <input type="text" name="titre" class="form-control">
        </div>
        <div class="form-group">
          <label for="numero">Numéro du commentaire</label>
          <br>
          <input type="text" name="numero" class="form-control">
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <br>
          <textarea name="message" rows="8" cols="80" class="form-control"></textarea>
        </div>
        <div>
          <button type="submit" class="btn btn-primary">Valider</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require 'template.php';
