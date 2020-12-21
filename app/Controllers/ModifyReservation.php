<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

/**
 * Description of ModifyReservation
 *
 * @author remi
 */
class ModifyReservation extends Controller{
    /**
     * Vérifie si l'utilisateur est connecté et que les champs du formulaire sont bien rempli
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
