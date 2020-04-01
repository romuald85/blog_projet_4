<?php ob_start(); ?>
<a href="index.php?route=posts" class="btn btn-danger">Retour</a>

<div class="container">
  <form action="index.php" method="post">
    <input type="hidden" name="route" value="createPost">
    <div class="form-group">
      <label for="title">Titre<span class="asterix">*</span></label>
      <br>
      <input id="title" type="text" name="title" class="form-control" required>
      <br>
    </div>
    <div class="form-group">
      <label for="content">Contenu<span class="asterix">*</span></label>
      <br>
      <textarea id="contentPost" name="content" rows="8" cols="80" class="form-control"></textarea>
      <br>
    </div>
    <div>
      <button type="submit" class="btn btn-primary">Valider</button>
      <p class="asterix">* Champs obligatoires à remplir</p>
    </div>
  </form>

</div>
<?php $content = ob_get_clean(); ?>

<?php require 'template.php';
