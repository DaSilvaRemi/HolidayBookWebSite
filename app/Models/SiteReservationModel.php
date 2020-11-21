<?php

namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of SiteReservationModel
 *Classe permettant de récuper les données de la base de données
 * @author dasilvaremi
 */
class SiteReservationModel extends Model{

    public function __construct(\CodeIgniter\Database\ConnectionInterface &$db = null, \CodeIgniter\Validation\ValidationInterface $validation = null) {
        parent::__construct($db, $validation);
        $this->db->connect('default');
    }

    /*--------------------------------------Table typelogement------------------------------------------------*/

    /*
    fonction : retourne la colonne typelogement de la table typelogement
    parametre : typelogement => String => setByDefault(null)     
    retour : retourne un tableau contenant les résultat de la requête     */
    public function getTypeLogement($typelogement = ""){
        if(empty($typelogement)){
            return  $this->db->query("SELECT typelogement FROM typelogement ORDER BY typelogement DESC;")->getResultArray();
        }
        else{
            return $this->db->query("SELECT typelogement FROM typelogement WHERE typelogement = :typelogement: ORDER BY typelogement DESC;",["typelogement" => $typelogement])->getResultArray();
        }
    }

    /*Retourne la requete pour le nombre de lit double*/
    public function getNbLitDouble($typelogement){
        $typelogement = $this->getTypeLogement($typelogement);
        return $this->db->query("SELECT nblitdouble FROM typelogement WHERE typelogement = :typelogement: ORDER BY typelogement DESC;",["typelogement" => $typelogement[0]['typelogement']])->getResultArray();
    }

    /*Retourne la requete pour le nombre de lit simple*/
    public function getNbLitSimple($typelogement){
        $typelogement = $this->getTypeLogement($typelogement);
        return  $this->db->query("SELECT nblitsimple FROM typelogement WHERE typelogement = :typelogement: ORDER BY typelogement DESC;",["typelogement" => $typelogement[0]['typelogement']])->getResultArray();
    }
    
}
