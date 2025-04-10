<?php
header('Content-Type: application/json');
ob_start(); // Start output buffering
session_start();
include("conn.php");

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté']);
    exit;
}

$user_id = $_SESSION['id'];

// Vérification de la présence de 'postId' et 'comment' dans POST
if (!isset($_POST['postId']) || !isset($_POST['comment'])) {
    echo json_encode(['success' => false, 'message' => 'Données manquantes dans la requête']);
    exit;
}

$post_id = intval($_POST['postId']); // Conversion de postId en entier
$comment = trim($_POST['comment']);

if (empty($comment)) {
    echo json_encode(['success' => false, 'message' => 'Le commentaire est vide']);
    exit;
}

// Vérification de la connexion à la base de données
if (!$con) {
    echo json_encode(['success' => false, 'message' => 'Échec de la connexion à la base de données']);
    exit;
}

// Insérer le commentaire
$sql = "INSERT INTO comments (id_user, id_post, date, commantaire) VALUES (?, ?, NOW(), ?)";
$stmt = $con->prepare($sql);

if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Erreur lors de la préparation de la requête']);
    exit;
}

$stmt->bind_param("iis", $user_id, $post_id, $comment);

if ($stmt->execute()) {
    ob_end_clean();
    echo json_encode([
        'success' => true,
        'comment' => [
            'id' => $stmt->insert_id,
            'user_id' => $user_id,
            'post_id' => $post_id,
            'comment' => htmlspecialchars($comment, ENT_QUOTES, 'UTF-8'),
            'created_at' => date("Y-m-d H:i:s")
        ]
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout du commentaire']);
}

$stmt->close();
$con->close();
?>
