<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{    
            echo view('template/header');
            echo view('welcome_message');
            echo view('template/footer');
                
	}

	//--------------------------------------------------------------------

}


