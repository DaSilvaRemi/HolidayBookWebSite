<?php

namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of SiteReservationModel
 *Classe permettant de récuper les données de la base de données
 * @author dasilvaremi
 */
class SiteReservationModel extends Model{
    private $dateDebut;
    private $dateFin;
    private $nbPersonne;
    private $typeLogement;
    private $pension;
    private $option;

    public function __construct(, \CodeIgniter\Database\ConnectionInterface &$db = null, \CodeIgniter\Validation\ValidationInterface $validation = null,
    ) {
        parent::__construct($db, $validation);
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
