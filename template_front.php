<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="public/css/template.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <title>Mon blog</title>
  </head>
  <body>
    <link rel="stylesheet" href="Public/css/home.css">

    <header class="header-image">
      <img src="img/paysage_alaska.jpg" alt="paysage_alaska" class="img-responsive image-paysage">
    </header>
    <?php showMessagesFlash(); ?>
    <?= $content ?>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
     tinymce.init({
       selector: '#contentPost'
     });
   </script>
  </body>
</html>
