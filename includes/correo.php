<?php

/*if (isset($_POST['enviar'])) {

        if (!empty($_POST['names']) && 
        !empty($_POST['lastname']) && 
        !empty($_POST['typeDocument']) && 
        !empty($_POST['numberDocument']) && 
        !empty($_POST['phone']) && 
        !empty($_POST['email'])) {
            
        $names = $_POST['names'];
        $lastname = $_POST['lastname'];
        $typeDocument = $_POST['numberDocument'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $header = "From: deibyrayo95@gmail.com" . "\r\n";
        $header.= "Reply-To: deibyrayo95@gmail.com". "\r\n";
        $header.= "X-Mailer: PHP/". phpversion();
        $mail = @mail($email,$names,$lastname,$typeDocument,$phone);
        if ($email) {
            echo "<h4>¡Correo enviado exitosamente!<h4></h4>";
        }
    }
}*/


if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $mail_to = "deiby.developer@gmail.com";
        $credito= ($_POST["credito"]);
        $monto = ($_POST["monto"]);
        $plazo = ($_POST["plazo"]);
        $lastname = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["lastname"])));
        $names = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["names"])));
        $typeDocument = trim($_POST["typeDocument"]);
        $numberDocument = trim($_POST["numberDocument"]);
        $phone = trim($_POST["phone"]);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        
        if ( empty($names) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($_POST['lastname']) 
        OR empty($_POST['typeDocument']) 
        OR empty($_POST['numberDocument'])
        OR empty($_POST['credito']) 
        OR empty($_POST['monto'])
        OR empty($_POST['plazo']) 
        OR empty($_POST['phone'])) {
            echo '<script type="text/javascript">
        alert("Por favor verifique la información");
        window.location.href="/Simulacion";
        </script>';

            exit;
        }
        
        $content = "Credito: $credito\n";
        $content = "Monto: $monto\n";
        $content = "Plazo: $plazo\n";
        $content = "Nombres: $names\n";
        $content .= "Apellidos:$lastname\n";
        $content .= "Tipo de documento:$typeDocument\n";
        $content .= "Numero de documento:$numberDocument\n";
        $content .= "Numero telefono:$phone\n";
        $content .= "E-mail: $email\n\n";
        
        $headers = "From: $name <$email>";

        $success = mail($mail_to, "Solicitud de credito", $content, $headers);

        if ($success) {
            echo '<script type="text/javascript">
        alert("Se envio exitosamente");
        window.location.href="/Simulacion";
        </script>';

        } else {
            echo '<script type="text/javascript">
        alert("Ups, algo ha salido mal, no pudimos enviar tu mensaje");
        window.location.href="/Simulacion";
        </script>';

        }
    } else {
        echo '<script type="text/javascript">
        alert("Hubo un problema con tu envio, intentalo nuevamente");
        window.location.href="/Simulacion";
        </script>';
    }

?>