<?php

// Include config in code
include_once 'src/config/db.config';

//Include funtions in code
include_once 'src/functions/db.php';
include_once 'src/functions/security.php';

$issetPost = true;

//start connection with db and return link
$link = db_connection();

if (!$link) {
    echo 'Erro:Não Foi Possivel conectar com db!|';
} else {
  if (!isset($_POST['nicknamePost'])) {
      $issetPost = false;
      echo "Erro:Insira Nickname|";
  }
  if (!isset($_POST['passwordPost'])) {
      $issetPost = false;
      echo "Erro:Insira Password|";
  }


  $sql = "SELECT `nickname`, `password`, `key`, `email` FROM `users` WHERE nickname='" . $_POST['nicknamePost'] . "' OR email='" . $_POST['nicknamePost'] . "'";
  $sql = mysqli_query( $link, $sql );
  $rs = mysqli_fetch_array( $sql );
  mysqli_close($link);



  if (isset($_POST['keyPost'])) {
      $key = $_POST['keyPost'];
  } else {
      $key = $rs['key'];
  }
  if ($issetPost) {

      //encrypt $_POST['nicknamePost'] and $_POST['passwordPost']
      $_POST['nicknamePost'] = encrypt($_POST['nicknamePost'], $key);
      $_POST['passwordPost'] = encrypt($_POST['passwordPost'], $key);
          //teste vars
          if ($rs['nickname'] === decrypt($_POST['nicknamePost'], $key)) {
              $validationNickname = true;
          } else {
            if($rs['email'] === decrypt($_POST['nicknamePost'], $key)){
              $validationNickname = true;
            }else{
              $validationPassword = false;
              echo "Erro:nickname Invalido!|";
            }
          }
          if (decrypt($rs['password'], $key) === decrypt($_POST['passwordPost'], $key)) {
              $validationPassword = true;
          } else {
              $validationPassword = false;
              echo "Erro:password Invalido!|";
          }
      }
      if ($validationNickname AND $validationPassword) {
          echo $rs['nickname'];
      }

}

?>
