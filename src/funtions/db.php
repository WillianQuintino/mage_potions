<? php
  //Função para Coneção no db
  function db_connection(){
    //Recebe variaveis derinidas em ../config/db-config.php.
    $host       = DB_HOST;
    $password   = DB_PASSWORD;
    $user       = DB_USER;
    $db         = DB_NAME;

    //efetua conecção no db e retona o acesso para variavel $link
    error_reporting(E_ERROR | E_PARSE);
    $link = mysqli_connect($host, $user, $password, $db);
    return $link;
  }
?>
