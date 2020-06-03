<?php

    /* Connection à la base de donnée*/

    include '../connection-bdd.php';

    
     /* Implémente Twig et renvoie l'affiche sur le bon template */

    require_once '../vendor/autoload.php';
    $loader = new \Twig\Loader\FilesystemLoader('../templates');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('connexion.html.twig');
    echo $template->render(array(

    )); 
?>


<?php

$errorconnection = "<script>alert('Mot de passe ou email incorrect')</script>";

if (isset($_POST["submit"])) {
    $mail = $_POST["mail"];
    $password = $_POST["password"];

    $reponse = $pdo->prepare("SELECT mdp FROM client WHERE mail = :mail");
    $reponse->execute(array('mail' => $mail));

 
    while ($donnees = $reponse -> fetch()) {
        $password_hash = $donnees['mdp'];
    }
    // Compare the posted password with the password hash fetched from db.
    if (password_verify($password, $password_hash)) {
            $_SESSION['user']= $mail;
            header('Location: accueil.php');
        } else echo $errorconnection;
            
        
    } 
    
?>

