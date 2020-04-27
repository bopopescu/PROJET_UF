<?php

    /* Connection à la base de donnée*/

    include '../connection-bdd.php';


     /* Implémente Twig et renvoie l'affiche sur le bon template */

    require_once '../vendor/autoload.php';
    $loader = new \Twig\Loader\FilesystemLoader('../templates');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('accueil.html.twig');
    echo $template->render(array(
        'titre' => $titre,
        'photos'=> $photos,
   )); 

?>

<?php
        //On créé la requête
        $sql = "SELECT * FROM annonce";
        /* execute et affiche l'erreur mysql si elle se produit */
        try {
            $stmtCpt = $pdo->prepare($sql);
            $stmtCpt->execute();
            while($cpt = $stmtCpt->fetch(PDO::FETCH_ASSOC)) {
                $titre = $cpt['titre'];
                $photos = $cpt['photos'];     
            }
        } catch(PDOException $e) {
            exit($e->getMessage() . "\n");
        }   

?>

