<?php

class Frontend
{
  public function listPosts()
  {
    echo 'Afficher la liste des postes';
  }

  public function onePost($id)
  {
    echo 'Voici le poste numéro ' . $id;
  }
}
