<?php 
session_start();
include("conn.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];
$sql = "SELECT * FROM db_user WHERE id = '$id'";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);

// Formatage de la date de naissance (si elle existe)
$date_naissance = '';
if (!empty($user['date_naissance'])) {
    $date_obj = new DateTime($user['date_naissance']);
    $date_naissance = $date_obj->format('d/m/Y');
}

// Détermination du genre à afficher
$genre = '';
if ($user['genre'] == 'M') {
    $genre = 'Masculin';
} elseif ($user['genre'] == 'F') {
    $genre = 'Féminin';
} else {
    $genre = 'Non spécifié';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="espaceEtudiant.css">
    <style>
        /* Styles spécifiques à la page de profil */
        .profile-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .profile-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
        }
        
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #f0f0f0;
            margin-bottom: 20px;
        }
        
        .profile-info {
            margin: 20px 0;
            text-align: left;
            padding: 0 20px;
        }
        
        .info-item {
            margin: 15px 0;
            font-size: 16px;
            display: flex;
            align-items: center;
        }
        
        .info-item i {
            color: #1877f2;
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }
        
        .info-label {
            font-weight: bold;
            min-width: 120px;
            display: inline-block;
        }
        
        .edit-btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #1877f2;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
            margin-top: 20px;
        }
        
        .edit-btn:hover {
            background-color: #166fe5;
        }
        
        @media (max-width: 768px) {
            .info-item {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .info-label {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="user-info">
            <?php 
               echo '<img src="images/userImg_'.$_SESSION['id'].'/'.$_SESSION['photo'].'" alt="User">';
            ?>
            <span class="user-name"><?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']; ?></span>
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
            <div class="profile-container">
                <div class="profile-card">
                    <img src="images/userImg_<?php echo $user['id']; ?>/<?php echo $user['photo']; ?>" alt="Photo de profil" class="profile-img">
                    <h2><?php echo $user['prenom'] . " " . $user['nom']; ?></h2>
                    
                    <div class="profile-info">
                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <span class="info-label">Email:</span>
                            <span><?php echo $user['email']; ?></span>
                        </div>
                        
                        <?php if (!empty($date_naissance)): ?>
                        <div class="info-item">
                            <i class="fas fa-birthday-cake"></i>
                            <span class="info-label">Date de naissance:  </span>
                            <span><?php echo '     '.$date_naissance; ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($user['adresse'])): ?>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span class="info-label">Adresse:</span>
                            <span><?php echo $user['adresse']; ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <div class="info-item">
                            <i class="fas fa-venus-mars"></i>
                            <span class="info-label">Genre:  </span>
                            <span><?php echo  $genre; ?></span>
                        </div>
                    </div>
                    
                    <a href="UpdateForm.php" class="edit-btn">
                        <i class="fas fa-edit"></i> Modifier le profil
                    </a>
                </div>
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
    </div>
    <script src="script.js"></script>
</body>
</html>