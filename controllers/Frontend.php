<?php

class Frontend
{
  public function listPosts()
  {
    // TODO Récupérer les postes avec le postManager
    // TODO Appeler la vue qui permettra d'afficher la liste des posts
    echo 'Afficher la liste des postes';
  }

  public function onePost($id)
  {
    echo 'Voici le poste numéro ' . $id;
  }

  public function apropos()
  {
    echo 'A propos de nous';
  }
}
