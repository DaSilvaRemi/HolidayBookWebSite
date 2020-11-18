<?php

namespace App\Models;
use CodeIgniter\Model;
use \App\Models\ControlSiteReservation;

/**
 * Description of SiteReservationModel
 *Classe permettant de récuper les données de la base de données
 * @author dasilvaremi
 */
class SiteReservationModel extends Model{

    public function __construct(\CodeIgniter\Database\ConnectionInterface &$db = null, \CodeIgniter\Validation\ValidationInterface $validation = null) {
        parent::__construct($db, $validation);
    }

    /*--------------------------------------Table typelogement------------------------------------------------*/

    /*Retourne la requete pour le type logement*/
    public function getQueryTypeLogement($typelogement){
        if(empty($typelogement)){
            $requete = $this->db->query("SELECT typelogement FROM typelogement ORDER BY DESC");
            return $requete;
        }
        else{
            $requete = $this->db->query("SELECT typelogement FROM typelogement WHERE typelogement ='".$typelogement."' ORDER BY DESC");
            return $requete;
        }
    }

    /*Retourne la requete pour le nombre de lit double*/
    public function getQueryNbLitDouble($typelogement){
        $typelogement = $this->getTypeLogement();
        $requete = $this->db->query("SELECT nblitdouble FROM typelogement WHERE typelogement = '".$typelogement."'");
    }

    /*Retourne la requete pour le nombre de lit simple*/
    public function getQueryNbLitSimple($typelogement){
        $typelogement = $this->getTypeLogement();
        $requete = $this->db->query("SELECT nblitdouble FROM typelogement WHERE typelogement = '".$typelogement."'");
    }

    /*--------------------------------------Table logement------------------------------------------------*/
    public function getNumLogement($numlogement){
        $requete = $this->db->query("SELECT numlogement FROM logement WHERE num_logement = '".$numlogement."'");
    }
}
