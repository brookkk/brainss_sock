<?php

namespace Brains\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BrainsPlatformBundle:Default:index.html.twig');
    }


    public function send_mailAction()
    {
    	for($i=0;$i<2;$i++){
    	 $message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('test.rmay.no2@gmail.com')
        ->setTo('grini.abdellah@gmail.com')
        ->setBody("hello world ".($i+1));
        $this->get('mailer')->send($message);
}

       // echo("wtf");



            /*$this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                'mail.html.twig',
                array('name' => 'abdellah')
            )*/
        
        /*
         * If you also want to include a plaintext version of the message
        ->addPart(
            $this->renderView(
                'Emails/registration.txt.twig',
                array('name' => $name)
            ),
            'text/plain'
        )
        */
   
    $this->get('mailer')->send($message);
     //$this->getMailer()->send("tets");

     return $this->render('BrainsPlatformBundle:Default:index.html.twig');


    }

}
