<?php
// Include config in code
include_once 'src\config\db.config';

//Include funtions in code
include_once 'src\funtions\db.php';
include_once 'src\funtions\security.php';

if(isset($_POST['nikenamePost']) AND isset($_POST['passwordPost']) AND isset($_POST['emailPost'])){

    //make a key for encrypt
    $key = makeKey($_POST['nikenamePost'], $_POST['passwordPost']);

    //encrypt $_POST['nikenamePost'] and $_POST['passwordPost']
    $_POST['nikenamePost'] = encrypt($_POST['nikenamePost'], $key);
    $_POST['passwordPost'] = encrypt($_POST['passwordPost'], $key);
    $_POST['emailPost'] = encrypt($_POST['emailPost'], $key);

    //start connection with db and return link
    $link = db_connection();

    $nikename         = decrypt($_POST['nikenamePost'], $key);
    $password         = $_POST['passwordPost'];
    $name             = decrypt($_POST['namePost'], $key);
    $email            = decrypt($_POST['mailPost'], $key);
    $data_ts          = time( );
    $user_active      = 0;
    $sendMailExeption = $_POST['sendMailExeptionPost'];

    $sql              = "INSERT INTO users(nikename,password,name,email,date_ts,user_active,sendMailExeption) ";
    $sql              = ."VALUES('".$nikename."','".$password."','".$name."','".$email."','".$date_ts."','".$user_active."','".$sendMailExeption."')";
    echo $sql;
    //query FROM users
    $rs = mysqli_query($link, $sql);
}
?>
