<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;
use \CodeIgniter\Controller;

/**
 * Description of CreateUser
 *
 * @author remi
 */
class CreateUser extends Controller{
    public function index(){
        helper('form');
        helper('html');
        
        echo link_tag('css/nav.css');
        echo link_tag('css/stylepp.css');
        echo link_tag('css/form.css');
        echo view('template/header');
        
        if (!$this->validate(['nom' => 'required|min_length[3]|max_length[60]', 'prenom' => 'required|min_length[3]|max_length[60]', 'user' => 'required|min_length[4]|max_length[20]',
            'password' => 'required|min_length[4]|max_length[30]'],
        ['nom' => ['required' => 'Merci d\'indiquer un nom.', 'min_length' => 'Merci d\'indiquer un nom d\'au moins 3 caractère', 
            'max_length' => 'La longueur du nom ne peut pas dépasser 60 caractère'], 
         'prenom' => ['required' => 'Merci d\'indiquer un prenom.', 'min_length' => 'Merci d\'indiquer un prenom d\'au moins 3 caractère', 
            'max_length' => 'La longueur du prenom ne peut pas dépasser 60 caractère'],
         'user' => ['required' => 'Merci d\'indiquer un login.', 'min_length' => 'Merci d\'indiquer un login d\'au moins 4 caractère', 
            'max_length' => 'La longueur du login ne peut pas dépasser 20 caractère'],
         'password' => ['required' => 'Merci d\'indiquer votre mot de passe','min_length' => 'Merci d\'indiquer un mot de passe d\'au moins 4 caractère', 
            'max_length' => 'La longueur du mot de passe ne peut pas dépasser 30 caractère']]))
        {
            echo view('form/createuser', [
                'validation' => $this->validator
            ]);
        }
        else
        {
            $this->verifyLoginExist();
        }
    }
    
    public function verifyLoginExist() {
        $SiteReservationModel = new \App\Models\SiteReservationModel();
        if(intval($SiteReservationModel->countUserLogin($this->request->getPost('user'))[0]['count']) != 0){
            $this->validator->setError("user", "Ce nom d'utilisateur existe déja");
            echo view('form/login', [
                'validation' => $this->validator, 'connexion' => 'votre compte existe déja'
            ]);
            
        }
        else{
            $SiteReservationModel->insertUser($this->request->getPost('nom'), $this->request->getPost('prenom'), $this->request->getPost('user'), $this->request->getPost('password'));
            echo view('form/login', [
                'validation' => $this->validator, 'connexion' => 'Vous avez créer votre compte'
            ]);
            
        }
    }
}