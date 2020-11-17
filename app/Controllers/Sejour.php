<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

/**
 * Description of Sejour
 *
 * @author dasilvaremi
 */
class Sejour {
    
    private $dateDebut;
    private $dateFin;
    private $nbPersonne;
    private $typeLogement;
    private $pension;
    private $option;
    private $exception;
    
    public function __construct($datedebut, $datefin, $nbPersonne, $typeLogement, $pension, $option) {
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
    }

    public function getDateDebut(){
        return $this->dateDebut;
    }

    public function getDateFin(){
        return $this->dateFin;
    }

    public function getNbPersonne(){
        return $this->nbPersonne;
    }

    public function getTypeLogement(){
        return $this->typeLogement;
    }

    public function getPension(){
        return $this->pension;
    }

    public function getOption(){
        return $this->option;
    }

    public function getErreur(){
        return $this->exception;
    }
    
    
    public function Erreur() : bool{
        $erreur = false;
        if(!$this->controlDuree($this->getDateDebut(), $this->getDateFin())){
            $this->addException(array("datedebut" => "La durée du séjour est incorrecte!")); 
            $erreur = true;
        }
        if(!$this->capacite()){
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
    
    public function controlDuree(string $date1,string $date2) : bool{
        if($this->dateJour($date1)[2] - $this->dateJour($date2)[2] == 7){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function capacite(){
        if($this->nbPersonne){
            
        }
    }
}
