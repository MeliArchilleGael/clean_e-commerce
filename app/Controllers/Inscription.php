<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Adresse;
use App\Models\Personne;

class Inscription extends Controller
{

    public function inscrire(){

        $email = htmlspecialchars(isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '');
        $password = htmlspecialchars(isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '');
        $nom = htmlspecialchars(isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '');
        $prenom = htmlspecialchars(isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : '');
        $telephone = htmlspecialchars(isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : '');
        $type = htmlspecialchars(isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '');
        $nomrue = htmlspecialchars(isset($_POST['nomrue']) ? htmlspecialchars($_POST['nomrue']) : '');
        $codepostal = htmlspecialchars(isset($_POST['codepostal']) ? htmlspecialchars($_POST['codepostal']) : '');
        $ville = htmlspecialchars(isset($_POST['ville']) ? htmlspecialchars($_POST['ville']) : '');
	    $image = $_FILES['image'];
	    
        if(!empty($nom) && !empty($prenom) && !empty($telephone) && !empty($email) && !empty($image) && !empty($type) && !empty($password)){
            if(strlen(trim($password)) >= 6){
                $passwordCrypt =  md5("mamy87".$password."papy15");
                /* Validation d'adresses email avec filter_var () */
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    
                    $erreur = "L'adresse email '$email' est valide.";

                    $ext = strtolower(substr($image['name'], -3));
	                $allow_ext = array('jpg','png','bmp','gif');
                    if(in_array($ext,$allow_ext)) {
 
                        move_uploaded_file($image['tmp_name'], "public/images/".$image['name']);         
                        
                        $image = "public/images/".$image['name']; 
                        
                        $pers = new Personne();
                        $res = $pers->inscription($nom,$prenom,$telephone,$email,$image,$type,$passwordCrypt);
                        //var_dump($res);
                        //die();
                        
                        $id = $pers->afficher_user($email,$password);
                        $id_user = $id["ID_PERS"];
                        var_dump($id_user);
                        
                        $adr = new Adresse();
                        $req = $adr->ajouter_adresse($id_user,$nomrue,$codepostal,$ville);
                        //var_dump($req);
                        //die();

                        if($res && $req){
                            //redirection vers la page de login
                            header('Location:' . URL . '/home/login');
                            exit();
                        }

                    }else{
                        $erreur = "Attention!! Votre fichier n'est pas une image";
                    }

                }else{
                    $erreur = "L'adresse email '$email' est invalide.";
                }
            }else{

                $erreur = "Password must have atleast 6 characters.";
            }
        }else{

            $erreur = "Erreur champs vides";
        }

    }

}

