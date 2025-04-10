<?php 
include("conn.php");
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fil d'actualités</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
    margin: 0;
    padding: 20px;
}

.container {
    width: 50%;
    margin: auto;
}

.post {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 15px;
    margin-bottom: 15px;
}

.post-header {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

.post-user strong {
    display: block;
    font-size: 14px;
}

.post-user span {
    font-size: 12px;
    color: gray;
}

.post-content p {
    font-size: 16px;
    margin: 10px 0;
}

.post-actions {
    display: flex;
    gap: 10px;
}

button {
    border: none;
    padding: 8px 12px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

.like-btn {
    background-color: #1877f2;
    color: white;
}

.share-btn {
    background-color: #42b72a;
    color: white;
}

</style>
<body>

    <div class="container">
        <div class="post">
            <div class="post-header">
                <img src="user-avatar.jpg" alt="Avatar" class="avatar">
                <div class="post-user">
                    <strong>Imane Chatar</strong>
                    <span>Il y a 5 minutes</span>
                </div>
            </div>
            <div class="post-content">
                <p>Bienvenue sur mon application de réseau social ! 🚀</p>
            </div>
            <div class="post-actions">
                <button class="like-btn">👍 J'aime</button>
                <button class="share-btn">🔄 Partager</button>
            </div>
        </div>

        <div class="post">
            <div class="post-header">
                <img src="user-avatar2.jpg" alt="Avatar" class="avatar">
                <div class="post-user">
                    <strong>Amina B.</strong>
                    <span>Il y a 10 minutes</span>
                </div>
            </div>
            <div class="post-content">
                <p>J'adore cette nouvelle fonctionnalité de partage 😍</p>
            </div>
            <div class="post-actions">
                <button class="like-btn">👍 J'aime</button>
                
            </div>
        </div>
    </div>

</body>
</html>
