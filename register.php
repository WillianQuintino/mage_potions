<?php
  // Include config in code
  include_once 'src\config\db.config';
  include_once 'src\config\site.config';

  //Include funtions in code
  include_once 'src\functions\db.php';
  include_once 'src\functions\security.php';
  include_once 'src\functions\mail.php';

if(isset($_POST['nicknamePost']) AND isset($_POST['passwordPost']) AND isset($_POST['emailPost'])){

    //make a key for encrypt
    $key = makeKey($_POST['nicknamePost'], $_POST['passwordPost']);

    //encrypt $_POST['nicknamePost'] and $_POST['passwordPost']
    $_POST['nicknamePost'] = encrypt($_POST['nicknamePost'], $key);
    $_POST['passwordPost'] = encrypt($_POST['passwordPost'], $key);
    $_POST['emailPost'] = encrypt($_POST['emailPost'], $key);

    //start connection with db and return link
    $link = db_connection();

    //Set variable for Conection sql
    $nickname         = decrypt($_POST['nicknamePost'], $key);
    $password         = $_POST['passwordPost'];
    $name             = decrypt($_POST['namePost'], $key);
    $email            = decrypt($_POST['mailPost'], $key);
    $data_ts          = time( );
    $user_active      = 0; //value 0 = not active | 1 = active
    $sendMailExeption = $_POST['sendMailExeptionPost']; //value 0 = not accept | 1 = accept

    //make sql code
    $sql              = "INSERT INTO users(nickname,password,key,name,email,date_ts,user_active,sendMailExeption) ";
    $sql              = ."VALUES('".$nickname."','".$password."','".$key."','".$name."','".$email."','".$date_ts."','".$user_active."','".$sendMailExeption."')";


    if( ! mysqli_query( $link, $sql ) ) {
        echo "Houve um erro inserindo o registro ".mysqli_error( );
    } else { // Register inser with success, send emailinserido com sucesso, mandar email

        $id = mysqli_insert_id( $link );

          sendVerificationMail($id, $name, $email, $key, $date_ts);

          echo "Registro inserido com sucesso";

              }
          }
    //query FROM users
    $rs = mysqli_query($link, $sql);
}
?>
