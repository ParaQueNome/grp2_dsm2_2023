<?php

require_once('Classes/Participante.php');
// Backend do cadastro de usuários do HTML

// Realizando a checagem do método de requisicao
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    
    
<<<<<<< HEAD

    //Instancia o objeto participante já conectando ao banco de dados
=======
    // Verifica se o campo dt_nascimento foi preenchido e é uma data válida
    if (empty($_POST["dt_nascimento"]) || !strtotime($_POST["dt_nascimento"])) {
        echo "O campo data de nascimento é obrigatório e deve ser uma data válida";
        exit;
    }
    
    // Verifica se o campo senha foi preenchido
    if (empty($_POST["senha"])) {
        echo "O campo senha é obrigatório";
        exit;
    }
    
    if($_POST['senha'] != $_POST['confirmasenha']){
        echo "Senhas não conferem";
        exit;
    }
        
    
    // Se todos os campos foram preenchidos corretamente, cadastra o participante
>>>>>>> a9193ade63a2f3622100401ad3e650dd75f0b3f0
    $participante = new Participante($servername, $username, $password, $dbname);
    //Declarando as variaveis recebidas via POST
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $idade = $_POST['dt_nascimento'];
    $senha = $_POST['senha'];
    $confirmasenha = $_POST['confirmaSenha'];
    //Realizando as verificacoes das variaveis
    $confirmasenha = $_POST['confirmaSenha'];
    $participante->verificaNome($nome);
    $participante->verificaEmail($email);
    $participante->verificaData($idade);
    $participante->comparaSenha($senha,$confirmasenha);

    

    // Se todos os campos foram preenchidos corretamente, cadastra o participante
    $participante->cadastrar($nome, $idade, $email, $senha);

    unset($participante);
}

?>
