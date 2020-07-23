<?php
    $mail = new phpMailer();

    $mail->isSMTP();
    $mail->charset = 'utf-8';

    $mail->Host = "mail.lennExample.com";
    $mail->SMTPdebug = 0;
    $mail->SMTPAuth = true;
    $mail->Port = 25;
    $mail->Username = 'username';
    $mail->Password = 'password';

    $mail->isHTML(true);
    $mail->Subject = 'order';
    $mail->body = '';
?>