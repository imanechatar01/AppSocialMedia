<?php 
include("conn.php");
session_start();

if (isset($_GET['friend_id'])) {
    $idExp = $_SESSION['id'];  // L'utilisateur connecté
    $idDest = $_GET['friend_id']; // L'ami sélectionné


    // Récupérer la photo de l'utilisateur connecté
$sql_user = "SELECT photo FROM db_user WHERE id = '$idExp'";
$result_user = mysqli_query($con, $sql_user);
$row_user = mysqli_fetch_assoc($result_user);
$photoExp = "images/userImg_".$idExp."/". $row_user['photo'];

// Récupérer la photo de l'ami
$sql_friend = "SELECT photo FROM db_user WHERE id = '$idDest'";
$result_friend = mysqli_query($con, $sql_friend);
$row_friend = mysqli_fetch_assoc($result_friend);
$photoDest = "images/userImg_".$idDest."/". $row_friend['photo'];


    // Sélectionner les messages entre l'utilisateur et l'ami
    $sql = "SELECT m.idDest, m.idExp, m.dateEnvoi, m.message 
    FROM messages m 
    WHERE (m.idExp = '$idExp' AND m.idDest = '$idDest') 
    OR (m.idExp = '$idDest' AND m.idDest = '$idExp')  
    ORDER BY m.dateEnvoi ASC";


$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $message = htmlspecialchars($row['message']);
        
        // Vérifier qui est l'expéditeur du message
        if ($row['idExp'] == $idExp) {
            $class = 'sent'; // Message envoyé (à droite, vert)
            $photo = $photoExp;
        } else {
            $class = 'received'; // Message reçu (à gauche, gris)
            $photo = $photoDest;
        }
        $date = date(" H:i", strtotime($row["dateEnvoi"]));

        echo "<div class='message-container $class'>
        <div class='message-info'>$date</div>
        <img class='imgConv' src='$photo'>
        <div class='message'>$message</div>
      </div>";
    }
} else {
    echo '<p style="color :rgb(128, 127, 127); margin-left:90px;">Start a conversation</p>';
}
}?>