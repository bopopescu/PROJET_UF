<?php

     /* Implémente Twig et renvoie l'affiche sur le bon template */

    require_once 'vendor/autoload.php';
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('menu.html.twig');

?>
