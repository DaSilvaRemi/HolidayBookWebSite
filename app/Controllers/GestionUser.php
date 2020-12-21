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
class GestionUser extends Controller{
    /* 
    fonction : Vérifie l'utilisateur est connecté et qu'il a les permissions, puis on charge la vue
    parametre : void
    retour : Si une erreur est détecté on retourne sur la vue et on affiche l'erreur. 
     * Sinon on retourne sur la page de connexion pour demander à l'utilisateur de se connecté
    */
    public function index() {
        helper('form');
        Session::startSession();
        if(!Session::verifySession() || Session::getSessionData('idUser') != 1){
            return redirect()->to(site_url('PageUser')); 
        }
        
        
        $SiteReservationModel = new \App\Models\SiteReservationModel;
        if(!empty($this->request->getPost('idUtilisateur'))){
            $SiteReservationModel->deleteAllReservationByUser($this->request->getPost('idUtilisateur'));
            $SiteReservationModel->deleteUser($this->request->getPost('idUtilisateur'));
        }
        
        echo view('template/header', ['iduser' => Session::getSessionData('idUser')]);
        echo view("form/gestionuser",['tabUtilisateurs' => $SiteReservationModel->getLesUtilisateurs()]);
        echo view('template/footer');
    }
}
