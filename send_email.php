<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Captura os dados do formulário
    $nome = htmlspecialchars($_POST['nome']);
    $sobrenome = htmlspecialchars($_POST['sobrenome']);
    $email = htmlspecialchars($_POST['email']);
    $assunto = htmlspecialchars($_POST['assunto']);
    $mensagem = htmlspecialchars($_POST['mensagem']);

    // Configuração do email
    $to = "contatothalitaa@gmail.com";
    $subject = "Contato de $nome $sobrenome - $assunto";
    $body = "Você recebeu uma nova mensagem:\n\n";
    $body .= "Nome: $nome $sobrenome\n";
    $body .= "Email: $email\n";
    $body .= "Assunto: $assunto\n";
    $body .= "Mensagem:\n$mensagem\n";

    $headers = "From: noreply@seudominio.com\r\n"; // Substitua por um email válido do domínio do servidor
    $headers .= "Reply-To: $email\r\n";

    // Envia o email
    if (mail($to, $subject, $body, $headers)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar a mensagem. Por favor, tente novamente mais tarde.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>




