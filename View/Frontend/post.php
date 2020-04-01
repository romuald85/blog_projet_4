<?php ob_start(); ?>
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
        <h3>Commentaires</h3>
        <!--<h2 class="comment">Commentaires</h2><span><a href="index.php?route=alert&id=<?= $post->id ?>">Alerter</a></span>-->
        <?php if(!empty($comments)):?>
            <div class="col-md-8">
              <?php foreach($comments as $comment): ?>
                <div id="myComment-<?= $comment->id; ?>">
                  <p><?= nl2br($comment->comment) ?></p>
                  <p><small><b><?= $comment->author ?></b> Posté le: <?= $comment->comment_date ?></small></p>
                  <p><a href="#" data-toggle="modal" data-target="#myModal-<?= $comment->id; ?>">Signaler</a></p>
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12" >
                        <div class="modal fade myModal" id="myModal-<?= $comment->id; ?>">
                          <div class="modal-dialog modal-md">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h2>Signaler le commentaire</h2>
                              </div>
                              <div class="modal-body">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="route" value="alert" />
                                    <input type="hidden" name="id" value="<?= $comment->id; ?>" />
                                  <div>
                                    <p>Raison<span class="asterix">*</span></p>
                                    <input type="radio" id="contenu-indesirable-<?= $comment->id; ?>" name="reportComment" value="commercial" />
                                    <label for="contenu-indesirable-<?= $comment->id; ?>">Contenu commercial indésirable ou spam</label>
                                  </div>
                                  <div>
                                    <input type="radio" id="heurter-<?= $comment->id; ?>" name="reportComment" value="heurter" />
                                    <label for="heurter-<?= $comment->id; ?>">Contenu pouvant heurter</label>
                                  </div>
                                  <div>
                                    <input type="radio" id="maltraitance-<?= $comment->id; ?>" name="reportComment" value="enfants" />
                                    <label for="maltraitance-<?= $comment->id; ?>">Maltraitance d'enfants</label>
                                  </div>
                                  <div class="modal-footer">
                                    <button class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                    <button class="btn btn-primary" type="submit">Confirmer</button>
                                    <p class="asterix">* Choix obligatoire</p>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <hr />
                <?php endforeach ?>
            </div>
            <?php endif ?>
          <div class="row">
            <div class="col-md-12 formulaire">
              <form action="index.php" method="post">
                <input type="hidden" name="id" value="<?= $post->id ?>" />
                <input type="hidden" name="route" value="addComment" />
                <div class="form-group">
                  <h3 class="write-comment">Écrivez votre commentaire</h3>
                  <label for="author">Auteur<span class="asterix">*</span></label>
                  <input id="author" type="text" name="author" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="comment">Commentaire<span class="asterix">*</span></label>
                  <textarea id="comment" name="comment" rows="6" cols="60" class="form-control" required></textarea>
                </div>
                <div>
                  <button type="submit" class="btn btn-primary bouton">Valider</button>
                  <p class="asterix">* Champs obligatoires à remplir</p>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>

  <?php $content = ob_get_clean(); ?>


    <?php require 'template_front.php'; ?>
