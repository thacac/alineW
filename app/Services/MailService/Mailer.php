<?php

namespace Services\MailService;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    private $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer();
        $this->mailer->isSMTP();                                       // Send using SMTP
        $this->mailer->Port = getApp()->getConfig('mail_port');                             // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $this->mailer->Host       = getApp()->getConfig('mail_host');                     // Set the SMTP server to send through
        $this->mailer->SMTPAuth   = getApp()->getConfig('smtp_auth');                     // Enable SMTP authentication
        $this->mailer->Username   = getApp()->getConfig('user_mail');                     // SMTP username
        $this->mailer->Password   = getApp()->getConfig('pwd_mail');
    }

    public function sendMail(array $form, string $filename = null)
    {

        $cleanData = $form;

        if ($cleanData) {
            try {
                //Server settings
                // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged

                //Recipients
                $this->mailer->setFrom($cleanData['email'], $cleanData['name']);
                $this->mailer->addAddress('joe@example.net', 'Joe User');     // Add a recipient
                $this->mailer->addReplyTo($cleanData['email'], $cleanData['name']);

                ($filename !== null) ? $this->mailer->addAttachment($filename) : false;

                // Content
                $this->mailer->isHTML(true);                                  // Set email format to HTML
                $this->mailer->Subject = 'contact';
                $this->mailer->Body    = '<p>' . $cleanData['message'] . '</p>';
                $this->mailer->AltBody = $cleanData['message'];

                $this->mailer->send();
                return ['success'=>'Message has been sent'];
            } catch (Exception $e) {
                return ['danger' => "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}"];
            }
        }
    }
}
