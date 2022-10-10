<?php

if(isset($_POST['enviar'])) {
//dados do formularios
$nome = $_POST["nome"];
$genero = $_POST["gen"];
$dataNasc = $_POST["data_nasc"];
$telefone = $_POST["tel"];
$email = $_POST["email"];

//erros
$erros = [];

// SANITIZAR limpeza dos dados
$nomes = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$telefones = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_NUMBER_INT);
$emails = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

//VALIDAÇÂO APOS SANITIZAR
//validação telefone
    if (!filter_var($telefones, FILTER_VALIDATE_INT)) {
        $erros[] = "Telefone inválido!";
    }

//validação email
    if (!filter_var($emails, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "Email inválido!";
    }

//validação data de nascimmento 
    $array = explode ('-', $dataNasc);

    if (count($array) == 3) {
        $dia = $array[0];
        $mes = $array[1];
        $ano = $array[2]; 
    }

    if (checkdate($dia, $mes, $ano)) {
        echo "Data válida<br>";

    } else {
        $erros[] = "Data inválida!";
    }

//array erros
    if (!empty($erros)) {
        foreach($erros as $erro) {
            echo "<li>$erro</li>";
        }
    } else {
        echo "<p>Dados corretos.</p>";
    }

//Mostra os dados
echo "<hr>";
echo "Nome: $nomes <br>";
echo "Data de nascimento: $dataNasc <br>";
echo "Telefone: $telefones <br>";
echo "Email: $emails <br>";

}
?>