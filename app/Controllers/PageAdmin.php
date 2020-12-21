<?php
namespace App\Controllers;
use \CodeIgniter\Controller;
use \App\Models\Session;

/**
 * Classe technique permettant de visualiser en admin
 *
 * @author Mathieu
 * @author Rémi
 * @author Martin
 */
class PageAdmin extends Controller{
    /**
     * Page d'acceuil pour l'administration permet seulement de naviguer
     *
     * @param void
     * @return string|object  
     * - string retourne la vue
     * - object redirige sur la Connexion et on demande à l'utilisateur de se connecter s'il ne l'est pas déja
     */
    public function index() {
        helper('form');
        Session::startSession();
        if(!Session::verifySession() || Session::getSessionData('idUser') != 1){
            return redirect()->to(site_url('PageUser')); 
        }
        
        $SiteReservationModel = new \App\Models\SiteReservationModel;
        echo view('template/header', ['iduser' => Session::getSessionData('idUser')]);
        echo view("form/pageadmin",['tabReservation' => $SiteReservationModel->getLesReservations()]);
        echo view('template/footer');
    }
}
