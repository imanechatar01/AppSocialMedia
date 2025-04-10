<?php 

include("conn.php");
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Facebook</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="posts.css">


</head>
<body>
     <!-- Navbar -->
     <div class="navbar">
    <div class="user-info-a">
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
        <div class="main-content">
    <div class="container2">
    <div class="post-creator">
    <div class="user-info">
        <img src="images/userImg_<?php echo $_SESSION['id'].'/'. $_SESSION['photo'];?>" alt="Photo de profil" class="user-avatar" id="currentUserAvatar">
        <strong id="currentUsername"><?php echo $_SESSION['prenom'].' '.$_SESSION['nom'];?></strong>
    </div>
    <form method="post" action="insertPost.php" enctype="multipart/form-data">
        <textarea class="post-input" name="text" id="postText" placeholder="Qu'avez-vous en tête ?"></textarea>
        <img id="imagePreview" class="image-preview" alt="Aperçu de l'image">
        <div class="post-actions">
            <label class="file-upload" id="fileLabel">
                <i class="fas fa-image"></i>
                Photo
                <input type="file" name="photo" id="imageUpload" accept="image/png, image/jpeg">
            </label>
            <button type="submit" class="post-btn" id="postButton" disabled>Publier</button>
        </div>
    </form>
</div>

        <div id="postsContainer"></div>
        
        <div class="loading-spinner" id="loadingSpinner">
            <i class="fas fa-circle-notch fa-spin fa-2x"></i>
        </div>
    </div>
  </div>  


    <script>
       

        // Utilisateur actuel
        const currentUser = {
            id: <?php echo $_SESSION['id']; ?>,
            name: "<?php echo $_SESSION['prenom'].' '.$_SESSION['nom']; ?>",
            avatar: "images/userImg_<?php echo $_SESSION['id'].'/'. $_SESSION['photo']; ?>"
        };
        
        // Variable pour stocker l'ID de l'utilisateur courant
     
        
        // Fonction pour créer une requête XMLHttpRequest
       
        function setupPostSubmission() {
    // 1. Récupération des éléments du DOM
    const postText = document.getElementById('postText');
    const postButton = document.getElementById('postButton');
    const imageUpload = document.getElementById('imageUpload');
    const imagePreview = document.getElementById('imagePreview');
    const loadingSpinner = document.getElementById('loadingSpinner');

    // 2. Validation dynamique du bouton
    function validateButton() {
        const hasText = postText.value.trim() !== '';
        const hasImage = imageUpload.files.length > 0;
        postButton.disabled = !(hasText || hasImage);
    }

    // 3. Prévisualisation de l'image
    imageUpload.addEventListener('change', function() {
        if (this.files[0]) {
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(this.files[0]);
        }
        validateButton();
    });

    // 4. Écouteur de saisie de texte
    postText.addEventListener('input', validateButton);

    // 5. Soumission avec XMLHttpRequest
    
        }
// Initialisation au chargement de la page
document.addEventListener('DOMContentLoaded', setupPostSubmission);
    
        // Valider le bouton de publication
        function validatePostButton() {
            const postText = document.getElementById('postText').value.trim();
            const imageUpload = document.getElementById('imageUpload');
            const postButton = document.getElementById('postButton');
            
            if (postText !== '' || (imageUpload.files && imageUpload.files.length > 0)) {
                postButton.disabled = false;
            } else {
                postButton.disabled = true;
            }
        }
        
        // Charger les publications depuis le serveur
        document.addEventListener("DOMContentLoaded", function () {
    loadPosts();
});

function loadPosts() {
    const postsContainer = document.getElementById('postsContainer');
    const loadingSpinner = document.getElementById('loadingSpinner');

    // Afficher le spinner de chargement
    loadingSpinner.style.display = 'block';

    let xhr = new XMLHttpRequest();
 
    xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
        loadingSpinner.style.display = 'none';
        
        if (xhr.status === 200) {
            try {
                // Check if response starts with < (HTML)
                if (xhr.responseText.trim().startsWith('<')) {
                    console.error("Received HTML instead of JSON:", xhr.responseText);
                    return;
                }
                
                const posts = JSON.parse(xhr.responseText);
                renderPosts(posts);
                loadingSpinner.style.display = 'none';
            } catch (error) {
                console.error("JSON Parsing Error:", error);
                console.log("Server Response:", xhr.responseText);
            }
        } else {
            console.error("Request failed with status:", xhr.status);
        }
    }
};
    xhr.open("GET", "loadPosts.php", true);
    xhr.send();
}

