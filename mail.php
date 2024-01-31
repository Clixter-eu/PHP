<? session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = strip_tags(trim($_POST["name"]));
    $phone = strip_tags(trim($_POST["phone"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));

    if (empty($name) or empty($message) or !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Fehlermeldung
        $_SESSION['msg'] = "Bitte füllen Sie das Formular korrekt aus.";
    } else {
        $recipient = "Empfänger@online.de"; // Ändern Sie diese E-Mail-Adresse
        $subject = "Neue Kontaktanfrage von $name";
        $email_content = "Name: $name\n";
        $email_content .= "Telefon: $phone\n";
        $email_content .= "E-Mail: $email\n\n";
        $email_content .= "Nachricht:\n$message\n";

        $email_headers = "From: $name <$email>";

        if (mail($recipient, $subject, $email_content, $email_headers)) {
            $_SESSION['msg'] = "Vielen Dank! Ihre Nachricht wurde gesendet.";
        } else {
            $_SESSION['msg'] = "Entschuldigung, es gab ein Problem beim Senden Ihrer Nachricht.";
        }
    }
    header('Location: {URl Weiterleitung "{https://url.de}"'); // Wird nach dem absenden aufgerufen
    exit;
}


?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt Formular</title>
    <style>
        .center {
            display: flex;
            flex-direction: column;
            align-items: left;
            margin: 10px;
        }
        .form {
            margin: 10px;
            align-items: left;
        }
    </style>
</head>

<body>
    <div class="center">
        <h1>Kontaktformular</h1>
        <form action="contact.php" method="post">
            <div class="form">
                <input name="name" type="text" class="" id="name" placeholder="Dein Name">
            </div>
            <div class="form">
                <input name="email" type="email" class="" id="email" placeholder="Deine E-mail E-Mail-Adresse">
            </div>
            <div class="form">
                <input name="phone" type="text" class="" id="phone" placeholder="Handy Nr. ">
            </div>
            <div class="form">
                <textarea name="message" class="" placeholder="Beschriebe dein Anliegen" id="message" style="height: 150px"></textarea>
            </div>
            <div class="col-12">
                <button class="btn btn-primary w-100 py-3" type="submit">Anfrage abschicken</button>
            </div>
            <div class="form">
        </form>
    </div>
</body>

</html>
