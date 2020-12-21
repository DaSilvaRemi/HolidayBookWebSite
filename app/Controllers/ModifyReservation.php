<?php

namespace App\Controllers;
use \CodeIgniter\Controller;
use \App\Models\Session;

/**
 * Description of ModifyReservation
 *
 * @author remi
 */
class ModifyReservation extends Controller{
    
    /**
     * Vérifie si l'utilisateur est connecté et que les champs du formulaire sont bien rempli
     * 
     * @param void
     * @return string|object  
     * - string retourne la vue
     * - object redirige sur la Connexion et on demande à l'utilisateur de se connecter s'il ne l'est pas déja
     */
    public function index() {
        helper('form');
        Session::startSession();
        if(!Session::verifySession() || Session::getSessionData('idUser') != 1){
            return redirect()->to(site_url('Connexion/deconnexion')); 
        }
        
        $SiteReservationModel = new \App\Models\SiteReservationModel;
        //Modifie la réservation
        if(!empty($this->request->getPost('idReservationModif'))){
            echo view('template/header', ['iduser' => Session::getSessionData('idUser')]);
            echo view("form/modifyreservation",['tabInfoReservation' => $SiteReservationModel->getLesReservationsById($this->request->getPost('idReservationModif'))[0],
                'tabTypeLogement' => $SiteReservationModel->getTypeLogement()][0]);
            echo view('template/footer');
        }
        else if(!empty($this->request->getPost('idUpdateReservation'))){
            $this->verifFieldModif();
            return redirect()->to(site_url('GestionReservation'));
        }
        else{
            return redirect()->to(site_url('GestionReservation')); 
        }  
    }
    
    
    private function verifFieldModif() : void{
        $InfoReservation = $this->verifFieldIsSame();
        $leControlSiteReservation = new ControlSiteReservationModel($InfoReservation['datedebut'], $InfoReservation['datefin'], $InfoReservation['nbpersonne'],
                $InfoReservation['typelogement'],
                $InfoReservation['pension'],
                $InfoReservation['menage']);

        if ($leControlSiteReservation->Erreur()) {
            $tabException = $leControlSiteReservation->getException();
            foreach ($tabException as $Exception) {
                foreach ($Exception as $errorField => $errorValue) {
                    $this->validator->setError($errorField, $errorValue);
                }
            }
            $SiteReservationModel = new \App\Models\SiteReservationModel();
            $SiteReservationModel->updateReservation($this->request->getPost('idUpdateReservation'), $this->request->getPost('datedebut'), $this->request->getPost('datefin'), 
                    $this->request->getPost('nbpersonne'), $this->request->getPost('typelogement'), $this->request->getPost('pension'), $this->request->getPost('menage'));
            unset($leControlSiteReservation);
        } else {
            $SiteReservationModel->updateReservation($this->request->getPost('idUpdateReservation'), $InfoReservation['datedebut'], $InfoReservation['datefin'], 
                $InfoReservation['nbpersonne'], $InfoReservation['typelogement'], $InfoReservation['pension'], $InfoReservation['menage']);
            unset($leControlSiteReservation);
        }
    }
    
    private function verifFieldIsSame() : array{
        $SiteReservationModel = new \App\Models\SiteReservationModel;
        $InfoReservation = $SiteReservationModel->getLesReservationsById($this->request->getPost('idUpdateReservation'))[0];
        $newInfoReservation = [];
        
        //Date debut
        if(!empty($this->request->getPost('datedebut')) && $InfoReservation['datedebut'] != $this->request->getPost('datedebut')){
            $newInfoReservation['datedebut'] = $this->request->getPost('datedebut');
        }
        else{
            $newInfoReservation['datedebut'] = $InfoReservation['datedebut'];
        }
        
        //Date Fin
        if(!empty($this->request->getPost('datefin')) && $InfoReservation['datefin'] != $this->request->getPost('datefin')){
            $newInfoReservation['datefin'] = $this->request->getPost('datefin');
        }
        else{
            $newInfoReservation['datefin'] = $InfoReservation['datefin'];
        }
        
        //nbPersonne
        if(!empty($this->request->getPost('nbpersonne')) && $InfoReservation['nbpersonne'] != $this->request->getPost('nbpersonne')){
           $newInfoReservation['nbpersonne'] = $this->request->getPost('nbpersonne'); 
        }
        else{
            $newInfoReservation['nbpersonne'] = $InfoReservation['nbpersonne'];
        }
        
        //typelogement
        if(!empty($this->request->getPost('typelogement')) && $InfoReservation['typelogement'] != $this->request->getPost('typelogement')){
           $newInfoReservation['typelogement'] = $this->request->getPost('typelogement'); 
        }
        else{
            $newInfoReservation['typelogement'] = $InfoReservation['typelogement'];
        }
        
        //Pension
        if(!empty($this->request->getPost('pension')) && $InfoReservation['pension'] != $this->request->getPost('pension')){
           $newInfoReservation['pension'] = $this->request->getPost('pension'); 
        }
        else{
            $newInfoReservation['pension'] = $InfoReservation['pension'];
        }
        
        //Menage
        if(!empty($this->request->getPost('menage')) && $InfoReservation['menage'] != $this->request->getPost('menage')){
           $newInfoReservation['menage'] = $this->request->getPost('menage'); 
        }
        else{
            $newInfoReservation['menage'] = $InfoReservation['menage'];
        }
        
        return $newInfoReservation;
    }
}
