<?php

namespace Brains\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Brains\PlatformBundle\Entity\Exercice;
use Symfony\Component\HttpFoundation\Request;
use Brains\PlatformBundle\Form\ExerciceType;
/*
use Brains\PlatformBundle\Entity\question;
use Brains\PlatformBundle\Form\questionType;

*/



class DefaultController extends Controller
{
    public function indexAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        return $this->render('BrainsPlatformBundle:Default:index.html.twig');
        else return $this->redirectToRoute('login');
    }


    public function send_mailAction()
    {
    	for($i=0;$i<2;$i++){
    	 $message = \Swift_Message::newInstance()
        ->setSubject('Hello Email'.($i+1))
        ->setFrom('test.rmay.no3@gmail.com')
        ->setTo('grini.abdellah@gmail.com')
        ->setBody("watta lah yhdik !!");
        $this->get('mailer')->send($message);
}


   
    $this->get('mailer')->send($message);
     //$this->getMailer()->send("tets");

     return $this->render('BrainsPlatformBundle:Default:index.html.twig');


    }


     public function chatAction()
    {
         return $this->render('BrainsPlatformBundle:Chat:chat.html.twig');
     }





}
