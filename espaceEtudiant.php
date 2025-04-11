<?php 
session_start();
include("conn.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maquette Web</title>
    <link rel="stylesheet" href="espaceEtudiant.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
 
<body >

    <!-- Navbar -->
    <div class="navbar">
    <div class="user-info">
        <?php 
           echo '<img src="images/userImg_'.$_SESSION['id'].'/'.$_SESSION['photo'].'" alt="User">';
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
            
            <div class="cards-container">
                <?php
                
                $id= $_SESSION['id'];
                $sql = "SELECT d.id, d.nom, d.prenom, d.photo, d.email 
                FROM db_user d 
                LEFT JOIN invitation i 
                ON d.id = i.idDest AND i.idExp = '$id' 
                WHERE d.id <> '$id' AND i.idDest IS NULL"; 
                $result = mysqli_query($con, $sql);

                if (!$result) {
                    echo "<p style='color:red;'>Erreur lors de la récupération des données.</p>";
                } else {
                    while ($data = mysqli_fetch_array($result)) {
                        $id = $data["id"];
                        $photo = $data['photo'];
                        $prenom = $data['prenom'];
                        $nom = $data['nom'];
                        $email=$data['email'];

                        echo '
                        <div class="card">
                            <img src="images/userImg_'.$id.'/'.$photo.'" alt="User">
                            <h2>' . $prenom . ' ' . $nom . '</h2>
                           <span>'.$email.'</span> 
                           <div class="card-buttons">
                                <a href="sendInvitation.php?id='.$id.'" class="invite-btn">Envoyer invitation</a>
                                <a href="#" class="invite-btn">Voir profile</a>
                            </div>
                        </div>';
                    }
                }
                ?>
            </div>
            <div id="friend_div">
                    <div id="friend_header" >
                    amies
                        <button id="toggleButton" onclick="toggleFriendsDiv()">x</button>
                        </div>
                        <div id="friendContainer">
                           
                        </div>
                    </div>
            </div>
            <div id="chat_box"  >
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


  <script > function openChatBox(friendId) {
        let nomUser =document.getElementById(friendId);
    
        currentFriendId = friendId;
        let chatBox = document.getElementById("chat_box");
         chatBox.style.display = "block";
       
            let divNomHeader = document.getElementById("chat_friend_name");
            divNomHeader.innerHTML = nomUser.innerText;
        // Vérifie après 100ms si le chat est toujours affiché
       
        loadMessages(friendId);
        interval =setInterval(loadFriendList,5000);
       
    }

</script>
<script src="script.js"></script>