<?php ob_start(); ?>

<link rel="stylesheet" href="Public/css/admin.css">

<div class="container">
    <a href="index.php?route=logout" class="btn btn-danger btn-lg btn-block">Déconnexion</a>
    <a href="index.php?route=commentsAndPosts" class="btn btn-primary btn-lg btn-block">Commentaires</a>
    <a href="index.php?route=commentSignal" class="btn btn-primary btn-lg btn-block">Commentaires signalés</a>
    <a href="index.php?route=posts" class="btn btn-primary btn-lg btn-block">Articles</a><br>
</div>

<?php $content = ob_get_clean(); ?>

<?php require 'template.php';
