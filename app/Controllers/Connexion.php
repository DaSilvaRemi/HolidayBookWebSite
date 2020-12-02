<?php
namespace App\Controllers;
use \CodeIgniter\Controller;

class Connexion extends Controller{
    /* 
    fonction : Vérifie si les champs manquant du formulaire sont bien rempli
    parametre : void
    retour : Si une erreur est détecté on retourne sur la vue et on affiche l'erreur. Sinon on appelle verifyLoginPassword
    */
    public function index() {
        helper('form');
        helper('html');
        
        echo link_tag('css/nav.css');
        echo link_tag('css/stylepp.css');
        echo link_tag('css/form.css');
        
        if (!$this->validate(['user' => 'required|min_length[4]|max_length[20]',
            'password' => 'required|min_length[4]|max_length[30]'],
        ['user' => ['required' => 'Merci d\'indiquer un login.', 'min_length' => 'Merci d\'indiquer un login d\'au moins 4 caractère', 
            'max_length' => 'La longueur du login ne peut pas dépasser 20 caractère'],
            'password' => ['required' => 'Merci d\'indiquer votre mot de passe','min_length' => 'Merci d\'indiquer un mot de passe d\'au moins 4 caractère', 
            'max_length' => 'La longueur du mot de passe ne peut pas dépasser 30 caractère']]))
        {
            echo view('template/header');
            echo view('form/login', ['validation' => $this->validator]);
            echo view('template/footer');
        }
        else
        {
            $this->verifyLoginPassword();
        }
    }
    
    /* 
    fonction : Vérifie si le login et le mot de passe correspondent 
    parametre : void
    retour : Si une erreur est détecté on retourne sur la vue et on affiche l'erreur. 
     * Sinon on appelle les controleur soit de la pageadmin ou de la pageuser selon l'id de la session
    */
    private function verifyLoginPassword(){
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
            if(Session::getSessionData('idUser') == 1){
                return redirect()->to(site_url('PageAdmin')); 
            }
            else {
                return redirect()->to(site_url('PageUser')); 
            }
        }
    }
    
    /* 
    fonction : Déconnecte l'utilisateur et renvoie sur la page index
    parametre : void
    retour : void
    */
    public function deconnexion() {
        Session::startSession();
        if(Session::verifySession()){
            Session::destructSession();
        }
        $this->index();
    }
   
}
