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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

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
            
            <?php 
            $id= $_SESSION['id'];

            $sql="SELECT d.* FROM amie a INNER JOIN db_user d ON (a.id1 = d.id OR a.id2 = d.id) 
                 WHERE (a.id1 = '$id' OR a.id2 = '$id') 
                    AND d.id <> '$id'";
            $result=mysqli_query($con,$sql);
                    echo '<table border =1>';
            while($data=mysqli_fetch_array($result)){

                $nom = $data['nom'];
                $prenom= $data['prenom'];
                $email= $data['email'];
                $photo =$data['photo'];
                

                echo '
                <tr> 
                <td><img src="images/userImg_'.$data['id'].'/'.$photo.'" alt="User" width=40px></td><td>'.$prenom.' '.$nom.'</td><td>'.$email.'</td>
                <td><a href="bloquerFriend.php?idFriend='.$data['id'].'"    class="swal-confirm">Bloquer</a></td><td><a href="messagesSection.php?id='.$data['id'].'" >contacter</a></td>
                </tr>';
                
            }
            echo '</table>';

                
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
   
    <script>
 document.querySelectorAll('.swal-confirm').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
        const href = this.href;
        
        Swal.fire({
            title: 'Confirmation',
            text: 'Êtes-vous sûr de vouloir bloquer <?php echo $prenom.' '.$nom ; ?>?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, bloquer !',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    });
});
</script>
<style>
/* Style général du tableau */

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Style des lignes */
tr {
    border-bottom: 1px solid #ddd;
    transition: background 0.3s ease-in-out;
}

/* Effet au survol */
tr:hover {
    background: #f0f2f5;
}

/* Style des cellules */
td {
    padding: 12px;
    font-family: Arial, sans-serif;
    font-size: 14px;
    color: #050505;
    text-align: center;
}

/* Image de profil */
td img {
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e4e6eb;
}

/* Liens */
td a {
    text-decoration: none;
    color: #1877f2;
    font-weight: bold;
}

td a:hover {
    text-decoration: underline;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    table {
        display: block;
        overflow-x: auto; /* Ajoute un défilement horizontal si nécessaire */
        white-space: nowrap;
    }
    
    /* Réduire la taille des images */
    td img {
        width: 30px;
        height: 30px;
    }

    /* Réduire la taille du texte */
    td {
        font-size: 12px;
        padding: 8px;
    }
}

/* Mode ultra compact sur petits écrans */
@media screen and (max-width: 480px) {
    table {
        display: block;
        width: 100%;
    }

    /* Afficher chaque ligne sous forme de carte */
    tr {
        display: flex;
        flex-direction: column;
        padding: 10px;
        border-radius: 8px;
        background: #fff;
        margin-bottom: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    td {
        display: block;
        text-align: center;
        border-bottom: none;
        padding: 5px;
    }

    /* Réduire la taille de l'image */
    td img {
        width: 40px;
        height: 40px;
    }

    /* Réorganiser les boutons */
    td a {
        display: inline-block;
        margin: 5px;
        padding: 5px 10px;
        background: #1877f2;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-size: 12px;
    }

    td a:hover {
        background: #145dbf;
    }
}


</style>
<script src="script.js"></script>
</body>
</html>
