<?php namespace App\Controllers;

use CodeIgniter\Controller;
use \App\Models\ControlSiteReservationModel;
use \App\Models\Session;

class BookForm extends Controller
{
    /* 
    fonction : Vérifie si l'utilisateur est connecté, si les champs manquant du formulaire sont bien rempli
    parametre : void
    retour : Si une erreur est détecté on retourne sur la vue et on affiche l'erreur. Sinon on appelle control
    */
    public function index()
    {
        helper('form');
        
        Session::startSession();
        if(!Session::verifySession()){
            return redirect()->to(site_url('Connexion/deconnexion')); 
        }
        
        if (!$this->validate(['datedebut' => 'required','datefin' => 'required',
            'pension' => 'required','typelogement' => 'required' ],
        ['datedebut' => ['required' => 'Merci d\'indiquer une date de début de séjour.'],
        'datefin' => ['required' => 'Merci d\'indiquer une date de fin de séjour.'],
        'pension'    => ['required' => 'Merci d\'indiquer votre pension.'], 
        'typelogement' => ['required' => 'Veuillez selectionnez un type de séjour']]))
        {
            echo($this->request->getPost('pension'));
            $SiteReservationModel = new \App\Models\SiteReservationModel();
            echo view('template/header',['iduser' => Session::getSessionData('idUser')]);
            echo view('form/book', ['validation' => $this->validator, 'data' => $SiteReservationModel->getTypeLogement()]);
            echo view('template/footer');
        }
        else
        {
            if($this->control()){
                return redirect()->to(site_url('PageUser'));
            }
        }
    }

    /* 
    fonction : Vérifie les éventuel erreurs lors de la création de l'objet(Durée de date incorrecte ou/et nombre de personne incorrecte)
    parametre : void
    retour : appelle les vues selon le résultat du test soit :
        -la vue success quand tout se passe bien
        -la vue book lorqu'il y'a une erreur et affiche celle ci.
    */
    private function control(){
        $leControlSiteReservation = new ControlSiteReservationModel($this->request->getPost('datedebut'), $this->request->getPost('datefin'), $this->request->getPost('nbpersonne'), 
        $this->request->getPost('typelogement'), 
        $this->request->getPost('pension'), 
        $this->request->getPost('menage'));

        if($leControlSiteReservation->Erreur()){
            $tabException = $leControlSiteReservation->getException();
            foreach($tabException as $Exception){
                foreach($Exception as $errorField => $errorValue){
                    $this->validator->setError($errorField, $errorValue);
                }
            }
            $SiteReservationModel = new \App\Models\SiteReservationModel();
            echo view('template/header',['iduser' => Session::getSessionData('idUser')]);
            echo view('form/book',['validation' => $this->validator, 'data' => $SiteReservationModel->getTypeLogement()] );
            echo view('template/footer');
            return false;
        }
        else {
            Session::startSession();
            $leControlSiteReservation->insertData(Session::getSessionData('idUser'));
            return true;
        } 
    }
}