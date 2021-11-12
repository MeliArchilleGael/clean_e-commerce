<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Produit;

class Home extends Controller
{

    //retourne la vue principale 
    public function index()
    {
        $produits = (new Produit)->getAll();
        
        $this->render('home', compact('produits'));
    }

    public function inscription(){
        $this->render('inscription');
    }

    public function login(){
        $this->render('login');
    }

    

}