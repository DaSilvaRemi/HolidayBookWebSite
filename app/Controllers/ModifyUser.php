<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use \App\Models\Session;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ModifyUser extends Controller {

    public function index() {
        helper('form');
        Session::startSession();
        if(!Session::verifySession() || Session::getSessionData('idUser') != 1){
            return redirect()->to(site_url('Connexion')); 
        }
        
        $SiteReservationModel = new \App\Models\SiteReservationModel;
        echo view('template/header', ['iduser' => Session::getSessionData('idUser')]);
        echo view("form/modifyuser", ['infoUtilisateur' => $SiteReservationModel->getInfoUser(Session::getSessionData('idUser'))]);
        echo view('template/footer');
    }
}
    