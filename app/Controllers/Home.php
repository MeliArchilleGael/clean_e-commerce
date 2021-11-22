<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Produit;

class Home extends Controller
{

    //retourne la vue principale 
    public function index()
    {
       // $produits = (new Produit)->getAll();
        $prod = new Produit();
        $produits = $prod->select_all();

        $this->render('home', compact('produits'));
    }

    public function inscription(){
        $this->render('inscription');
    }

    public function login(){
        $this->render('login');
    }

    public function panier(){
        $this->render('gestion_panier');
    }

    public function add_product(){
        $this->render('add_product');
    }

    

}