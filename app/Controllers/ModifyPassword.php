<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Models\Session;

/**
 * Description of ModifyUser
 *
 * @author remi
 */
class ModifyPassword extends Controller{
     /* 
    fonction : Vérifie si l'utilisateur est connecté et si les champs manquant du formulaire sont bien rempli
    parametre : void
    retour : Si une erreur est détecté on retourne sur la vue et on affiche l'erreur ou on renvoie sur la page Connexion. Sinon on appelle verifPassword
    */
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
            if($this->verifPassword()){
                return redirect()->to(site_url('Connexion/deconnexion')); 
            }
        }
    }
    
    /* 
    fonction : Vérifie si les mot de passe sont équivalent et que l'utilisateur ne rentre pas son mot passe actuel
    parametre : void
    retour : Si une erreur est détecté on retourne sur la vue et on affiche l'erreur. 
     * Sinon on retourne sur la page de connexion pour demander à l'utilisateur de se connecté
    */
    private function verifPassword(){
        if($this->request->getPost('password') != $this->request->getPost('confirmPassword')){
            $this->validator->setError("password","vos mot de passe ne correspondent pas");
            echo view('template/header');
            echo view('form/modifypassword', ['validation' => $this->validator]);
            echo view('template/footer');
            
            return false;
        }
        else{
            Session::startSession();
            $SiteReservationModel = new \App\Models\SiteReservationModel;
            if(intval($SiteReservationModel->countUserMdp(Session::getSessionData('idUser'), $this->request->getPost('password'))[0]['count']) != 0){
                $this->validator->setError("password", "Le mot de passe que vous avez entré est déja lié à vôtre compte !");
                echo view('template/header');
                echo view('form/modifypassword', ['validation' => $this->validator]);
                echo view('template/footer');
                return false;
            }
            else{
                $SiteReservationModel->updateUserMdp(Session::getSessionData('idUser'), $this->request->getPost('password'));
                return true;
            }
        }
    }
}
