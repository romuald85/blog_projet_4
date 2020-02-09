<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
  </head>
  <body>
    <?= $content ?>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
     tinymce.init({
       selector: '#contentPost'
     });
   </script>
  </body>
</html>
