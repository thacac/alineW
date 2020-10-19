<?php

namespace Controller;

use \W\Controller\Controller;
use Services\MailService\Mailer;

class ContactController extends Controller
{

    /**
     * Page d'accueil par défaut
     */
    public function contact()
    {
        return $this->render('contact/contact');
    }

    public function sendMail()
    {
        $mail =  new mailer();
        $result = $mail->sendMail($_POST);
        $messTtype = array_keys($result)[0]; 
        $this->addFlash($messTtype,$result[$messTtype]);
        $this->contact;

    }
}