interval = setInterval(loadPosts, 30000); // Toutes les 30 secondes
// Afficher les publications dans le conteneur
function renderPosts(posts) {
    const postsContainer = document.getElementById('postsContainer');
    postsContainer.innerHTML = '';

    posts.forEach(post => {
        const postElement = createPostElement(post);
        postsContainer.appendChild(postElement);
        
        // Load comments for this post
        loadComments(post.id);
    });
    
    // Attach event listeners for commenting and liking
    attachCommentEventListeners();
}
function attachCommentEventListeners() {
    document.querySelectorAll('.send-comment-btn').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.dataset.postId;
            const inputField = document.getElementById(`commentInput-${postId}`);
            const commentText = inputField.value.trim();

            if (commentText !== "") {
                addComment(postId, commentText, inputField);
            }
        });
    });
    
    
    document.querySelectorAll('.comment-input').forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const postId = this.dataset.postId;
                const commentText = this.value.trim();
                
                if (commentText !== "") {
                    addComment(postId, commentText, this);
                }
            }
        });
    });
}

// Créer un élément de publication
function createPostElement(post) {
    const postDiv = document.createElement('div');
    postDiv.className = 'post';
    postDiv.dataset.postId = post.id;

    let postHTML = `
        <div class="post-header">
            <img src="${post.user.avatar}" alt="Photo de profil" class="user-avatar">
            <div class="post-user-info">
                <p class="post-username">${post.user.name}</p>
                <p class="post-time">${formatTimestamp(post.timestamp)}</p>
            </div>
        </div>
        <div class="post-content">${post.content}</div>
    `;

    // Ajouter l'image si elle existe
    if (post.image) {
        postHTML += `<img src="${post.image}" alt="Image de la publication" class="post-image">`;
    }
     
    // Ajouter les statistiques et les boutons d'interaction
   // Dans createPostElement, modifiez la partie interactions :
    postHTML += `
    <div class="post-footer">
        <div class="post-stats">
            <div>
                <i class="fas fa-thumbs-up" style="color: #1877f2;"></i>
                <span id="likeCount-${post.id}">${post.likes}</span>
            </div>
            <div>
                <span id="commentCount-${post.id}">${post.comments ? post.comments.length : 0} commentaires</span>
            </div>
        </div>
        <div class="interaction-buttons">
            <div class="interaction-button like-button ${post.liked ? 'liked' : ''}" data-post-id="${post.id}">
                <i class="fas fa-thumbs-up"></i> J'aime
            </div>
            <div class="interaction-button comment-button" data-post-id="${post.id}">
                <i class="far fa-comment"></i> Commenter
            </div>
            
        </div>
        <div class="comments-section" id="comments-${post.id}">
`;

// Ajouter les commentaires existants (si la liste n'est pas vide)
if (post.comments && post.comments.length > 0) {
    post.comments.forEach(comment => {
        postHTML += `
            <div class="comment">
                <img src="${comment.user.avatar}" alt="Photo de profil" class="user-avatar" style="width: 32px; height: 32px;">
                <div class="comment-content">
                    <div class="comment-username">${comment.user.name}</div>
                    <p class="comment-text">${comment.content}</p>
                </div>
            </div>
        `;
    });
} 

// Ajouter la section pour saisir un nouveau commentaire
postHTML += `
        </div>
        <div class="new-comment">
            <img src="${currentUser?.avatar || 'default-avatar.jpg'}" alt="Photo de profil" class="user-avatar" style="width: 32px; height: 32px;">
            <input type="text" id="commentInput-${post.id}" class="comment-input" placeholder="Écrivez un commentaire..." data-post-id="${post.id}">
            <button class="send-comment-btn" data-post-id="${post.id}">Envoyer</button>
        </div>
    </div>
`;
    
    postDiv.innerHTML = postHTML;
    
    // Ajouter le gestionnaire d'événement pour les likes
    const likeButton = postDiv.querySelector('.like-button');
likeButton._hasLiked = false; // État initial

likeButton.addEventListener('click', function() {
    this._hasLiked = !this._hasLiked; // Basculer l'état
    handleLike(post.id, this);
});
    

    // Dans createPostElement, après avoir créé le HTML:

    return postDiv;
}
// Fonction pour formater la date (exemple)
function formatTimestamp(timestamp) {
    const date = new Date(timestamp);
    return date.toLocaleString(); // Affichage de la date locale
}



