<?php
use PHPMailer\PHPMailer\PHPMailer;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $mail_to = "ebenitesg@gmail.com";
        $credito= $_POST["credito"];
        $monto = $_POST["monto"];
        $plazo = $_POST["plazo"];
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

        $content = "<p>Credito: $credito <br>";
        $content .= "Monto: $monto <br>";
        $content .= "Plazo: $plazo <br>";
        $content .= "Nombres: $names <br>";
        $content .= "Apellidos:$lastname <br>";
        $content .= "Tipo de documento:$typeDocument <br>";
        $content .= "Numero de documento:$numberDocument <br>";
        $content .= "Numero telefono:$phone <br>";
        $content .= "E-mail: $email <br>";

        require_once 'PHPMailer/vendor/autoload.php';

        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = "email-smtp.us-west-2.amazonaws.com";  // Indicamos los servidores SMTP
        $mail->SMTPAuth = true;                               // Habilitamos la autenticación SMTP
        $mail->Username = "AKIATSW7M2FVT3NYREPS";                 // SMTP username
        $mail->Password = "BLtJj1SQ3CymZOBeEYhsuUyPa5V3nVqDCdf7Ia/y24Z7";                    // SMTP password
        $mail->SMTPSecure = 'tls';                            // Habilitar encriptación TLS o SSL
        $mail->Port = 587;
        //Set who the message is to be sent from
        $mail->setFrom($email, $names);
        //Set an alternative reply-to address
        //$mail->addReplyTo('replyto@example.com', 'First Last');
        //Set who the message is to be sent to
        $mail->addAddress("ebenitesg@gmail.com", "Excinober Benites");
        //Set the subject line
        $mail->Subject = "Solicitud de crédito";
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($content);
        //Replace the plain text body with one created manually
        //$mail->AltBody = 'This is a plain-text message body';
        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');
        //$mail->setLanguage('es');
        $mail->setLanguage('es');
        $mail->CharSet = 'UTF-8';

        if ($mail->send()) {
            echo '<script type="text/javascript">
            alert("La solicitud fue enviada, pronto te contactaremos!");
            window.location.href="/Simulacion"; </script>';

        }else{
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