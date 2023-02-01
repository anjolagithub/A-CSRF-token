<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- title -->
    <title>PHP CSRF PROTECTION</title>
    <!-- Default stylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <!-- JQuery -->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!-- styles -->
    <style>
        .error-field {
            border: 1px solid #d96557;
        }

        .send-button {
            cursor: pointer;
            background: #3cb73c;
            border: #36a536 1px solid;
            color: #FFF;
            font-size: 1em;
            width: 100px;
        }
    </style>
</head>

<body>
    <!-- main container -->
    <div class="container">
        <!-- header -->
        <h3>PHP CSRF PROTECTION</h3>
        <!-- POST form -->
        <form action="" method="post" id="frm-contact" onsubmit="return validateContactForm()">
            <!-- row userName-->
            <div class="row">
                <!-- userName label -->
                <div class="label">
                    Name: <span id="userName-info" class="validation-message"></span>
                </div>
                <input type="text" name="userName" id="userName" class="frm-input" value="<?php if (!empty($_POST['userName'])&& $type == 'error') {
    echo $_POST['userName'];
}?>">
            </div>
            <!-- row userName ends here-->
            <!-- row email-->
            <div class="row">
                <!-- email label -->
                <div class="label">
                    Email: <span id="email" class="validation-message"></span>
                </div>
                <in
                put type="email" name="email" id="email" class="frm-input" value="<?php if (!empty($_POST['email'])&& $type == 'error') {
    echo $_POST['email'];
}?>">
            </div>
            <!-- row email ends here-->
            <!-- row userName-->
            <div class="row">
                <!-- subject label -->
                <div class="label">
                    Subject: <span id="subject-info" class="validation-message"></span>
                </div>
                <input type="text" name="subject" id="subject" class="frm-input" value="<?php if (!empty($_POST['subject'])&& $type == 'error') {
    echo $_POST['userName'];
}?>">
            </div>
            <!-- row subject ends here-->
            <!-- row message starts here-->
            <div class="row">
                <div class="label">
                    Message: <span id="userMessage-info" class="validation-message"></span>
                </div>
                <textarea name="content" id="content" class="phppot-input" cols="60" rows="6"></textarea>
            </div>
            <!-- row message ends here-->
            <!-- submit/send info -->
            <div class="row">
                <input type="submit" name="send" class="send-button" value="Send" />
            </div>
        </form>

    <script src="assets/js/validate.js"></script>
    <?php
use MailService;

session_start();
if (!empty($_POST['send'])) {
    require_once __DIR__ . '/lib/SecurityService.php';
    $antiCSRF = new SecurityService\securityService();
    $csrfResponse = $antiCSRF->validate();
    if (!empty($csrfResponse)) {
        require_once __DIR__ . '/lib/MailService.php';
        $mailService = new MailService();
        $response = $mailService->sendContactMail($_POST);
        if (!empty($response)) {
            $message = "Hi, we have received your message. Thank you.";
            $type = "success";
        } else {
            $message = "Unable to send email.";
            $type = "error";
        }
    } else {
        $message = "Security alert: Unable to process your request.";
        $type = "error";
    }
}

?>
</body>

</html>