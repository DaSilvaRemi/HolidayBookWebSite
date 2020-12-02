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

    /*Retourne le résultat pour le nombre de lit double*/
    public function getNbLitDouble($typelogement){
        return $this->db->query("SELECT nblitdouble FROM public.typelogement WHERE typelogement = :typelogement: ORDER BY typelogement DESC;",["typelogement" => $typelogement])->getResultArray();
    }

    /*Retourne le résultat pour le nombre de lit simple*/
    public function getNbLitSimple($typelogement){
        return  $this->db->query("SELECT nblitsimple FROM public.typelogement WHERE typelogement = :typelogement: ORDER BY typelogement DESC;",["typelogement" => $typelogement])->getResultArray();
    }
    
    /*--------------------------------------Table réservation------------------------------------------------*/
     /*Retourne l'id de la réservation*/
    public function getIdReservation(){
        return $this->db->query("SELECT id_reservation FROM public.reservation;")->getResultArray();
    }

     /*Retourne la date de début*/
    public function getDateDebut() {
        return $this->db->query("SELECT datedebut FROM public.reservation;")->getResultArray();
    }
    
    /*Retourne le nombre de personne*/
    public function getNbPersonne() {
        return $this->db->query("SELECT nbpersonne FROM public.reservation;")->getResultArray();
    }
    
    /*Retourne la validité de la réservation*/
    public function getValide() {
        return $this->db->query("SELECT valide FROM public.reservation;")->getResultArray();
    }
    
    /*Retourne l'id de l'utilisateur de la réservation*/
    public function getIdUser_Reservation() {
        return $this->db->query("SELECT id_user FROM public.reservation;")->getResultArray();
    }
    
    /*Retourne toutes les réservations de tous les utilisateurs*/
    public function getLesReservations(){
        return $this->db->query("SELECT id_reservation, datedebut, nbpersonne, (SELECT nom FROM user), pension, valide FROM public.reservation INNER JOIN public.user ON "
                . "public.reservation.id_user = public.user.id_user ORDER BY valide DESC;")->getResultArray();
    }
    
    /*
    -fonction : /*Retourne toutes les réservations d'un utilisateur
    -parametre : idUser => int => UNIQUE KEY => Correspond à l'id de l'user
    -retour : void     */
    public function getLesReservationsByUser($idUser){
        return $this->db->query("SELECT id_reservation, datedebut, nbpersonne, (SELECT nom FROM user), pension, valide FROM public.reservation INNER JOIN public.user ON "
                . "public.reservation.id_user = public.user.id_user WHERE id_user = :id_user ORDER BY valide DESC;",['id_user' => $idUser])->getResultArray();
    }
    
    /*
    -fonction : Modifie le champs valide lorsque l'admin à accepté une réservation
    -parametre : idReservation => int => PRIMARY KEY => Correspond à l'id de la réservation
     * valide => boolean => setByDefault(true) => Champs de validation
    -retour : void     */
    public function updateisValide($idReservation, $valide = "Valide") : void{
        $this->db->query("UPDATE public.reservation SET valide = :valide: WHERE id_reservation = :id_reservation:;",["valide" => $valide, "id_reservation" => $idReservation]);
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
                ["datedebut" => $dateDebut, "datefin" => $dateFin, "nbpersonne" => $nbPersonne, "pension" => $pension, "menage" => $menage, "valide" => "En attente de validation",
                    "id_user" => $id_user, "typelogement" => $typelogement,]);
    }
    
    /*------------------------------------Table user---------------------------------------------------------*/
    /*
    -fonction : Retourne l'id de l'utilisateur
    -parametre : login => String => UNIQUE KEY => Correspond à l'id de la réservation
    -retour : array => Retourne toutes les réservations de tous les utilisateurs   */
    public function getIdUser($login) {
        return $this->db->query("SELECT id_user FROM public.user WHERE login = :login: ",["login" => $login])->getResultArray();
    }
    
    /*
    -fonction : Retourne le nom de l'utilisateur
    -parametre : login => String => UNIQUE KEY => setByDefault(null) => Correspond à l'id de la réservation
     * idUser => int => UNIQUE KEY => setByDefault(null) => Correspond à l'id de l'user
    -retour : array => Retourne toutes les réservations de tous les utilisateurs   */
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
    
    /*
    -fonction : Retourne le nombre de mot de passe
    -parametre : idUser => int => UNIQUE KEY => Correspond à l'id de l'user
     * mdp => String
    -retour : array => Retourne le nombre de mot de passe   */
    public function countUserMdp($idUser, $mdp){
        return $this->db->query('SELECT COUNT(mdp) FROM public.user WHERE id_user = :iduser: AND mdp = :mdp:;',['iduser' => $idUser, 'mdp' => $mdp])->getResultArray();
    }

    /*
    -fonction : Retourne le nombre d'user
    -parametre : login => String => UNIQUE KEY => Correspond au login de l'user
    -retour : array => Retourne le nombre d'user  */
    public function countUserLogin($login){
        return $this->db->query("SELECT COUNT(login) FROM public.user WHERE login = :login:",['login' => $login])->getResultArray();
    }
    
    /*
    -fonction : COmpte s'il y a bien qu'un user qui existe avec ce mot de passe et ce login
    -parametre : login => String => UNIQUE KEY => Correspond au login de l'user
     * mdp => String
    -retour : array => Compte le nombre d'user avec le login et le mot de passe  */
    public function countIdUserValide($login, $mdp){
        return $this->db->query("SELECT COUNT(id_user) FROM public.user WHERE login = :login: AND mdp = :mdp:",['login' => $login, 'mdp' => $mdp])->getResultArray();
    }
    
    /*
    -fonction : Insere un user
    -parametre : nom => String
     * prenom => String
     * login => String => UNIQUE KEY
     * mdp => String
    -retour : void  */
    public function insertUser($nom, $prenom, $login, $mdp) {
        $this->db->query('INSERT INTO public.user(nom, prenom, login, mdp) VALUES(:nom:, :prenom:, :login:, :mdp:);',['nom' => $nom, 'prenom' => $prenom, 'login' => $login, 'mdp' => $mdp]);
    }
    
    /*
    -fonction : Modifie le mot de passe
    -parametre : login => String => UNIQUE KEY => Correspond au login de l'utilisateur
     *  mdp => String 
    -retour : void  */
    public function updateUserMdp($idUser, $mdp){
        $this->db->query('UPDATE public.user SET mdp = :mdp: WHERE id_user = :id_user:',['mdp' => $mdp, 'id_user' => $idUser]);
    }
    
}
