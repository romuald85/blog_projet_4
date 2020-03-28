<?php
const PRIMARY_MESSAGE = 'primary';
const SUCCESS_MESSAGE = 'success';
const DANGER_MESSAGE = 'danger';
const SECONDARY_MESSAGE = 'secondary';

// liste des types de message que l'on accepte 
const TYPE_MESSAGE = array(PRIMARY_MESSAGE, SUCCESS_MESSAGE, DANGER_MESSAGE, SECONDARY_MESSAGE);

/**
 * ajoute à la session un message dont le type est accepté (cf. @param). 
 * @param string $message le message à afficher
 * @param int $typeMessage OPTIONNEL liste prédéfinie dans la constante TYPE_MESSAGE, par defaut primary
 */
function setMessageFlash($message, $typeMessage = PRIMARY_MESSAGE){
    // sort de la fonction si le type de message qu'on essaye d'ajouter dans la session ne fait pas partit de la liste des types de messages accéptés
    if(!in_array($typeMessage, TYPE_MESSAGE, true)){
        return false;
    }
    // met en session le message et son type 
    $_SESSION['messagesFlash'][] = array('message' => $message, 'type' => $typeMessage);
}

/**
 * affiche les messages flash mis en forme et les supprimes de la session
 */
function showMessagesFlash(){
    if(isset($_SESSION['messagesFlash'])){
        while(0 < count($_SESSION['messagesFlash'])){
            $message = array_shift($_SESSION['messagesFlash']);
            printf('<div class="messFlash alert alert-%s" role="alert">%s</div>', $message['type'], $message['message']);
        }
    }
}

/**
 * indique si un utilisateur est connecté ou non
 * @return bool
 */
function isUserConnected(){
    return isset($_SESSION['user']) && !empty($_SESSION['user']) ? true : false;
}

/**
 * redirige l'utilisateur vers la page login s'il n'est pas connecté
 */
function redirectUnconnectedUsers(){
    if(!isUserConnected())
    {
      // Renvoi vers la page login si l' utilisateur n'existe pas
      header('Location: index.php?route=login');
    }
}
