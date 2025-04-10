<?php

include("conn.php");
session_start();





    // Validation des entrées
    $text = isset($_POST['text']) ? trim($_POST['text']) : '';
    $hasImage = isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK;

    if (empty($text) && !$hasImage) {
       echo 'Le post doit contenir du texte ou une image';
    }

    // Traitement de l'image
    $imagePath = null;
    if ($hasImage) {
        $file = $_FILES['photo'];
        $allowedTypes = ['image/jpeg' => 'jpg', 'image/png' => 'png'];
        
        if (!array_key_exists($file['type'], $allowedTypes)) {
            throw new Exception('Seuls les JPG et PNG sont acceptés');
        }

        if ($file['size'] > 2000000) {
            throw new Exception('L\'image ne doit pas dépasser 2MB');
        }

        $uploadDir = 'posts/postImg_' . $_SESSION['id'] . '/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $ext = $allowedTypes[$file['type']];
        $filename = uniqid('post_', true) . '.' . $ext;
        $destination = $uploadDir . $filename;
        
        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new Exception('Erreur lors de l\'enregistrement de l\'image');
        }

        $imagePath = $destination;
    }

    // Insertion en base de données (version sécurisée)
    $query = "INSERT INTO post (id,id_user, date, text, piece_joint, likes, deslikes) 
              VALUES (null,?, NOW(), ?, ?, 0, 0)";
    
    $stmt = mysqli_prepare($con, $query);
    if (!$stmt) {
        echo'Erreur de préparation: ' . mysqli_error($con);
    }

    mysqli_stmt_bind_param($stmt, "iss", $_SESSION['id'], $text, $imagePath);
    
    if (!mysqli_stmt_execute($stmt)) {
        echo'Erreur d\'exécution: ' . mysqli_error($con);
    }
else{
    header('location:sendPostsForm.php');
}
    $response = [
        'status' => 'success',
        'post_id' => mysqli_insert_id($con),
        'image_url' => $imagePath
    ];

?>