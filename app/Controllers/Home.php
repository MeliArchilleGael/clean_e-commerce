<?php

namespace App\Controllers;

use App\Controller;


class Home extends Controller
{

    //retourne la vue principale 
    public function index()
    {
        $this->render('home');
    }

    public function inscription(){
        $this->render('inscription');
    }

    public function login(){
        $this->render('login');
    }

    

}