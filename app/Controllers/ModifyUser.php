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
        if (!Session::verifySession() || Session::getSessionData('idUser') != 1) {
            return redirect()->to(site_url('Connexion'));
        }

        $SiteReservationModel = new \App\Models\SiteReservationModel;
        if (!empty($this->request->getPost('idUtilisateur'))) {
            $SiteReservationModel = new \App\Models\SiteReservationModel;
            echo view('template/header', ['iduser' => Session::getSessionData('idUser')]);
            echo view("form/modifyuser", ['infoUser' => $SiteReservationModel->getInfoUser($this->request->getPost('idUtilisateur'))]);
            echo view('template/footer');
        } else if (!empty($this->request->getPost('idModifUser'))) {
            if ($this->updateUser()) {
                return redirect()->to(site_url('GestionUser'));
            }
        }
    }
    
    
    private function updateUser(): bool {
        $SiteReservationModel = new \App\Models\SiteReservationModel;
        $NewInfoUser = $this->verifyFields();
        $SiteReservationModel->updateInfoUser($this->request->getPost('idModifUser'), $NewInfoUser['nom'], $NewInfoUser['prenom'], $NewInfoUser['password']);
        return true;
    }
    
    

    private function verifyFields(): array {
        $SiteReservationModel = new \App\Models\SiteReservationModel;
        $InfoUser = $SiteReservationModel->getInfoUSer($this->request->getPost('idModifUser'))[0];
        $newInfoUser = [];

        //nom 
        if (!empty($this->request->getPost('nom')) && $InfoUser['nom'] != $this->request->getPost('nom')) {
            $newInfoUser['nom'] = $this->request->getPost('nom');
        } else {
            $newInfoUser['nom'] = $InfoUser['nom'];
        }

        //prenom
        if (!empty($this->request->getPost('prenom')) && $InfoUser['prenom'] != $this->request->getPost('prenom')) {
            $newInfoUser['prenom'] = $this->request->getPost('prenom');
        } else {
            $newInfoUser['prenom'] = $InfoUser['prenom'];
        }

        //motDePasse
        if (!empty($this->request->getPost('password')) && $InfoUser['mdp'] != $this->request->getPost('password')) {
            $newInfoUser['password'] = $this->request->getPost('password');
        } else {
            $newInfoUser['password'] = $InfoUser['mdp'];
        }

        return $newInfoUser;
    }

}
