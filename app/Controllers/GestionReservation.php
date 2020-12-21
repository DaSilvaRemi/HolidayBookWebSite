<?php
namespace App\Controllers;
use \CodeIgniter\Controller;
use \App\Models\Session;

/**
 * Classe technique permettant de visualiser les reservations en admin
 *
 * @author Mathieu
 * @author Rémi
 */
class GestionReservation extends Controller{
    /**
     * Vérifie si l'utilisateur est connecté et que les champs du formulaire sont bien rempli
     * 
     * @param void
     * @return void Si une erreur est détecté on retourne sur la vue et on affiche l'erreur. Sinon on appelle control
     */
    public function index() {
        helper('form');
        Session::startSession();
        if(!Session::verifySession() || Session::getSessionData('idUser') != 1){
            return redirect()->to(site_url('Connexion/deconnexion')); 
        }
        
        $SiteReservationModel = new \App\Models\SiteReservationModel;
        //Valide la réservation
        if(!empty($this->request->getPost('idReservationValide'))){
            $SiteReservationModel->updateisValide($this->request->getPost('idReservationValide'), "Validée");
        }
        //Refuse la réservation 
        else if(!empty($this->request->getPost('idReservationRefus'))){
            $SiteReservationModel->updateisValide($this->request->getPost('idReservationRefus'), "Refusée");
        }
        //Supprime la réservation
        elseif(!empty($this->request->getPost('idReservationSuppr'))){
            $SiteReservationModel->deleteReservation($id_reservation);
        }
        echo view('template/header', ['iduser' => Session::getSessionData('idUser')]);
        echo view("form/gestionreservation",['tabReservation' => $SiteReservationModel->getLesReservations()]);
        echo view('template/footer');
    }
}
