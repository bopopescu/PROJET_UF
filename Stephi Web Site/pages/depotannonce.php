<?php

    /* Connection à la base de donnée*/

    include '../connection-bdd.php';



     /* Implémente Twig et renvoie l'affiche sur le bon template */

    require_once '../vendor/autoload.php';
    $loader = new \Twig\Loader\FilesystemLoader('../templates');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('depotannonce.html.twig');
    echo $template->render(array(

    )); 

?>


<?php

$statusMsg = '';

// File upload path
$targetDir = "uploads/";
$fileName = $_FILES["img"]["name"];
$targetFilePath = $targetDir . $fileName;

$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

$allowTypes = array('jpg','png','jpeg');

if(isset($_POST["submit"])){
    // Allow certain file formats
       
    $titre = $_POST["titre"];
    $text = $_POST["description"];
    $prix = $_POST["prix"];
    $agence = $_POST["agence"];
    
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["img"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $pdo->query("INSERT into annonce (titre, img_name, description, prix,agence) VALUES ('".$titre."''".$fileName."''".$text."''".$prix."''".$agence."')");
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
?>


