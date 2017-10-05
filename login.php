<?php

  // Include config in code
  include_once 'src\config\db.config';

  //Include funtions in code
  include_once 'src\funtions\db.php';
  include_once 'src\funtions\security.php';

  if(isset($_POST['nicknamePost']) AND isset($_POST['passwordPost'])){

    //make a key for encrypt
    $key = makeKey($_POST['nicknamePost'], $_POST['passwordPost']);

    //encrypt $_POST['nicknamePost'] and $_POST['passwordPost']
    $_POST['nicknamePost'] = encrypt($_POST['nicknamePost'], $key);
    $_POST['passwordPost'] = encrypt($_POST['passwordPost'], $key);

    //start connection with db and return link
    $link = db_connection();

    //query FROM users
    $rs = mysqli_query($link, "SELECT nickname,password FROM users WHERE nickname='".decrypt($_POST['nicknamePost'], $key)."'");
    $rs = mysqli_fetch_assoc($rs);


    //teste vars
    if ($rs['nickname']===decrypt($_POST['nicknamePost'], $key )){
      echo "nickname OK!";
    } else {
      echo "nickname Invalido!";
    }
    if (decrypt($rs['password'], $key)===decrypt($_POST['passwordPost'], $key)){
      echo "password OK!";
    } else {
      echo "password Invalido!";
    }

  }

?>
