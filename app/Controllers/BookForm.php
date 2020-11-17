<?php namespace App\Controllers;

use CodeIgniter\Controller;

class BookForm extends Controller
{
    public function index()
    {
        helper(['form', 'url']);
        
        if (!$this->validate(['datedebut' => 'required','datefin' => 'required','pension' => 'required','typelogement' => 'required' ],
        ['datedebut' => ['required' => 'Merci d\'indiquer une date de début de séjour.'],'datefin' => ['required' => 'Merci d\'indiquer une date de fin de séjour.'],
        'pension'    => ['required' => 'Merci d\'indiquer votre pension.'], 'typelogement' => ['required' => 'Veuillez selectionnez un type de séjour']]))
        {
            echo view('form/book', [
                'validation' => $this->validator
            ]);
        }
        else
        {
            $this->control();
        }
    }
    
    public static function showData(){
        $model = new \App\Models\BookModel();
        return $model->getTypeLogement();
    }
    
    public function control(){
        $sejour = new Sejour($this->input->post('datedebut'), $this->input->post('datefin'), $this->input->post('nbpersonne'), 
        $this->input->post('typelogement'), $this->input->post('pension'), $this->input->post('menage'));
        if(is_array($sejour)){
            foreach ($sejour as $tabErreurSejour) {
                foreach ($tabErreurSejour as $erreur => $valeurErreur) {
                    $this->validator->setError($erreur, $valeurErreur);
                }
            }
            echo view('form/book',['validation' => $this->validator]);   
       }
       else{
          echo view('form/sucess'); 
       }
    }
}

