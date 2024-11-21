<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Captura os dados do formulário
    $nome = htmlspecialchars($_POST['nome']);
    $sobrenome = htmlspecialchars($_POST['sobrenome']);
    $email = htmlspecialchars($_POST['email']);
    $assunto = htmlspecialchars($_POST['assunto']);
    $mensagem = htmlspecialchars($_POST['mensagem']);

    // Verifica o reCAPTCHA
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $secretKey = "6LfjfoUqAAAAALsisxLAv_ryzwGUtVf1hHVg1Fj8";
    $recaptchaURL = "https://www.google.com/recaptcha/api/siteverify";
    
    // Valida o reCAPTCHA
    $response = file_get_contents("$recaptchaURL?secret=$secretKey&response=$recaptchaResponse");
    $responseKeys = json_decode($response, true);

    if (!$responseKeys["success"]) {
        die("Erro na validação do reCAPTCHA. Tente novamente.");
    }

    // Configuração do email
    $to = "contatothalitaa@gmail.com";
    $subject = "Contato de $nome $sobrenome - $assunto";
    $body = "Você recebeu uma nova mensagem:\n\n";
    $body .= "Nome: $nome $sobrenome\n";
    $body .= "Email: $email\n";
    $body .= "Assunto: $assunto\n";
    $body .= "Mensagem:\n$mensagem\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Envia o email
    if (mail($to, $subject, $body, $headers)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar a mensagem.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>


