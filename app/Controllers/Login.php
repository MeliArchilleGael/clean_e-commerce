<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Personne;

class Login extends Controller
{

    //check login and redirect user

    public function checkLogin()
    {
        session_start();
        $email = htmlspecialchars(isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '');
        $password = htmlspecialchars(isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '');

        if (!empty($email)) {
            if (!empty($password)) {
                $p = new Personne();

                $p->email = $email;
                $p->password = $password;

                $p->getPersonneByEmail_Password();

                if ($p->id_pers != null) {
                    //save information about the user in session 
                    $_SESSION['user'] = [
                        'id' => $p->id_pers,
                        'nom' => $p->nom_pers,
                        'telephone' => $p->telephone,
                        'email' => $p->email,
                        'image_pers' => $p->image_pers,
                        'type_pers' => $p->type_pers,
                    ];

                    //login now redirect user according to his type
                    if ($p->type_pers == 'Prestataire') {
                        $_SESSION['message'] = 'you are login as a Prestatire';
                        
                        //redirection vers la page d'acceuil 
                        header('Location:' . URL . '/home');
                        exit();
                    } elseif ($p->type_pers == 'Client') {
                        $_SESSION['message'] = 'you are login as a client ';

                        //redirection vers la page d'acceuil 
                        header('Location:' . URL . '/home');
                    }
                } else {
                    $_SESSION['message'] = 'No watch records';
                }
            } else {
                $_SESSION['message'] = 'empty password';
            }
        } else {
            $_SESSION['message'] = 'empty email';
        }
        //redirection vers la page de login
        header('Location:' . URL . '/home/login');
        exit();
    }
    
/**
 * Logout a user  
 */
    public function logout(){
        if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
            unset($_SESSION['user']);
        }
        header('Location:' . URL . '/home/login');
        exit();
    }
}
