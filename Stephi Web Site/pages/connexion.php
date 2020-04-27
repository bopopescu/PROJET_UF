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


if (isset($_POST["submit"])) {
    $mail = $_POST["mail"];
    $password = $_POST["password"];

    $sql = "SELECT mdp FROM client where mail = '" . $mail . "' ";
    $statement = $pdo->query($sql);
    $credentials = $statement->fetch(PDO::FETCH_ASSOC);
   
    if ($credentials) { // Record found.
        $hash = $credentials['mdp'];

        // Compare the posted password with the password hash fetched from db.
        if (password_verify($password, $hash)) {
            echo "Bienvenu";
        } else {
            echo "Mauvais mdp";
        }
    } else {
        echo 'Compte non trouvé';
    }
}
?>

