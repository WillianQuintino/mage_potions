<?php
  // Include config in code
  include_once 'src\config\db.config';
  include_once 'src\config\site.config';

  //Include funtions in code
  include_once 'src\functions\db.php';
  include_once 'src\functions\security.php';

  //Data coming by url
  $id = $_GET['id'];
  $emailMd5 = $_GET['email'];
  $uidMd5 = $_GET['uid'];
  $dataMd5 = $_GET['key'];

  //Search the data base
  $sql = "select email,key,date_ts,user_active from cadastro where id_cadastro = '$id'";
  $sql = mysqli_query( $sql );
  $rs = mysqli_fetch_array( $sql );

  //compare the data what caught base, with the data coming by url
  $valido = true;

  if( $emailMd5 !== encrypt($rs['email'], $key) )
      $valido = false;

  if( $uidMd5 !== $rs['key'] )
      $valido = false;

  if( $dataMd5 !== encrypt($rs['data_ts'], $key) )
      $valido = false;


  // the data is correct, time to activate the registration
  if( $valido === true ) {
      $sql = "update cadastro set ativo='1' where id_cadastro='$id'";
      mysql_query( $sql );
      echo "Cadastro ativado com sucesso!";
  } else {
      echo "Informações inválidas";
  }

?>
