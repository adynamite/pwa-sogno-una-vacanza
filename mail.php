<?php

 header('Content-Type: text/html; charset=ISO-8859-1');

    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        # FIX: Replace this email with recipient email
        $mail_to = "adina.informatica@gmail.com";
        
        # Sender Data
        
        $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_GET["nome"])));
        $last = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_GET["cognome"])));
        $email = filter_var(trim($_GET["email"]), FILTER_SANITIZE_EMAIL);
        $phone = trim($_GET["cellulare"]);
        $message = trim($_GET["messaggio"]);
        
       
        
        # Mail Content
        $content = "Nome: $name\n";
        $content .= "Cognome: $last\n\n";
        $content .= "Email: $email\n\n";
        $content .= "Cellulare: $phone\n";
        $content .= "Messaggio: \n$message\n";

        # email headers.
        $headers = "From: $name <$email>";

        # Send the email.
       # Send the email.
        $success = mail($mail_to, $subject, $content, $headers);
        if ($success) {
            # Set a 200 (okay) response code.
            http_response_code(200);
            echo "Grazie per averci contattato! Ti informiamo che il tuo messaggio è stato inviato con successo. Sarai ricontattato nel più breve tempo possibile. A presto.";
        } else {
            # Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Qualcosa è andato storto, il messaggio non è stato inviato. Ti preghiamo di riprovare. A presto";
        }

    } 

   

?>
	