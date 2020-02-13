<?php

ob_start(); ?>
   <h1>Mon blog</h1>
   <div id="posts">
     <?php if(!empty($posts)): ?>
         <div class="posts-list">
       <?php foreach($posts as $post): ?>
         <h2><?= $post->title ?>
           <br>
           <em><?= $post->creation_date ?></em> </h2>
         <p><?= $this->ellipsis($post->content) ?><a href="index.php?route=post&id=<?= $post->id ?>">Voir la suite</a></p>
       <?php endforeach ?>
       </div>
     <?php endif ?>
   </div>
   <?php $content = ob_get_clean(); ?>

   <?php require 'template.php';
