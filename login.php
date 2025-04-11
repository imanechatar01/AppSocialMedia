<?php
session_start();
include("conn.php");
if(isset($_POST["email"]) ) {
    $email = $_POST["email"];
    $password = md5($_POST["password"]);
    $sql="select * from db_user where email = '$email' and pasword ='$password'";
    $result = mysqli_query($con, $sql);
    if(!$result){
        echo "Erreur de requête : " . mysqli_error($con);
    }
    else if(mysqli_num_rows($result)> 0) {

       $data=mysqli_fetch_assoc($result);
       $_SESSION["nom"]=$data['nom'];
       $_SESSION['prenom']=$data['prenom'];
       $_SESSION['photo']=$data['photo'];
       $_SESSION['id']=$data['id'];
       if($data['role']=='prof'){
        header("location:sendPostsForm.php");
       }
       else{
        header("location:sendPostsForm.php");
       }
    }else{
        echo "<script type='text/javascript'>
        alert('Email ou mot de passe incorrect');
        window.location.href = 'loginForm.php'; // Redirection vers la page de connexion
      </script>";
    }

}  else{
    header("location:loginForm.php");
    
}


   
?>