function handleLike(postId, button) {
    const postElement = button.closest('.post');
    const likeCountElement = postElement.querySelector(`#likeCount-${postId}`);
    const icon = button.querySelector('i');

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `likePost.php?postId=${postId}`, true);
    
    xhr.onload = function() {
        if (this.status === 200) {
            try {
                const response = JSON.parse(this.responseText);
                
                if (response.success) {
                    // Mettre à jour le compteur
                    if (likeCountElement) {
                        likeCountElement.textContent = response.newLikeCount;
                    }
                    
                    // Basculer l'état visuel
                    button.classList.toggle('liked');
                    
                    // Changer l'icône
                    icon.className = (response.action === 'liked') 
                        ? 'fas fa-thumbs-up' 
                        : 'far fa-thumbs-up';
                }
            } catch (e) {
                console.error('Erreur de parsing JSON:', e);
            }
        }
    };
    
    xhr.onerror = function() {
        console.error('Erreur de réseau');
    };
    
    xhr.send();
}


function addComment(postId, commentText, inputField) {
    console.log("Post ID:", postId, "Comment:", commentText); // Vérifier que les données sont correctes

    // Prevent empty comments
    if (!commentText.trim()) {
        return;
    }

    const formData = new FormData();
    formData.append("postId", postId);
    formData.append("comment", commentText);

    fetch("addComment.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log("Response from server:", data); // Debug

        if (data.success) {
            // Get the comment section
            const commentSection = document.querySelector(`#comments-${postId}`);
            
            // Remove "no comments" message if it exists
            const noCommentsMsg = commentSection.querySelector('.no-comments');
            if (noCommentsMsg) {
                noCommentsMsg.remove();
            }
            
            // Create new comment element
            const newComment = document.createElement("div");
            newComment.classList.add("comment");
            newComment.innerHTML = `
                <img src="${currentUser.avatar}" alt="Photo de profil" class="user-avatar" style="width: 32px; height: 32px;">
                <div class="comment-content">
                    <div class="comment-username">Moi</div>
                    <p class="comment-text">${data.comment.comment}</p>
                </div>
            `;
            
            // Add the new comment to the comment section
            commentSection.appendChild(newComment);

            // Update the comment count
            const commentCount = document.getElementById(`commentCount-${postId}`);
            if (commentCount) {
                const currentCount = parseInt(commentCount.textContent);
                commentCount.textContent = `${currentCount + 1} commentaires`;
            }
            
            // Clear the input field
            if (inputField) {
                inputField.value = '';
            }
        } else {
            alert(data.message || "Erreur lors de l'ajout du commentaire");
        }
    })
    .catch(error => console.error("Erreur :", error));
}
function loadComments(postId) {
    fetch(`getComments.php?postId=${postId}`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update comment count
            const commentCount = document.getElementById(`commentCount-${postId}`);
            if (commentCount) {
                commentCount.textContent = `${data.comment_count} commentaires`;
            }
            
            // Use the correct selector to match your HTML structure
            const commentSection = document.querySelector(`#comments-${postId}`);
            
            if (!commentSection) {
                console.error(`Comment section #comments-${postId} not found`);
                return;
            }
            
            // Clear existing comments
            commentSection.innerHTML = "";
            
            // Add each comment with the same structure used elsewhere
            data.comments.forEach(comment => {
                const commentDiv = document.createElement("div");
                commentDiv.classList.add("comment");
                commentDiv.innerHTML = `
                    <img src="Images/userImg_${comment.user_id}/${comment.avatar}" alt="Photo de profil" class="user-avatar" style="width: 32px; height: 32px;">
                    <div class="comment-content">
                        <div class="comment-username">${comment.username}</div>
                        <p class="comment-text">${comment.comment}</p>
                    </div>
                `;
                commentSection.appendChild(commentDiv);
            });
            
          
        }
    })
    .catch(error => console.error("Erreur de chargement des commentaires:", error));
}

// Charger les commentaires lors du chargement de la page
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".comments-section").forEach(section => {
        const postId = section.id.split("-")[1]; 
        loadComments(postId);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Créer le bouton toggle si pas déjà présent
    if (!document.querySelector('.sidebar-toggle')) {
        const toggleButton = document.createElement('button');
        toggleButton.className = 'sidebar-toggle';
        toggleButton.innerHTML = '☰';
        document.body.appendChild(toggleButton);
        
        // Gérer le clic sur le bouton
        toggleButton.addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            
            if (document.body.classList.contains('sidebar-hidden')) {
                // Afficher la sidebar
                document.body.classList.remove('sidebar-hidden');
                toggleButton.innerHTML = '☰';
            } else if (sidebar.classList.contains('expanded')) {
                // Cacher la sidebar
                document.body.classList.add('sidebar-hidden');
                sidebar.classList.remove('expanded');
                toggleButton.innerHTML = '☰';
            } else {
                // Étendre la sidebar
                sidebar.classList.add('expanded');
                toggleButton.innerHTML = '×';
            }
        });
    }
});
</script>
</body>
</html>