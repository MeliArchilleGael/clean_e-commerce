<?php
namespace App\Controllers;

use App\Controller;
use App\Models\Personne;

class Login extends Controller
{
    
    //check login and redirect user

    public function checkLogin(){
        session_start();
        $email = htmlspecialchars(isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '');
        $password = htmlspecialchars(isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '');

        if (!empty($email)) {
            if (!empty($password)) {
                $p = new Personne();

                $p->email = $email;
                $p->password = $password;

                $p->getPersonneByEmail_Password();

                if($p->id_pers != null){
                    //save information about the user in session 
                    $_SESSION['user'] = $p->id_pers;
                    
                   //login now redirect user according to his type
                   if($p->type_pers == 'Prestataire'){
                    var_dump('you are login as a Prestatire');
                    die();

                   }elseif($p->type_pers == 'Client') {
                    var_dump('you are login as a client ');
                    die();

                   }else{
                       session_abort();
                   }
                }else{
                    var_dump('No watch records');
                    die();
                }
            }else{
                var_dump('empty password');
                die();
            }
        }else{
            var_dump('empty email');
            die();
        }
    }
}