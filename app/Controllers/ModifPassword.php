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
            echo view('form/login', [
                'validation' => $this->validator
            ]);
        }
        else
        {
            $this->verifyLoginPassword();
        }
    }
    
    public function verifyLoginPassword(){
        $SiteReservationModel = new \App\Models\SiteReservationModel;
        if(intval($SiteReservationModel->countIdUserValide($this->request->getPost('user'), $this->request->getPost('password'))[0]['count']) != 1){
            if($SiteReservationModel->countUserLogin($this->request->getPost('user'))[0]['count'] != 1 ){
                $this->validator->setError("user", "Votre nom d'utilisateur n'éxiste pas !");
            }else{
                $this->validator->setError("password", "Le mot de passe est incorrect !");
            }
            echo view('form/login', [
                'validation' => $this->validator
            ]);
        }
        else{
            Session::initSession($SiteReservationModel->getIdUser($this->request->getPost('user'))[0]['id_user']);
            Session::setSessionData('nom', $SiteReservationModel->getNameUser($this->request->getPost('user'))[0]['nom']);
            echo view("form/pageadmin");
        }
    }
}
