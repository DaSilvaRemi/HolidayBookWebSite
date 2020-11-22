<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

/**
 * Description of Session
 *
 * @author remi
 */
abstract class Session {
    
    private static $session;
    
    public static function initSession($idUser) {
        Session::$session = \Config\Services::session();
        Session::setSessionData("idUser", $idUser);
    }
    
    public static function destructSession() {
        Session::$session->destroy();
        Session::$session->stop();
    }
    
    public static function verifySession(){
        if(isset(Session::$session)){
            return false;
        }
        elseif(Session::hasSessionData("idUser")){
            Session::destructSession();
            return false;
        }
        else{
            return true;
        }
    }
    
    public static function hasSessionData($idChamp){
        return Session::$session->has($idChamp);
    }
    
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
    
    public static function removeSessionData($idChamp){
        if(!Session::hasSessionData($idChamp)){
            Session::$session-->remove($idChamp);
        }
        else{
            return false;
        }
    }
}