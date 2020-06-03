<?php

    /* Connection à la base de donnée*/

    include '../connection-bdd.php';


     /* Implémente Twig et renvoie l'affiche sur le bon template */

    require_once '../vendor/autoload.php';
    $loader = new \Twig\Loader\FilesystemLoader('../templates');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('inscription.html.twig');
    echo $template->render(array(
    )); 
?>


<?php

$error1 = "<script>alert('Les mots de passe ne sont pas identiques')</script>";
$error2 = "<script>alert('Le mot de passe est trop court !')</script>";
$error3 = "<script>alert('Veuillez saisir tous les champs !')</script>";
$succes = "<script>alert('Inscription réussie !')</script>";

     
if (isset($_POST['submit']))
{
   /* on test si les champ sont bien remplis */
    if(!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['mail']) and !empty($_POST['password']) and !empty($_POST['repeatpassword']) and !empty($_POST['genre']) and !empty($_POST['adresse']) and !empty($_POST['code_postal']) and !empty($_POST['ville']) and !empty($_POST['pays']) and !empty($_POST['numero']) and !empty($_POST['date_de_naissance']) and !empty($_POST['agence']) )
    {
        /* on test si le mdp contient bien au moins 6 caractère */
        if (strlen($_POST['password'])>=6)
        {
            /* on test si les deux mdp sont bien identique */
            if ($_POST['password']==$_POST['repeatpassword'])
            {
                // On crypte le mot de passe
                $password = $_POST['password'];
                $_POST['passwordhash'] = password_hash($password, PASSWORD_DEFAULT);
                //On créé la requête
                $sql = "INSERT INTO client VALUES ('".$_POST['nom']."','".$_POST['prenom']."','".$_POST['mail']."','".$_POST['passwordhash']."','".$_POST['genre']."','".$_POST['adresse']."','".$_POST['code_postal']."','".$_POST['ville']."','".$_POST['pays']."','".$_POST['numero']."','".$_POST['date_de_naissance']."','".$_POST['agence']."',NULL)";
                /* execute et affiche l'erreur mysql si elle se produit */
                if (!$pdo->query($sql))
                {

                   echo "<script>alert('Message d'erreur : %s\n', $pdo->error)</script>";
                }
            // on ferme la connexion
            mysqli_close($pdo);
            }
            else echo $error1;
        }
        else echo $error2;
    }
    else echo $error3; 
       
echo $succes; 


}



?>