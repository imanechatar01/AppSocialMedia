<style>
    #friend_div{
        width: 250px;
        height: 200px;
        background-color: lightblue;
        border: 1px solide lightgray;
        position: fixed;
        bottom: 0;
        right: 0;
        display: block;
       
        
    }
    .friend_header{
        padding: 2px 4px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: antiquewhite;
    }
    .friend_header button{
            padding: 6px;

    }
</style>
<body onload="initialize()">
    
</body>
<div id="friend_div">
<div id="friend_header">
amies
       <button onclick="toggleFriendDiv()">test</button>
    </div>
    <div id="friendContainer">
        <h1>hi</h1>
    </div>
</div>
<script>
    var interval;
    function toggleFriendDiv(){
        let friendContainer = document.getElementById("friendContainer");
        if(friendContainer.style.dispay != "none"){
            friendContainer.style.display = "none";
        }else{
            friendContainer.style.display = "block";
        }
    }
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
    function initialize(){
       
        loadFriendList();
        interval =setInterval(loadFriendList,5000);
    }
</script>
</body>