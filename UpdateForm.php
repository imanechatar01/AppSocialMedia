<?php
session_start();
include("conn.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];
$sql = "SELECT * FROM db_user WHERE id='$id'";
$result = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($result);

// Formatage de la date pour l'input date
$formatted_date = !empty($data['date_naissance']) ? date('Y-m-d', strtotime($data['date_naissance'])) : '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="espaceEtudiant.css">
    <style>
        /* Styles existants de votre espaceEtudiant.css */
        

        /* Styles spécifiques au formulaire */
        .profile-form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .profile-form {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .form-group label {
            width: 150px;
            font-weight: bold;
            margin-right: 15px;
        }

        .form-control {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            min-width: 200px;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .radio-group {
            display: flex;
            gap: 15px;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #1877f2;
            color: white;
        }

        .btn-primary:hover {
            background-color: #166fe5;
        }

        .btn-danger {
            background-color: #f44336;
            color: white;
        }

        .btn-danger:hover {
            background-color: #d32f2f;
        }

        .profile-picture-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #f0f0f0;
        }

        @media (max-width: 768px) {
            .form-group label {
                width: 100%;
                margin-bottom: 5px;
            }
            
            .form-control {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="user-info">
            <img src="images/userImg_<?php echo $_SESSION['id']; ?>/<?php echo $_SESSION['photo']; ?>" alt="User">
            <span class="user-name"><?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']; ?></span>
        </div>
        <a href="logout.php" class="logout">Déconnexion</a>
    </div>

    <!-- Contenu principal -->
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="espaceEtudiant.php"><i class="fas fa-home"></i> Accueil</a>
            <a href="searchFriend.php"><i class="fas fa-search"></i> Chercher</a>
            <a href="receivedInvitation.php"><i class="fas fa-user-plus"></i> Invitations</a>
            <a href="messagesSection.php"><i class="fas fa-envelope"></i> Messages</a>
            <a href="amiesList.php"><i class="fas fa-users"></i> Amis</a>
            <a href="userProfil.php"><i class="fas fa-user"></i> Profil</a>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="profile-form-container">
                <form action="Update.php" method="post" class="profile-form" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    
                    <div class="profile-picture-container">
                        <img src="images/userImg_<?php echo $id; ?>/<?php echo $data['photo']; ?>" alt="Photo de profil" class="profile-picture">
                    </div>
                    
                    <div class="form-group">
                        <label for="nomId">Nom</label>
                        <input type="text" name="nom" id="nomId" class="form-control" value="<?php echo htmlspecialchars($data['nom']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="prenomId">Prénom</label>
                        <input type="text" name="prenom" id="prenomId" class="form-control" value="<?php echo htmlspecialchars($data['prenom']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="emailId">Email</label>
                        <input type="email" name="email" id="emailId" class="form-control" value="<?php echo htmlspecialchars($data['email']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="dateId">Date de Naissance</label>
                        <input type="date" name="date" id="dateId" class="form-control" value="<?php echo $formatted_date; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="paswordId">Mot de passe</label>
                        <input type="password" name="pasword" id="paswordId" class="form-control" placeholder="password">
                    </div>
                    
                    <div class="form-group">
                        <label>Genre</label>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input type="radio" name="genre" value="M" <?php echo ($data['genre'] == 'M') ? 'checked' : ''; ?>> Masculin
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="genre" value="F" <?php echo ($data['genre'] == 'F') ? 'checked' : ''; ?>> Féminin
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="file">Photo de profil</label>
                        <input type="file" name="photo" id="file" class="form-control" accept="image/*">
                    </div>
                    
                    <div class="form-group">
                        <label for="adressId">Adresse</label>
                        <textarea name="adress" id="adressId" class="form-control"><?php echo htmlspecialchars($data['adress']); ?></textarea>
                    </div>
                    
                    <div class="form-actions">
                        <button type="reset" class="btn btn-danger">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>