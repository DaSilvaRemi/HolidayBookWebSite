<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

/**
 * Description of ModifyUser
 *
 * @author remi
 */
class ModifyUser extends Controller{
    public function index() {
        helper('form');
        helper('html');
        
        Session::startSession();
        if(!Session::verifySession()){
            return redirect()->to(site_url('Connexion')); 
        }
        
        echo link_tag('css/nav.css');
        echo link_tag('css/stylepp.css');
        echo link_tag('css/form.css');
        
        if (!$this->validate(['password' => 'required|min_length[4]|max_length[20]','confirmPassword' => 'required|min_length[4]|max_length[30]'],
        ['password' => ['required' => 'Merci d\'indiquer votre mot de passe.', 'min_length' => 'Merci d\'indiquer un mot de passe d\'au moins 4 caractère', 
            'max_length' => 'La longueur du mot de passe ne peut pas dépasser 20 caractère'],
            'confirmPassword' => ['required' => 'Merci de confirmer votre mot de passe','min_length' => 'La confirmation du mot de passe doit avoir au moins 4 caractère', 
            'max_length' => 'La longueur du mot de passe ne peut pas dépasser 30 caractère']]))
        {
            echo view('template/header');
            echo view('form/modifypassword', ['validation' => $this->validator]);
            echo view('template/footer');
        }
        else
        {
            $this->verifPassword();
        }
    }
    
    private function verifPassword(){
        if($this->request->getPost('password') != $this->request->getPost('confirmPassword')){
            $this->validator->setError("password","vos mot de passe ne correspondent pas");
            echo view('template/header');
            echo view('form/modifypassword', ['validation' => $this->validator]);
            echo view('template/footer');
        }
        else{
            Session::startSession();
            $SiteReservationModel = new \App\Models\SiteReservationModel;
            if(int($SiteReservationModel->countUserMdp(Session::getSessionData('idUser'), $this->request->getPost('password')))[0]['count'] != 0){
                $this->validator->setError("password", "Le mot de passe que vous avez entré est déja lié à vôtre compte !");
                echo view('template/header');
                echo view('form/modifypassword', ['validation' => $this->validator]);
                echo view('template/footer');
            }
            else{
                return redirect()->to(site_url('Connexion/deconnexion')); 
            }
        }
    }
}
