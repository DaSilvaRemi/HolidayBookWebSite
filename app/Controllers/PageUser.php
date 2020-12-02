<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;
use \CodeIgniter\Controller;
use \App\Models\Session;

/**
 * Description of PageUser
 *
 * @author remi
 */
class PageUser extends Controller{
    /* 
    fonction : Vérifie l'utilisateur est connecté, puis on charge la vue
    parametre : void
    retour : Si une erreur est détecté on retourne sur la vue et on affiche l'erreur. 
     * Sinon on retourne sur la page de connexion pour demander à l'utilisateur de se connecté
    */
    public function index() {
        Session::startSession();
        if(!Session::verifySession()){
            return redirect()->to(site_url('Connexion')); 
        }
        $SiteReservationModel = new \App\Models\SiteReservationModel;
        echo view('template/header');
        echo view("form/pageuser",['tabReservation' => $SiteReservationModel->getLesReservations()]);
        echo view('template/footer');

    }
}
