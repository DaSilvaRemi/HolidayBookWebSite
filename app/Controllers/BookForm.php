<?php namespace App\Controllers;

use CodeIgniter\Controller;
use \App\Models\ControlSiteReservationModel;

class BookForm extends Controller
{
    public function index()
    {
        helper('form');
        helper('html');
        
        Session::startSession();
        if(!Session::verifySession()){
            return redirect()->to(site_url('Connexion')); 
        }
        
        echo link_tag('css/nav.css');
        echo link_tag('css/stylepp.css');
        echo link_tag('css/form.css');
        
        if (!$this->validate(['datedebut' => 'required','datefin' => 'required','pension' => 'required','typelogement' => 'required' ],
        ['datedebut' => ['required' => 'Merci d\'indiquer une date de début de séjour.'],'datefin' => ['required' => 'Merci d\'indiquer une date de fin de séjour.'],
        'pension'    => ['required' => 'Merci d\'indiquer votre pension.'], 'typelogement' => ['required' => 'Veuillez selectionnez un type de séjour']]))
        {
            $SiteReservationModel = new \App\Models\SiteReservationModel();
            echo view('template/header');
            echo view('form/book', [
                'validation' => $this->validator, 'data' => $SiteReservationModel->getTypeLogement()
            ]);
        }
        else
        {
            $this->control();
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
        $this->request->getPost('typelogement'), $this->request->getPost('pension'), $this->request->getPost('menage'));

        if($leControlSiteReservation->Erreur()){
            $tabException = $leControlSiteReservation->getException();
            foreach($tabException as $Exception){
                foreach($Exception as $errorField => $errorValue){
                    $this->validator->setError($errorField, $errorValue);
                }
            }
            $SiteReservationModel = new \App\Models\SiteReservationModel();
            echo view('template/header');
            echo view('form/book',['validation' => $this->validator, 'data' => $SiteReservationModel->getTypeLogement()] );  
        }
        else {
            Session::startSession();
            $leControlSiteReservation->insertData(Session::getSessionData('idUser')); //Mettre à la place du un l'id de l'utilisateur(on peut le stocker dans une session)
            echo view('template/header');
            echo view('form/sucess'); 
        } 
    }
}