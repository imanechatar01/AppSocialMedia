<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    include("conn.php");

   
     $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $date_nai = $_POST['date'];
    $Pass = md5($_POST['pasword']);
    $genre = $_POST['genre'];
    $role = $_POST['role'];
   
    $adress = $_POST['adress'];

    
    if (isset ($_FILES['photo'] )&&($_FILES['photo']['type'] == 'image/png' || $_FILES['photo']['type'] == 'image/jpeg')  && $_FILES['photo']['error'] ==0 && $_FILES['photo']['size']< 1000000  ){
        $photo = $_FILES['photo']['name'] ;
        $sql="INSERT INTO `db_user` (`id`, `nom`, `prenom`, `email`, `date_naissance`, `pasword`, `genre`,  `adress` , `photo`, `role`)
        VALUES (NULL, '$nom', '$prenom', '$email', '$date_nai', '$Pass', '$genre',   '$adress' , '$photo', '$role') ";
        if (mysqli_query($con, $sql)){
            
        
            $insertedId = mysqli_insert_id($con);
            $nameImg = 'userImg_'.$insertedId;
            $userDir = 'images/'.$nameImg ;
            mkdir($userDir);
            $source = $_FILES['photo']['tmp_name'];
            $destination = $userDir .'/'.$photo;
            move_uploaded_file($source ,$destination);
            header("location:loginForm.php");
        } else {
            echo "Erreur : " . mysqli_error($con); // Si l'insertion échoue
        }
        
       
    }else{
        $photo = "noimage.jpeg";
        $sql="INSERT INTO `db_user` (`id`, `nom`, `prenom`, `email`, `date_naissance`, `pasword`, `genre`,  `adress` , `photo`, `role`)
        VALUES (NULL, '$nom', '$prenom', '$email', '$date_nai', '$Pass', '$genre',   '$adress' , '$photo', '$role') ";
         $insertedId = mysqli_insert_id($con);
         $nameImg = 'userImg_'.$insertedId;
         $userDir = 'images/'.$nameImg ;
         mkdir($userDir);
         $source = $_FILES['photo']['tmp_name'];
         move_uploaded_file($source ,$userDir);
    }
 
    mysqli_close($con);
                 


 
    
    ?>

</body>
</html>