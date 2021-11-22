<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Personne;
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
            $ref_prod = $_POST["produit"];
            $produit = $produit->selectOneProduct($ref_prod);

            // var_dump($produit);
            
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

            // var_dump($_SESSION['chariot']);
            // die();
            //redirection au hame
            header('Location: '.URL.'/home');


        } else {
            $_SESSION['message'] = "Aucun Produit n'a été sélectioné";
        }
    }


    public function addPanier(){


        $prod = new Produit();
        
        if(isset($_POST["addtocart"])){
            if(!empty($_POST["quantite"]) && !empty($_POST["produit"])) {
                $ref_prod = $_POST["produit"];
                   // var_dump($ref_prod);
                        $productByCode = $prod->selectOneProduct($ref_prod);
                        
                        //var_dump($productByCode);
                        //die();

                        $itemArray = array(
                        $productByCode["REF_PROD"]=>array('labels'=>$productByCode["LABELS"], 'code'=>$productByCode["REF_PROD"], 'quantite'=>$_POST["quantite"], 'prix'=>$productByCode["PRIX"], 'image'=>$productByCode["IMAGE_PROD"]));
                            
                        //var_dump($itemArray);
                        //die();
                        if(!empty($_SESSION["cart_item"])) {
                           // var_dump($_SESSION["cart_item"]);
                           // die();
                            if(in_array($productByCode["REF_PROD"],array_keys($_SESSION["cart_item"]))) { 
                            // in_array() recherche la ref_prod dans toutes les clés du tableau session
                            //  array_keys() retourne toutes les clés ou un ensemble de clés d'un tableau
                                foreach($_SESSION["cart_item"] as $k => $v) {
                                    if($productByCode["REF_PROD"] == $k) {  // on regarde si la ref_prod fait partir des clés du tableau session
                                        if(empty($_SESSION["cart_item"][$k]["quantite"])) {
                                            $_SESSION["cart_item"][$k]["quantite"] = 0;
                                        }
                                        $_SESSION["cart_item"][$k]["quantite"] += $_POST["quantite"];
                                        $_SESSION['message'] = "La quantité du produit dans le panier a bien été mis a jour";
                                    }
                                }

                            } else {
                                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                                $_SESSION['message'] = "Ajouter au Panier";
                               // header('Location: '.URL.'/home');
                            }

                        } else {
                            // sauvegarde en session
                            $_SESSION["cart_item"] = $itemArray;
                            //redirection au hame
                           // header('Location: '.URL.'/home');
                        }
                    }else{
                        $_SESSION['message'] = "Aucun Produit n'a été sélectioné";
                    }

            } 
            header('Location: '.URL.'/home');
           // var_dump($_SESSION["cart_item"]);
           // die();        
    }

    public function remove($ref_prod){

        if(!empty($_SESSION["cart_item"])) {
            foreach($_SESSION["cart_item"] as $k => $v) {
                    if($ref_prod == $k)
                        unset($_SESSION["cart_item"][$k]);				
                    if(empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
            }
        }

        header('Location:' . URL . '/home/panier');
      
    }

    public function emptyCard(){
   
        unset($_SESSION["cart_item"]);
        header('Location:' . URL . '/home/panier');
             
    }

    public function commander(){
        $pers = new Personne();
        if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {
            $id_user = $_SESSION['user']['id'];
            $id_cmde = $pers->order($id_user);
            //var_dump($id_user);
            //var_dump($id_cmde);
            //die();
            if(!empty($_SESSION["cart_item"])){
                foreach($_SESSION["cart_item"] as $item){
                    $ref_prod = $item["code"];
                    $qte_cmde = $item["quantite"];
                    $prix_cmde = $item["prix"];
                    //var_dump($ref_prod);
                    //var_dump($qte_cmde);
                    //var_dump($prix_cmde);
                    //die();
                    $res = $pers->order_all($id_cmde,$ref_prod,$qte_cmde,$prix_cmde);
                    // var_dump($res); die();                    
                }
                if($res){
                    // update quantité en stock de la quantité commandée  
                    foreach($_SESSION["cart_item"] as $item){
                        $ref_prod = $item["code"];
                        $rq = $pers->update_stock($id_cmde,$ref_prod);
                    }

                    if($rq){

                    $_SESSION['message'] = "Commande effectuée avec success!!";
                    // on vide le panier et effectue une redirection vers la page d'acceuil
                    unset($_SESSION["cart_item"]);
                   // header('Location:' . URL . '/home');
                }else{
                    $_SESSION['message'] = "Error de modification des quantitées en stocks";
                }
                }
            }else{
                $_SESSION['message'] = "Empty cart";
            }

        }else{
            $_SESSION['message'] = "User is not exist";
        }

        header('Location:' . URL . '/home');
    }



}
