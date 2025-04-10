
<?php 
     include("conn.php");
     session_start();

     $id =$_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $date_nai = $_POST['date'];
    $Pass = md5($_POST['pasword']);
    $genre = $_POST['genre'];
   
   
    $adress = $_POST['adress'];

    
    $sql = "UPDATE db_user SET 
    nom = '$nom', 
    prenom = '$prenom', 
    email = '$email', 
    date_naissance = '$date_nai', 
    pasword = '$Pass', 
    genre = '$genre', 
    
    
    adress = '$adress' 
    WHERE id = '$id' ;"; 
if (mysqli_query($con, $sql)) {
            $_SESSION['prenom']=$prenom;
             $_SESSION['nom']=$nom;
             
    header("location:userProfil.php");
    
} else {
    echo "Erreur : " . mysqli_error($con); // Si l'insertion échoue
}
mysqli_close($con);
     
 
    
    ?>