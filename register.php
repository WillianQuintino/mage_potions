<?php
// Include config in code
include_once 'src/config/db.config';
include_once 'src/config/site.config';

//Include funtions in code
include_once 'src/functions/db.php';
include_once 'src/functions/security.php';
include_once 'src/functions/mail.php';

$issetPost = true;

if (!isset($_POST['nicknamePost'])) {
  $issetPost = false;
  echo "Erro:Insira Nickname|";
}
if (!isset($_POST['passwordPost'])) {
  $issetPost = false;
  echo "Erro:Insira Password|";
} else {
  if (8 > strlen($_POST['passwordPost'])) {
    $issetPost = false;
    echo "Erro:Senha Curta|";
  }
  if (!isset($_POST['emailPost'])) {
    $issetPost = false;
    echo "Erro:Insira o email|";
  }
  if (!isset($_POST['namePost'])) {
    $issetPost = false;
    echo "Erro:Insira Nickname|";
  }
  //make a key for encrypt
  if (isset($_POST['keyPost'])) {
    $key = $_POST['keyPost'];
  } else {
    if (isset($_POST['nicknamePost']) AND isset($_POST['passwordPost'])) {
                    $key = makeKey($_POST['nicknamePost'], $_POST['passwordPost']);
    }
  }

  if ($issetPost AND isset($_POST['nicknamePost'])) {


    //encrypt $_POST['nicknamePost'] and $_POST['passwordPost']
    $_POST['nicknamePost'] = encrypt(str_replace(" ", "", $_POST['nicknamePost']), $key);
    $_POST['passwordPost'] = encrypt($_POST['passwordPost'], $key);
    $_POST['emailPost']    = encrypt(str_replace(" ", "", $_POST['emailPost']), $key);

    //start connection with db and return link
    $link = db_connection();

    //check $_POST['sendMailExeptionPost'] and atribution $sendMailExeption value 0 = not accept | 1 = accept
    if (isset($_POST['sendMailExeptionPost'])) {
      $sendMailExeption = 1;
    } else {
      $sendMailExeption = 0;
    }

    //Set variable for Conection sql
    $nickname    = decrypt($_POST['nicknamePost'], $key);
    $password    = $_POST['passwordPost'];
    $email       = decrypt($_POST['emailPost'], $key);
    $date_ts     = date();//time();
    $user_active = 0; //value 0 = not active | 1 = active

    if ($link) {
      //make sql code
      $sql = "INSERT INTO `users`(`id`, `nickname`, `password`, `email`, `user_active`, `key`, `date_ts`, `sendMailException`) VALUES(NULL,'" . $nickname . "','" . $password . "','" . $email . "','" . $user_active . "','" . $key . "','" . $date_ts . "','" . $sendMailExeption . "')";

      //query FROM users
      if (!mysqli_query($link, $sql)) {
        echo "Erro:Houve um erro inserindo o registro" . mysqli_error() . "|";
        mysqli_close($link);
      } else { // Register inser with success, send emailinserido com sucesso, mandar email

        $id = mysqli_insert_id($link);
        sendVerificationMail($id, $link);
        mysqli_close($link);

        echo "Registro inserido com sucesso|";
      }
    } else {
      echo 'Erro:Não Foi Possivel conectar com db!';
    }
  }
}
?>
