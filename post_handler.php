<?php
include 'conn.php'; // Inclure la connexion à la base de données
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'];

    // Insertion du post avec texte et image
    if ($action === "add") {
        $content = trim($_POST['content']);
        $user_id = $_SESSION['id']; // Remplace par l'ID de l'utilisateur connecté (si tu as une session utilisateur)

        $imagePath = null;

        // Vérifier si une image a été envoyée
        if (isset($_FILES['postImage']) && $_FILES['postImage']['error'] === UPLOAD_ERR_OK) {
            $imageTmp = $_FILES['postImage']['tmp_name'];
            $imageName = basename($_FILES['postImage']['name']);
            $imageDir = 'uploads/';
            $imagePath = $imageDir . $imageName;

            // Déplacer l'image dans le dossier 'uploads'
            if (!move_uploaded_file($imageTmp, $imagePath)) {
                echo  "Erreur lors du téléchargement de l'image.";
                exit;
            }
        }

        // Préparer et exécuter la requête d'insertion
        $query = "INSERT INTO post(id, id_user, date, text, piece_joint,likes,deslikes ) VALUES (null,'$user_id', NOW(),'$content', '$imagePath',0,0)";

        if (mysqli_query($con, $query)) {
           header("location:loginForm.php");
        } else {
            header("location:messagesSection.php");
            }
    }else {
        header("location:messagesSection.php");
        }
}
else {
    header("location:messagesSection.php");
    }
?>
