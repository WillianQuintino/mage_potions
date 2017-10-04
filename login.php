<?php

  // Include config in code
  include_once 'src\config\db.config';

  //Include funtions in code
  include_once 'src\funtions\db.php';
  include_once 'src\funtions\security.php';

  if(isset($_POST['nikenamePost']) AND isset($_POST['passwordPost'])){

    //make a key for encrypt
    $key = makeKey($_POST['nikenamePost'], $_POST['passwordPost']);

    //encrypt $_POST['nikenamePost'] and $_POST['passwordPost']
    $_POST['nikenamePost'] = encrypt($_POST['nikenamePost'], $key);
    $_POST['passwordPost'] = encrypt($_POST['passwordPost'], $key);

    //start connection with db and return link
    $link = db_connection();

    //query FROM users
    $rs = mysqli_query($link, "SELECT nikename,password FROM users WHERE nikename='".decrypt($_POST['nikenamePost'], $key)."'");
    $rs = mysqli_fetch_assoc($rs);
    //teste vars
    if ($rs['nikename']===decrypt($_POST['nikenamePost'], $key )){
      echo "nikename OK!";
    } else {
      echo "nikename Invalido!";
    }
    if (decrypt($rs['password'], $key)===decrypt($_POST['passwordPost'], $key)){
      echo "password OK!";
    } else {
      echo "password Invalido!";
    }

  }

?>
