<?php

ob_start(); ?>

<link rel="stylesheet" href="Public/css/admin.css">

<div class="container">
    <a href="index.php?route=admin&deconnect=true" class="btn btn-danger btn-lg btn-block">Déconnexion</a>
    <a href="index.php?route=articles" class="btn btn-primary btn-lg btn-block">Articles</a><br>
    <a href="index.php?route=commentsAndPosts" class="btn btn-primary btn-lg btn-block">Commentaires</a>
    <a href="index.php?route=commentSignal" class="btn btn-primary btn-lg btn-block">Commentaires signalés</a>
</div>

<?php $content = ob_get_clean(); ?>

<?php require 'template.php';