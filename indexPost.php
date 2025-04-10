<?php
include("conn.php");
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Publication</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Reset et styles de base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            line-height: 1.6;
        }

        .post-container {
            width: 100%;
            max-width: 500px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .post-header {
            background-color: #2ecc71;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
        }

        .profile-info {
            display: flex;
            align-items: center;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
        }

        .privacy-select {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .post-form {
            padding: 20px;
        }

        .post-textarea {
            width: 100%;
            height: 150px;
            resize: none;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .post-textarea:focus {
            outline: none;
            border-color: #2ecc71;
            box-shadow: 0 0 0 2px rgba(46, 204, 113, 0.2);
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .media-actions {
            display: flex;
            gap: 15px;
        }

        .media-actions button {
            background: none;
            border: none;
            color: #7f8c8d;
            cursor: pointer;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .media-actions button:hover {
            color: #2ecc71;
        }

        .post-button {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .post-button:hover {
            background-color: #27ae60;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .post-container {
                width: 95%;
                margin: 10px;
            }

            .form-actions {
                flex-direction: column;
                gap: 10px;
            }

            .media-actions {
                width: 100%;
                justify-content: space-between;
            }

            .post-button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="post-container">
        <div class="post-header">
            <div class="profile-info">
                <div class="profile-icon">
                    <i class="fas fa-user"></i>
                </div>
                <span>GeeksforGeeks</span>
            </div>
            <select class="privacy-select">
                <option>Amis</option>
                <option>Public</option>
                <option>Moi uniquement</option>
            </select>
        </div>

        <form id="postForm" enctype="multipart/form-data">
            <textarea id="postContent" placeholder="Quoi de neuf ?"></textarea>
            <input type="file" id="postImage" name="postImage" accept="image/*">
            <button type="button" onclick="publishPost()">Publier</button>
        </form>
    </div>

    <script>
        function publishPost() {
    let content = document.getElementById("postContent").value;
    let image = document.getElementById("postImage").files[0];

    if (content.trim() === "" && !image) {
        alert("Veuillez saisir du texte ou ajouter une image.");
        return;
    }

    let formData = new FormData();
    formData.append("action", "add");
    formData.append("content", content);

    if (image) {
        formData.append("postImage", image);
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "post_handler.php", true);

    // Gestion de la réponse
   

    xhr.send(formData);
}

    </script>
</body>
</html>
