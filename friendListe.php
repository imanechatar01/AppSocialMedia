<?php
include("conn.php");
session_start();
/*______________________________________*/
while($data=mysqli_fetch_array($result)) {  
    echo '<li>'
    .$data['nom'].' '.$data['prenom'].'
    </li>';
}
