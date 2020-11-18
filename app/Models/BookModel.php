<?php

namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of BookModel
 *
 * @author dasilvaremi
 */
class BookModel extends Model{
    public function __construct(\CodeIgniter\Database\ConnectionInterface &$db = null, \CodeIgniter\Validation\ValidationInterface $validation = null) {
        parent::__construct($db, $validation);
    }
    
    public function getTypeLogement($typelogement = ""){
        if(empty($typelogement)){
            $requete = $this->db->query("SELECT typelogement FROM typelogement ORDER BY DESC");
            return $requete;
        }
        else{
            $requete = $this->db->query("SELECT typelogement FROM typelogement WHERE typelogement ='".$typelogement."' ORDER BY DESC");
            return $requete;
        }
    }

    public function getNbLitDouble(){
        $requete = $this->db->query("SELECT nblitdouble FROM typelogement WHERE typelogement = '".$typelogement."'");
    }

    public function getNbLitSimple(){

    }
}
