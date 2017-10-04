<?php
  //funtion for make a key for encrypt
  function makeKey($nikename, $password){
    //split nikename and password
    $nikename_key = str_split($nikename, 3);
    $password_key = str_split($password, 3);

    //using firt part split for make key
    $key = $nikename_key[0].$password_key[0];

    $key = openssl_digest ($key , "sha256");
    return $key;
  }

  //funtion for encrypt using key
  function encrypt($data, $key) {
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode($key);
    // Generate an initialization vector
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
    return base64_encode($encrypted . '::' . $iv);
}
  //funtion for decrypt using key
  function decrypt($data, $key) {
      // Remove the base64 encoding from our key
      $encryption_key = base64_decode($key);
      // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
      list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
      return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
  }
?>
