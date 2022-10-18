<?php

    if (isset($_POST['enviar'])) {

        if (is_array($_POST['user'])) {
            //ARRAY - receber dados do formulario
            $dadosUser = [];

            //ERROS
            $erros = [];

            //Passado dados do formluario
            $dadosUser['nome'] = $_POST['user']['nome'];
            $dadosUser['dataNasc'] = $_POST['user']['dataNasc'];
            $dadosUser['telefone'] = $_POST['user']['telefone'];
            $dadosUser['email'] = $_POST['user']['email'];
            $dadosUser['genero'] = $_POST['user']['gen'];
        
            //SANITIZAR - limpeza dos dados
            $dadosUser['nome']  = filter_var($dadosUser['nome'], FILTER_SANITIZE_STRING);
            $dadosUser['telefone'] = filter_var($dadosUser['telefone'], FILTER_SANITIZE_NUMBER_INT);
            $dadosUser['email']  = filter_var($dadosUser['email'], FILTER_SANITIZE_EMAIL);
        
            //VALIDAÇÂO APÓS SANITIZAR
            //validação telefone
                if (!filter_var($dadosUser['telefone'], FILTER_VALIDATE_INT)) {
                    $erros[] = "Telefone inválido!";
                }
            
            //validação email
                if (!filter_var($dadosUser['email'], FILTER_VALIDATE_EMAIL)) {
                    $erros[] = "Email inválido!";
                }
            
            //validação data de nascimmento 
                $array = explode ('-', $dadosUser['dataNasc']);
    
                if (!checkdate($array[0], $array[1], $array[2])) {
                    $erros[] = "Data inválida!";
                }
            
            //
                $opcoes_gen = ['Masculino','Feminino','N/I']; //array com as opocoes do formulario
                if (in_array($dadosUser['genero'], $opcoes_gen)){
                    $dadosUser['genero'] = filter_var($dadosUser['genero'], FILTER_SANITIZE_STRING); 
                }


            //array erros
                if (!empty($erros)) {
                    foreach($erros as $erro) {
                        echo "<li>$erro</li>";
                    }
                } else {
                    echo "Dados corretos.<br><br>";
                }
           
            //salvando dados no arquivo json
            $jsonDados = @json_decode(file_get_contents('dadsoUser.json'), true);

            if (!$jsonDados)
                $jsonDados = [];     
    
            if (isset($dadosUser)) {
                $jsonDados[] = $dadosUser;

                    $file = fopen('dadosUser.json', 'a+');
                    fwrite($file, json_encode($jsonDados, JSON_PRETTY_PRINT));

                    fclose($file);        
                }
                $erro = json_last_error();
                print_r ($erro);

            }
            //var_dump($dadosUser);
            //var_dump($jsonDados);

            
    }
?>

