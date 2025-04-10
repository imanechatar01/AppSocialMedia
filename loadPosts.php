<?php
header('Content-Type: application/json');
ob_start(); // Start output buffering
session_start();

include("conn.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Non autorisé']);
    exit;
}

$user_id = $_SESSION['id'];

$sql = "SELECT p.*, u.prenom, u.nom, u.photo 
        FROM  amie a 
        INNER JOIN post p ON a.id1 = p.id_user OR a.id2 = p.id_user
        INNER JOIN db_user u ON p.id_user = u.id 
        WHERE ((a.id1 = '$user_id') OR (a.id2 = '$user_id')) 
        AND p.id_user <> '$user_id'
        ORDER BY p.date DESC";

$result = mysqli_query($con, $sql);

if (!$result) {
    echo json_encode(['status' => 'error', 'message' => 'Erreur SQL', 'error' => mysqli_error($con)]);
    exit;
}

$posts = [];

while ($row = mysqli_fetch_assoc($result)) {
    $posts[] = [
        'id' => $row['id'],
        'content' => $row['text'],
        'image' => $row['piece_joint'],
        'timestamp' => $row['date'],
        'likes' => $row['likes'],
        'dislikes' => $row['deslikes'],
        'user' => [
            'id' => $row['id_user'],
            'name' => $row['prenom'] . ' ' . $row['nom'],
            'avatar' => 'images/userImg_' . $row['id_user'] . '/' . $row['photo']
        ]
    ];
}
ob_end_clean();
echo json_encode($posts);
exit;
?>
