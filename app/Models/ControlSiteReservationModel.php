<?php
namespace App\Models;
use CodeIgniter\Model;
use Date;

class ControlSiteReservationModel extends Model{

    private $dateDebut;
    private $dateFin;
    private $nbPersonne;
    private $typeLogement;
    private $pension;
    private $option;

    public function __construct($datedebut, $datefin, $nbPersonne, $typeLogement, $pension, $option){
        $this->dateDebut = new Date($datedebut);
        $this->dateFin = new Date($datefin);
        $this->nbPersonne = $nbPersonne;
        $this->typeLogement = $typeLogement;
        $this->pension = $pension;
        $this->option = $option;
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
    public function getException(){
        return $this->exception;
    }

    /*
    fonction : Génère et ajoute des erreur à au tableau d'exception
    parametre : Void
    retour : erreur => bool 
    */
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
    retour : void
    */
    public function addException(array $tab) : void {
        $this->exception[] = $tab;
    }

    /*
    fonction : Controle si le nombre de personne est inférieur à la capacité des chambres
    parametre : Aucun
    retour : retourne si la capacité est correcte
    */

    public function controlCapacite() : bool{
        $siteReservationModel = new SiteReservationModel();
        if($siteReservationModel->getNbLitDouble($this->getTypeLogement())[0]['nblitdouble'] != 0 || 
            $siteReservationModel->getNbLitSimple($this->getTypeLogement())[0]['nblitsimple'] != 0){
            if($this->getNbPersonne() <= intval($siteReservationModel->getNbLitDouble($this->getTypeLogement())[0]['nblitdouble'])*2){
                unset($siteReservationModel);
                return true;
            }
            elseif($this->getNbPersonne() <= intval($siteReservationModel->getNbLitSimple($this->getTypeLogement())[0]['nblitsimple'])){
                unset($siteReservationModel);
                return true;
            }
            else{
                unset($siteReservationModel);
                return false;
            }
        }
        else{
                unset($siteReservationModel);
                return false;
        }
        }
    

    /*
    fonction : Controle la durée du séjour s'il est égale à 7 jours
    parametre : Void
    retour : un booléan selon si la durée du séjour est bonne
    */
    public function controlDuree() : bool{
        if($this->getDateFin()->getDay() - $this->getDateDebut()->getDay()  == 7){
            return true;
        }
        else{
            return false;
        }
    } 

    /*
    -fonction : Créer une réservation et détruit le modèle
    -parametre : id_user => int => id de l'utilisateur connecté     
    -retour : void     
     */
    public function insertData($id_user) : void{
        $siteReservationModel = new SiteReservationModel();
        $siteReservationModel->insertReservation($this->getTypeLogement(), $id_user, $this->getDateDebut()->getDate(), $this->getDateFin()->getDate(), $this->getNbPersonne(), $this->getPension(), $this->getOption());
        unset($siteReservationModel);
    }
}