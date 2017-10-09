<?php

// Include config in code
include_once 'src/config/db.config';

//Include funtions in code
include_once 'src/functions/db.php';
include_once 'src/functions/security.php';

  $issetPost = true;

  if(!isset($_POST['nicknamePost'])){
    $issetPost = false;
    echo "Erro:Insira Nickname|";
  }
  if(!isset($_POST['passwordPost'])){
    $issetPost = false;
    echo "Erro:Insira Password|";
  }
  if (isset($_POST['keyPost']))
  {
    $key = $_POST['keyPost'];
  }else{
    if(isset($_POST['nicknamePost']) AND isset($_POST['passwordPost'])){
      $key = makeKey($_POST['nicknamePost'], $_POST['passwordPost']);
    }

  }

  if($issetPost AND isset($_POST['nicknamePost'])){

    //encrypt $_POST['nicknamePost'] and $_POST['passwordPost']
    $_POST['nicknamePost'] = encrypt($_POST['nicknamePost'], $key);
    $_POST['passwordPost'] = encrypt($_POST['passwordPost'], $key);

    //start connection with db and return link
    $link = db_connection();

    if(!$link){
      echo 'Erro:Não Foi Possivel conectar com db!|';
    }else{

      //query FROM users
      if( !mysqli_query( $link, "SELECT nickname,password FROM users WHERE nickname='".decrypt($_POST['nicknamePost'], $key)."' OR email='".decrypt($_POST['nicknamePost'], $key)."'")  ) {
          echo "Erro:Não Foi Possivel conectar tabela do db!".mysqli_error()."|";
          mysqli_close($link);
      } else {

        $rs = mysqli_fetch_assoc($rs);
        mysqli_close($link);
        //teste vars
        if ($rs['nickname']===decrypt($_POST['nicknamePost'], $key )){
          $validationNickname = true;
        } else {
          $validationPassword = false;
          echo "Erro:nickname Invalido!|";
        }
        if (decrypt($rs['password'], $key)===decrypt($_POST['passwordPost'], $key)){
          $validationPassword = true;
        } else {
          $validationPassword = false;
          echo "Erro:password Invalido!|";
        }
      }
      if($validationNickname AND $validationPassword){
          echo $rs['nickname'];
      }
    }

  }

?>
