<?php
namespace App\Models;
use CodeIgniter\Model;

class ControlSiteReservationModel extends Model{
    public function __construct($datedebut, $datefin, $nbPersonne, $typeLogement, $pension, $option){
        if(!$this->Erreur()){
            $this->dateDebut = $datedebut;
            $this->$datefin = $datefin;
            $this->$nbPersonne = $nbPersonne;
            $this->$typeLogement = $typeLogement;
            $this->$pension = $pension;
            $this->$option = $option;
        }
        else{
            $Exception = $this->getErreur();
            unset($this);
            return $Exception;
        }
    
        //retour : date de début du séjour
        public function getDateDebut(){
            return $this->dateDebut;
        }
    
        //retour : date de fin du séjour
        public function getDateFin(){
            return $this->dateFin;
        }
    
        //retour : nombre de personne ayant réservé le séjour
        public function getNbPersonne(){
            return $this->nbPersonne;
        }
    
        //retour : le type de logement du séjour
        public function getTypeLogement(){
            return $this->typeLogement;
        }
    
        //retour : retourne le type de pension
        public function getPension(){
            return $this->pension;
        }
    
        //retour : retourne les options sélectionné
        public function getOption(){
            return $this->option;
        }
    
        //retour : retourne les erreurs
        public function getErreur(){
            return $this->exception;
        }

        public function Erreur() : bool{
            $erreur = false;
            if(!$this->controlDuree($this->getDateDebut(), $this->getDateFin())){
                $this->addException(array("datedebut" => "La durée du séjour est incorrecte!")); 
                $erreur = true;
            }
            if(!$this->controlCapacite()){
                $this->addException(array("nbpersonne" => "Le nombre de personnes n'est pas correcte par rapport à la capacité!"));   
                $erreur = true; 
            }
            return $erreur;
        }
    
        /*
        fonction : ajoute une exception
        parametre : tableau d'erreur
        retour : null
        */
        public function addException(array $tab) {
            $this->exception[] = $tab;
        }
        
        /*
        fonction : retourne le jour de la date */
        public function dateToDay(string $date) {
            if(strpos($date, "-")){
                $day = explode("-", $date);
            }
            elseif($date, "/"){
                $day = explode("/", $date);
            }
            else{

            }
            return 
        }
    }
}