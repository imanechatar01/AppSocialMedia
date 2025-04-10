<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $server = 'localhost';
    $user = 'root';
    $password ='';
    $database ='users';

    $con =mysqli_connect($server,$user,$password,$database);
    
    if(mysqli_error($con)){
        echo"erreur dans connexion en ".mysqli_errno($con);
    }
   
    
    
  
    
    ?>
</body>
</html>