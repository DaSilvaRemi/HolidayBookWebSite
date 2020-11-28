<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;
use \CodeIgniter\Controller;

/**
 * Description of PageAdmin
 *
 * @author remi
 */
class PageAdmin extends Controller{
    public function index() {
        Session::startSession();
        if(!Session::verifySession() && Session::getSessionData('idUser') != 1){
            return redirect()->to(site_url('Connexion/deconnexion')); 
        }
        $SiteReservationModel = new \App\Models\SiteReservationModel;
        echo view("form/pageadmin",['tabReservation' => $SiteReservationModel->getLesReservations()]);
    }
}
