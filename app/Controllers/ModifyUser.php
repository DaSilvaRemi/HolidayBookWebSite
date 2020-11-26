<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

/**
 * Description of ModifyUser
 *
 * @author remi
 */
class ModifyUser extends Controller{
    public function index()
    {
        helper('form');
        helper('html');
        
        Session::startSession();
        if(!Session::verifySession()){
            return redirect()->to(site_url('Connexion')); 
        }
        
        echo link_tag('css/nav.css');
        echo link_tag('css/stylepp.css');
        echo link_tag('css/form.css');
        
        if (!$this->validate(['user' => 'required','datefin' => 'required','pension' => 'required','typelogement' => 'required' ],
        ['datedebut' => ['required' => 'Merci d\'indiquer une date de début de séjour.'],'datefin' => ['required' => 'Merci d\'indiquer une date de fin de séjour.'],
        'pension'    => ['required' => 'Merci d\'indiquer votre pension.'], 'typelogement' => ['required' => 'Veuillez selectionnez un type de séjour']]))
        {
            $SiteReservationModel = new \App\Models\SiteReservationModel();
            echo view('template/header');
            echo view('form/book', [
                'validation' => $this->validator, 'data' => $SiteReservationModel->getTypeLogement()
            ]);
        }
        else
        {
            $this->control();
        }
    }
}
