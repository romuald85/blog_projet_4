<?php ob_start(); ?>

  <link rel="stylesheet" href="public/css/post.css">

  <header class="header-image">
    <img src="img/paysage_alaska.jpg" alt="paysage_alaska" class="img-responsive image-paysage">
  </header>

  <div id="profile" class="container">
    <div class="row">
      <div class="col-sm-3 profile">
        <aside class="aside">
          <img class="rounded-circle" id="image-alaska" src="img/alaska.jpg" alt="alaska-image">
          <h4>Billet pour l'Alaska</h4>
          <p>jean-forteroche@gmail.com</p>
          <a class="twitter-follow-button" href="https://twitter.com/JeanForteroche" data-show-count="true" data-size="large">
              Follow @JeanForteroche
            </a>
          <hr>
          <p>Partager cette page:</p>
          <ul class="clear-fix">
            <li><img src="img/social_icons/email.png" alt=""></li>
            <li><img src="img/social_icons/facebook.png" alt=""></li>
            <li><img src="img/social_icons/googleplus.png" alt=""></li>
            <li><img src="img/social_icons/linkedin.png" alt=""></li>
            <li><img src="img/social_icons/pinterest.png" alt=""></li>
            <li><img src="img/social_icons/twitter.png" alt=""></li>
          </ul>
        </aside>
      </div>
      <div id="col" class="col-sm-8">
        <article>
          <header class="titre-article">
            <h2><?= $post->title ?></h2>
          </header>
          <footer><small>Posté le: <?= $post->creation_date ?></small></footer>
          <a href="index.php?route=home">Revenir à la page d'accueil</a>
          <p>
            <?= $post->content ?>
          </p>
        </article>
        <h2 class="comment">Commentaires</h2><span><a href="index.php?route=alert&id=<?= $post->id ?>">Alerter</a></span>
        <?php if(!empty($comments)):?>
            <div class="col-md-8">
              <?php foreach($comments as $comment): ?>
                <p>
                  <?= $comment->comment ?>
                </p>
                <footer><small><b><?= $comment->author ?> </b>Posté le: <?= $comment->comment_date ?>
                  <br>
                  <p>#<?= $comment->id ?></p></small></footer>
                <hr>
                <?php endforeach ?>
                  <?php endif ?>
            </div>
          <div class="row">
            <div class="col-md-12 formulaire">
              <form action="index.php?route=showComment&id=<?= $post->id ?>" method="post">
                <div class="form-group">
                  <h3 class="write-comment">Écrivez votre commentaire</h3>
                  <label for="author">Auteur</label>
                  <br>
                  <input id="author" type="text" name="author" class="form-control">
                </div>
                <div class="form-group">
                  <label for="comment">Commentaire</label>
                  <br>
                  <textarea id="comment" name="comment" rows="6" cols="60" class="form-control">
                  </textarea>
                </div>
                <div>
                  <button type="submit" class="btn btn-primary bouton">Valider</button>
                </div>
                <?php if($addComment): ?>
                  <div id="addComment" class="alert alert-primary" role="alert">
                    Votre commentaire a bien été pris en compte, il est en attente d'approbation.
                  </div>
                  <?php endif; ?>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>

  <?php $content = ob_get_clean(); ?>

    <script type="text/javascript" src="public/js/post.js"></script>

    <?php require 'template.php'; ?>
