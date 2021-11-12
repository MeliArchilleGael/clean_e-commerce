<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Produit;

class Chariot extends Controller
{

    public function index()
    {
    }

    public function AJouterAuChariot()
    {

        $quantite = (int) !empty($_POST['quantite']) ? $_POST['quantite'] : 1;

        if (isset($_POST['produit'])) {
            $produit = new Produit();
            $produit->id = $_POST['produit'];
            $produit = $produit->getOne();

            //var_dump($produit);

            //set it the session
            $chariot = isset($_SESSION['chariot']) ? $_SESSION['chariot'] : [];

            //c'est le premier produit du chariot 
            if ($chariot == []) {
                $chariot = [
                    $produit['REF_PROD'] => [
                        'produit' => $produit,
                        'quantite' => $quantite,
                    ],
                ];
                $_SESSION['message'] = "Ajouter au Panier Avec success";
            } else {
                //le produit existe deja dans le panier alors on ajoute la quantite
                if (isset($chariot[$produit['REF_PROD']])) {    
                    $chariot[$produit['REF_PROD']]['quantite'] += $quantite;

                    $_SESSION['message'] = "La quantité du produit dans le panier a bien été mis a jour";
                } else {
                    $chariot[$produit['REF_PROD']] = [
                        'produit' => $produit,
                        'quantite' => $quantite,
                    ];
                    $_SESSION['message'] = "Ajouter au Panier";
                }
            }

            //sauvegarde en session
            $_SESSION['chariot'] = $chariot;

            //var_dump($_SESSION['chariot']);

            //redirection au hame
            header('Location: '.URL.'/home');


        } else {
            $_SESSION['message'] = "Aucun Produit n'a été sélectioné";
        }
    }
}
