<?php

namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of BookModel
 *
 * @author dasilvaremi
 */
class BookModel extends Model{
    private $dateDebut;
    private $dateFin;
    private $nbPersonne;
    private $typeLogement;
    private $pension;
    private $option;

    public function __construct($datedebut, $datefin, $nbPersonne, $typeLogement, $pension, $option, \CodeIgniter\Database\ConnectionInterface &$db = null, \CodeIgniter\Validation\ValidationInterface $validation = null,
    ) {
        if(!$this->Erreur()){
            parent::__construct($db, $validation);
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

    public function addException(array $tab) {
        $this->exception[] = $tab;
    }
    
    public function dateJour(string $date) {
        return explode("/", $date);
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
    
    public function getQueryTypeLogement(){
        if(empty($this->typelogement)){
            $requete = $this->db->query("SELECT typelogement FROM typelogement ORDER BY DESC");
            return $requete;
        }
        else{
            $requete = $this->db->query("SELECT typelogement FROM typelogement WHERE typelogement ='".$typelogement."' ORDER BY DESC");
            return $requete;
        }
    }

    public function getQueryNbLitDouble($typelogement){
        $typelogement = $this->getTypeLogement();
        $requete = $this->db->query("SELECT nblitdouble FROM typelogement WHERE typelogement = '".$typelogement."'");
    }

    public function getQueryNbLitSimple($typelogement){
        $typelogement = $this->getTypeLogement();
        $requete = $this->db->query("SELECT nblitdouble FROM typelogement WHERE typelogement = '".$typelogement."'");
    }

    /*
    fonction : Controle si le nombre de personne est inférieur à la capacité des chambres
    parametre : Aucun
    retour : retourne si la capacité est correcte
    */
    public function controlCapacite(){
        $model = \App\Models\BookModel();;
        if($model->getNbLitDouble() != 0 || $model->getNbLitSimple() != 0){
            if($this->getNbPersonne() <= $model->getNbLitDouble()*2){
                return true;
            }
            elseif($this->getNbPersonne() <= $model->getNbLitSimple()){
                return true;
            }
            else{
                return false;
            }
        }
        else{
                return false;
        }
    }

    /*
    fonction : Controle la durée du séjour s'il est égale à 7 jours
    parametre : -date du début de séjour
                -date de fin de séjour
    retour : un booléan selon si la durée du séjour est bonne
    */
    public function controlDuree(string $date1,string $date2) : bool{
        if($this->dateJour($date1)[2] - $this->dateJour($date2)[2] == 7){
            return true;
        }
        else{
            return false;
        }
    }
}
