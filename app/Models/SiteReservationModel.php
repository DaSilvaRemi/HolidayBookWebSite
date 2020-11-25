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
            return  $this->db->query("SELECT typelogement FROM public.typelogement;")->getResultArray();
        }
        else{
            return $this->db->query("SELECT typelogement FROM public.typelogement WHERE typelogement = :typelogement: LIMIT 1;",["typelogement" => $typelogement])->getResultArray();
        }
    }

    /*Retourne la requete pour le nombre de lit double*/
    public function getNbLitDouble($typelogement){
        return $this->db->query("SELECT nblitdouble FROM public.typelogement WHERE typelogement = :typelogement: ORDER BY typelogement DESC;",["typelogement" => $typelogement])->getResultArray();
    }

    /*Retourne la requete pour le nombre de lit simple*/
    public function getNbLitSimple($typelogement){
        return  $this->db->query("SELECT nblitsimple FROM public.typelogement WHERE typelogement = :typelogement: ORDER BY typelogement DESC;",["typelogement" => $typelogement])->getResultArray();
    }
    
    /*--------------------------------------Table réservation------------------------------------------------*/
    /*
    -fonction : Modifie le champs valide lorsque l'admin à accepté une réservation
    -parametre : idSejour => int => PRIMARY KEY => Correspond à l'id de la réservation
     * valide => boolean => setByDefault(true) => Champs de validation
    -retour : void     */
    public function updateisValide($idSejour, $valide = true) : void{
        $this->db->query("UPDATE public.reservation SET valide = :valide: WHERE id_sejour = :id_sejour:;",["valide" => $valide, "is_sejour" => $idSejour]);
    }
    
    /*
    -fonction : insère des données dans la table réservation     
    -parametre : *typelogement => String
     * id_user => int
     * dateDebut => Date en format YYYY-MM-DD
     * dateFin => Date en format YYYY-MM-DD 
     * nbPersonne => int
     * pension => String => Correspond au type de pension
     * menage => boolean => Correspond à option   
    -retour : void     */
    public function insertReservation($typelogement, $id_user,$dateDebut, $dateFin, $nbPersonne, $pension, $menage) : void{
        $this->db->query("INSERT INTO public.reservation (datedebut, datefin, nbpersonne, pension, menage, valide, id_user, num_logement, typelogement) "
                . "VALUES(:datedebut:, :datefin:, :nbpersonne:, :pension:, :menage: , :valide:, :id_user:, "
                . "(SELECT num_logement FROM logement WHERE typelogement = :typelogement:), :typelogement:);",
                ["datedebut" => $dateDebut, "datefin" => $dateFin, "nbpersonne" => $nbPersonne, "pension" => $pension, "menage" => $menage, "valide" => false,
                    "id_user" => $id_user, "typelogement" => $typelogement,]);
    }
    
    /*------------------------------------Table user---------------------------------------------------------*/
    public function getIdUser($login) {
        return $this->db->query("SELECT id_user FROM public.user WHERE login = :login: ",["login" => $login])->getResultArray();
    }
    
    public function getNameUser($login = null, $idUser = null){
        if(!empty($idUser)){
            return $this->db->query('SELECT nom FROM public.user WHERE id_user = :iduser:;',['iduser' => $idUser])->getResultArray();
        }
        elseif(!empty($login)) {
            return $this->db->query('SELECT nom FROM public.user WHERE id_user = :iduser:;',['iduser' => $this->getIdUser($login)[0]['id_user']])->getResultArray();
        }
        else{
            return false;
        }
    }

    public function countUserLogin($login){
        return $this->db->query("SELECT COUNT(login) FROM public.user WHERE login = :login:",['login' => $login])->getResultArray();
    }
    
    public function countIdUserValide($login, $mdp){
        return $this->db->query("SELECT COUNT(id_user) FROM public.user WHERE login = :login: AND mdp = :mdp:",['login' => $login, 'mdp' => $mdp])->getResultArray();
    }
    
    public function insertUser($nom, $prenom, $login, $mdp) {
        return $this->db->query('INSERT INTO public.user(nom, prenom, login, mdp) VALUES(:nom:, :prenom:, :login:, :mdp:);',['nom' => nom, 'prenom' => $prenom, 'login' => $login, 'mdp' => $mdp]);
    }
    
}
