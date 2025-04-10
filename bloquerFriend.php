<?php
include("conn.php");
session_start();
$idFriend =  $_GET['idFriend'];
$id = $_SESSION['id'];
$sql="delete from amie where (id1 = '$id' or id1 = '$idFriend' ) and id2 = '$id' or id2 = '$idFriend'";
$result = mysqli_query($con, $sql);
if(mysqli_errno($con)) {
    echo "erreur de suppresion". mysqli_error($con);

}
else {
    header("location:amiesList.php");
}
?>