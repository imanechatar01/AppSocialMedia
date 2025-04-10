var interval;
function toggleFriendsDiv() {
    let friendContainer = document.getElementById("friendContainer");
    let toggleButton = document.getElementById("toggleButton");
    let friendDiv = document.getElementById("friend_div");

    if (friendContainer.style.display !== "none") {
        friendContainer.style.display = "none";
        friendDiv.style.height = "40px"; // Réduit la hauteur
        toggleButton.textContent = "v";
        toggleButton.style.backgroundColor="green" // Change le bouton pour rouvrir
    } else {
        friendContainer.style.display = "block";
        friendDiv.style.height = "auto"; // Revient à la taille normale
        toggleButton.textContent = "x";
        toggleButton.style="backround_color: red; background-color: #e74c3c; color: white;border: none;padding: 6px 10px;border-radius: 4px;cursor: pointer;font-size: 14px;" // Change le bouton pour fermer;
    
}}

    function loadFriendList(){
        let url ="loadFriends.php";
        let xhr =new XMLHttpRequest();
        let divFriendContainer= document.getElementById('friendContainer');
        xhr.onreadystatechange=function(){
            if(xhr.readyState==4 && xhr.status==200){
                 divFriendContainer.innerHTML= xhr.responseText;

            }
        }
        xhr.open("get",url,true);
        xhr.send();



    }
    function init(){
       
        loadFriendList();
        
        interval =setInterval(loadFriendList,5000);
       
    }
   
    window.onload = function() {
        init();
    };
 
   
    


    var currentFriendId = null;

    interval = setInterval(loadFriendList, 30000); // Toutes les 30 secondes


    



    function loadMessages(friendId) {
        currentFriendId = friendId;  // 🔴 Stocke l'ID de l'ami sélectionné
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("chat_messages").innerHTML = xhr.responseText;
            }
        };
        xhr.open("GET", "messagesFriends.php?friend_id="+friendId, true);
        xhr.send();
    }
    setInterval(function() {
        if (currentFriendId) {  // 🔴 Vérifie qu'un ami est sélectionné
            loadMessages(currentFriendId);
        }
    }, 3000);
        

function sendMessage() {
    let messageText = document.getElementById("message_text").value;
    if (messageText.trim() === "") return;

    let xhr = new XMLHttpRequest();
    let formData = new FormData();
    formData.append("friend_id", currentFriendId);
    formData.append("message", messageText);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("message_text").value = "";
            loadMessages(currentFriendId); // Recharge les messages après envoi
        }
    };
    xhr.open("POST", "sendMessage.php", true);
    xhr.send(formData);
}
function autoResize(textarea) {
    textarea.style.height = "auto"; // Réinitialise la hauteur
    textarea.style.height = Math.min(textarea.scrollHeight, 100) + "px"; // Ajuste sans dépasser 100px
}


function closeChatBox() {
    document.getElementById("chat_box").style.display = "none";
}

let message_text = document.getElementById("message_text");
message_text.addEventListener("keydown" , function(action){
    if (action.key === "Enter") { // Vérifie si la touche est "Enter"
        sendMessage();
    }
   
});

// Améliorations pour la gestion de l'interface sur petits écrans

// Fonction pour détecter si l'écran est petit
function isSmallScreen() {
    return window.innerWidth <= 768;
}

// Fonction améliorée pour ouvrir le chat
function openChatBox(friendId) {
    let nomUser = document.getElementById(friendId);
    currentFriendId = friendId;
    
    let chatBox = document.getElementById("chat_box");
    chatBox.style.display = "block";
    chatBox.classList.add("active");
    
    let divNomHeader = document.getElementById("chat_friend_name");
    divNomHeader.innerHTML = nomUser.innerText;
    
    // Sur petit écran, masque la liste d'amis quand le chat est ouvert
    if (isSmallScreen()) {
        document.getElementById("friend_div").style.display = "none";
    }
    
    loadMessages(friendId);
    interval = setInterval(loadFriendList, 5000);
}

// Fonction améliorée pour fermer le chat
function closeChatBox() {
    let chatBox = document.getElementById("chat_box");
    chatBox.style.display = "none";
    chatBox.classList.remove("active");
    
    // Sur petit écran, réaffiche la liste d'amis quand le chat est fermé
    if (isSmallScreen()) {
        document.getElementById("friend_div").style.display = "block";
    }
}

// Fonction améliorée pour basculer la liste d'amis
function toggleFriendsDiv() {
    let friendContainer = document.getElementById("friendContainer");
    let toggleButton = document.getElementById("toggleButton");
    let friendDiv = document.getElementById("friend_div");

    if (friendContainer.style.display !== "none") {
        friendContainer.style.display = "none";
        friendDiv.style.height = "40px";
        toggleButton.textContent = "v";
        toggleButton.style.backgroundColor = "green";
    } else {
        friendContainer.style.display = "block";
        
        // Ajuste la hauteur en fonction de la taille d'écran
        if (isSmallScreen()) {
            friendDiv.style.height = "300px";
        } else {
            friendDiv.style.height = "auto";
        }
        
        toggleButton.textContent = "x";
        toggleButton.style = "background-color: #e74c3c; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer; font-size: 14px;";
    }
}

// Ajout d'un gestionnaire pour les changements d'orientation
window.addEventListener('resize', function() {
    // Ajuste l'interface selon la taille d'écran actuelle
    if (document.getElementById("chat_box").style.display === "block") {
        if (isSmallScreen()) {
            document.getElementById("friend_div").style.display = "none";
        } else {
            document.getElementById("friend_div").style.display = "block";
        }
    }
});

// Amélioration de la fonction init pour s'assurer que tout est bien initialisé
function init() {
    loadFriendList();
    
    // Ajuster la hauteur de la liste d'amis au démarrage
    if (isSmallScreen()) {
        let friendDiv = document.getElementById("friend_div");
        let friendContainer = document.getElementById("friendContainer");
        
        if (friendContainer.style.display !== "none") {
            friendDiv.style.height = "300px";
        } else {
            friendDiv.style.height = "40px";
        }
    }
    
    interval = setInterval(loadFriendList, 5000);
}

window.onload = function() {
    init();
};