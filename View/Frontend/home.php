<?php ob_start(); ?>

  <link rel="stylesheet" href="Public/css/home.css">

  <header class="header-image">
    <img src="img/paysage_alaska.jpg" alt="paysage_alaska" class="img-responsive image-paysage">
  </header>
  <div id="profile" class="container">
    <div class="row">
      <div class="col-sm-3 profile">
        <aside>
          <img class="rounded-circle img-responsive" id="image-alaska" src="img/alaska.jpg" alt="alaska-image">
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
          <?php if(!empty($posts)): ?>
            <?php foreach($posts as $post): ?>
              <header>
                <h3 class="titre-article"><?= $post->title ?></h3>
              </header>
              <footer><small>Posté le: <?= $post->creation_date ?></small></footer>
              <br>
              <p>
                <?= $this->ellipsis($post->content) ?><a href="index.php?route=post&id=<?= $post->id ?>"><br>Voir la suite</a>
              </p>
              <?php endforeach ?>
                <?php endif ?>
        </article>
      </div>
    </div>
  </div>
  <?php $content = ob_get_clean(); ?>

    <script>
      window.twttr = (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
          t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);
        t._e = [];
        t.ready = function(f) {
          t._e.push(f);
        };
        return t;
      }(document, "script", "twitter-wjs"));
    </script>

    <?php require 'template.php';
