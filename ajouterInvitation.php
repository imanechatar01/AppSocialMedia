<?php 
include("conn.php");
session_start();
$id1= $_SESSION['id'];
$id2= $_GET['id'];
$sql="insert into amie (id1, id2, etat) values('$id1', '$id2', 'active')";
$result = mysqli_query($con,$sql);
if(mysqli_errno($con)) {
    echo "erreur de insertion".mysqli_error($con);
}else{
    header("location:receivedInvitation.php");
}
?>