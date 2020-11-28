<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;
use \CodeIgniter\Controller;

/**
 * Description of PageUser
 *
 * @author remi
 */
class PageUser extends Controller{
    public function index() {
        Session::startSession();
        if(!Session::verifySession()){
            return redirect()->to(site_url('Connexion')); 
        }
        $SiteReservationModel = new \App\Models\SiteReservationModel;
        echo view("form/pageuser",['tabReservation' => $SiteReservationModel->getLesReservations()]);
    }
}
