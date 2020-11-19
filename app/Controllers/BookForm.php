<?php namespace App\Controllers;

use CodeIgniter\Controller;
use \App\Models\ControlSiteReservationModel;
use \Config\Services;

class BookForm extends Controller
{
    public function index()
    {
        helper('form');
        
        /*$this->validate([]);
        echo view('form/book', [
                'validation' => $this->validator
            ]);*/
        
        if (!$this->validate(['datedebut' => 'required','datefin' => 'required','pension' => 'required','typelogement' => 'required' ],
        ['datedebut' => ['required' => 'Merci d\'indiquer une date de début de séjour.'],'datefin' => ['required' => 'Merci d\'indiquer une date de fin de séjour.'],
        'pension'    => ['required' => 'Merci d\'indiquer votre pension.'], 'typelogement' => ['required' => 'Veuillez selectionnez un type de séjour']]))
        {
            echo view('form/book', [
                'validation' => $this->validator
            ]);
        }
        else
        {
            $this->control();
        }
    }
    
    public static function showData(){
        $model = new \App\Models\SiteReservationModel();
        return $model->getQueryTypeLogement();
    }
    
    /* 
    fonction : Vérifie les éventuel erreurs lors de la création de l'objet(Durée de date incorrecte ou/et nombre de personne incorrecte)
    parametre : void
    retour : appelle les vues selon le résultat du test soit :
        -la vue success quand tout se passe bien
        -la vue book lorqu'il y'a une erreur et affiche celle ci.
    */
    public function control(){
        $leControlSiteReservation = new ControlSiteReservationModel($this->$request->getPost('datedebut'), $this->$request->getPost('datefin'), $this->$request->getPost('nbpersonne'), 
        $this->$request->getPost('typelogement'), $this->$request->getPost('pension'), $this->$request->getPost('menage'));

        if(!$leControlSiteReservation->Erreur()){
            $tabException = $leControlSiteReservation->getException();
            foreach($tabException as $Exception){
                foreach($Exception as $errorField => $errorValue){
                    $this->validator->setError($errorField, $errorValue);
                }
            }
            echo view('form/book',['validation' => $this->validator]);  
        }
        else {
            echo view('form/sucess'); 
        }      
    }
}

