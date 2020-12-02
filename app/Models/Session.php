<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

/**
 * Description of Session
 *
 * @author remi
 */
abstract class Session {
    
    private static $session;
    
    /* 
    fonction : démarre une session
    parametre : void
    retour : void
    */
    public static function startSession(){
        Session::$session = \Config\Services::session();
    }
    
    /* 
    fonction : Initialise une session avec des paramètre par défault
    parametre : idUser : int
    retour : void
    */
    public static function initSession($idUser) {
        Session::startSession();
        Session::setSessionData("idUser", $idUser);
    }
    
     /* 
    fonction : Détruit la session
    parametre : void
    retour : void
    */
    public static function destructSession() {
        Session::$session->destroy();
    }
    
     /* 
    fonction : Vérifie si la session est correcte
    parametre : void
    retour : bool => Correspond à l'état de vérification
    */
    public static function verifySession() : bool{
        if(!isset(Session::$session)){
            return false;
        }
        elseif(Session::getSessionData('idUser') === NULL){
            Session::destructSession();
            return false;
        }
        else{
            return true;
        }
    }
    
    /* 
    fonction : Récupère une donnée de Session
    parametre : idChamps => String =>setByDefault(null) => correspond à l'index du champ de la session
    retour : multiple => renvoie la valeur du champs de la session
    */
    public static function getSessionData($idChamp = ''){
        return Session::$session->get($idChamp);
    }
    
    /* 
    fonction : Ajoute une donnée de Session
    parametre : idChamps => String => correspond à l'index du champ de la session
     *value => multiple => setByDefault(null) => correspond à la valeur du champ 
    retour : bool
    */
    public static function setSessionData($idChamp, $value = ""){
        if(is_array($idChamp)){
            Session::$session->set($idChamp);
        }
        elseif(!empty ($value)){
            Session::$session->set($idChamp, $value);
        }
        else{
            return false;
        }

    }
    
    /* 
    fonction : Supprime un champs
    parametre : idChamps => String => correspond à l'index du champ de la session
    retour : bool
    */
    public static function removeSessionData($idChamp){
        if(!Session::hasSessionData($idChamp)){
            Session::$session-->remove($idChamp);
        }
        else{
            return false;
        }
    }
}
