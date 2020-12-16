<?php

namespace App\Models;
use CodeIgniter\Model;

/**
 * Classe héritière de Model permettant de récuper les données de la base de données
 * 
 * @author dasilvaremi
 */
class SiteReservationModel extends Model{

    /**
     * Constructeur par défault
     * 
     * @param pointer $db Valeur par défault = null; Permet de choisir sur qu'elle interface de la BDD on se connecte
     * @param object $validation Valeur par défault = null;
     * @return void
     */
    public function __construct(\CodeIgniter\Database\ConnectionInterface &$db = null, \CodeIgniter\Validation\ValidationInterface $validation = null) {
        parent::__construct($db, $validation);
        $this->db->connect('default');
    }

    /*--------------------------------------Table typelogement------------------------------------------------*/

    /**
     * retourne la colonne typelogement de la table typelogement
     * 
     * @param string $typelogement
     * @return array<int,array<string,string|int>> contient les résultat de la requête
     */
    public function getTypeLogement($typelogement = ""){
        if(empty($typelogement)){
            return  $this->db->query("SELECT typelogement FROM public.typelogement;")->getResultArray();
        }
        else{
            return $this->db->query("SELECT typelogement FROM public.typelogement WHERE typelogement = :typelogement: LIMIT 1;",["typelogement" => $typelogement])->getResultArray();
        }
    }

    /**
     * retourne la colonne typelogement de la table typelogement
     * 
     * @param string $typelogement
     * @return array<int,array<string,string|int>> contient les résultat de la requête
     */
    public function getNbLitDouble($typelogement){
        return $this->db->query("SELECT nblitdouble FROM public.typelogement WHERE typelogement = :typelogement: ORDER BY typelogement DESC;",["typelogement" => $typelogement])->getResultArray();
    }

    /**
     * retourne le nombre de lits simples
     * 
     * @param string $typelogement
     * @return array<int,array<string,string|int>> contient les résultat de la requête
     */
    public function getNbLitSimple($typelogement){
        return  $this->db->query("SELECT nblitsimple FROM public.typelogement WHERE typelogement = :typelogement: ORDER BY typelogement DESC;",["typelogement" => $typelogement])->getResultArray();
    }
    
    /*--------------------------------------Table réservation------------------------------------------------*/
     /**
     * retourne l'id de la réservation
     * 
     * @param void
     * @return array<int,array<string,string|int>> contient les résultat de la requête
     */
    public function getIdReservation(){
        return $this->db->query("SELECT id_reservation FROM public.reservation;")->getResultArray();
    }

    /**
     * retourne la date de début
     * 
     * @param void
     * @return array<int,array<string,string|int>> contient les résultat de la requête
     */
    public function getDateDebut() {
        return $this->db->query("SELECT datedebut FROM public.reservation;")->getResultArray();
    }
    
    /**
     * retourne le nombre de personne pour une réservation
     * 
     * @param void
     * @return array<int,array<string,string|int>> contient les résultat de la requête
     */
    public function getNbPersonne() {
        return $this->db->query("SELECT nbpersonne FROM public.reservation;")->getResultArray();
    }
    
    /**
     * retourne la validité d'une réservation
     * 
     * @param void
     * @return array<int,array<string,string|int>> contient les résultat de la requête
     */
    public function getValide() {
        return $this->db->query("SELECT valide FROM public.reservation;")->getResultArray();
    }
    
    /**
     * retourne l'id de l'utilisateur
     * 
     * @param void
     * @return array<int,array<string,string|int>> contient les résultat de la requête
     */
    public function getIdUser_Reservation() {
        return $this->db->query("SELECT id_user FROM public.reservation;")->getResultArray();
    }
    
    /**
     * retourne toutes les reservations de tous les utilisateurs
     * 
     * @param void
     * @return array<int,array<string,string|int>> contient les résultat de la requête
     */
    public function getLesReservations(){
        return $this->db->query("SELECT id_reservation, datedebut, nbpersonne, (SELECT nom FROM user), pension, valide FROM public.reservation INNER JOIN public.user ON "
                . "public.reservation.id_user = public.user.id_user ORDER BY valide;")->getResultArray();
    }
    
    /**
     * Retourne toutes les réservations d'un utilisateur
     * 
     * @param int $idUser
     * @return array<int,array<string,string|int>> contient les résultat de la requête
     */
    public function getLesReservationsByUser($idUser){
        return $this->db->query("SELECT id_reservation, datedebut, nbpersonne, (SELECT nom FROM user), pension, valide FROM public.reservation INNER JOIN public.user ON "
                . "public.reservation.id_user = public.user.id_user WHERE public.reservation.id_user = :id_user: ORDER BY valide;",['id_user' => $idUser])->getResultArray();
    }
    
    /**
     * Modifie le champs valide lorsque l'admin à accepté une réservation
     * 
     * @param int $idReservation
     * @param string $valide
     * @return void
     */
    public function updateisValide($idReservation, $valide = "Valide") : void{
        $this->db->query("UPDATE public.reservation SET valide = :valide: WHERE id_reservation = :id_reservation:;",["valide" => $valide, "id_reservation" => $idReservation]);
    }
    
