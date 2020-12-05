<?php namespace App\Controllers;
use \App\Models\Session;

class Home extends BaseController
{
        /**
        * Vérifie si le compte existe ou pas sinon onc crée le compte
        * 
        * @param void
        * @return string retourne la page d'acceuil
        */
	public function index()
	{    
            Session::startSession();
            $iduser = NULL;
            if(Session::verifySession()){
                $iduser = Session::getSessionData('idUser');
            }
            echo view('template/header',['iduser' => $iduser]);
            echo view('welcome_message');
            echo view('template/footer');
                
	}

	//--------------------------------------------------------------------

}


