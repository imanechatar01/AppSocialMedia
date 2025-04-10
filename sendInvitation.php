<?php
include("conn.php");
session_start();
$idDest = $_GET['id'];
$idExp =$_SESSION['id'];
$dateEnvoi =date("Y/m/d");
echo $idDest ." ".$idExp;
$sql1 = "select * from invitation where idDest = '$idDest' and idExp='$idExp'";
$result1 = mysqli_query($con,$sql1);
if(mysqli_num_rows($result1) > 0){
    header("location:espaceEtudiant.php");
}
else{$sql ="insert into invitation (idDest, idExp, dateEnvoi)values('$idDest', '$idExp','$dateEnvoi')";
$result = mysqli_query($con,$sql) ;
if(mysqli_errno($con)){
    echo "erreur".mysqli_error( $con )."";
}else{
    header("location:espaceEtudiant.php");
}
}
?>