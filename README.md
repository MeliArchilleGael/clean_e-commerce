# Installation 
1) cloné le repository: il faut se rassurer le depot local a le meme nom que celui en ligne.

2) Si vous changer le nom du project il faut egalement changer la valeur de la superglobale 'URL' dans le fichir 'index' a la racine du project.

3) placer le project dans le dossier 'www' du serveur local si c'est pas deja fait.

4) executer la commande 'composer install'(composer est requis 'composer.org').

5) lancé l'application dans saisant : 
    home => 'localhost/{nom_du_project}/home"
    login => 'localhost/{nom_du_project}/home/login"
    inscrition => 'localhost/{nom_du_project}/home/inscription"

6) La structure des URL doit etre: 'URL/{nom_du_controlleur}/{nom_de_la_methode_du_controllur_a_appellée}/{paramétre(si possible)} 

### by DevMAG