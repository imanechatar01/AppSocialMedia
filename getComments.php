<?php
header('Content-Type: application/json');
ob_start(); // Start output buffering
include("conn.php");

$post_id = intval($_GET['postId']);

// First, get the total comment count
$countSql = "SELECT COUNT(*) as comment_count FROM comments WHERE id_post = ?";
$countStmt = $con->prepare($countSql);
$countStmt->bind_param("i", $post_id);
$countStmt->execute();
$countResult = $countStmt->get_result();
$countRow = $countResult->fetch_assoc();
$commentCount = $countRow['comment_count'];

// Then, get all comments with user details
$sql = "SELECT c.id, c.commantaire, c.date, CONCAT(u.prenom, ' ', u.nom) as username, u.photo, u.id as user_id 
        FROM comments c 
        INNER JOIN db_user u ON c.id_user = u.id 
        WHERE c.id_post = ? 
        ORDER BY c.date ASC";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

$comments = [];
while ($row = $result->fetch_assoc()) {
    $comments[] = [
        'user_id' => $row['user_id'],
        'id' => $row['id'],
        'username' => $row['username'],
        'comment' => htmlspecialchars($row['commantaire']),
        'created_at' => $row['date'],
        'avatar' => $row['photo']
    ];
}

ob_end_clean();
echo json_encode([
    'success' => true, 
    'comments' => $comments,
    'comment_count' => $commentCount
]);
?>