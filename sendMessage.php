<?php
include("conn.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idExp = $_SESSION['id'];
    $idDest = $_POST['friend_id'];
    $messageText = $_POST['message'];
    $dateEnvoi = date('Y-m-d H:i:s');

    $sql = "INSERT INTO messages (idExp, idDest, message, dateEnvoi) VALUES ('$idExp', '$idDest', '$messageText', '$dateEnvoi')";
    
    if (mysqli_query($con, $sql)) {
        echo "Message envoyé.";
    } else {
        echo "Erreur : " . mysqli_error($con);
    }
}
?>