    /**
     * insère des données dans la table réservation  
     * 
     * @param string $typelogement
     * @param int $id_user
     * @param string dateDebut Date en format YYYY-MM-DD 
     * @param string dateFin Date en format YYYY-MM-DD 
     * @param int nbPersonne
     * @param string $pension Correspond au type de pension
     * @param string $menage Correspond à option n
     * @return void
     */
    public function insertReservation($typelogement, $id_user,$dateDebut, $dateFin, $nbPersonne, $pension, $menage) : void{
        $this->db->query("INSERT INTO public.reservation (datedebut, datefin, nbpersonne, pension, menage, valide, id_user, num_logement, typelogement) "
                . "VALUES(:datedebut:, :datefin:, :nbpersonne:, :pension:, :menage: , :valide:, :id_user:, "
                . "(SELECT num_logement FROM logement WHERE typelogement = :typelogement:), :typelogement:);",
                ["datedebut" => $dateDebut, "datefin" => $dateFin, "nbpersonne" => $nbPersonne, "pension" => $pension, "menage" => $menage, "valide" => "En attente de validation",
                    "id_user" => $id_user, "typelogement" => $typelogement,]);
    }
    
    /*------------------------------------Table user---------------------------------------------------------*/
   
     /**
     * Retourne l'id de l'utilisateur
     * 
     * @param string $login UNIQUE KEY : Correspond au login
     * @return array<int,array<string,string|int>> contient les résultat de la requêtee
     */
    public function getIdUser($login) {
        return $this->db->query("SELECT id_user FROM public.user WHERE login = :login: ",["login" => $login])->getResultArray();
    }
    
    /** Retourne tout les utilisateurs sauf admin
     * 
     */
    public function getLesUtilisateurs(){
        return $this->db->query("SELECT id_user, nom, prenom, login FROM public.user WHERE id_user != 1;")->getResultArray();
    }
    
    
    /**
     * Retourne le nom de l'utilisateur
     * 
     * Au moins un des deux paramètre doit être non null
     * 
     * @param string $login UNIQUE KEY; Correspond au login
     * @param int $idUser UNIQUE KEY; Correspond à l'id de l'utilisateur
     * @return array<int,array<string,int>>|bool
     * -array<int,array<string,int>> contient les résultat de la requête
     * -false si les deux paramètres sont vides
     */
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
    
     /**
     * Retourne le nombre de mot de passe
     * 
     * @param int $idUser UNIQUE KEY; Correspond à l'id de l'utilisateur
     * @param string $mdp Correspond au mot de passe
     * @return array<int,array<string,string|int>> contient les résultat de la requête
     */
    public function countUserMdp($idUser, $mdp){
        return $this->db->query('SELECT COUNT(mdp) FROM public.user WHERE id_user = :iduser: AND mdp = :mdp:;',['iduser' => $idUser, 'mdp' => $mdp])->getResultArray();
    }

    /**
     * Retourne le nombre d'user
     * 
     * @param string $login Valeur UNIQUE KEY; Correspond au login
     * @return array<int,array<string,value>> contient les résultat de la requête
     */
    public function countUserLogin($login){
        return $this->db->query("SELECT COUNT(login) FROM public.user WHERE login = :login:",['login' => $login])->getResultArray();
    }
    
    /**
     * Compte s'il y a bien qu'un user qui existe avec ce mot de passe et ce login
     * 
     * @param string $login UNIQUE KEY; Correspond au login
     * @param string $mdp Correspond au mot de passe
     * @return array<int,array<string,string|int>> contient les résultat de la requête
     */
    public function countIdUserValide($login, $mdp){
        return $this->db->query("SELECT COUNT(id_user) FROM public.user WHERE login = :login: AND mdp = :mdp:",['login' => $login, 'mdp' => $mdp])->getResultArray();
    }
    
    /**
     * Insert un user
     * 
     * @param string string
     * @param string $prenom
     * @param string $login UNIQUE KEY; Correspond au login
     * @param string $mdp Correspond au mot de passe
     * @return void
     */
    public function insertUser($nom, $prenom, $login, $mdp) {
        $this->db->query('INSERT INTO public.user(nom, prenom, login, mdp) VALUES(:nom:, :prenom:, :login:, :mdp:);',['nom' => $nom, 'prenom' => $prenom, 'login' => $login, 'mdp' => $mdp]);
    }

    /**
     * Modifie le mot de passe
     * 
     * @param int $idUser Valeur par défault = null; UNIQUE KEY; Correspond à l'id de l'utilisateur
     * @param string $mdp Correspond au mot de passe
     * @return void
     */
    public function updateUserMdp($idUser, $mdp){
        $this->db->query('UPDATE public.user SET mdp = :mdp: WHERE id_user = :id_user:',['mdp' => $mdp, 'id_user' => $idUser]);
    }
    
}
