<?php
// Include config in code
include_once 'src\config\db.config';

//Include funtions in code
include_once 'src\funtions\db.php';
include_once 'src\funtions\security.php';

if(isset($_POST['nikenamePost']) AND isset($_POST['passwordPost']) AND isset($_POST['emailPost'])){
    echo $_POST['nikenamePost']." -|- ".$_POST['passwordPost']." -|- ".$_POST['emailPost']."</br>";
    //make a key for encrypt
    $key = makeKey($_POST['nikenamePost'], $_POST['passwordPost']);

    echo $key."</br>";
    //encrypt $_POST['nikenamePost'] and $_POST['passwordPost']
    $_POST['nikenamePost'] = encrypt($_POST['nikenamePost'], $key);
    $_POST['passwordPost'] = encrypt($_POST['passwordPost'], $key);
    $_POST['emailPost'] = encrypt($_POST['emailPost'], $key);

    echo $_POST['nikenamePost']." -|- ".$_POST['passwordPost']." -|- ".$_POST['emailPost']."</br>";
    //start connection with db and return link
    $link = db_connection();

    if ($link){
      echo 'connection ok!</br>';
    }else{
      echo 'erro connection!</br>';
    }
    //query FROM users
    $rs = mysqli_query($link, "INSERT INTO users(nikename,password,email) VALUES('". decrypt($_POST['nikenamePost'], $key) ."','". $_POST['passwordPost'] ."','". decrypt($_POST['emailPost'], $key) ."')");
}
?>
