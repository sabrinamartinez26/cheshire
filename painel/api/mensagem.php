<?php
  $url = "http://api.enviame.com.br/send-text";

  $data = array('instance' => $instancia_api,
                'to' => $telefone_envio,
                'token' => $token_api,
                'message' => $mensagem);


  $options = array('http' => array(
                 'method' => 'POST',
                 'content' => http_build_query($data)
  ));

  $stream = stream_context_create($options);

  $result = @file_get_contents($url, false, $stream);

  //echo $result;
?>
  