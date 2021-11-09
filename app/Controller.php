<?php
namespace App;

 abstract class Controller{
    
   //   public function loadModel(string $model){
   //      require_once(ROOT.'app/Models/'.$model .'.php');
   //      $this->$model = new $model();
   //   }

     public function render($fichier, array $data = []){

        extract($data);

        $fichier = str_replace('.','/',$fichier);

        //on demarre de buffer de sortie
        ob_start();

        //require_once(ROOT.'Views/pages/'.strtolower(get_class($this)).'/'.$fichier.'.php');
        require_once(ROOT.'views/'.$fichier.'.php');

        //on met le contenue de notre buffer dans content
        $content = ob_get_clean();

        require_once(ROOT.'views/layouts/app.php');

     }
   
 }