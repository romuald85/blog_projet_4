<?php ob_start(); ?>
<a href="index.php?route=posts">Retour</a>

<div class="container">
  <form action="#" method="post">
    <div class="form-group">
      <label for="title">Titre</label>
      <br>
      <input id="title" type="text" name="title" class="form-control" required>
      <br>
    </div>
    <div class="form-group">
      <label for="content">Contenu</label>
      <br>
      <textarea id="contentPost" name="content" rows="8" cols="80" class="form-control" required></textarea>
      <br>
    </div>
    <div>
      <button type="submit" class="btn btn-primary">Valider</button>
    </div>
  </form>

</div>
<?php $content = ob_get_clean(); ?>

<?php require 'template.php';
