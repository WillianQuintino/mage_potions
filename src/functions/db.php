<?php
  //Function for connection to db
  function db_connection(){
    //Receve variable define in ../config/db-config.php.
    $host       = DB_HOST;
    $password   = DB_PASSWORD;
    $user       = DB_USER;
    $db         = DB_NAME;

    //effects connection to db and return the access for variable $link
    error_reporting(E_ERROR | E_PARSE);
    $link = mysqli_connect($host, $user, $password, $db);
    return $link;
  }
?>
