<?php
include("conn.php");
session_start();

if (isset($_GET['id'])) {
    $friendId = $_GET['id'];
    echo "<script>window.onload = function() { openChatBox($friendId); };</script>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maquette Web</title>
    <link rel="stylesheet" href="espaceEtudiant.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body >

    <!-- Navbar -->
    <div class="navbar">
        <div class="user-info">
            <?php 
               echo'<img src="images/userImg_'.$_SESSION['id'].'/'.$_SESSION['photo'].'" alt="User">';
            ?>
            
            <span class="user-name"><?php echo $_SESSION['prenom']; ?></span>
            <span class="user-name"><?php echo $_SESSION['nom']; ?></span>
        </div>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <!-- Contenu principal -->
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
        <a href="sendPostsForm.php"><i class="fas fa-home"></i> Accueil</a>
            <a href="searchFriend.php"><i class="fas fa-search"></i> Chercher</a>
            <a href="receivedInvitation.php"><i class="fas fa-user-plus"></i> Invitations</a>
            <a href="messagesSection.php"><i class="fas fa-envelope"></i> Messages</a>
            <a href="amiesList.php"><i class="fas fa-users"></i> Amis</a>
            <a href="userProfil.php"><i class="fas fa-user"></i> Profil</a>
            <a href="espaceEtudiant.php"><i class="fas fa-user-plus"></i> Envoyer Invitations</a>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="messages-container">
        <!-- Colonne gauche : Liste des amis -->
                <div class="friends-list">
                    <h3>Amis</h3>
                    <div id="friendContainer"></div>
                </div>

        <!-- Colonne droite : Conversation -->
                <div class="chat-box">
                    <div id="chat_header" >
                    <span id="chat_friend_name"></span>
                    <button onclick="closeChatBox()">X</button>
                </div>
                    <div id="chat_messages"></div>
                    <div id="chat_input">
                    <textarea id="message_text" placeholder="Écrire un message..." oninput="autoResize(this)"></textarea>
                        <button onclick="sendMessage()">Envoyer</button>
                    </div>
                </div>
        </div>

    </div>

<style>
   
    .messages-container {
    display: flex;
    width: 100%;
    height: 100%;
    border: 1px solid #ccc;
   border-radius: 30px;
}

.friends-list {
    width: 30%;
    background-color: #f0f0f0;
    padding: 10px;
    overflow-y: auto;
    height: 100%;
    border-radius: 30px;
}

.chat-box {
    width: 70%;
    display: flex;
    flex-direction: column;
    border-left: 1px solid #ccc;
    padding: 10px;
}

#chat_messages {
    flex: 1;
    overflow-y: auto;
    border-bottom: 1px solid #ccc;
    padding: 10px;
    min-height: 300px;
}

#chat_input {
    display: flex;
    padding: 5px;
}

#chat_input input {
    flex: 1;
    padding: 8px;
    margin-right: 5px;

}
.friend-item {
    padding: 10px;
    cursor: pointer;
    border-bottom: 1px solid #ddd;
}

.friend-item:hover {
    background-color: #ddd;
}


</style>
<script>
    function openChatBox(friendId) {
    let nomUser =document.getElementById(friendId);

    currentFriendId = friendId;
    
   
        let divNomHeader = document.getElementById("chat_friend_name");
        divNomHeader.innerHTML = nomUser.innerText;
    // Vérifie après 100ms si le chat est toujours affiché
   
    loadMessages(friendId);
   
}
</script>
<script src="script.js"></script>