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
	$departure = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_GET["partenza"])));
        $arrival = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_GET["arrivo"])));
        $date = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_GET["data_partenza"])));
        $number = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_GET["persone"])));
        $message = trim($_GET["messaggio"]);
        
       
        
        # Mail Content
        $content = "Nome: $name\n";
        $content .= "Cognome: $last\n\n";
        $content .= "Email: $email\n\n";
        $content .= "Cellulare: $phone\n";
        $content .= "Luogo di partenza: $departure\n";
        $content .= "Luogo di arrivo: $arrival\n";
        $content .= "Data indicativa di partenza: $date\n";
        $content .= "Numero persone: $number\n";
        $content .= "Altre note: \n$message\n";

        # email headers.
        $headers = "From: $name <$email>";

       
       # Send the email.
        $success = mail($mail_to, $subject, $content, $headers);
        if ($success) {
            # Set a 200 (okay) response code.
            http_response_code(200);
            echo "Gentile ".$name. ", il messaggio è stato inviato correttamente.\n Nel ringraziarti per averci contattato, ti assicuriamo che stiamo già lavorando alla tua richiesta e ti forniremo nel più breve tempo possibile tutte le informazioni di cui necessiti.";
        } else {
            # Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Qualcosa è andato storto, il messaggio non è stato inviato. Ti preghiamo di riprovare. A presto";
        }

    } else {
        # Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "C'è un errore nell'invio del messaggio. Ti preghiamo di riprovare. A presto.";
    }

   

?>
	