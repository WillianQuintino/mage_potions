<?php
    function sendVerificationMail($id, $name, $email, $key, $date_ts){
      //Make the variables for validate the email
        $url = sprintf( 'id=%s&email=%s&uid=%s&key=%s',$id, encrypt($email, $key), $key, encrypt($data_ts, $key) );

        $mensagem = sprintf('Olá %s, Seja Bem Vindo ao %s', $nome, NOME_GAME);
        $mensagem .= 'Para confirmar seu cadastro acesse o link:'."\n";
        $mensagem .= sprintf('http://localhost/ativar.php?%s',$url);

        //send email
        mail( $email, 'Confirmacao de cadastro', $mensagem );


    }

?>
