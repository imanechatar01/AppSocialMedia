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
$post_id = intval($_GET['postId']);

// Vérifier si l'utilisateur a déjà liké ce post
$check_sql = "SELECT * FROM likes WHERE user_id = ? AND post_id = ?";
$stmt = $con->prepare($check_sql);
$stmt->bind_param("ii", $user_id, $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // L'utilisateur a déjà liké, on supprime le like (toggle dislike)
    $delete_sql = "DELETE FROM likes WHERE user_id = ? AND post_id = ?";
    $stmt = $con->prepare($delete_sql);
    $stmt->bind_param("ii", $user_id, $post_id);
    $stmt->execute();

    // Décrémenter le compteur de likes
    $update_sql = "UPDATE post SET likes = likes - 1 WHERE id = ?";
    $stmt = $con->prepare($update_sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    ob_end_clean();
    echo json_encode(['success' => true, 'newLikeCount' => getLikeCount($con, $post_id), 'action' => 'unliked']);
} else {
    // Ajouter le like
    $insert_sql = "INSERT INTO likes (user_id, post_id) VALUES (?, ?)";
    $stmt = $con->prepare($insert_sql);
    $stmt->bind_param("ii", $user_id, $post_id);
    $stmt->execute();

    // Incrémenter le compteur de likes
    $update_sql = "UPDATE post SET likes = likes + 1 WHERE id = ?";
    $stmt = $con->prepare($update_sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    ob_end_clean();
    echo json_encode(['success' => true, 'newLikeCount' => getLikeCount($con, $post_id), 'action' => 'liked']);
}

// Fonction pour récupérer le nombre de likes
function getLikeCount($con, $post_id) {
    $sql = "SELECT likes FROM post WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['likes'];
}
?>
