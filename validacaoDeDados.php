<?php
//dados do formularios
$nome = $_POST["nome"];
$genero = $_POST["gen"];
$dataNasc = $_POST["data_nasc"];
$telefone = $_POST["tel"];
$email = $_POST["email"];

//limpeza dos dados
$nomes = filter_var($nome, FILTER_SANITIZE_STRING);
$telefones = filter_var($telefone, FILTER_SANITIZE_NUMBER_INT);
$emails = filter_var($email, FILTER_SANITIZE_EMAIL);

echo $nomes."<br>";//teste ---- tira as tags html do input

//VALIDAÇÂO
//validação telefone
    if (!filter_var($telefones, FILTER_VALIDATE_INT) === false) {
        echo "Telefone válido! <br>";
    } else{
        echo "telefone inválido! <br>";
    }

//validação email
    if (!filter_var($emails, FILTER_VALIDATE_EMAIL) === false) {
        echo $emails. "Email válido!<br>";
    } else {
        echo $emails. "Email inválido!<br>";
    }

//validação data de nascimmento 
    $array = explode ('-', $dataNasc);

    if (count($array) == 3) {
        $dia = $array[0];
        $mes = $array[1];
        $ano = $array[2]; 
    }

    if (checkdate($mes, $dia, $ano)) {
        echo "Data ".$dataNasc." é válida<br>";
    } else {
        echo "Data ".$dataNasc." é inválida<br>";
    }

?>