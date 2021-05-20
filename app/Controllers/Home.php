<?php namespace App\Controllers;
use \App\Models\Session;

/**
 * Classe technique permettant d'afficher la page index
 *
 * @author Mathieu
 * @author Rémi
 */
class Home extends BaseController
{
        /**
        * Affiche la page d'acceuil avec l'utilisateur connecté ou non
        * 
        * @param void
        * @return string retourne la page d'acceuil
        */
	public function index()
	{    
            Session::startSession();
            $iduser = NULL;
            $idAdmin = NULL;
            if(Session::verifySession()){
                $iduser = Session::getSessionData('idUser');
                $idAdmin = Session::getSessionData('isAdmin');
            }
            echo view('template/header',['iduser' => $iduser, 'isAdmin' => $idAdmin]);
            echo view('welcome_message');
            echo view('template/footer');
                
	}

	//--------------------------------------------------------------------

}


