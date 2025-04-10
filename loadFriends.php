<?php
include("conn.php");
session_start();
$id = $_SESSION['id'];

$sql="SELECT d.* FROM amie a INNER JOIN db_user d ON (a.id1 = d.id OR a.id2 = d.id) 
                 WHERE (a.id1 = '$id' OR a.id2 = '$id') 
                    AND d.id <> '$id'";
$result = mysqli_query($con,$sql);
if($result){
    while($data = mysqli_fetch_array($result)){
        $idDest=$data["id"];
        echo'<li><a id="'.$idDest.'"href="javascript:void(0);" onclick="openChatBox('.$idDest.')"> '.$data['nom'].' '.$data['prenom'].'</a></li>';}
}else{
    echo 'nothing';
}